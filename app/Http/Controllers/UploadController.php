<?php

namespace App\Http\Controllers;

use App\Imports\DeliveriesImport;
use App\Models\BulkUploadLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function index(): View
    {
        return view('uploads.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240',
            ],
        ], [
            'file.required' => 'Please select an Excel or CSV file.',
            'file.mimes' => 'The file must be .xlsx, .xls, or .csv.',
            'file.max' => 'The file must not exceed 10MB.',
        ]);

        $file = $request->file('file');
        $import = new DeliveriesImport;

        try {
            Excel::import($import, $file);

            $total = $import->successCount + $import->duplicateCount + $import->failureCount;
            $success = $import->successCount;
            $duplicates = $import->duplicateCount;
            $failures = $import->failureCount;

            if (auth()->check()) {
                BulkUploadLog::create([
                    'filename' => $file->getFilename(),
                    'original_filename' => $file->getClientOriginalName(),
                    'file_path' => 'upload/'.now()->format('Y-m-d').'/'.$file->getClientOriginalName(),
                    'file_size' => (string) $file->getSize(),
                    'uploaded_by' => auth()->id(),
                    'total_records' => $total,
                    'success_count' => $success,
                    'failure_count' => $failures,
                    'duplicate_count' => $duplicates,
                    'status' => $failures > 0 && $success === 0 ? BulkUploadLog::STATUS_FAILED : BulkUploadLog::STATUS_COMPLETED,
                    'errors' => $import->errors,
                    'processing_started_at' => now(),
                    'processing_completed_at' => now(),
                ]);
            }

            $parts = [];
            if ($success > 0) {
                $parts[] = "{$success} record(s) imported.";
            }
            if ($duplicates > 0) {
                $parts[] = "{$duplicates} duplicate(s) skipped.";
            }
            if ($failures > 0) {
                $parts[] = "{$failures} row(s) failed.";
            }

            $message = implode(' ', $parts) ?: 'No data rows found.';
            $type = $success > 0 ? 'success' : ($failures > 0 ? 'danger' : 'warning');

            return redirect()->route('uploads.index')
                ->with('message', $message)
                ->with('messageType', $type);
        } catch (\Throwable $e) {
            return redirect()->route('uploads.index')
                ->with('message', 'Import failed: '.$e->getMessage())
                ->with('messageType', 'danger');
        }
    }
}

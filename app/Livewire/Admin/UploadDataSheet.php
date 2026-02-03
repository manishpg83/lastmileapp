<?php

namespace App\Livewire\Admin;

use App\Imports\DeliveriesImport;
use App\Models\BulkUploadLog;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.app')]
class UploadDataSheet extends Component
{
    use WithFileUploads;

    public $file = null;

    public ?string $message = null;

    public ?string $messageType = null;

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Please select an Excel or CSV file.',
            'file.mimes' => 'The file must be .xlsx, .xls, or .csv.',
            'file.max' => 'The file must not exceed 10MB.',
        ];
    }

    public function upload(): void
    {
        $this->validate();
        $this->message = null;
        $this->messageType = null;

        $import = new DeliveriesImport;

        try {
            Excel::import($import, $this->file->getRealPath());

            $total = $import->successCount + $import->duplicateCount + $import->failureCount;
            $success = $import->successCount;
            $duplicates = $import->duplicateCount;
            $failures = $import->failureCount;

            if (auth()->check()) {
                BulkUploadLog::create([
                    'filename' => $this->file->getFilename(),
                    'original_filename' => $this->file->getClientOriginalName(),
                    'file_path' => 'upload/'.now()->format('Y-m-d').'/'.$this->file->getClientOriginalName(),
                    'file_size' => (string) $this->file->getSize(),
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

            $this->message = implode(' ', $parts) ?: 'No data rows found.';
            $this->messageType = $success > 0 ? 'success' : ($failures > 0 ? 'danger' : 'warning');

            // Log System Notification
            Notification::create([
                'type' => 'bulk_import',
                'level' => $this->messageType === 'danger' ? Notification::LEVEL_ERROR : ($this->messageType === 'warning' ? Notification::LEVEL_WARNING : Notification::LEVEL_SUCCESS),
                'notifiable_type' => \App\Models\User::class,
                'notifiable_id' => auth()->id(),
                'title' => 'Bulk Import Completed',
                'message' => 'File: "' . $this->file->getClientOriginalName() . '" - ' . $this->message,
            ]);

            $this->reset('file');
        } catch (\Throwable $e) {
            Log::channel('single')->error('UploadDataSheet: import exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->message = 'Import failed: '.$e->getMessage();
            $this->messageType = 'danger';
        }
    }

    public function render()
    {
        return view('livewire.admin.upload-data-sheet');
    }
}

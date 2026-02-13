<?php

namespace App\Imports;

use App\Models\Delivery;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeliveriesImport implements ToCollection, WithHeadingRow
{
    public int $successCount = 0;

    public int $duplicateCount = 0;

    public int $failureCount = 0;

    public array $errors = [];

    public function collection(Collection $rows): void
    {
        $rowCount = $rows->count();
        Log::channel('single')->info('DeliveriesImport: collection() called', ['row_count' => $rowCount]);

        if ($rowCount > 0) {
            $firstRow = $rows->first();
            $firstArr = $firstRow instanceof Collection ? $firstRow->all() : (array) $firstRow;
            $rawKeys = array_keys($firstArr);
            Log::channel('single')->info('DeliveriesImport: first row raw keys', ['keys' => $rawKeys, 'sample' => $firstArr]);
        }

        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;

            $customerName = $this->getRowValue($row, ['customer_name', 'customer name']);
            $companyName = $this->getRowValue($row, ['company_name', 'company name']);
            $docketNumber = $this->getRowValue($row, ['docket_number', 'docket number']);
            $address = $this->getRowValue($row, ['delivery_address', 'delivery address', 'address']);
            $phone = $this->getRowValue($row, ['phone_number', 'phone number', 'phone']);
            $pincode = $this->getRowValue($row, ['pincode', 'pin_code', 'pin code']);
            $package = $this->getRowValue($row, ['package', 'pkg', 'Pkg', 'Package']);

            if ($index < 2) {
                Log::channel('single')->info("DeliveriesImport: row {$rowNumber} extracted", [
                    'customer_name' => $customerName,
                    'docket_number' => $docketNumber,
                    'address' => $address,
                    'phone' => $phone,
                    'pincode' => $pincode,
                    'package' => $package,
                ]);
            }

            if (empty($customerName) && empty($docketNumber) && empty($address) && empty($phone)) {
                Log::channel('single')->debug("DeliveriesImport: row {$rowNumber} skipped (empty)");

                continue;
            }

            $missing = [];
            if (blank($customerName)) {
                $missing[] = 'Customer Name';
            }
            if (blank($companyName)) {
                $missing[] = 'Company Name';
            }
            if (blank($docketNumber)) {
                $missing[] = 'Docket Number';
            }
            if (blank($address)) {
                $missing[] = 'Delivery Address';
            }
            if (blank($phone)) {
                $missing[] = 'Phone Number';
            }
            if (blank($pincode)) {
                $missing[] = 'Pincode';
            }
            if (blank($package)) {
                $missing[] = 'Package';
            }

            if (! empty($missing)) {
                $this->failureCount++;
                $this->errors[] = "Row {$rowNumber}: Missing required columns: ".implode(', ', $missing);

                continue;
            }

            $docketNumber = (string) $docketNumber;
            if (Delivery::where('docket_number', $docketNumber)->exists()) {
                $this->duplicateCount++;
                $this->errors[] = "Row {$rowNumber}: Docket number '{$docketNumber}' already exists.";

                continue;
            }

            try {
                Delivery::create([
                    'docket_number' => $docketNumber,
                    'customer_name' => (string) $customerName,
                    'company_name' => (string) $customerName,
                    'address' => (string) $address,
                    'pincode' => $pincode !== null ? (string) $pincode : null,
                    'phone' => (string) $phone,
                    'package' => $package,
                    //'weight' => $weight ? (float) filter_var($weight, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null,
                    'status' => Delivery::STATUS_PENDING,
                ]);
                $this->successCount++;
                Log::channel('single')->debug("DeliveriesImport: row {$rowNumber} created", ['docket' => $docketNumber]);
            } catch (\Throwable $e) {
                $this->failureCount++;
                $this->errors[] = "Row {$rowNumber}: ".$e->getMessage();
                Log::channel('single')->error("DeliveriesImport: row {$rowNumber} exception", [
                    'message' => $e->getMessage(),
                    'docket' => $docketNumber,
                ]);
            }
        }
    }

    /**
     * @param  array<string, mixed>|Collection<string, mixed>  $row
     * @param  array<int, string>  $keys
     */
    private function getRowValue(array|Collection $row, array $keys): mixed
    {
        $arr = $row instanceof Collection ? $row->all() : $row;
        $normalizedRow = [];
        foreach (array_keys($arr) as $k) {
            $normalizedRow[str_replace([' ', '-'], '_', strtolower((string) $k))] = $arr[$k];
        }

        foreach ($keys as $key) {
            $normalized = str_replace([' ', '-'], '_', strtolower($key));
            if (isset($normalizedRow[$normalized])) {
                $value = $normalizedRow[$normalized];
                if ($value !== null && $value !== '') {
                    return $value;
                }
            }
        }

        return null;
    }
}

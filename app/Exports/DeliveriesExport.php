<?php

namespace App\Exports;

use App\Models\Delivery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DeliveriesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Delivery::with('driver')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Docket Number',
            'Customer Name',
            'Company Name',
            'Phone',
            'Pincode',
            'Package',
            'Driver',
            'Status',
            'Gati Status',
            'Updated At',
        ];
    }

    public function map($delivery): array
    {
        return [
            $delivery->docket_number,
            $delivery->customer_name,
            $delivery->company_name,
            $delivery->phone,
            $delivery->pincode,
            $delivery->package,
            $delivery->driver ? $delivery->driver->name : 'Unassigned',
            ucfirst(str_replace('_', ' ', $delivery->status)),
            $delivery->status === 'delivered' ? 'Done' : 'In Progress',
            $delivery->updated_at->format('d-m-Y h:i A'),
        ];
    }
}

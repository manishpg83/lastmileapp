<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #7367f0;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #7367f0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #7367f0;
            color: white;
            text-align: left;
            padding: 8px;
            font-weight: bold;
            border: 1px solid #7367f0;
        }

        td {
            padding: 8px;
            border: 1px solid #eee;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
            color: #999;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .bg-success {
            background-color: #e8fadf;
            color: #71dd37;
        }

        .bg-warning {
            background-color: #fff2e2;
            color: #ffab00;
        }

        .bg-primary {
            background-color: #e7e7ff;
            color: #696cff;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Master Delivery Report</h2>
        <p>Generated on: {{ now()->format('M d, Y H:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Driver</th>
                <th>Customer</th>
                <th>Company</th>
                <th>Docket</th>
                <th>Pkts</th>
                <th>Phone</th>
                <th>Pincode</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliveries as $delivery)
                <tr>
                    <td>{{ $delivery->driver ? $delivery->driver->name : 'Unassigned' }}</td>
                    <td>{{ $delivery->customer_name ?? '-' }}</td>
                    <td>{{ $delivery->company_name ?? '-' }}</td>
                    <td><strong>{{ $delivery->docket_number }}</strong></td>
                    <td>{{ $delivery->package ?? '-' }}</td>
                    <td>{{ $delivery->phone ?? '-' }}</td>
                    <td>{{ $delivery->pincode ?? '-' }}</td>
                    <td>{{ $delivery->delivered_at ? $delivery->delivered_at->format('d-m-Y') : '-' }}</td>
                    <td>
                        <span class="badge">{{ ucfirst(str_replace('_', ' ', $delivery->status)) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

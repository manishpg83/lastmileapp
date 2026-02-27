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
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #03c3ec;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            color: #03c3ec;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #03c3ec;
            color: white;
            text-align: left;
            padding: 10px;
            font-weight: bold;
            border: 1px solid #03c3ec;
        }

        td {
            padding: 10px;
            border: 1px solid #eee;
        }

        tr:nth-child(even) {
            background-color: #f4fbfd;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 9px;
            color: #999;
        }

        .total-row {
            background-color: #eee !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Driver Wise Performance Report</h2>
        <p>Generated on: {{ now()->format('M d, Y H:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Driver Name</th>
                <th class="text-center">Date</th>
                <th class="text-center">Total Hours</th>
                <th class="text-center">Total Distance (KM)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $row)
                <tr>
                    <td><strong>{{ $row['driver_name'] }}</strong></td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($row['date'])->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $row['formatted_hours'] }}</td>
                    <td class="text-center">{{ number_format($row['km'], 2) }} km</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2"><strong>Grand Total</strong></td>
                <td class="text-center">
                    @php
                        $totalMinutes = collect($entries)->sum('total_minutes');
                        $totalKm = collect($entries)->sum('km');
                    @endphp
                    {{ floor($totalMinutes / 60) }}h {{ $totalMinutes % 60 }}m
                </td>
                <td class="text-center">{{ number_format($totalKm, 2) }} km</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        This is a system generated report.
    </div>
</body>

</html>

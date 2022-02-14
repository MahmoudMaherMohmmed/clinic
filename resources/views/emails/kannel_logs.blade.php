<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px !important;
        }

        tr:nth-child(even) {
            background: #dddddd;
        }

    </style>
</head>

<body>
    @if (isset($kannels_title) && count($kannels_title) > 0)
        @foreach ($kannels_title as $kannel)
            <p><strong>{{ $emails_title[$kannel] }}</strong></p>
            <table>
                <tbody>
                    <tr style="background-color:#dddddd;">
                        <td style="font-weight: bold;">Connection name</td>
                        <td>{{ $kannels_connection[$kannel]['connection_name'] }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Connection Status</td>
                        <td>{{ $kannels_connection[$kannel]['status'] }}</td>
                    </tr>
                    <tr style="background-color:#dddddd;">
                        <td style="font-weight: bold;">Messages Sent</td>
                        <td>{{ $kannels_connection[$kannel]['sent'] }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Messages Queued</td>
                        <td>{{ $kannels_connection[$kannel]['queued'] }}</td>
                    </tr>
                    <tr style="background-color:#dddddd;">
                        <td style="font-weight: bold;">Messages Failed</td>
                        <td>{{ $kannels_connection[$kannel]['failed'] }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Throughput</td>
                        <td>{{ $kannels_connection[$kannel]['throughput'] }}</td>
                    </tr>
                    @if (isset($kannels_connection[$kannel]['excel_link']) && $kannels_connection[$kannel]['excel_link'] != null)
                        <tr style="background-color:#dddddd;">
                            <td style="font-weight: bold;">Excel Link</td>
                            <td><a href="{{ $kannels_connection[$kannel]['excel_link'] }}">View Excel</a></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br /><br /><br />
        @endforeach
    @endif
</body>

</html>

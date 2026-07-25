<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Absentees Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Absentees Report</h2>

    <table>
        <thead>
            <tr>
                <th>Center No</th>
                <th>Date</th>
                <th>Session</th>
                <th>Subject No</th>
                <th>Paper Code</th>
                <th>Index No</th>
                <th>User Id</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absentees as $absent)
                <tr>
                    <td>{{ $absent->center_no }}</td>
                    <td>{{ $absent->date }}</td>
                    <td>{{ $absent->session }}</td>
                    <td>{{ $absent->subject_code }}</td>
                    <td>{{ $absent->paper_code }}</td>
                    <td>{{ $absent->index_no }}</td>
                    <td>{{ $absent->user_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

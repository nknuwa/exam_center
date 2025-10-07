<!DOCTYPE html>
<html>
<head>
    <title>OL Re-Correction</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; padding: 5px; text-align: center; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">OL Re-Correction</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Index No</th>
                <th>Center No</th>
                <th>Subject No</th>
                <th>Paper Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->index_no }}</td>
                    <td>{{ $row->center_no }}</td>
                    <td>{{ $row->subject_no }}</td>
                    <td>{{ $row->paper_code }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

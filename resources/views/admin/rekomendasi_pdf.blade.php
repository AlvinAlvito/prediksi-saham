<!DOCTYPE html>
<html>
<head>
    <title>Hasil Rekomendasi Saham</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Hasil Rekomendasi Saham</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Saham</th>
                <th>Nama Saham</th>
                <th>Nilai Z</th>
                <th>Persentase</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->saham->kode_saham ?? '-' }}</td>
                    <td>{{ $item->saham->nama_saham ?? '-' }}</td>
                    <td>{{ number_format($item->nilai_z, 2) }}</td>
                    <td>{{ number_format($item->persentase, 2) }}%</td>
                    <td>{{ $item->kategori }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

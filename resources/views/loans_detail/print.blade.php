<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data Pinjaman Buku</title>
</head>

<body>
    <h1 style="text-align: center;">Data Pinjaman Buku</h1>
    <p style="text-align: center;">Laporan Data Pinjaman Buku Tahun 2024</p>
    <br />
    <table border="1" style="border-collapse: collapse; align-content: center;">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pinjaman</th>
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
           
            @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->user->name ?? 'Tidak Ditemukan' }}</td>
                        <td>{{ $loan->book->title ?? 'Tidak Ditemukan' }}</td>
                        <td>{{ $loan->created_at }}</td>
                        <td>{{ $loan->updated_at }}</td>
                        <td>
                            @if($loan->return_at < now())
                                <span class="text-danger">Dipinjam</span>
                            @else
                                <span class="text-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            
        </tbody>
    </table>
</body>

</html>

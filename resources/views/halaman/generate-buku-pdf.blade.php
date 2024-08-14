<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <h2>{{ $title }}</h2>
    <h2>Date : {{ $date }}</h2>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Status</th>
            <th>Stok</th>
            <th>Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($buku as $b) 
        <tr>
            <td>{{ $b-> id_buku}}</td>
            <td>'{{ $b->judul }}</td>
            <td>{{ $b->penulis }}</td>
            <td>{{ $b->penerbit }}</td>
            <td>{{ $b->tahun_terbit }}</td>
            <td>{{ $b->status_ketersediaan }}</td>
            <td>{{ $b->stok }}</td>
            <td>{{ $b->kategori }}</td>
        </tr>
        @endforeach
    </tbody>

    </table>
    
</body>
</html>
<!-- resources/views/peminjaman/cetak.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Peminjaman</title>
</head>

<body>
    <h1>Cetak Peminjaman</h1>

    <h2>Data Peminjaman</h2>
    <p>Nama Pemohon: {{ $data->nama_pemohon }}</p>
    <p>Hak Milik: {{ $data->hak_milik }}</p>
    <p>Kecamatan: {{ $data->kecamatan }}</p>
    <p>Desa: {{ $data->desa }}</p>
    <p>Keperluan: {{ $data->keperluan }}</p>
    <p>Tanggal: {{ $data->tanggal_formatted }}</p>
    <p>Status: {{ $data->status }}</p>

    
</body>

</html>
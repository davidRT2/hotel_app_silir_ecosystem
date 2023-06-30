<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- debug/beDebug.blade.php -->

    <h1>Detail Kamar</h1>

    @if (isset($data))
    <p>ID Kamar: {{ $data['id_kamar'] }}</p>
    <p>Nama Tipe: {{ $data['nama_tipe'] }}</p>
    <p>Harga per Malam: {{ $data['harga_per_malam'] }}</p>

    <h2>Fasilitas:</h2>
    @foreach($data['daftar_fasilitas'] as $fasilitas)
    <p>ID Fasilitas: {{ $fasilitas['id_fasilitas'] }}</p>
    <p>Nama Fasilitas: {{ $fasilitas['nama_fasilitas'] }}</p>
    <hr>
    @endforeach
    @endif

</body>

</html>
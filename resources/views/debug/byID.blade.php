<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>Data Penginap By ID</h1>
        @if(isset($data))
        @foreach($data as $penginap)
        <p>ID Penginap: {{ $penginap['id_penginap'] }}</p>
        <p>Nama Penginap: {{ $penginap['nama_penginap'] }}</p>
        <p>Telepon: {{ $penginap['telepon'] }}</p>
        <p>ID Kamar: {{ $penginap['id_kamar'] }}</p>
        <p>Durasi: {{ $penginap['durasi'] }}</p>
        <p>Check-in: {{ $penginap['check_in'] }}</p>
        @endforeach
        @endif
    </div>
</body>

</html>
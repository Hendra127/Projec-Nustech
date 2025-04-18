<!DOCTYPE html>
<html>
<head>
    <title>Halaman Baru</title>
</head>
<body>
    <h1>Ini adalah halaman baru di Laravel!</h1>
    <p>Selamat datang di halaman yang kamu buat sendiri 🎉</p>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Site Name</th>
                <!-- <th>Provinsi</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->id }}</td>
                <!-- <td>{{ $item->sitename }}</td> -->
                <td>{{ $item->provinsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

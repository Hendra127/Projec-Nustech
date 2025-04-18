<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <tabel>
    <?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "laravel";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani pencarian
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Query untuk mencari data
$sql = "SELECT * FROM rekap_performance_site";
if (!empty($search)) {
    $sql .= " WHERE kolom1 LIKE '%$search%' OR kolom2 LIKE '%$search%' OR kolom3 LIKE '%$search%'";
}

$result = $conn->query($sql);

// Menangani penambahan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kolom1 = $_POST['COL 1'];
    $kolom2 = $_POST['COL 2'];
    $kolom3 = $_POST['COL 3'];

    $insert_sql = "INSERT INTO rekap_performance_site (COL 1, COL 2, COL 3) VALUES ('$COL 1', '$COL 2', '$COL 3')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='Data-Site.php';</script>";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tabel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Data dari Database</h2>

<!-- Form Pencarian -->
<form method="GET">
    <input type="text" name="search" placeholder="Cari data..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Cari</button>
</form>

<!-- Form Tambah Data -->
<form method="POST">
    <input type="text" name="COL 1" placeholder="Masukkan Kolom 1" required>
    <input type="text" name="COL 2" placeholder="Masukkan Kolom 2" required>
    <input type="text" name="COL 3" placeholder="Masukkan Kolom 3" required>
    <button type="submit">Tambah Data</button>
</form>

<table>
    <tr>
        <?php
        if ($result->num_rows > 0) {
            // Ambil nama kolom secara dinamis
            $columns = array_keys($result->fetch_assoc());
            foreach ($columns as $column) {
                echo "<th>$column</th>";
            }
            // Reset pointer ke awal hasil query
            $result->data_seek(0);
            echo "</tr>";

            // Menampilkan data dalam tabel
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . $row[$column] . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<td colspan='100%'>Tidak ada data</td></tr>";
        }
        ?>
</table>

</body>
</html>

<?php
$conn->close();
?>

    
</body>
</html>
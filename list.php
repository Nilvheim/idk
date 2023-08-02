<?php
// Menghubungkan ke database
$host = "nama_host";
$username = "nama_pengguna";
$password = "kata_sandi";
$database = "nama_database";

$conn = mysqli_connect("localhost", "root", "", "tatl");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Daftar tabel dosen yang akan ditampilkan
$tabel_dosen = array("dwi","hadiyanto","hilmansyah","irtawaty","mikail","wahyu","zulkarnain");

?>

<!DOCTYPE html>
<html>

<head>
    <title>List Tabel Dosen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        .logout-btn {
    display: inline-block;
}

.logout-button {
    display: inline-block;
    padding: 8px 16px;
    background-color: #4CAF50;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.logout-button:hover {
    background-color: #45a049;
}

.logout-button:active {
    background-color: #3e8e41;
}

    </style>
</head>

<body>
    <div class="container">
        <h1>List Tabel Dosen</h1>
        <div class="logout-btn">
    <a href="index.php" class="logout-button">Kembali</a>
</div>

        <?php
        // Menampilkan data dari tabel dosen
        foreach ($tabel_dosen as $tabel) {
            echo "<h2>Tabel " . $tabel . "</h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Nama</th>";
            echo "<th>NIM</th>";
            echo "<th>Topik TA</th>";
            echo "</tr>";

            // Mengambil data dari tabel dosen
            $sql = "SELECT nama, nim, topik_ta FROM $tabel";
            $result = mysqli_query($conn, $sql);

            // Menampilkan data dari tabel dosen
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['nim'] . "</td>";
                echo "<td>" . $row['topik_ta'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>

    </div>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>

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
$tabel_dosen = array("Hadiyanto", "Hilmansyah", "Irtawaty", "Dwi", "Mikail", "Wahyu", "Zulkarnain");

// Fungsi untuk menambahkan data ke tabel dosen
function tambahData($conn, $tabel, $nama, $nim, $topik_ta) {
    $sql = "INSERT INTO $tabel (nama, nim, topik_ta) VALUES ('$nama', '$nim', '$topik_ta')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengubah data pada tabel dosen
function ubahData($conn, $tabel, $id, $nama, $nim, $topik_ta) {
    $sql = "UPDATE $tabel SET nama='$nama', nim='$nim', topik_ta='$topik_ta' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk menghapus data dari tabel dosen
function hapusData($conn, $tabel, $id) {
    $sql = "DELETE FROM $tabel WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

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

        .form-container {
            margin-top: 20px;
            text-align: left;
        }

        .form-container input[type="text"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .form-container button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
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
    <a href="index.php" class="logout-button">Logout</a>
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
            echo "<th>Aksi</th>";
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
                echo "<td>";
                echo "<button style='background-color: yellow;'><a href='edit.php?tabel=$tabel&nim=" . $row['nim'] . "'>Edit</a></button>";
                echo "<button style='background-color: red;'><a href='delete.php?tabel=$tabel&nim=" . $row['nim'] . "'>Delete</a></button>";                
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>

        <div class="form-container">
            <h2>Tambah Data</h2>
            <form method="POST" action="">

                <input type="text" name="tabel" placeholder="Tabel" required>
                <input type="text" name="nama" placeholder="Nama" required>
                <input type="text" name="nim" placeholder="NIM" required>
                <input type="text" name="topik_ta" placeholder="Topik TA" required>
                <button type="submit" name="tambah">Tambah</button>
            </form>
        </div>

        <?php
        // Proses tambah data
        if (isset($_POST['tambah'])) {
            $tabel = $_POST['tabel'];
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $topik_ta = $_POST['topik_ta'];

            if (tambahData($conn, $tabel, $nama, $nim, $topik_ta)) {
                echo "<p>Data berhasil ditambahkan pada tabel $tabel!</p>";
            } else {
                echo "<p>Data gagal ditambahkan!</p>";
            }
        }
        ?>

    </div>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>

<?php
// Menghubungkan ke database
require_once 'koneksi.php';

// Fungsi untuk mengambil data dosen berdasarkan nim
function getDataDosen($conn, $tabel, $nim) {
    $sql = "SELECT * FROM $tabel WHERE nim='$nim'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

// Fungsi untuk mengubah data pada tabel dosen
function ubahData($conn, $tabel, $nim, $nama, $topik_ta) {
    $sql = "UPDATE $tabel SET nama='$nama', topik_ta='$topik_ta' WHERE nim='$nim'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Mendapatkan nilai tabel dan nim dari URL
$tabel = $_GET['tabel'];
$nim = $_GET['nim'];

// Mendapatkan data dosen yang akan diubah
$dataDosen = getDataDosen($conn, $tabel, $nim);

// Proses update data
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $topik_ta = $_POST['topik_ta'];

    if (ubahData($conn, $tabel, $nim, $nama, $topik_ta)) {
        echo "<p>Data berhasil diubah!</p>";
        // Redirect kembali ke halaman utama setelah data diubah
        header("Location: admin.php");
        exit();
    } else {
        echo "<p>Data gagal diubah!</p>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Dosen</title>
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

        .form-container a {
            margin-top: 10px;
            display: block;
            text-decoration: none;
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Data Dosen</h1>

        <div class="form-container">
            <form method="POST" action="">

                <input type="text" name="nama" placeholder="Nama" value="<?php echo $dataDosen['nama']; ?>" required>
                <input type="text" name="topik_ta" placeholder="Topik TA" value="<?php echo $dataDosen['topik_ta']; ?>" required>
                <button type="submit" name="update">Update</button>
            </form>
            <a href="admin.php">Kembali</a>
        </div>
    </div>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>

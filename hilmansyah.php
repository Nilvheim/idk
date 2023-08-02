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

// Mengecek apakah ada data yang dikirim dari form (tombol "Diterima" atau "Ditolak" diklik)
if (isset($_POST['id_permohonan']) && isset($_POST['aksi'])) {
    $id_permohonan = $_POST['id_permohonan'];
    $aksi = $_POST['aksi'];

    if ($aksi == "Diterima") {
        // Mengambil data permohonan berdasarkan ID
        $sql = "SELECT * FROM permohonan WHERE nim='$id_permohonan'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    
            $nama = $row['nama'];
            $nim = $row['nim'];
            $topik_ta = $row['topik_ta'];
    
            // Ganti "mikail" dengan nama dosen yang sesuai
            $nama_tabel_dosen = 'Hilmansyah';
    
            $sql_insert = "INSERT INTO $nama_tabel_dosen (nama, nim, topik_ta) VALUES ('$nama', '$nim', '$topik_ta')";
            if (mysqli_query($conn, $sql_insert)) {
                // echo "Permohonan diterima. Data berhasil dipindahkan ke tabel $nama_tabel_dosen.";
    
                // Menghapus data permohonan dari tabel permohonan
                $sql_delete = "DELETE FROM permohonan WHERE nim='$id_permohonan'";
                mysqli_query($conn, $sql_delete);
    
                // Simpan juga data ke tabel mahasiswa_ta
                $sql_insert_mahasiswa_ta = "INSERT INTO mahasiswa_ta (nama, nim, topik_ta) VALUES ('$nama', '$nim', '$topik_ta')";
                if (mysqli_query($conn, $sql_insert_mahasiswa_ta)) {
                    // echo "Data berhasil disimpan di tabel mahasiswa_ta.";
                } else {
                    echo "Error: " . $sql_insert_mahasiswa_ta . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
            }
        }
    }
     elseif ($aksi == "Ditolak") {
        // Menghapus data permohonan berdasarkan ID
        $sql_delete = "DELETE FROM permohonan WHERE nim='$id_permohonan'";
        if (mysqli_query($conn, $sql_delete)) {
            //echo "Permohonan ditolak. Data berhasil dihapus dari tabel permohonan.";
        } else {
            echo "Error: " . $sql_delete . "<br>" . mysqli_error($conn);
        }
    }
}

// Menampilkan data dari tabel mahasiswa_TA berdasarkan nama dosen yang sedang login
// Ganti "mikail" dengan nama dosen yang sesuai
$nama_tabel_dosen = "hilmansyah";

$sql_mahasiswa_ta = "SELECT * FROM $nama_tabel_dosen";
$result_mahasiswa_ta = mysqli_query($conn, $sql_mahasiswa_ta);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pengelolaan Permohonan</title>
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

        .table-container {
            margin-top: 30px;
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

        .actions {
            display: flex;
            justify-content: center;
        }

        .actions button {
            margin: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Pengelolaan Permohonan</h1>

        <div class="table-container">
            <h2>Tabel <?php echo $nama_tabel_dosen; ?></h2>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Topik TA</th>
                </tr>
                <?php
                // Menampilkan data dari tabel mahasiswa_TA
                while ($row = mysqli_fetch_assoc($result_mahasiswa_ta)) {
                    echo "<tr>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['nim'] . "</td>";
                    echo "<td>" . $row['topik_ta'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div class="table-container">
            <h2>Tabel Permohonan</h2>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Topik TA</th>
                    <th>Dosen</th>
                    <th>Aksi</th>
                </tr>
                <?php
                // Menampilkan data dari tabel permohonan
                $sql_permohonan = "SELECT * FROM permohonan";
                $result_permohonan = mysqli_query($conn, $sql_permohonan);

                while ($row = mysqli_fetch_assoc($result_permohonan)) {
                    echo "<tr>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['nim'] . "</td>";
                    echo "<td>" . $row['topik_ta'] . "</td>";
                    echo "<td>" . $row['dosen'] . "</td>";
                    echo "<td class='actions'>
                            <form method='POST' action=''>
                                <input type='hidden' name='id_permohonan' value='" . $row['nim'] . "'>
                                <button type='submit' name='aksi' value='Diterima'>Diterima</button>
                                <button type='submit' name='aksi' value='Ditolak'>Ditolak</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <a class="logout-button" href="index.php">Logout</a>
    </div>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>

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

// Mengecek apakah ada data yang dikirim dari form
if (isset($_POST['nama']) && isset($_POST['nim']) && isset($_POST['topik_ta']) && isset($_POST['dosen']) && isset($_POST['nip']) && isset($_POST['bidang_keahlian'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $topik_ta = $_POST['topik_ta'];
    $dosen = $_POST['dosen'];
    $nip = $_POST['nip'];
    $bidang_keahlian = $_POST['bidang_keahlian'];

      // Membuat nama tabel permohonan_dosen sesuai dengan dosen yang dipilih
      $tabel_permohonan = "permohonan_" . $dosen;
    
    // Menyimpan data ke tabel permohonan
    $sql = "INSERT INTO $tabel_permohonan (nama, nim, topik_ta, dosen, nip, bidang_keahlian) VALUES ('$nama', '$nim', '$topik_ta', '$dosen', '$nip', '$bidang_keahlian')";
    if (mysqli_query($conn, $sql)) {
        //echo "Permohonan berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Menutup koneksi ke database
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Pembimbing TA</title>
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
        
        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 300px;
        }
        
        .form-group textarea {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 300px;
            height: 100px;
        }
        
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        
        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc;
            color: #000;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pengajuan Pembimbing TA</h1>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" name="nim" id="nim" required>
            </div>
            
            <div class="form-group">
                <label for="topik_ta">Topik TA:</label>
                <textarea name="topik_ta" id="topik_ta" required></textarea>
            </div>
            
            <div class="form-group">
    <label for="dosen">Dosen:</label>

    <select name="dosen" id="dosen">
    <?php

        $sql="SELECT * FROM dospem";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $coloumn1Value = $row["nama"];
                $coloumn2Value = $row["nip"];
                // echo "Result";
                echo "<option value='$coloumn1Value' > $coloumn2Value  </option>";
                        }
           }
          
           else {
            echo "No result";
        }
    ?>
        <!-- Tambahkan opsi dropdown untuk dosen lainnya -->
    </select>

    

</div>

            
            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" name="nip" id="nip" required>
            </div>
            
            <div class="form-group">
                <label for="bidang_keahlian">Bidang Keahlian:</label>
                <input type="text" name="bidang_keahlian" id="bidang_keahlian" required>
            </div>
            
            <div class="form-group">
                <button type="submit=" value="Proses">Send</button>
            </div>
        </form>
        
        <a href="index.php" class="logout-button">Logout</a>
    </div>
</body>
</html>

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
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Mengecek ke tabel login_dosen
    $sql = "SELECT * FROM login_dosen WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Redirect ke program PHP selanjutnya sesuai dengan username dosen
        header("Location: $username.php");
        exit();
    }
    
    // Mengecek ke tabel login_mahasiswa
    $sql = "SELECT * FROM logins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: mahasiswa.php");
        exit();
    }
    
    // Mengecek ke tabel login_admin
    $sql = "SELECT * FROM login_admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: admin.php");
        exit();
    }
}

// Menutup koneksi ke database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        
        .logo {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
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
        
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        
        .back-button {
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
        <h1>Login</h1>
        
        <img class="logo" src="logo.png" alt="Logo">
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Login">
                <a href="index.php" class="back-button">Kembali ke Home</a>
            </div>
        </form>
    </div>
</body>
</html>

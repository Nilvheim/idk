<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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
        }
        
        .logo {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        
        .button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        #admin-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang</h1>
        <h1>Silahkan Anda Login</h1>
        
        <img class="logo" src="logo.png" alt="Logo">
        
        <a class="button" href="login.php">Dosen</a>
        <a class="button" href="login.php">Mahasiswa</a>
        <a class="button" href="list.php">List</a>
        
        <button  onclick="window.location.href='login.php'" id="admin-button" class="button" >Admin</button>
       
    </div>
</body>
</html>

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
?>
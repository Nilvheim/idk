<?php
// Menghubungkan ke database
require_once 'koneksi.php';

// Fungsi untuk menghapus data dari tabel dosen
function hapusData($conn, $tabel, $nim) {
    $sql = "DELETE FROM $tabel WHERE nim='$nim'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Mendapatkan nilai tabel dan nim dari URL
$tabel = $_GET['tabel'];
$nim = $_GET['nim'];

// Proses hapus data
if (hapusData($conn, $tabel, $nim)) {
    echo "<p>Data berhasil dihapus!</p>";
} else {
    echo "<p>Data gagal dihapus!</p>";
}

// Redirect kembali ke halaman utama
header("Location: admin.php");

// Menutup koneksi database
mysqli_close($conn);
?>

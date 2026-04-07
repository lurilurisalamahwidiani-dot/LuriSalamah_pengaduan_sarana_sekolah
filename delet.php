<?php
include "koneksi.php";

// Cek apakah parameter 'hapus' ada di URL
if (isset($_GET['hapus'])) {
    $id_hapus = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    
    // Pastikan nama tabel (tabel_input) dan kolom (id_pelapor) sudah benar
    $query_del = "DELETE FROM `tabel_input` WHERE `id_pelapor` = '$id_hapus'";
    
    if (mysqli_query($koneksi, $query_del)) {
        // Cek apakah ada baris yang benar-benar terhapus
        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='dashboardAdmin.php';</script>";
        } else {
            echo "<script>alert('Data tidak ditemukan di database!'); window.location.href='dashboardAdmin.php';</script>";
        }
    } else {
        // Menampilkan error database jika query gagal
        die("Error Query: " . mysqli_error($koneksi));
    }
} else {
    // Jika diklik tapi parameter hapus tidak terbaca
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='dashboardAdmin.php';</script>";
}
exit();
?>

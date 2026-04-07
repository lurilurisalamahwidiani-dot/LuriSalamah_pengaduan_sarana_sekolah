<?php
include "koneksi.php";

if (isset($_POST['update_admin'])) {
    // Mengambil data dari form dashboardAdmin.php
    $id = $_POST['id'];
    $st = $_POST['status'];
    $fb = mysqli_real_escape_string($koneksi, $_POST['feedback']);

    // Menjalankan perintah update
    $query_upd = "UPDATE `tabel_input` SET `Status`='$st', `Feedback`='$fb' WHERE `id_pelapor`='$id'";
    
    if (mysqli_query($koneksi, $query_upd)) {
        echo "<script>alert('Berhasil diupdate!'); window.location.href='dashboardAdmin.php';</script>";
    } else {
        echo "Gagal Update: " . mysqli_error($koneksi);
    }
} else {
    // Jika diakses tanpa submit form, arahkan kembali
    header("Location: dashboardAdmin.php");
}
?>

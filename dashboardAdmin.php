<?php
include "koneksi.php";

// PROSES UPDATE
if (isset($_POST['update_admin'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    // Jika status = selesai → pindahkan
    if ($status == 'selesai') {

        $ambil = mysqli_query($koneksi, "SELECT * FROM tabel_input WHERE id_pelapor='$id'");
        $data = mysqli_fetch_assoc($ambil);

        // INSERT ke tabel_selesai (SESUAI STRUKTUR KAMU)
        mysqli_query($koneksi, "INSERT INTO tabel_selesai 
        (id_pelapor, Nama, Tanggal, Kelas, Pengaduan, Keterangan, Lokasi, Status, Feedback)
        VALUES 
        ('$data[id_pelapor]', '$data[Nama]', '$data[Tanggal]', '$data[Kelas]', '$data[Pengaduan]', '$data[Keterangan]', '$data[Lokasi]', 'selesai', '$feedback')");

        // Hapus dari tabel_input
        mysqli_query($koneksi, "DELETE FROM tabel_input WHERE id_pelapor='$id'");

        echo "<script>alert('Data dipindahkan ke tabel selesai');</script>";

    } else {
        // Update biasa
        mysqli_query($koneksi, "UPDATE tabel_input 
        SET Status='$status', Feedback='$feedback' 
        WHERE id_pelapor='$id'");

        echo "<script>alert('Data berhasil diupdate');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .btn-delete { color: white; background: red; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 12px; }
        .btn-update { background: #4CAF50; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px; }
        select, input[type="text"] { padding: 5px; }
    </style>
</head>
<body>

<h2>Admin</h2>

<table width="100%">
    <tr style="background-color: #f2f2f2;">
        <th>ID</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Kelas</th>
        <th>Laporan</th>
        <th>Keterangan</th>
        <th>Lokasi</th>
        <th>Status</th>
        <th>Aksi Update</th>
        <th>Opsi</th>
    </tr>

<?php
$res_admin = mysqli_query($koneksi, "SELECT * FROM tabel_input ORDER BY id_pelapor DESC");
while ($adm = mysqli_fetch_assoc($res_admin)) {
?>

<tr>
    <td><?php echo $adm['id_pelapor']; ?></td>
    <td><?php echo $adm['Nama']; ?></td>
    <td><?php echo $adm['Tanggal']; ?></td>
    <td><?php echo $adm['Kelas']; ?></td>
    <td><?php echo $adm['Pengaduan']; ?></td>
    <td><?php echo $adm['Keterangan']; ?></td>
    <td><?php echo $adm['Lokasi']; ?></td>
    <td><strong><?php echo strtoupper($adm['Status']); ?></strong></td>

    <td>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $adm['id_pelapor']; ?>">

            <select name="status">
                <option value="proses" <?php if($adm['Status']=='proses') echo 'selected'; ?>>Proses</option>
                <option value="diterima" <?php if($adm['Status']=='diterima') echo 'selected'; ?>>Terima</option>
                <option value="ditolak" <?php if($adm['Status']=='ditolak') echo 'selected'; ?>>Tolak</option>
                <option value="selesai">Selesai</option>
            </select>

            <input type="text" name="feedback" value="<?php echo $adm['Feedback']; ?>" required>

            <button type="submit" name="update_admin" class="btn-update">Update</button>
        </form>
    </td>

    <td>
        <a href="delet.php?hapus=<?php echo $adm['id_pelapor']; ?>" 
           class="btn-delete"
           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>
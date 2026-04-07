<?php
include "koneksi.php";
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
    <h2> Admin</h2>
    <table width="100%">
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Nama</th>
            <th>Laporan</th>
            <th>Lokasi</th>
            <th>Status Sekarang</th>
            <th>Aksi Update</th>
            <th>Opsi Lain</th>
        </tr>
        <?php
        $res_admin = mysqli_query($koneksi, "SELECT * FROM `tabel_input` ORDER BY Id_pelapor DESC");
        while ($adm = mysqli_fetch_assoc($res_admin)) {
        ?>
        <tr>
            <td><?php echo $adm['id_pelapor']; ?></td>
            <td><?php echo $adm['Nama']; ?></td>
            <td><?php echo $adm['Pengaduan']; ?></td>
             <td><?php echo $adm['Lokasi']; ?></td>
            <td><strong><?php echo strtoupper($adm['Status']); ?></strong></td>
            <td>
                <form method="POST" action="update.php" style="display: inline-block;">
                    <input type="hidden" name="id" value="<?php echo $adm['id_pelapor']; ?>">
                    <select name="status">
                        <option value="proses" <?php echo ($adm['Status'] == 'proses') ? 'selected' : ''; ?>>Proses</option>
                        <option value="diterima" <?php echo ($adm['Status'] == 'diterima') ? 'selected' : ''; ?>>Terima</option>
                        <option value="ditolak" <?php echo ($adm['Status'] == 'ditolak') ? 'selected' : ''; ?>>Tolak</option>
                    </select>
                    <input type="text" name="feedback" placeholder="Isi feedback..." value="<?php echo $adm['Feedback']; ?>" required>
                    <button type="submit" name="update_admin" class="btn-update">Update</button>
                </form>
            </td>
            <td>
                <a href="delet.php?hapus=<?php echo $adm['id_pelapor']; ?>" 
                   class="btn-delete" 
                   onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } // Penutup While ?>
    </table>
</body>
</html>

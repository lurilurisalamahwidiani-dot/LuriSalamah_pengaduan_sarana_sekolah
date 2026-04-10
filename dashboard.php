<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $nama       = mysqli_real_escape_string($koneksi, $_POST['Nama']);
    $tanggal    = mysqli_real_escape_string($koneksi, $_POST['Tanggal']); // ambil dari form
    $kelas      = mysqli_real_escape_string($koneksi, $_POST['Kelas']);
    $pengaduan  = mysqli_real_escape_string($koneksi, $_POST['Pengaduan']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['Keterangan']);
    $lokasi     = mysqli_real_escape_string($koneksi, $_POST['Lokasi']);
    
    $status     = "proses";
    $feedback   = "tunggu sedang di proses.";

    $query_ins = "INSERT INTO tabel_input 
        (Nama, Tanggal, Kelas, Pengaduan, Keterangan, Lokasi, Status, Feedback) 
        VALUES 
        ('$nama', '$tanggal', '$kelas', '$pengaduan', '$keterangan', '$lokasi', '$status', '$feedback')";

    if (mysqli_query($koneksi, $query_ins)) {
        echo "<script>alert('Pengaduan berhasil dikirim!'); window.location.href='simpanpengaduan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Pengaduan</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body { font-family: 'Poppins', sans-serif; background: #f0f4f8; padding: 40px; color: #333; }
        .section { background: white; padding: 35px; border-radius: 15px; max-width: 600px; margin: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        h2 { color: #1e40af; border-bottom: 3px solid #3b82f6; padding-bottom: 10px; margin-top: 0; margin-bottom: 25px; }
        
        .btn-back { display: inline-block; margin-bottom: 20px; color: #3b82f6; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s; }
        .btn-back:hover { color: #1e40af; transform: translateX(-5px); }

        label { display: block; margin-bottom: 8px; font-weight: 600; color: #1e40af; font-size: 14px; }
        input, textarea { 
            width: 100%; 
            padding: 12px; 
            margin-bottom: 20px; 
            border: 1px solid #e2e8f0; 
            border-radius: 10px; 
            box-sizing: border-box; 
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            transition: 0.3s;
        }
        input:focus, textarea:focus { outline: none; border-color: #3b82f6; background: #fff; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        
        button { 
            background: #3b82f6; 
            color: white; 
            border: none; 
            padding: 15px; 
            border-radius: 10px; 
            cursor: pointer; 
            width: 100%; 
            font-weight: 600; 
            font-size: 16px; 
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        button:hover { background: #1e40af; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(30, 64, 175, 0.4); }
        
        .link-history { display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 14px; }
        .link-history b { color: #3b82f6; }
    </style>
</head>
<body>

<div class="section">
    <a href="dashboard.php" class="btn-back">← Kembali</a>
    <h2>📝 Kirim Laporan</h2>
    
    <form method="POST">
        <label>Nama Lengkap</label>
        <input type="text" name="Nama" placeholder="Masukkan nama Anda" required>
        
        <label>Tanggal</label>
        <input type="date" name="Tanggal" value="<?php echo date('Y-m-d'); ?>" required>
        
        <label>Kelas</label>
        <input type="text" name="Kelas" placeholder="Contoh: XII RPL 1" required>
        
        <label>Judul Pengaduan</label>
        <input type="text" name="Pengaduan" placeholder="Apa yang ingin dilaporkan?" required>
        
        <label>Keterangan Detail</label>
        <textarea name="Keterangan" placeholder="Ceritakan kronologi secara jelas..." rows="4" required></textarea>
        
        <label>Lokasi Kejadian</label>
        <input type="text" name="Lokasi" placeholder="Misal: Kantin, Lab, atau Parkiran">
        
        <button type="submit" name="submit">Kirim Sekarang 🚀</button>
    </form>
    
    <a href="simpanpengaduan.php" class="link-history">Sudah pernah melapor? <b>Lihat Riwayat ➡️</b></a>
</div>

</body>
</html>
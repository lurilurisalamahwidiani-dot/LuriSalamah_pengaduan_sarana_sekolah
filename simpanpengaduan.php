<?php 
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengaduan</title>
    <style>
      <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
    
    body { 
        font-family: 'Poppins', sans-serif; 
        background: #f0f4f8; 
        margin: 0; 
        padding: 20px; 
        color: #333; 
    }

    /* Membuat section sangat lebar ke samping */
    .section { 
        background: white; 
        padding: 30px; 
        border-radius: 15px; 
        max-width: 98%; /* Memanfaatkan hampir seluruh lebar layar */
        margin: auto; 
        box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
    }
    
    .header-area {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #3b82f6;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    h2 { color: #1e40af; margin: 0; font-size: 24px; }
    
    .btn-back { 
        background: #eff6ff;
        padding: 8px 15px;
        border-radius: 8px;
        color: #3b82f6; 
        text-decoration: none; 
        font-weight: 600; 
        font-size: 14px; 
        transition: 0.3s; 
    }
    .btn-back:hover { background: #3b82f6; color: white; }

    .table-container { 
        overflow-x: auto; 
        white-space: nowrap; /* Mencegah teks turun ke bawah secara paksa */
    }

    table { 
        width: 100%; 
        border-collapse: collapse; 
        min-width: 1200px; /* Menjamin tabel memanjang ke samping */
    }

    th, td { 
        padding: 18px 20px; 
        border-bottom: 1px solid #e2e8f0; 
        text-align: left; 
        white-space: normal; /* Mengizinkan teks bungkus hanya jika kolom sudah habis */
    }

    th { 
        background: #f8fafc; 
        color: #1e40af; 
        font-weight: 600; 
        text-transform: uppercase; 
        font-size: 12px; 
        letter-spacing: 1px;
    }

    tr:hover { background-color: #f1f5f9; }

    /* Pengaturan Badge agar tetap rapi */
    .badge { 
        padding: 6px 16px; 
        border-radius: 50px; 
        color: white; 
        font-size: 11px; 
        font-weight: bold; 
        text-transform: uppercase; 
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .bg-proses { background: #f59e0b; } 
    .bg-terima { background: #22c55e; } 
    .bg-tolak  { background: #ef4444; }
    
    .feedback-text { 
        font-size: 13px; 
        color: #64748b; 
        font-style: italic; 
        min-width: 200px; /* Memberi ruang lebih untuk kolom feedback */
    }

    b { color: #1e40af; }
</style>

</head>
<body>

<div class="section">
    <div class="header-area">
        <h2>📌 Riwayat Laporan Pengaduan</h2>
        <a href="dashboard.php" class="btn-back">⬅️ Kembali ke Dashboard</a>
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="10%">Tanggal</th>
                    <th width="15%">Nama Pelapor</th>
                    <th width="10%">Kelas</th>
                    <th width="20%">Pengaduan</th>
                    <th width="15%">Lokasi</th>
                    <th width="10%">Status</t>
                    <th width="20%">Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query mengambil data terbaru
                $query = mysqli_query($koneksi, "SELECT * FROM `tabel_input` ORDER BY Id_pelapor DESC");

                if($query && mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                        $status = strtolower($row['Status']);
                        
                        // Logika warna badge
                        $badge_color = 'bg-proses';
                        if($status == 'diterima' || $status == 'terima') $badge_color = 'bg-terima';
                        if($status == 'ditolak' || $status == 'tolak') $badge_color = 'bg-tolak';

                        echo "<tr>
                                <td>" . date('d M Y', strtotime($row['Tanggal'])) . "</td>
                                <td><b>" . htmlspecialchars($row['Nama']) . "</b></td>
                                <td>" . htmlspecialchars($row['Kelas']) . "</td>
                                <td>" . htmlspecialchars($row['Pengaduan']) . "</td>
                                <td>" . htmlspecialchars($row['Lokasi']) . "</td>
                                <td><span class='badge $badge_color'>$status</span></td>
                                <td class='feedback-text'>" . ($row['Feedback'] ? $row['Feedback'] : 'Menunggu respon...') . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='empty-state'>Belum ada riwayat pengaduan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

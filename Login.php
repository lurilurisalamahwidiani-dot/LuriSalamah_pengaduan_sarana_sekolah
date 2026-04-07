<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // cek siswa
    $querySiswa = mysqli_query($koneksi,
        "SELECT * FROM tabel_siswa WHERE Ussername='$username' AND Password='$password'"
    );

    // cek admin
    $queryAdmin = mysqli_query($koneksi,
        "SELECT * FROM tabel_admin WHERE Ussername='$username' AND Password='$password'"
    );

    // login siswa
    if($querySiswa && mysqli_num_rows($querySiswa) > 0){

        $_SESSION['tabel_siswa'] = $username;

        echo "<script>alert('Login Siswa Berhasil!'); window.location='dashboard.php';</script>";
        exit();
    }

    // login admin
    else if($queryAdmin && mysqli_num_rows($queryAdmin) > 0){

        $_SESSION['tabel_admin'] = $username;

        echo "<script>alert('Login Admin Berhasil!'); window.location='dashboardAdmin.php';</script>";
        exit();
    }

    else{
        echo "<script>alert('Username atau Password Salah!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-sm text-center">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Login</h2>
        
        <form method="POST" class="space-y-4">
            <div>
                <input type="text" name="username" placeholder="Username" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-blue-500" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-blue-500" required>
            </div>
            <button type="submit" name="login" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300">
                Masuk
            </button>
        </form>
        
        <p class="mt-4 text-sm text-gray-500 italic">Silahkan Login terlebih dahulu</p>
    </div>
</body>
</html>
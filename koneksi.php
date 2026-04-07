<?php
$h = "127.0.0.1";
$s = "root";
$p = "root";
$db = "Pengaduan_sarana_sekolah";

$koneksi = mysqli_connect($h, $s, $p, $db);

if (!$koneksi) {
  die("Koneksi gagal: ".mysqli_connect_error());
}

<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "db_depotair";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
   die("Koneksi gagal: " . mysqli_connect_error());
}

?>
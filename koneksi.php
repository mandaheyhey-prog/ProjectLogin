<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_casir"; 

$conn = mysqli_connect("localhost", "root", "", "db_casir");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>

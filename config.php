<?php
$conn = mysqli_connect("localhost", "root", "", "salon_hairst");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

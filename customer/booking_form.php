<?php
$conn = mysqli_connect("localhost", "root", "", "salon_hairst");

$tanggal = isset($_POST['tanggal_booking']) ? $_POST['tanggal_booking'] : date('Y-m-d');

// Proses Booking
if(isset($_POST['submit'])){
    $nama = $_POST['nama_customer'];
    $tanggal = $_POST['tanggal_booking'];
    $jam = $_POST['jam_booking'];
    $layanan = $_POST['layanan'];

    // Cek bentrok
    $cek = "SELECT * FROM booking WHERE tanggal_booking='$tanggal' AND jam_booking='$jam'";
    $hasil = mysqli_query($conn, $cek);

    if(mysqli_num_rows($hasil) > 0){
        echo "<p style='color:red; text-align:center;'>Maaf, jadwal di tanggal dan jam tersebut sudah terbooking. Silakan pilih waktu lain.</p>";
    } else {
        $query = "INSERT INTO booking (nama_customer, tanggal_booking, jam_booking, layanan, status) 
                  VALUES ('$nama', '$tanggal', '$jam', '$layanan', 'Booked')";
        if(mysqli_query($conn, $query)){
            echo "<p style='color:green; text-align:center;'>Booking berhasil!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Terjadi kesalahan: " . mysqli_error($conn) . "</p>";
        }
    }
}

// Cek jadwal kosong
$jam_buka = 9;
$jam_tutup = 17;
$booked_times = [];

$query = "SELECT jam_booking FROM booking WHERE tanggal_booking='$tanggal'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)){
    $booked_times[] = $row['jam_booking'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Booking Salon Hairst + Jadwal Kosong</title>
    <link rel="stylesheet" type="text/css" href="style_customer.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffe6f0;
            padding: 20px;
        }
        h2 {
            color: #d63384;
            text-align: center;
        }
        form {
            background: #fff0f5;
            padding: 20px;
            border-radius: 12px;
            width: 350px;
            margin: 20px auto;
            box-shadow: 0 0 10px #f8b8d0;
        }
        input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ff99cc;
        }
        input[type="submit"] {
            background: #ff66b2;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: #e0559d;
        }
        table {
            width: 350px;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff0f5;
            box-shadow: 0 0 8px #f8b8d0;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ffb3d9;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #ff66b2;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #ffe6f0;
        }
    </style>
</head>
<body>

<h2>Form Booking Salon Hairst</h2>
<form method="POST" action="">
    Nama Customer:<br>
    <input type="text" name="nama_customer" required><br>
    Tanggal Booking:<br>
    <input type="date" name="tanggal_booking" value="<?php echo $tanggal; ?>" required onchange="this.form.submit()"><br>
    Jam Booking:<br>
    <input type="time" name="jam_booking" required><br>
    Layanan:<br>
    <input type="text" name="layanan" required><br><br>
    <input type="submit" name="submit" value="Booking Sekarang">
</form>

<h2>Jadwal Kosong Tanggal <?php echo $tanggal; ?></h2>
<table>
    <tr><th>Jam</th><th>Status</th></tr>
    <?php
    for($i = $jam_buka; $i < $jam_tutup; $i++){
        $jam = sprintf("%02d:00:00", $i);
        echo "<tr>";
        echo "<td>" . sprintf("%02d:00", $i) . "</td>";
        if(in_array($jam, $booked_times)){
            echo "<td style='color:red;'>Terbooking</td>";
        } else {
            echo "<td style='color:green;'>Tersedia</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

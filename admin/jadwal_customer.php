<?php
$conn = mysqli_connect("localhost", "root", "", "salon_hairst");
$result = mysqli_query($conn, "SELECT * FROM booking ORDER BY tanggal_booking, jam_booking");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Booking Customer</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff0f5;
            box-shadow: 0 0 10px #f8b8d0;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ffb3d9;
            padding: 10px;
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

<h2>Jadwal Booking Customer</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Customer</th>
        <th>Tanggal Booking</th>
        <th>Jam Booking</th>
        <th>Layanan</th>
        <th>Status</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['id_booking']; ?></td>
        <td><?= $row['nama_customer']; ?></td>
        <td><?= $row['tanggal_booking']; ?></td>
        <td><?= $row['jam_booking']; ?></td>
        <td><?= $row['layanan']; ?></td>
        <td><?= $row['status']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

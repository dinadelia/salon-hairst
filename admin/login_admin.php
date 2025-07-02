<?php
// Simulasi login sederhana
session_start();

$admin_user = "admin";
$admin_pass = "admin123";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === $admin_user && $password === $admin_pass){
        $_SESSION['login'] = true;
        header("Location: jadwal_customer.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin Salon</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffe6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #fff0f5;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px #f8b8d0;
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #d63384;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ff99cc;
            border-radius: 6px;
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
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin Salon</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
</div>

</body>
</html>

<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: welcome.php");
    exit();
}

if (isset($_POST["btnLogin"])) {
    $name = trim($_POST["username"]);

    $_SESSION["username"] = $name;
    var_dump($_SESSION["username"]);

    header("Location: welcome.php");
    exit();
}
?>  

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Đăng nhập</h2>

<form method="post">
    <input type="text" name="username" placeholder="Nhập tên..." required>
    <button type="submit" name="btnLogin">Đăng nhập</button>
</form>

</body>
</html>

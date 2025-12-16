<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>

<h2>Xin chào, <?php echo $_SESSION["username"]; ?>!</h2>

<a href="logout.php">Đăng xuất</a>

</body>
</html>

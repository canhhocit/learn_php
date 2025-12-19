<?php
include("connect.php");
if (!isset($_GET["id"])) {
    header("location:index.php?delete_msg=Chua nhan dc id");
}
$id = $_GET["id"];
$sql = "delete from person where id='$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("location:index.php?delete_msg=Delete thanh cong!!");
}
?>

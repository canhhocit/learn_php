<link rel="stylesheet" href="action.css">
<?php
//select 
include("connect.php");
if (!isset($_GET["id"])) {
    header("location:index.php?edit_msg=Chua nhan dc id");
}
$id = $_GET["id"];
$sql = "select * from person where id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="form">
    <form method="post">
        <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
        <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
        <button type="submit" name="btn">Edit</button>
        <button><a href="index.php" style="text-decoration: none;">Back</a></button>
    </form>

</div>


<!--  update -->
<?php
if (isset($_POST["btn"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $sql = "update person set name ='$name', email='$email' where id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location:index.php?edit_msg=Update thanh cong");
    }
}

?>
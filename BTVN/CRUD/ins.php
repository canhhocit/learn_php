
<?php
include("connect.php");
//
if (isset($_POST["btn"])) {
    $name  = $_POST["name"];
    $email = $_POST["email"];
    $sql = "insert into person(name,email) values ('$name','$email')";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("location:index.php?ins_msg=Insert thanh cong");
    }
}
?>
<link rel="stylesheet" href="action.css">
<div class="form">
    <form method="post">
    <input type="text" name="name" placeholder="name"><br><br>
    <input type="text" name="email"  placeholder="email"><br><br>
    <button type="submit" name="btn">ADD</button>
    <button><a href="index.php" style="text-decoration: none;">Back</a></button>
</form>
</div>


<form action="bai2.php" method="get">
<input type="text" name="search">
<button type="submit">Tim kiem</button>

</form>

<?php 
if(isset($_GET['search'])){
    echo 'Tu khoa: '. htmlspecialchars($_GET['search']) .'';
}
?>
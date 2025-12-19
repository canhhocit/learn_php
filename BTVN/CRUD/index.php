<link rel="stylesheet" href="stylee.css">
<?php
session_start();
include("connect.php");

if (isset($_GET['search_done']) && isset($_SESSION['search_results'])) {
    $datas = $_SESSION['search_results'];
    $key_tk = $_SESSION['key_tk'];

    unset($_SESSION['search_results']);
    unset($_SESSION['key_tk']);

    echo "<h2>Kết quả tìm kiếm cho: \"$key_tk\"</h2>";

} else {
    $sql = "select * from person";
    $rs = mysqli_query($conn, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($rs)) {
        $datas[] = $row;
    }
}
?>

<form method="post" action="timkiem.php">
    <div class="input_search">
        <input type="text" name="txt_find" id="inp_txt" placeholder="Nhap ten de tim kiem">
        <button name="btn_find" id="btn-find" type="submit">
            <div class="text">Search</div>
        </button>
    </div>
</form>


<table align="center">
    <thead>
        <th>name</th>
        <th>email</th>
        <th><a href="ins.php" style="text-decoration:none; color: chartreuse;">Add</a></th>
    </thead>
    <tbody>
        <?php
        foreach ($datas as $row) {
            ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><a href="edit.php?id=<?php echo $row['id'] ?>" style="text-decoration: none;">Edit</a> <span>|</span>
                    <a href="delete.php?id=<?php echo $row['id'] ?>" style="text-decoration: none; color: red;"
                        onclick="return confirm('Xoa dong nay ?');"><b>Delete</b></a>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<div class="msg">

    <?php if (isset($_GET['ins_msg'])) { ?>
        <script>
            alert("<?php echo $_GET['ins_msg']; ?>");
        </script>
    <?php } ?>

    <?php if (isset($_GET['edit_msg'])) { ?>
        <script>
            alert("<?php echo $_GET['edit_msg']; ?>");
        </script>
    <?php } ?>

    <?php if (isset($_GET['delete_msg'])) { ?>
        <script>
            alert("<?php echo $_GET['delete_msg']; ?>");
        </script>
    <?php } ?>

    <?php if (isset($_GET['search_msg'])) { ?>
        <script>
            alert("<?php echo $_GET['search_msg']; ?>");
        </script>
    <?php } ?>
    <?php if (isset($_GET['search_done'])) { ?>
        <script>
            alert("<?php echo $_GET['search_done']; ?>");
        </script>
    <?php } ?>

</div>
<?php if (isset($_GET['search_msg'])) { ?>
    <script>
        alert("<?php echo $_GET['search_msg']; ?>");
    </script>
<?php } ?>

<?php if (isset($_GET['empty_result'])) { ?>
    <script>
        alert("Không tìm thấyy kết quảaaaaaaaa");
        let inputElement = document.getElementById("inp_txt");
        inputElement.classList.add("run");
        setTimeout(function () {
            inputElement.classList.remove("run");
        }, 1000);

    </script>
<?php } ?>

</div>
<?php
session_start(); 
include("connect.php");

if(isset($_POST["btn_find"]) ){
    $key = $_POST["txt_find"];
    if(!empty($key)){
        $sql ="select * from person where name like '%$key%'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count > 0){
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            $_SESSION['search_results'] = $data;
            $_SESSION['key_tk'] = $key;

            header("location:index.php?search_done= Tìm thấy ".$count." kết quả"); 
            exit();

        } else {
            // null
            header("location:index.php?search_msg=Không tìm thấy thông tin với tên: \"".$key."\"&empty_result=1");
            exit();
        }
    } else {
        header("location:index.php"); 
        exit();
    }
} 
?>
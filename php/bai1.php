<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Tai lieu lap trinh web</h1>
    <?php
    echo "<h2>PHP co ban</h2>";
    echo "<h3>PHP nang cao</h3>";
    echo "<h4>PHP va MySQL</h4>";
    ?>
    <hr>
    <?php
    $text = "Tu co ban" . " " . "den nang cao";
    echo "<h2>$text</h2>";
    ?>



    <?php
    function tinhTong($a, $b)
    {
        $tong = $a*0.5/ $b;
        return $tong;
        
    }
    echo tinhTong(10,10);
    echo tinhTong(11,11);
    echo tinhTong(12,12);
    echo tinhTong(13,13);
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-100</title>
</head>

<body>
    <?php
    for ($i = 1; $i <= 100; $i++) {
        if ($i % 2 == 0) {
    ?>
            <b style="color: red; font-size: 30px;"><?php echo $i ?></b>
        <?php
        } else {
        ?>
            <b style="color: blue;"><i><?php echo $i ?> </i></b>
    <?php
        }
    }
    ?>
</body>

</html>
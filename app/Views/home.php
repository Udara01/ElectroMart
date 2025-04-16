<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

</head>
<body>
    <?php
        echo view('layouts/header');
        echo view('layouts/navbar');
        echo view('components/cart');
        echo "<hr style=\"width:100%;text-align:left;margin-left:0\">";
        echo view('layouts/footer');
    ?>
</body>
</html>
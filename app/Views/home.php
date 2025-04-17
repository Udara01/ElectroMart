<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <?= view('layouts/header') ?>
    <?= view('layouts/navbar') ?>
    
    <?= view('components/cart', [
        'topSelling' => $topSelling,
        'newProducts' => $newProducts,
        'products' => $products,
        'product_spaces' => $product_spaces,
        'categories' => $categories
    ]) ?>

    <hr style="width:100%;text-align:left;margin-left:0">
    <?= view('layouts/footer') ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; text-align: left; }
        img { width: 80px; height: auto; }
    </style>
</head>
<body>
    <h2>All Product Details</h2>
    <?php foreach ($products as $product): ?>
        <h3><?= esc($product['name']) ?> (<?= esc($product['category_name']) ?>)</h3>
        <p><strong>Description:</strong> <?= esc($product['description']) ?></p>
        <p><strong>Price:</strong> Rs <?= esc($product['price']) ?></p>
        <?php /*if ($product['image']): ?>
            <p><img src="<?= FCPATH . 'uploads/' . $product['image'] ?>"></p>
        <?php endif; */ ?>
       
        <strong>Specifications:</strong>
        <ul>
            <?php foreach ($product_spaces as $spec): ?>
                <?php if ($spec['product_id'] == $product['id']): ?>
                    <li><strong><?= esc($spec['spec_key']) ?>:</strong> <?= esc($spec['spec_value']) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <hr>
    <?php endforeach; ?>
</body>
</html>
    
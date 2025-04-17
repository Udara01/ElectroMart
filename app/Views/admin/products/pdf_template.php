<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Product Details</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .product-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .product-image {
            max-width: 120px;
            height: auto;
            border-radius: 5px;
        }
        .product-title {
            margin-bottom: 10px;
        }
        ul.specs-list {
            padding-left: 20px;
        }
        hr {
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-center">All Product Details</h2>
    
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <div class="row">
                <div class="col-md-2 text-center">
                    <?php /*if ($product['image']): ?>
                        <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="Product Image" class="product-image img-fluid">
                        <?php endif;*/ ?>
                </div>
                <div class="col-md-10">
                    <h4 class="product-title"><?= esc($product['name']) ?> <small class="text-muted">(<?= esc($product['category_name']) ?>)</small></h4>
                    <p><strong>Description:</strong> <?= esc($product['description']) ?></p>
                    <p><strong>Price:</strong> <span class="text-success fw-bold">Rs <?= esc($product['price']) ?></span></p>
                    <p><strong>Specifications:</strong></p>
                    <ul class="specs-list">
                        <?php foreach ($product_spaces as $spec): ?>
                            <?php if ($spec['product_id'] == $product['id']): ?>
                                <li><strong><?= esc($spec['spec_key']) ?>:</strong> <?= esc($spec['spec_value']) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Bootstrap JS Bundle (optional if you want JS components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script></body>
</html>
   
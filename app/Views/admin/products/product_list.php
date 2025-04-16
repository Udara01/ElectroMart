
<div class="container">
    <h2>All Products</h2>
    <?php if (!empty($products)) : ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (Rs)</th>
                <th>Category</th>
                <th>Image</th>
            </tr>
            <?php foreach ($products as $product) : ?>
    <tr>
        <td><?= esc($product['id']) ?></td>
        <td><?= esc($product['name']) ?></td>
        <td><?= esc($product['description']) ?></td>
        <td><?= esc($product['price']) ?></td>
        <td><?= esc($product['category_name']) ?></td>
        
        <td>
            <?php if ($product['image']) : ?>
                <img src="<?= base_url('uploads/' . $product['image']) ?>" width="100">
            <?php else : ?>
                No image
            <?php endif; ?>
        </td>            
    </tr>
    <!-- Optional: show specs below each product -->
    <tr>
        <td colspan="5">
            <strong>Specifications:</strong><br>
            <ul>
                <?php foreach ($product_spaces as $spec) : ?>
                    <?php if ($spec['product_id'] == $product['id']) : ?>
                        <li><strong><?= esc($spec['spec_key']) ?>:</strong> <?= esc($spec['spec_value']) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </td>
    </tr>
<?php endforeach; ?>
        </table>
        <td><a href="<?= base_url('admin/download_pdf') ?>" class="btn btn-primary" target="_blank">Download PDF</a> </td>

    <?php else : ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>


<div class="container">
    <h2>All Products</h2>
    <?php if (!empty($product_data)) : ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (Rs)</th>
                <th>Image</th>
            </tr>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= esc($product['id']) ?></td>
                    <td><?= esc($product['name']) ?></td>
                    <td><?= esc($product['description']) ?></td>
                    <td><?= esc($product['price']) ?></td>
                    <td>
                        <?php if ($product['image']) : ?>
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" width="100">
                        <?php else : ?>
                            No image
                        <?php endif; ?>
                    </td>
                </tr>
                if($space_data[product_id] == $product['id']){
                    <tr>
                        <td><?= esc($space_data['spec_key']) ?></td>
                        <td><?= esc($space_data['spec_value']) ?></td>
                    </tr>
                }
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

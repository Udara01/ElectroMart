<div class="container">
    <h2>All Products</h2>

    <!-- Filter Form -->
    <form method="get" action="<?= base_url('productsShop') ?>" class="mb-3">
        <label>Department:</label>
        <select name="department" onchange="this.form.submit()">
            <option value="all">All</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= ($filters['department'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                    <?= esc($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Price:</label>
        <select name="price">
            <option value="">All</option>
            <option value="1" <?= ($filters['price'] ?? '') == '1' ? 'selected' : '' ?>>Below Rs. 25</option>
            <option value="2" <?= ($filters['price'] ?? '') == '2' ? 'selected' : '' ?>>Below Rs. 50</option>
            <option value="3" <?= ($filters['price'] ?? '') == '3' ? 'selected' : '' ?>>Below Rs. 100</option>
            <option value="4" <?= ($filters['price'] ?? '') == '4' ? 'selected' : '' ?>>Below Rs. 200</option>
            <option value="5" <?= ($filters['price'] ?? '') == '5' ? 'selected' : '' ?>>Above Rs. 200</option>
        </select>

        <?php if (!empty($specOptions)) : ?>
            <h4>Additional Filters</h4>
            <?php foreach ($specOptions as $specKey => $options): ?>
                <label><?= esc($specKey) ?>:</label>
                <select name="<?= esc($specKey) ?>">
                    <option value="">All</option>
                    <?php foreach ($options as $opt): ?>
                        <option value="<?= esc($opt) ?>" <?= ($filters[$specKey] ?? '') == $opt ? 'selected' : '' ?>>
                            <?= esc($opt) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endforeach; ?>
        <?php endif; ?>

        <button type="submit">Apply Filter</button>
    </form>

    <?php if (!empty($products)) : ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th><th>Name</th><th>Description</th><th>Price (Rs)</th><th>Category</th><th>Image</th>
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
                <tr>
                    <td colspan="6">
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
    <?php else : ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

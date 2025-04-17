<div class="container">
    <h3 class="mb-4">All Products</h3>

    <?php if (!empty($products)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price (Rs)</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Specifications</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= esc($product['id']) ?></td>
                            <td><?= esc($product['name']) ?></td>
                            <td><?= esc($product['description']) ?></td>
                            <td><?= esc($product['price']) ?></td>
                            <td><?= esc($product['category_name']) ?></td>
                            <td>
                                <?php if ($product['image']) : ?>
                                    <img src="<?= base_url('uploads/' . $product['image']) ?>" width="80" height="80" class="img-thumbnail">
                                <?php else : ?>
                                    <span class="text-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $specList = array_filter($product_spaces, function ($spec) use ($product) {
                                    return $spec['product_id'] == $product['id'];
                                });
                                ?>
                                <?php if (!empty($specList)) : ?>
                                    <ul class="mb-0">
                                        <?php foreach ($specList as $spec) : ?>
                                            <li><strong><?= esc($spec['spec_key']) ?>:</strong> <?= esc($spec['spec_value']) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else : ?>
                                    <span class="text-muted">No specs</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <a href="<?= base_url('admin/download_pdf') ?>" class="btn btn-outline-primary" target="_blank">
                <i class="bi bi-download me-1"></i>Download PDF
            </a>
        </div>

    <?php else : ?>
        <div class="alert alert-warning">No products found.</div>
    <?php endif; ?>
</div>

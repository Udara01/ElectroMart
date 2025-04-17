<div class="card p-4">
    <h4 class="mb-3">Delete Product</h4>
    <form action="<?= site_url('admin/delete_product') ?>" method="post" onsubmit="return confirm('Are you sure?')">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="product_id" class="form-label">Select Product</label>
            <select name="product_id" class="form-select" required>
                <option value="">-- Select Product --</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= esc($product['id']) ?>"><?= esc($product['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-danger">Delete Product</button>
    </form>
</div>

<div class="card p-4">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php elseif (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <h4 class="mb-3">Update Product</h4>
    <form action="<?= site_url('admin/update_product') ?>" method="post">
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

        <div class="mb-3">
            <label class="form-label">New Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">New Price</label>
            <input type="number" step="0.01" name="price" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">New Description</label>
            <input type="text" name="description" class="form-control">
        </div>

        

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>

<script>
document.querySelector('select[name="product_id"]').addEventListener('change', function() {
    let productId = this.value;
    if (productId) {
        fetch(`/admin/get_product_details/${productId}`)
            .then(response => response.json())
            .then(product => {
                document.querySelector('input[name="name"]').value = product.name || '';
                document.querySelector('input[name="description"]').value = product.description || '';
                document.querySelector('input[name="price"]').value = product.price || '';
            });
    } else {
        document.querySelector('input[name="name"]').value = '';
        document.querySelector('input[name="description"]').value = '';
        document.querySelector('input[name="price"]').value = '';
    }
});
</script>


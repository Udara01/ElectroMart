
    <div>
    <form method="post" action="<?= base_url('/admin/add_category') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form> 
    </div>


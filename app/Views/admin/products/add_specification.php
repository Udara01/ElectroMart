<div>
    <form method="post" action="<?= base_url('/add_specification') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="specification_name" class="form-label">Specification Name</label>
            <input type="text" name="specification_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Specification</button>
    </form> 
</div>

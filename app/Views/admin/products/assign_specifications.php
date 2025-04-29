<div class="row">
    <!-- Left Side - Categories -->
    <div class="col-md-6">
        <h4>Select Category</h4>
        <form method="post" action="<?= base_url('/assign_specifications') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <?php foreach ($categories as $category): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category_id" id="category_<?= $category['id'] ?>" value="<?= $category['id'] ?>" required>
                        <label class="form-check-label" for="category_<?= $category['id'] ?>">
                            <?= esc($category['name']) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>

    <!-- Right Side - Specifications -->
    <div class="col-md-6">
        <h4>Select Specifications</h4>
        <div class="mb-3">
            <?php foreach ($specifications as $spec): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="specifications[]" id="spec_<?= $spec['id'] ?>" value="<?= $spec['id'] ?>">
                    <label class="form-check-label" for="spec_<?= $spec['id'] ?>">
                        <?= esc($spec['name']) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-success">Assign Specifications</button>
        </form>
    </div>
</div>

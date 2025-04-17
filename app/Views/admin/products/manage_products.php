<?php echo view('layouts/admin_header') ?>
<?php echo view('layouts/admin_navbar') ?>

<div class="container py-4">
    <h2 class="mb-4 text-center">Manage Products</h2>

    <!-- Bootstrap Nav Tabs -->
    <ul class="nav nav-tabs mb-3" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab">Add Product</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="view-tab" data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab">View Products</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="update-tab" data-bs-toggle="tab" data-bs-target="#update" type="button" role="tab">Update Product</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="delete-tab" data-bs-toggle="tab" data-bs-target="#delete" type="button" role="tab">Delete Product</button>
        </li>
    </ul>

    <!-- Tab Panes -->
    <div class="tab-content" id="productTabsContent">
        <!-- Add Product -->
        <div class="tab-pane fade show active" id="add" role="tabpanel">
            <?php echo view('admin/products/add_product') ?>
        </div>

        <!-- View Products -->
        <div class="tab-pane fade" id="view" role="tabpanel">
            <?php echo view('admin/products/product_list') ?>
        </div>

        <!-- Update Product -->
        <div class="tab-pane fade" id="update" role="tabpanel">
    <?= view('admin/products/update_product', ['products' => $allProducts]) ?>
</div>


        <!-- Delete Product -->
        <div class="tab-pane fade" id="delete" role="tabpanel">
            <?php echo view('admin/products/delete_product') ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

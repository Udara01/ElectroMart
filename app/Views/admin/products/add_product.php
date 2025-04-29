<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Add Product</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('admin/add_product') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <!-- Product Category -->
                <div class="mb-3">
                    <label for="categorySelect" class="form-label">Product Category</label>
                    <select name="category" id="categorySelect" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= esc($category['id']) ?>">
                                <?= esc($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Dynamic Specification Area -->
                <div class="mb-3">
                    <label class="form-label">Category Specs</label>
                    <div id="categorySpacesContainer" class="row g-2">
                        <!-- JavaScript will populate based on category -->
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (LKR)</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>


document.getElementById('categorySelect').addEventListener('change', function () {
    const selectedCategory = this.value;
    const container = document.getElementById('categorySpacesContainer');
    container.innerHTML = ''; // Clear previous

    if (selectedCategory) {
        fetch(`<?= base_url('admin/getCategorySpecifications/') ?>${selectedCategory}`)
            .then(response => response.json())
            .then(specifications => {
                specifications.forEach(spec => {
                    const div = document.createElement('div');
                    div.classList.add('col-md-6');

                    const label = document.createElement('label');
                    label.classList.add('form-label');
                    label.innerText = spec.spec_name; 

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = `category_spaces[${spec.spec_name}]`;
                    input.classList.add('form-control');
                    input.required = true;

                    div.appendChild(label);
                    div.appendChild(input);

                    container.appendChild(div);
                });
            })
            .catch(error => {
                console.error('Error fetching specifications:', error);
            });
    }
});


</script>
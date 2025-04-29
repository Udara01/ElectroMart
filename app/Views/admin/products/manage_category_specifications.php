<?= view('layouts/admin_navbar') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link href="/asset/Styles/manage_category_specifications.css" rel="stylesheet">


<div class="container py-5 animate__animated animate__fadeIn">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 mb-3" style="color: var(--primary-color);">
            <i class="bi bi-diagram-3-fill me-2"></i> Category & Specification Manager
        </h1>
        <p class="lead text-muted">Organize product category with the specifications</p>
    </div>

    <form method="post" action="<?= base_url('/assign_specifications') ?>">
        <?= csrf_field() ?>

        <div class="row g-4">
            <!-- Categories Card -->
            <div class="col-lg-6">
                <div class="management-card h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="section-header">
                            <i class="bi bi-tags me-2"></i> Product Categories
                        </h3>
                        <span class="badge badge-count"><?= count($categories) ?> items</span>
                    </div>
                    
                    <div class="scrollable-list mb-4">
                        <?php foreach ($categories as $category): ?>
                            <div class="form-check list-item">
                                <input class="form-check-input" type="radio" name="category_id" id="category_<?= $category['id'] ?>" value="<?= $category['id'] ?>" required>
                                <label class="form-check-label ms-2" for="category_<?= $category['id'] ?>">
                                    <?= esc($category['name']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="add-section">
                        <h5 class="mb-3 text-primary">
                            <i class="bi bi-plus-circle-dotted me-2"></i>Create New Category
                        </h5>
                        <div class="input-group">
                            <input type="text" id="new_category_name" class="form-control input-custom" placeholder="e.g., Laptop, SmartPhone...">
                            <button type="button" id="add_category_btn" class="btn btn-primary-custom">
                                <i class="bi bi-plus-lg me-1"></i> Add
                            </button>
                        </div>
                        <small class="text-muted mt-1 d-block">Add the Categories for the products</small>
                    </div>
                </div>
            </div>
            
            <!-- Specifications Card -->
            <div class="col-lg-6">
                <div class="management-card h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="section-header">
                            <i class="bi bi-list-check me-2"></i> Product Specifications
                        </h3>
                        <span class="badge badge-count"><?= count($specifications) ?> items</span>
                    </div>
                    
                    <div class="scrollable-list mb-4">
                        <?php foreach ($specifications as $spec): ?>
                            <div class="form-check list-item">
                                <input class="form-check-input" type="checkbox" name="specifications[]" id="spec_<?= $spec['id'] ?>" value="<?= $spec['id'] ?>">
                                <label class="form-check-label ms-2" for="spec_<?= $spec['id'] ?>">
                                    <?= esc($spec['name']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="add-section">
                        <h5 class="mb-3 text-primary">
                            <i class="bi bi-plus-circle-dotted me-2"></i>Create New Specification
                        </h5>
                        <div class="input-group">
                            <input type="text" id="new_spec_name" class="form-control input-custom" placeholder="e.g., Ram, Display, Weight...">
                            <button type="button" id="add_spec_btn" class="btn btn-primary-custom">
                                <i class="bi bi-plus-lg me-1"></i> Add
                            </button>
                        </div>
                        <small class="text-muted mt-1 d-block">Add Specifications for the Category</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="text-center mt-5 animate__animated animate__fadeInUp">
            <button type="submit" class="btn btn-primary-custom btn-lg px-5 py-3">
                <i class="bi bi-save me-2"></i> Add Specifications
            </button>
            <p class="text-muted mt-3">Selected specifications will be assigned to the chosen category</p>
        </div>
    </form>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary"><i class="bi bi-check-circle-fill me-2"></i>Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalMessage">Operation completed successfully.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-custom" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    
    document.getElementById('add_category_btn').addEventListener('click', function() {
        const name = document.getElementById('new_category_name').value.trim();
        if (name !== '') {
            fetch('<?= base_url('/add_category_ajax') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify({ category_name: name })
            }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Category Added!',
                        text: `"${name}" has been added to your categories.`,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message || 'Error adding category.'
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter a category name.'
            });
        }
    });
    
    document.getElementById('add_spec_btn').addEventListener('click', function() {
        const name = document.getElementById('new_spec_name').value.trim();
        if (name !== '') {
            fetch('<?= base_url('/add_specification_ajax') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify({ specification_name: name })
            }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Specification Added!',
                        text: `"${name}" has been added to your specifications.`,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message || 'Error adding specification.'
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter a specification name.'
            });
        }
    });
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.list-item').forEach((item, index) => {
        item.style.setProperty('--animate-delay', `${index * 0.05}s`);
        observer.observe(item);
    });
});
</script>
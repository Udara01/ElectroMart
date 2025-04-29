<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="/asset/Styles/shop.css">
  
  
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">🛍️ All Products</h2>
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-md-3">
            <form method="get" action="<?= base_url('productsShop') ?>" class="mb-3">
                <h5>Filter by</h5>

                <div class="mb-3">
                    <label>Categories:</label>
                    <select name="department" class="form-select" onchange="this.form.submit()">
                        <option value="all">All</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= ($filters['department'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                <?= esc($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Price:</label>
                    <select name="price" class="form-select">
                        <option value="">All</option>
                        <option value="1" <?= ($filters['price'] ?? '') == '1' ? 'selected' : '' ?>>Below Rs. 25</option>
                        <option value="2" <?= ($filters['price'] ?? '') == '2' ? 'selected' : '' ?>>Below Rs. 50</option>
                        <option value="3" <?= ($filters['price'] ?? '') == '3' ? 'selected' : '' ?>>Below Rs. 100</option>
                        <option value="4" <?= ($filters['price'] ?? '') == '4' ? 'selected' : '' ?>>Below Rs. 200</option>
                        <option value="5" <?= ($filters['price'] ?? '') == '5' ? 'selected' : '' ?>>Above Rs. 200</option>
                    </select>
                </div>

                <?php if (!empty($specOptions)) : ?>
                    <div class="mb-3">
                        <h6>Additional Filters</h6>
                        <?php foreach ($specOptions as $specKey => $options): ?>
                            <label><?= esc($specKey) ?>:</label>
                            <select name="<?= esc($specKey) ?>" class="form-select mb-2">
                                <option value="">All</option>
                                <?php foreach ($options as $opt): ?>
                                    <option value="<?= esc($opt) ?>" <?= ($filters[$specKey] ?? '') == $opt ? 'selected' : '' ?>>
                                        <?= esc($opt) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </form>
        </div>

        <!-- Product Cards -->
        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-img-wrapper">
                                    <?php if (!empty($product['discount'])): ?>
                                        <span class="discount-badge"><?= esc($product['discount']) ?>% OFF</span>
                                    <?php endif; ?>
                                    <img src="<?= $product['image'] ? base_url('uploads/' . $product['image']) : 'https://placehold.co/600x400/png' ?>"
                                         class="card-img-top" alt="Product Image">
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title"><?= esc($product['name']) ?></h5>
                                        <?php foreach ($product_spaces as $spec) : ?>
                                            <?php if ($spec['product_id'] == $product['id'] && $spec['spec_key'] == 'Brand') : ?>
                                                <p class="text-muted mb-1"><strong>Brand:</strong> <?= esc($spec['spec_value']) ?></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <p class="card-text"><?= esc($product['description']) ?></p>
                                        <p class="card-text"><strong>Rs. <?= esc($product['price']) ?></strong></p>
                                    </div>
                                    <button
                                        class="btn btn-primary add-to-cart-btn mt-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#productDetailModal"
                                        data-product="<?= htmlspecialchars(json_encode([
                                        'id' => $product['id'], 
                                        'name' => $product['name'],
                                        'description' => $product['description'],
                                        'price' => $product['price'],
                                        'image' => $product['image'] ? base_url('uploads/' . $product['image']) : 'https://placehold.co/600x400/png',
                                        'specs' => array_values(array_filter($product_spaces, fn($spec) => $spec['product_id'] == $product['id'])),
                                    ]), ENT_QUOTES, 'UTF-8') ?>"
                                    >View Details</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalContent">
        <!-- Filled dynamically with JS -->
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('productDetailModal');
    const modalFooter = modal.querySelector('.modal-footer');
    const modalContent = document.getElementById('modalContent');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const productData = JSON.parse(button.getAttribute('data-product'));

        
        const today = new Date();// Adding the current date for the PDF
        const formattedDate = today.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });

        let specHTML = '<div class="specs-columns"><ul>';
        productData.specs.forEach(spec => {
            specHTML += `<li><strong>${spec.spec_key}:</strong> ${spec.spec_value}</li>`;
        });
        specHTML += '</ul></div>';

        const content = `
            <div class="pdf-header">
                <h2>${productData.name}</h2>
                <div class="subtitle">Product Details | ${formattedDate}</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="${productData.image}" class="img-fluid" alt="Product Image">
                </div>
                <div class="col-md-6">
                    <p class="price"><strong>Price:</strong> Rs. ${productData.price}</p>
                    <p>${productData.description}</p>
                </div>
            </div>
            <h6>Specifications</h6>
            ${specHTML}
            <div class="pdf-footer">
                <p>© ${new Date().getFullYear()} ElectroMart. All rights reserved.</p>
            </div>
        `;

        modalContent.innerHTML = content;

        modalFooter.innerHTML = `
            <form method="post" action="<?= base_url('cart/add') ?>" class="d-inline">
                <input type="hidden" name="product_id" value="${productData.id}">
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
            <button type="button" class="btn btn-primary" id="downloadPdfBtn">
                <i class="bi bi-file-earmark-pdf"></i> Download PDF
            </button>
        `;

        const downloadBtn = document.getElementById('downloadPdfBtn');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', () => {
                // Show loading state
                downloadBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating PDF...';
                downloadBtn.disabled = true;
                
                // Prevent scrolling issues
                document.body.style.overflow = 'hidden';
                window.scrollTo(0, 0);
                
                // Add PDF export class
                modalContent.classList.add('pdf-export');

                const opt = {
                    margin: [0.2, 0.2, 0.2, 0.2], 
                    filename: `${productData.name.replace(/\s+/g, '_')}_details.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { 
                        scale: 2,
                        logging: false,
                        useCORS: true,
                        scrollY: 0, 
                        windowHeight: document.getElementById('modalContent').scrollHeight
                    },
                    jsPDF: { 
                        unit: 'in', 
                        format: 'letter', 
                        orientation: 'portrait',
                        hotfixes: ["px_scaling"] 
                    },
                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                };

                // Generate PDF
                html2pdf().set(opt).from(modalContent).save().then(() => {
                    // Clean up
                    modalContent.classList.remove('pdf-export');
                    downloadBtn.innerHTML = '<i class="bi bi-file-earmark-pdf"></i> Download PDF';
                    downloadBtn.disabled = false;
                    document.body.style.overflow = '';
                });
            });
        }
    });
});
</script>

</body>
</html>
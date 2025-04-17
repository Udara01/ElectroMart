<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My E-Commerce - Categories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card:hover .add-to-cart-btn {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    .add-to-cart-btn {
      transition: all 0.3s ease;
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
    }
    .discount-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: red;
      color: white;
      padding: 5px 10px;
      font-size: 0.9rem;
      border-radius: 5px;
      z-index: 1;
    }
    .card-img-wrapper {
      position: relative;
    }
  </style>
</head>
<body>
<div class="container mt-4">

  <!-- Section 1: Top Selling -->
  <h2 class="mb-4">Top Selling</h2>
<div class="row row-cols-1 row-cols-md-4 g-4">
  <?php foreach ($topSelling as $product): ?>
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-img-wrapper">
          <span class="discount-badge">Top</span>
          <img src="<?= base_url('uploads/' . $product['image']) ?>" class="card-img-top" alt="<?= esc($product['name']) ?>">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title"><?= esc($product['name']) ?></h5>
            <p class="card-text"><?= esc($product['description']) ?></p>
            <p class="card-text"><strong>$<?= esc($product['price']) ?></strong></p>
          </div>
          <button
                        class="btn btn-primary mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#productDetailModal"
                        data-product='<?= htmlspecialchars(json_encode([
                           'id' => $product['id'], 
                            'name' => $product['name'],
                            'description' => $product['description'],
                            'price' => $product['price'],
                            'brand' => $product['brand_name'] ?? 'N/A',
                            'image' => $product['image'] ? base_url('uploads/' . $product['image']) : 'https://placehold.co/600x400/png',
                            'specs' => $product['specs'] ?? [],
                        ]), ENT_QUOTES, 'UTF-8') ?>'
                    >View Details</button>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>


<!-- Section 2: Hottest/New Products -->
<h2 class="my-5">Explore Hottest Products</h2>

<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php foreach ($newProducts as $product): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-img-wrapper position-relative">
                    <span class="badge bg-success position-absolute top-0 start-0 m-2">NEW</span>
                    <img src="<?= base_url('uploads/' . $product['image']) ?>" class="card-img-top" alt="<?= esc($product['name']) ?>">
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><?= esc($product['name']) ?></h5>
                        <p class="card-text"><?= esc($product['description']) ?></p>
                        <p class="card-text"><strong>Rs. <?= esc($product['price']) ?></strong></p>
                    </div>
                    <button
                        class="btn btn-primary mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#productDetailModal"
                        data-product='<?= htmlspecialchars(json_encode([
                            'id' => $product['id'], 
                            'name' => $product['name'],
                            'description' => $product['description'],
                            'price' => $product['price'],
                            'brand' => $product['brand_name'] ?? 'N/A',
                            'image' => $product['image'] ? base_url('uploads/' . $product['image']) : 'https://placehold.co/600x400/png',
                            'specs' => $product['specs'] ?? [],
                        ]), ENT_QUOTES, 'UTF-8') ?>'
                    >View Details</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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
    const modalContent = document.getElementById('modalContent');
    const modalFooter = modal.querySelector('.modal-footer'); // Get footer element

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const productData = JSON.parse(button.getAttribute('data-product'));

        let specHTML = '<ul>';
        (productData.specs || []).forEach(spec => {
            specHTML += `<li><strong>${spec.spec_key}:</strong> ${spec.spec_value}</li>`;
        });
        specHTML += '</ul>';

        const content = `
            <div class="row">
                <div class="col-md-6">
                    <img src="${productData.image}" class="img-fluid" alt="Product Image">
                </div>
                <div class="col-md-6">
                    <h5>${productData.name}</h5>
                    <p><strong>Brand:</strong> ${productData.brand}</p>
                    <p><strong>Price:</strong> Rs. ${productData.price}</p>
                    <p>${productData.description}</p>
                    <h6>Specifications:</h6>
                    ${specHTML}
                </div>
            </div>
        `;

        modalContent.innerHTML = content;

        //Add to Cart button form
        modalFooter.innerHTML = `
            <form method="post" action="<?= base_url('cart/add') ?>">
                <input type="hidden" name="product_id" value="${productData.id}">
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
        `;
    });
});

</script>

<!-- Bootstrap Bundle JS -->
</body>
</html>


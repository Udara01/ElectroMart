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
  <h2 class="mb-4">🔥 Top Selling</h2>
  <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php
    for ($cart = 0; $cart < 8; $cart++) {
        echo <<<HTML
        <div class="col">
          <div class="card h-100 shadow-sm">
            <div class="card-img-wrapper">
              <span class="discount-badge">20% OFF</span>
              <img src="https://placehold.co/600x400/png" class="card-img-top" alt="Product Image">
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title">Top Product {$cart}</h5>
                <p class="card-text">Best-selling product with great reviews and high demand.</p>
                <p class="card-text"><strong>\$29.99</strong></p>
              </div>
              <button class="btn btn-primary add-to-cart-btn mt-3">Add to Cart</button>
            </div>
          </div>
        </div>
        HTML;
    }
    ?>
  </div>

  <!-- Section 2: Hottest/New Products -->
  <h2 class="my-5">🌟 Explore Hottest Products</h2>
  <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php
    for ($cart = 8; $cart < 16; $cart++) {
        echo <<<HTML
        <div class="col">
          <div class="card h-100 shadow-sm">
            <div class="card-img-wrapper">
              <span class="discount-badge bg-success">NEW</span>
              <img src="https://placehold.co/600x400/png" class="card-img-top" alt="New Product">
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title">New Product {$cart}</h5>
                <p class="card-text">Recently added products with the latest features and designs.</p>
                <p class="card-text"><strong>\$24.99</strong></p>
              </div>
              <button class="btn btn-success add-to-cart-btn mt-3">Explore</button>
            </div>
          </div>
        </div>
        HTML;
    }
    ?>
  </div>

</div>

<!-- Bootstrap Bundle JS -->
</body>
</html>


  <style>
    .category-btn {
      background-color: #ffbf29;
      color: white;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      border: none;
    }

    .category-btn i {
      margin-right: 8px;
    }

    .navbar-nav .nav-link {
      padding: 0 15px;
      font-weight: 500;
      color: #000;
    }

    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:hover {
      color: orange;
    }
  </style>
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">

      <!-- All Categories Dropdown -->
      <div class="dropdown me-3">
        <button class="category-btn dropdown-toggle" role="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-list"></i> All Categories
        </button>
        
        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
          <li>
            <a class="dropdown-item" href="<?= base_url('productsShop?department=1') ?>"><i class="bi bi-laptop me-2"></i>Laptop</a>
            <a class="dropdown-item" href="<?= base_url('productsShop?department=2') ?>"><i class="bi bi-pc me-2"></i>PC</a>
            <a class="dropdown-item" href="<?= base_url('productsShop?department=3') ?>"><i class="bi bi-tablet me-2"></i>Tablet</a>
            <a class="dropdown-item" href="<?= base_url('productsShop?department=4') ?>"><i class="bi bi-phone me-2"></i>Mobile</a>
            <a class="dropdown-item" href="<?= base_url('productsShop?department=5') ?>"><i class="bi bi-tv me-2"></i>TV</a>
          </li>
        </ul>
      </div>

      <!-- Navbar Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="/home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/productsShop">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Most Popular</a></li>
          <li class="nav-item"><a class="nav-link" href="#">On Sale</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Computer & Laptop</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Home Appliances</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Bootstrap Bundle JS (required for dropdowns) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/asset/Styles/header.css">
</head>
<body> 
    <header class="header shadow-sm">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between py-2">
                
                <!-- Logo -->
                <a href="#!" class="d-flex align-items-center mb-2 mb-md-0">
                    <img src="<?= base_url('asset/Images/Logo.png') ?>" height="80" width="80" alt="Logo">

                </a>
                
                <!-- Search and Icons -->
                <div class="search-container w-100 mt-2 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="input-group search-box w-75">
                        <input type="text" class="form-control search-input" placeholder="Search...">
                        <span class="input-group-text bg-white border-start-0">
                            <i class="bi bi-search text-secondary"></i>
                        </span>
                    </div>   

                    <div class="icon-container ms-3">
                        <a href="#" class="icon-link" title="Wishlist">
                            <i class="bi bi-heart"></i>
                        </a>
                        <a href="/login" class="icon-link" title="Account">
                            <i class="bi bi-person-fill"></i>
                        </a>
                        <!--a href="#" class="icon-link position-relative" title="Cart">
                            <i class="bi bi-cart"></i>
                            <span class="cart-count">3</span>
                        </a-->

                        <?php
                            use App\Models\CartModel;

                            $cartCount = 0;
                            if (session()->get('logged_in')) {
                                $cartModel = new CartModel();
                                $cartCount = $cartModel->where('user_id', session()->get('user_id'))->countAllResults();
                            }
                        ?>
                        <a href="<?= base_url('cart') ?>" class="icon-link position-relative" title="Cart">
                            <i class="bi bi-cart"></i>
                            <?php if ($cartCount > 0): ?>
                                <span class="cart-count bg-danger">
                                    <?= $cartCount ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

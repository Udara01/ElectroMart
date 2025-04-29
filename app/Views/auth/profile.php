<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php
        echo view('layouts/header');
        echo view('layouts/navbar');
    ?>

    <div class="container py-5">
        <div class="row">
            
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="<?= base_url('asset/Images/default-user.png') ?>" alt="User Avatar" class="rounded-circle mb-3" width="120" height="120">
                        <h5 class="card-title mb-0"><?= esc($user['username']) ?></h5>
                        <small class="text-muted"><?= esc($user['email']) ?></small>
                        <div class="mt-3">
                            <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm w-100 mb-2">Logout</a>
                            <a href="<?= base_url('edit-profile') ?>" class="btn btn-outline-primary btn-sm w-100">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Account Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
                        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                        <p><strong>Account Created:</strong> <?= esc(date('F j, Y', strtotime($user['created_at']))) ?></p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Your Orders</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">No orders found yet. Start shopping now!</p>
                        <a href="<?= base_url('shop') ?>" class="btn btn-success">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        echo view('layouts/footer');
    ?>
</body>
</html>

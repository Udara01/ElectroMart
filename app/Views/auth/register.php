<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php
        echo view('layouts/header');
        echo view('layouts/navbar');
    ?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">User Registration</div>
        <div class="card-body">
          <form method="post" action="<?= base_url('/user_register') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="conf_password" class="form-label">Confirm Password</label>
              <input type="password" name="conf_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
          <div class="text-center mt-2">
            <small>Already have an account? <a href='/login'>Login</a></small>
          </div>
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

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
        <div class="card-header bg-primary text-white">User Login</div>
        <div class="card-body">
          <form method="post" action="<?= base_url('/user_login') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="login" class="form-label">Email or Username</label>
              <input type="text" name="login" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
          <div class="text-center mt-2">
            <small>Don't have an account? <a href='/register'>Register</a></small>
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-box {
      max-width: 400px;
      padding: 2rem;
      border-radius: 12px;
      background-color: #fff;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    .logo {
      width: 80px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

<div class="login-box text-center">
  <img src="<?= base_url('asset/Images/Logo.png') ?>" class="logo" alt="Admin Logo">
  <h4 class="mb-4">Admin Login</h4>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>

  <form action="<?= base_url('admin/login') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3 text-start">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" id="username" required>
    </div>
    <div class="mb-3 text-start">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
</div>

</body>
</html>

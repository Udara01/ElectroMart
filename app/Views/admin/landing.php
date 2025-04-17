<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('/asset/Images/admin-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .login-form {
            display: none;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
        }
        .btn-login {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1 class="mb-4">Welcome to Admin Portal</h1>
    <button class="btn btn-warning btn-lg" onclick="showLogin()">Login</button>

    <div class="login-form mt-4" id="loginForm">
        <form method="post" action="<?= site_url('admin/login') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').style.display = 'block';
        }
    </script>

</body>
</html>

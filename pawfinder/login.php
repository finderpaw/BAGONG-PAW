<?php
session_start();

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

$pet_id = $_GET['pet_id'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfinder - Account Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-card">

    <div class="sidebar-left">
        <div>
            <div class="brand-logo">PAWFINDER</div>

            <div class="welcome-text">
                <h3>Welcome Back!</h3>
                <p>Log in to access your account, check pet rescue updates, and connect with the community.</p>
            </div>
        </div>

        <div>
            <div class="sidebar-img-container">
                <img src="image/animal.jpg" alt="Friendly pet">
            </div>

            <div class="register-link">
                Don't have an account?<br>
                <a href="register.php">Create an Account </a>
            </div>
        </div>
    </div>

    <div class="form-right">

        <h2>Sign In to Pawfinder</h2>

        <?php if (!empty($error)): ?>
            <p class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <p>Please enter your credentials to log into your account.</p>

        <form action="login_process.php" method="POST">

            <input type="hidden" name="pet_id"
                   value="<?php echo htmlspecialchars($pet_id); ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text"
                       id="username"
                       name="username"
                       placeholder="Enter username"
                       required
                       autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="******"
                       required
                       autocomplete="current-password">
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember_me">
                    Remember me
                </label>

                <a href="forgot_password.php" class="forgot-password">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="btn-submit">
                Sign In
            </button>

        </form>

    </div>
</div>

</body>
</html>

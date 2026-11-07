<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

$username_email = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$pet_id = (int)($_POST['pet_id'] ?? 0);

if ($username_email === '' || $password === '') {
    $_SESSION['error'] = "Please enter your username and password.";
    header("Location: login.php");
    exit();
}

// Find user (FIX 1: your accounts are saved in the `users` table)
$sql = "SELECT id, username, password, role
        FROM users
        WHERE username = ? OR email = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    $_SESSION['error'] = "Database query failed.";
    header("Location: login.php");
    exit();
}

mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) === 1) {

    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
    mysqli_stmt_fetch($stmt);

    // FIX 2: removed the extra "{" that was here
    if (!empty($hashed_password) && password_verify($password, $hashed_password)) {

        session_regenerate_id(true);

        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['logged_in'] = true;

        mysqli_stmt_close($stmt);

        // Pet details redirect
        if ($pet_id > 0) {
            header("Location: pet_details.php?id=" . $pet_id);
            exit();
        }

        // Role-based redirect
        $user_role = strtolower(trim((string)$role));

        switch ($user_role) {

            case 'admin':
                header("Location: admin.php");
                break;

            case 'rescuer':
            case 'rescuers':
                header("Location: rescue.php");
                break;

            // FIX 3: added 'guest' and 'adopter' so those accounts can log in
            case 'visitor':
            case 'local':
            case 'guest':
            case 'adopter':
                header("Location: homepage.php");
                break;

            default:
                session_destroy();
                session_start();
                $_SESSION['error'] = "Invalid account role.";
                header("Location: login.php");
                break;
        }

        exit();
    }
}

mysqli_stmt_close($stmt);

$_SESSION['error'] = "Invalid username/email or password.";

$redirect = "login.php";

if ($pet_id > 0) {
    $redirect .= "?pet_id=" . $pet_id;
}

header("Location: " . $redirect);
exit();
?>
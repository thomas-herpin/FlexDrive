<?php
require_once 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = mysqli_prepare($conn, "SELECT id_user, first_name, last_name, email, password, role FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] === 'admin') {
            echo 'admin_success';
        } else {
            echo 'user_success';
        }
    } else {
        echo 'wrong_password';
    }
} else {
    echo 'user_not_found';
}

$stmt->close();
$conn->close();
?>

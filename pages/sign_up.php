<?php
require_once 'config.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

$checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
if ($checkEmail->get_result()->num_rows > 0) {
    echo "error: Email sudah terdaftar";
    exit();
}

if ($stmt->execute()) {
  echo "success";
} else {
  echo "error: " . $stmt->error;
}

$conn->close();
?>

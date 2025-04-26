<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_flexdrive";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$email = $_POST['email'];
$inputPassword = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
  if (password_verify($inputPassword, $user['password'])) {
    echo "success";
  } else {
    echo "wrong_password";
  }
} else {
  echo "user_not_found";
}

$conn->close();
?>

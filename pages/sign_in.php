<?php
require_once 'config.php';

$email = $_POST['email'];
$inputPassword = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
  if (password_verify($inputPassword, $user['password'])) {
      // Simpan data user di session
      $_SESSION["user_id"] = $user["id"];
      $_SESSION["user_email"] = $user["email"];
      $_SESSION["user_name"] = $user["first_name"] . " " . $user["last_name"];
      echo "success";
  } else {
      echo "wrong_password";
  }
} else {
  echo "user_not_found";
}

$conn->close();
?>

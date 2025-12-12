<?php
session_start();
require 'db.php';

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            header("Location: index.php");
            exit;
        } else {
            $err = "Username atau password salah.";
        }
    } else {
        $err = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css?v=3"> 
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if (!empty($err)): ?>
        <div class="error-msg"><?= htmlspecialchars($err); ?></div>
    <?php endif; ?>

    <form method="POST" class="login-form">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>

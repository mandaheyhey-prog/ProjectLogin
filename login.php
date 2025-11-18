<?php
session_start();
if (isset($_SESSION['mandaheyhey-prog'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class="error">mandaheyhey-prog atau password salah!</p>
    <?php } ?>

    <form action="process_login.php" method="POST">
        <input type="text" name="mandaheyhey-prog" placeholder="mandaheyhey-prog" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">LOGIN</button>
    </form>
</div>

</body>
</html>
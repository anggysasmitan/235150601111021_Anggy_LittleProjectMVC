<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="../login.php" method="POST">
        <input type="text" name="nim" placeholder="NIM" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register_view.php">Daftar di sini</a></p>
</body>
</html>
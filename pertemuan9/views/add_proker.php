<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login_view.php");
    exit();
}
include_once '../controllers/ProgramKerja.php';
$controller = new ProgramKerjaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->addProker();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Program Kerja</title>
</head>

<body>
    <h2>Tambah Program Kerja</h2>
    <form action="" method="POST">
        <label>Nomor Program:</label><br>
        <input type="number" name="nomor" required><br><br>

        <label>Nama Program:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Surat Keterangan:</label><br>
        <input type="text" name="surat_keterangan" required><br><br>

        <button type="submit">Tambah Program Kerja</button>
    </form>
</body>

</html>
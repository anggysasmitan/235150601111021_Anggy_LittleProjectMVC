<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login_view.php");
    exit();
}
include_once '../controllers/ProgramKerja.php';
$controller = new ProgramKerjaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->updateProker();
    header("Location: list_proker.php");
    exit();
}

if (isset($_GET['nomor'])) {
    $nomorProgram = (int)$_GET['nomor'];
    $program = $controller->programModel->fetchOneProgramKerja($nomorProgram);
} else {
    header("Location: list_proker.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Program Kerja</title>
</head>

<body>
    <h2>Edit Program Kerja</h2>
    <form action="edit_proker.php" method="POST">
        <label>Nomor Program:</label><br>
        <input type="number" name="nomor" value="<?= htmlspecialchars($program['nomor']) ?>" readonly><br><br>

        <label>Nama Program:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($program['nama']) ?>" required><br><br>

        <label>Surat Keterangan:</label><br>
        <input type="text" name="surat_keterangan" value="<?= htmlspecialchars($program['surat_keterangan']) ?>" required><br><br>

        <button type="submit">Update Program Kerja</button>
    </form>
</body>

</html>
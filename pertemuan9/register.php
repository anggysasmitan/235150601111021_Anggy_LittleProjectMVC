<?php

require_once 'controllers/PengurusController.php';

$pengurusController = new PengurusController();
$pengurusController->registerAccount();


// Pastikan kamu sudah melakukan koneksi ke database di sini.
$host = 'localhost'; // ganti dengan host database kamu
$user = 'root'; // ganti dengan username database kamu
$pass = ''; // ganti dengan password database kamu
$dbname = 'bem'; // ganti dengan nama database kamu

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama = htmlspecialchars($_POST['nama']);
    $nim = htmlspecialchars($_POST['nim']);
    $angkatan = htmlspecialchars($_POST['angkatan']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $foto = htmlspecialchars($_POST['foto']);
    $password = $_POST['password'];

    // Validasi input (misalnya, memeriksa apakah NIM sudah terdaftar)
    $sql = "SELECT * FROM users WHERE nim = '$nim'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "NIM sudah terdaftar!";
    } else {
        // Enkripsi password menggunakan password_hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Menyimpan data pengguna ke dalam database
        $sql_insert = "INSERT INTO users (nama, nim, angkatan, jabatan, foto, password)
                        VALUES ('$nama', '$nim', '$angkatan', '$jabatan', '$foto', '$hashed_password')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Registrasi berhasil!";
            header("Location: login_view.php"); // Redirect ke halaman login
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

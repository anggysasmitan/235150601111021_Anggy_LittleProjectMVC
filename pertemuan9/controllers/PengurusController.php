<?php

include_once("model/PengurusBEM.php");

class PengurusController 
{
    private $pengurusModel;

    public function __construct()
    {
        $this->pengurusModel = new PengurusBEM();
        session_start();
    }

    public function viewRegister()
    {
        include("views/register_view.php");
    }

    public function registerAccount()
    {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $angkatan = $_POST['angkatan'];
        $jabatan = $_POST['jabatan'];
        $foto = $_POST['foto'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $this->pengurusModel->createModel($nama, $nim, $angkatan, $jabatan, $foto, $password);

        if ($this->pengurusModel->insertPengurusBEM()) {
            header("Location: views/login_view.php");
            exit();
        } else {
            echo "Registrasi gagal!";
        }
    }

    public function viewLogin()
    {
        include("views/login_view.php");
    }

    public function loginAccount()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nim = $_POST['nim'];
            $password = $_POST['password'];

            if ($this->pengurusModel->validateLogin($nim, $password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['nim'] = $nim;
                header("Location: views/list_proker.php");
                exit();
            } else {
                echo "Login gagal, periksa NIM atau password.";
            }
        } else {
            $this->viewLogin();
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: views/login_view.php");
        exit();
    }
}
?>

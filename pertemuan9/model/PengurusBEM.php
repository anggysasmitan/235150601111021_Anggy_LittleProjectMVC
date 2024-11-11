<?php

require("config/koneksi_mysql.php");

class PengurusBEM 
{
    private $nama;
    private $nim;
    private $angkatan;
    private $jabatan;
    private $foto;
    private $password;

    public function createModel($nama, $nim, $angkatan, $jabatan, $foto, $password) 
    {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->angkatan = $angkatan;
        $this->jabatan = $jabatan;
        $this->foto = $foto;
        $this->password = $password;
    }

    public function insertPengurusBEM() 
    {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO pengurus_bem (nama, nim, angkatan, jabatan, foto, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $this->nama, $this->nim, $this->angkatan, $this->jabatan, $this->foto, $this->password);
        return $stmt->execute();
    }

    public function validateLogin($nim, $password)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT password FROM pengurus_bem WHERE nim = ?");
        $stmt->bind_param("s", $nim);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return password_verify($password, $data['password']);
        }
        return false;
    }
}
?>

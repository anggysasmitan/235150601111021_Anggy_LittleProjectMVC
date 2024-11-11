<?php

include_once '../config/koneksi_mysql.php';


class ProgramKerja 
{
    private $nomorProgram;
    private $nama;
    private $suratKeterangan;

    public function createModel($nomorProgram, $nama, $suratKeterangan) 
    {
        $this->nomorProgram = $nomorProgram;
        $this->nama = $nama;
        $this->suratKeterangan = $suratKeterangan;
    }

    public function fetchAllProgramKerja()
    {
        global $mysqli;
        $result = $mysqli->query("SELECT * FROM program_kerja");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchOneProgramKerja($nomorProgram)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT * FROM program_kerja WHERE nomor = ?");
        $stmt->bind_param("i", $nomorProgram);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertProgramKerja() 
    {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO program_kerja (nomor, nama, surat_keterangan) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $this->nomorProgram, $this->nama, $this->suratKeterangan);
        return $stmt->execute();
    }

    public function updateProgramKerja()
    {
        global $mysqli;
        $stmt = $mysqli->prepare("UPDATE program_kerja SET nama = ?, surat_keterangan = ? WHERE nomor = ?");
        $stmt->bind_param("ssi", $this->nama, $this->suratKeterangan, $this->nomorProgram);
        return $stmt->execute();
    }

    public function deleteProgramKerja($nomor)
    {
        global $mysqli;
        $stmt = $mysqli->prepare("DELETE FROM program_kerja WHERE nomor = ?");
        $stmt->bind_param("i", $nomor);
        return $stmt->execute();
    }
}
?>

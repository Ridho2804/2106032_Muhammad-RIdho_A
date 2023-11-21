<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_identitas = $_POST['jenis_identitas'];
    $tes_mengemudi = isset($_POST['tes_mengemudi']) ? 1 : 0;
    $tes_lisan = isset($_POST['tes_lisan']) ? 1 : 0;
    $tes_tulisan = isset($_POST['tes_tulisan']) ? 1 : 0;
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO permohonan_sim (user_id, jenis_identitas, tes_mengemudi, tes_lisan, tes_tulisan)
              VALUES ($user_id, '$jenis_identitas', $tes_mengemudi, $tes_lisan, $tes_tulisan)";

    if (mysqli_query($koneksi, $query)) {
        header("location: data_permohonan.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>

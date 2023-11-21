<?php
session_start();
include("koneksi.php");

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Permohonan SIM C</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['login_user']; ?>!</h2>

    <h3>Data Permohonan SIM C</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Jenis Identitas</th>
            <th>Tes Mengemudi</th>
            <th>Tes Lisan</th>
            <th>Tes Tulisan</th>
            <th>Action</th>
        </tr>
        <!-- Tampilkan data permohonan dari database -->
        <?php
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM permohonan_sim WHERE user_id = $user_id";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['jenis_identitas']}</td>";
            echo "<td>{$row['tes_mengemudi']}</td>";
            echo "<td>{$row['tes_lisan']}</td>";
            echo "<td>{$row['tes_tulisan']}</td>";
            echo "<td><a href='edit_permohonan.php?id={$row['id']}'>Edit</a></td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>

    <h3>Formulir Permohonan SIM C</h3>
    <form action="proses_permohonan.php" method="post">
        <!-- Tambahkan input untuk jenis identitas, tes, dan lain-lain -->
        <label for="jenis_identitas">Jenis Identitas:</label>
        <input type="text" id="jenis_identitas" name="jenis_identitas" required>

        <label for="tes_mengemudi">Tes Mengemudi:</label>
        <input type="checkbox" id="tes_mengemudi" name="tes_mengemudi">

        <label for="tes_lisan">Tes Lisan:</label>
        <input type="checkbox" id="tes_lisan" name="tes_lisan">

        <label for="tes_tulisan">Tes Tulisan:</label>
        <input type="checkbox" id="tes_tulisan" name="tes_tulisan">

        <input type="submit" value="Ajukan Permohonan">
    </form>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>

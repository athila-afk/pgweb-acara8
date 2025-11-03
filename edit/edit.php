<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

$sql = "UPDATE penduduk 
        SET kecamatan='$kecamatan', longitude='$longitude', latitude='$latitude', 
            luas='$luas', jumlah_penduduk='$jumlah_penduduk' 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diperbarui. <a href='../index.php'>Kembali</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

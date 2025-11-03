<?php
$id = $_GET['id'];

// Sesuaikan dengan setting MySQL kamu
$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP kosong
$dbname = "latihan7";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// DELETE query
$sql = "DELETE FROM penduduk WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

// balik ke index
header("Location: index.php");
exit();
?>

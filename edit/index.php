<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// pastikan parameter id ada dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID tidak valid atau tidak diberikan.");
}

// ambil data berdasarkan id
$sql = "SELECT * FROM penduduk WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html>
    <body>
        <h2>Form Edit</h2>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label>Kecamatan:</label><br>
            <input type="text" name="kecamatan" value="<?php echo $row['kecamatan']; ?>"><br>

            <label>Longitude:</label><br>
            <input type="text" name="longitude" value="<?php echo $row['longitude']; ?>"><br>

            <label>Latitude:</label><br>
            <input type="text" name="latitude" value="<?php echo $row['latitude']; ?>"><br>

            <label>Luas:</label><br>
            <input type="text" name="luas" value="<?php echo $row['luas']; ?>"><br>

            <label>Jumlah Penduduk:</label><br>
            <input type="text" name="jumlah_penduduk" value="<?php echo $row['jumlah_penduduk']; ?>"><br><br>

            <input type="submit" value="Submit">
        </form>
    </body>
    </html>
    <?php
} else {
    echo "Data tidak ditemukan.";
}
$conn->close();
?>

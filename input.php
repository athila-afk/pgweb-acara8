<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kecamatan = $_POST['kecamatan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $luas = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    // Koneksi database
    $conn = new mysqli("localhost", "root", "", "latihan7");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query insert
    $sql = "INSERT INTO penduduk (kecamatan, longitude, latitude, luas, jumlah_penduduk)
            VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Input Data Penduduk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            margin-top: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #bbb;
            border-radius: 6px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            background-color: #ff6fa5;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #ff4d88;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Input Data Penduduk</h2>
    <form action="input.php" method="POST">
        <label for="kecamatan">Kecamatan:</label>
        <input type="text" id="kecamatan" name="kecamatan" required>

        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" required>

        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" required>

        <label for="luas">Luas:</label>
        <input type="text" id="luas" name="luas" required>

        <label for="jumlah_penduduk">Jumlah Penduduk:</label>
        <input type="text" id="jumlah_penduduk" name="jumlah_penduduk" required>

        <input type="submit" value="Simpan">
    </form>
</div>

</body>
</html>

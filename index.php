<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penduduk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        thead {
            background-color: #ff6fa5;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #fce4ec;
        }
        .action-links {
            margin-bottom: 20px;
            text-align: center;
        }
        .action-links a {
            text-decoration: none;
            color: white;
            background-color: #ff6fa5;
            padding: 10px 15px;
            border-radius: 6px;
            margin: 0 5px;
            transition: background-color 0.3s;
        }
        .action-links a:hover {
            background-color: #ff4d88;
        }
        .table-actions a {
            text-decoration: none;
            color: #337ab7;
            margin-right: 10px;
        }
        .table-actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Penduduk</h2>

    <div class="action-links">
        <a href='input.php'>Input Data Baru</a>
        <a href='map.php'>Lihat Peta</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kecamatan</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Luas (km²)</th>
                <th>Jumlah Penduduk</th>
                <th colspan='2'>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Sesuaikan dengan setting MySQL kamu
            $servername = "localhost";
            $username = "root";
            $password = ""; // kosongkan jika default XAMPP
            $dbname = "latihan7";

            // Buat koneksi
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM penduduk";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["kecamatan"]) . "</td>
                            <td>" . htmlspecialchars($row["longitude"]) . "</td>
                            <td>" . htmlspecialchars($row["latitude"]) . "</td>
                            <td>" . htmlspecialchars($row["luas"]) . "</td>
                            <td align='right'>" . number_format($row["jumlah_penduduk"]) . "</td>
                            <td class='table-actions'><a href='edit/index.php?id=" . $row["id"] . "'>Edit</a></td>
                            <td class='table-actions'><a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\");'>Hapus</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

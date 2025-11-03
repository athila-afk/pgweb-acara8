<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT kecamatan, longitude, latitude, luas, jumlah_penduduk FROM penduduk";
$result = $conn->query($sql);

$features = [];
while ($row = $result->fetch_assoc()) {
    $features[] = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'Point',
            'coordinates' => [(float)$row['longitude'], (float)$row['latitude']]
        ],
        'properties' => [
            'name' => $row['kecamatan'],
            'luas' => $row['luas'],
            'jumlah_penduduk' => $row['jumlah_penduduk']
        ]
    ];
}

$geojson = [
    'type' => 'FeatureCollection',
    'features' => $features
];

echo json_encode($geojson);

$conn->close();
?>

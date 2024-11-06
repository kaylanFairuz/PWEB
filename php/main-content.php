<?php
$sqlFilePath = __DIR__ . "\..\sql\initial.sql";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pweb2";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT SCHEMA_NAME FROM information_schema.SCHEMATA WHERE SCHEMA_NAME = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dbname);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $conn->select_db($dbname);
} else {
    $sql = "CREATE DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        $conn->select_db($dbname);
        if (file_exists($sqlFilePath)) {
            $sql = file_get_contents($sqlFilePath);
            if ($sql !== false) {
                $queries = explode(';', $sql);
                foreach ($queries as $query) {
                    $query = trim($query);
                    if (!empty($query)) {
                        if ($conn->query($query) === FALSE) {
                            echo "Error executing query: " . $conn->error;
                        }
                    }
                }
            } else {
                echo "Error reading SQL file content.";
            }
        } else {
            echo "SQL file not found at path: " . $sqlFilePath;
        }
    }
}

$sql = "SELECT title, description, image_path, link FROM cards";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<main>';
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="card">
            <a href="' . $row['link'] . '">
                <img src="' . $row['image_path'] . '" alt="' . $row['title'] . '" class="card-image" />
            </a>
            <div class="card-content">
                <h2 class="card-title">' . $row['title'] . '</h2>
                <p class="card-description">' . $row['description'] . '</p>
            </div>
        </div>';
    }
    echo '</main>';
} else {
    echo "No cards available.";
}

$conn->close();

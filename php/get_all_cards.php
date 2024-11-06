<?php
include 'dbconnect.php';

$query = "SELECT id, title FROM cards";
$result = $conn->query($query);

$cards = [];
while ($card = $result->fetch_assoc()) {
    $cards[] = $card;
}

echo json_encode($cards);

// Close the connection
$conn->close();

<?php
include 'dbconnect.php';

$sql = "SELECT UPPER(SUBSTRING(title, 1, 1)) AS first_letter, COUNT(*) AS count
        FROM cards
        GROUP BY first_letter
        ORDER BY first_letter";
$result = $conn->query($sql);

$letters = [];
if ($result->num_rows > 0) {
    // Process each result and store the data in an array
    while ($row = $result->fetch_assoc()) {
        $letters[] = $row;
    }
} else {
    echo "No results found.";
}

$conn->close();
?>

<aside class="archive-bar">
    <hr />
    <b>Entry</b>
    <?php foreach ($letters as $letter): ?>
        <div class="archive-item">
            <button class="archive-toggle" data-letter="<?php echo $letter['first_letter']; ?>">
                ▸ <?php echo $letter['first_letter']; ?> (<?php echo $letter['count']; ?>)
            </button>
            <ul class="archive-dropdown">
                <?php
                // Fetch the cards starting with this letter
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql_cards = "SELECT title FROM cards WHERE UPPER(SUBSTRING(title, 1, 1)) = ? ORDER BY title";
                $stmt = $conn->prepare($sql_cards);
                $stmt->bind_param("s", $letter['first_letter']);
                $stmt->execute();
                $stmt->bind_result($name);

                // Display each card for this letter
                while ($stmt->fetch()) {
                    echo "<li>" . htmlspecialchars($name) . "</li>";
                }

                $stmt->close();
                $conn->close();
                ?>
            </ul>
        </div>
    <?php endforeach; ?>
    <hr />
</aside>
<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$dbname = "pweb2";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the country name from the URL (for example, 'africa')
$country = isset($_GET['country']) ? $_GET['country'] : 'Africa';

// Query to get the country details from the cards table
$query = "SELECT * FROM cards WHERE title = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $country);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $countryData = $result->fetch_assoc();
    $countryName = $countryData['title'];
    $countryImage = $countryData['image_path'];

    // Query to get content sections for the country
    $contentQuery = "SELECT * FROM cards_contents WHERE card_id = ?";
    $contentStmt = $conn->prepare($contentQuery);
    $contentStmt->bind_param('i', $countryData['id']);
    $contentStmt->execute();
    $contentResult = $contentStmt->get_result();
} else {
    echo "Country not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CTheEarth | <?php echo $countryName; ?></title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/country.css" />
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon" />
</head>

<body>
    <header>
        <?php include '../php/navbar.php'; ?>
    </header>

    <section class="banner" style="background-image: url(<?php echo "../$countryImage"; ?>);">
        <section class="slide active">
            <h1><?php echo $countryName; ?></h1>
        </section>
    </section>

    <?php while ($content = $contentResult->fetch_assoc()): ?>
        <section>
            <div class="text-image-container">
                <?php if ($content['image_path']): ?>
                    <img src="<?php echo $content['image_path']; ?>" alt="Description of image" class="side-image" />
                <?php endif; ?>
                <div class="text-content">
                    <h2><?php echo $content['section_title']; ?></h2>
                    <p><?php echo $content['section_content']; ?></p>
                </div>
            </div>
        </section>
    <?php endwhile; ?>

    <footer>
        <?php
        $FilePath = __DIR__ . "/../php/footer.php";
        include $FilePath;
        ?>
    </footer>

    <script src="../js/login.js"></script>
    <?php
    $FilePath = __DIR__ . "/../php/modals.php";
    include $FilePath;
    ?>
</body>

</html>

<?php
$stmt->close();
$contentStmt->close();
$conn->close();
?>
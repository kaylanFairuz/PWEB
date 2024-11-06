<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect to visitor homepage if not admin
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'dbconnect.php';

    // Sanitize and get form data
    $title = $_POST['cardTitle']; // Card Title
    $mainImagePath = uploadImage($_FILES['cardImage'], $title);
    $link = 'pages/country.php?country=' . urlencode($title);
    $description = $_POST['contentText'][0]; // Take the first content text as description

    // Insert into `cards` table
    $stmt = $conn->prepare("INSERT INTO cards (title, description, image_path, link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $mainImagePath, $link);
    $stmt->execute();
    $card_id = $stmt->insert_id;
    $stmt->close();

    // Loop through content sections and insert them into `cards_contents` table
    $sectionCount = count($_POST['contentText']); // Number of content sections (based on contentText[] array)
    for ($i = 0; $i < $sectionCount; $i++) {
        $sectionTitle = $_POST['contentTitle'][$i] ?? null;
        $sectionContent = $_POST['contentText'][$i];

        // Handle file upload for content images
        if (isset($_FILES['contentImage']['name'][$i]) && $_FILES['contentImage']['name'][$i] !== '') {
            $contentImageFile = [
                'name' => $_FILES['contentImage']['name'][$i],
                'type' => $_FILES['contentImage']['type'][$i],
                'tmp_name' => $_FILES['contentImage']['tmp_name'][$i],
                'error' => $_FILES['contentImage']['error'][$i],
                'size' => $_FILES['contentImage']['size'][$i]
            ];

            // Upload the content image and get the path
            $contentImagePath = uploadImage($contentImageFile, $title, $i + 1); // i + 1 for image name numbering
        } else {
            $contentImagePath = null;
        }

        $newContentImagePath = "../" . $contentImagePath;

        // Insert into `cards_contents` table
        $stmt = $conn->prepare("INSERT INTO cards_contents (card_id, section_title, section_content, image_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $card_id, $sectionTitle, $sectionContent, $newContentImagePath);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    header("Location: ..\admin_index.php"); // Redirect back to admin homepage after processing
    exit();
}

// Function to handle image upload
function uploadImage($file, $title = "", $index = "")
{
    $uploadDir = "../assets/";
    $relativePath = "assets/";
    $safeTitle = strtolower(str_replace(" ", "_", $title)); // sanitize title for file name
    $fileInfo = pathinfo($file["name"]);
    $extension = isset($fileInfo['extension']) ? $fileInfo['extension'] : 'jpg'; // Default to jpg if extension is missing
    $targetFile = $uploadDir . $safeTitle . $index . '.' . $extension; // Destination file path
    $dbPath = $relativePath . $safeTitle . $index . '.' . $extension; // Path to store in the database

    // Check if the file is a valid image
    if (getimagesize($file["tmp_name"]) === false) {
        die("File is not an image.");
    }

    // Attempt to move the uploaded file to the desired directory
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $dbPath;
    } else {
        die("Error uploading the image: " . $file["name"]);
    }
}

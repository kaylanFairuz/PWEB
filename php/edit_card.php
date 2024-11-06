<?php
session_start();
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cardTitle'])) {
        // Update card title and description
        $cardTitle = $_POST['cardTitle'];
        $cardId = $_POST['cardId']; // Assuming cardId is sent to identify the card to update
        $description = $_POST['contentText'][0]; // Assuming first content text is the description
        $cardImage = $_FILES['cardImage']['name'];

        // Process image upload for the main card image
        if ($cardImage) {
            move_uploaded_file($_FILES['cardImage']['tmp_name'], "../assets/" . strtolower($cardTitle) . ".jpg");
            $cardImagePath = "../assets/" . strtolower($cardTitle) . ".jpg";
        } else {
            $cardImagePath = $_POST['existingImage']; // Use the existing image if not uploaded
        }

        // Update card in the database
        $query = "UPDATE cards SET title = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $cardTitle, $cardImagePath, $cardId);
        $stmt->execute();

        // Update card contents (if any)
        foreach ($_POST['contentText'] as $index => $contentText) {
            $contentTitle = $_POST['contentTitle'][$index];
            $contentImage = $_FILES['contentImage'][$index]['name'];

            // Process content images
            if ($contentImage) {
                move_uploaded_file($_FILES['contentImage'][$index]['tmp_name'], "../assets/content_" . $cardId . "_" . $index . ".jpg");
                $contentImagePath = "../assets/content_" . $cardId . "_" . $index . ".jpg";
            } else {
                $contentImagePath = $_POST['existingContentImages'][$index]; // Use the existing image
            }

            $updateContentQuery = "UPDATE cards_contents SET section_title = ?, section_content = ?, image_path = ? WHERE card_id = ? AND section_id = ?";
            $stmt = $conn->prepare($updateContentQuery);
            $stmt->bind_param('sssii', $contentTitle, $contentText, $contentImagePath, $cardId, $index);
            $stmt->execute();
        }

        header("Location: ..\admin_index.php"); // Redirect back to admin home
    }
}

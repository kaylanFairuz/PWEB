<?php
include 'dbconnect.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect if not admin
    exit();
}

// Check if card IDs are passed
if (isset($_POST['card_ids']) && is_array($_POST['card_ids'])) {
    $cardIds = $_POST['card_ids'];

    // Prepare the DELETE query
    $cardIdsPlaceholder = implode(',', array_fill(0, count($cardIds), '?')); // Generate placeholders
    $deleteQuery = "DELETE FROM cards WHERE id IN ($cardIdsPlaceholder)";

    if ($stmt = $conn->prepare($deleteQuery)) {
        // Bind parameters
        $stmt->bind_param(str_repeat('i', count($cardIds)), ...$cardIds); // 'i' for integers

        // Execute the query
        if ($stmt->execute()) {
            echo "Selected cards have been deleted successfully.";
        } else {
            echo "Error deleting cards: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
} else {
    echo "No cards selected.";
}

if ($_SESSION['user_role'] == 'admin') {
    header("Location: ..\admin_index.php");
    exit();
} else {
    header("Location: ..\index.php");
    exit();
}

// Close the database connection
$conn->close();

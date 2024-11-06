<?php
session_start();

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false && preg_match('/@.+\..+/', $email);
}

function isValidPassword($password)
{
    // Define forbidden words for passwords
    $forbiddenWords = ['offensiveWord1', 'offensiveWord2', 'racism', 'curseword']; // Add actual forbidden words here

    // Check if password length is within limit and contains only letters and numbers
    if (strlen($password) > 30 || !preg_match('/^[a-zA-Z0-9]+$/', $password)) {
        return false;
    }

    // Check if password contains any forbidden words (case-insensitive)
    foreach ($forbiddenWords as $word) {
        if (stripos($password, $word) !== false) {
            return false;
        }
    }

    return true;
}

include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email
    if (!isValidEmail($email)) {
        $_SESSION['register_email_error'] = "* Invalid email format.";
        header("Location: ../index.php");
        exit();
    }

    // Validate password
    if (!isValidPassword($password)) {
        $_SESSION['register_password_error'] = "* Password must be less than 30 characters, contain only letters and numbers, and must not contain offensive words.";
        header("Location: ../index.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['register_email_error'] = "* Email already registered.";
        header("Location: ../index.php");
        exit();
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        // Set session variables to log in user immediately
        $_SESSION['user_email'] = $email;
        $_SESSION['username'] = explode('@', $email)[0]; // Set username from email prefix

        header("Location: ../index.php");
        exit();
    }

    $stmt->close();
}

$conn->close();

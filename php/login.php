<?php
session_start();

include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['email_error'] = "* Email not registered";
        header("Location: ..\index.php");
        exit();
    } else {
        // Fetch the password from the database
        $stmt->bind_result($stored_password, $role);
        $stmt->fetch();

        if ($password !== $stored_password) {
            $_SESSION['password_error'] = "* Incorrect password";
            header("Location: ..\index.php");
            exit();
        } else {
            $_SESSION['user_email'] = $email;
            $_SESSION['username'] = explode('@', $email)[0];
            $_SESSION['user_role'] = $role;

            if ($remember) {
                setcookie("user_email", $email, time() + (7 * 24 * 60 * 60), "/");
            } else {
                setcookie("user_email", "", time() - 3600, "/");
            }

            if ($role == 'admin') {
                header("Location: ..\admin_index.php");
                exit();
            } else {
                header("Location: ..\index.php");
                exit();
            }
        }
    }
    $stmt->close();
}

$conn->close();

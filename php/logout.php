<?php
session_start();

// Unset all of the session variables
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy session and clear cookie
session_destroy();
setcookie("user_email", "", time() - 3600, "/"); // Clear the cookie

header("Location: ..\index.php");
exit();

<?php
// Check if a user is provided in the URL (e.g., check_user.php?user=admin)
if (isset($_GET['user'])) {

    // Database connection
    $db = new mysqli("db", "user", "password", "webapp");

    if ($db->connect_errno) {
        echo "DB Connection Error.";
        exit();
    }

    // --- VULNERABLE QUERY ---
    $sql = "SELECT * FROM users WHERE username = '" . $_GET['user'] . "'";

    $res = $db->query($sql);

    // This is a "Boolean-Based" response. It only says yes or no.
    if ($res && $res->num_rows > 0) {
        echo "User Found.";
    } else {
        echo "User Not Found.";
    }
    $db->close();
} else {
    echo "Please provide a user. (e.g., ?user=admin)";
}
?>
<!DOCTYPE html>
<html>
<head><title>Lab 4 - Login</title></head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Vulnerable Login Form (Lab 4)</h2>
    <form action="index.php" method="POST">
        <p>Username: <input type="text" name="user" /></p>
        <p>Password: <input type="password" name="pass" /></p>
        <p><input type="submit" value="Login" /></p>
    </form>
    <hr>

    <?php
    // Check if the form was submitted
    if (isset($_POST['user']) && isset($_POST['pass'])) {

        // Database connection details (from docker-compose)
        $db = new mysqli("db", "user", "password", "webapp");

        if ($db->connect_errno) {
            echo "Failed to connect to MySQL: " . $db->connect_error;
            exit();
        }

        // --- VULNERABLE QUERY ---
        // It directly inserts user input into the SQL string.
        $sql = "SELECT * FROM users WHERE username = '" . $_POST['user'] . 
               "' AND password = '" . $_POST['pass'] . "'";

        echo "<p><strong>Executing SQL:</strong> " . $sql . "</p>";

        $res = $db->query($sql);

        // Check if the query returned any rows
        if ($res && $res->num_rows > 0) {
            echo "<h2>Login Successful!</h2>";
            echo "<p>Query returned the following users:</p>";
            echo "<table border='1'><tr><th>ID</th><th>Username</th><th>Password</th><th>Role</th></tr>";
            // Loop through results and print them (to help with UNION attack)
            while($row = $res->fetch_assoc()) {
                echo "<tr><td>" . $row['id'] . "</td><td>" . $row['username'] . "</td><td>" . $row['password'] . "</td><td>" . $row['role'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>Login Failed.</h2>";
            // Show errors to help with debugging (and attacks!)
            echo "<p><strong>MySQL Error:</strong> " . $db->error . "</p>";
        }
        $db->close();
    }
    ?>
</body>
</html>
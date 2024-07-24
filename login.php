<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("3.95.230.147", "root", "", "windows");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable SQL query
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Windows Login Screen</title>
    <style></style>
</head>
<body>
    <div class="login-container">
        <div class="background"></div>
        <div class="login-box">
            <div class="clock-section">
                <p id="time"></p>
                <p id="date"></p>
            </div>
            <div class="avatar">
                <span class="avatar-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.6177 21.25C19.6177 17.6479 15.6021 14.7206 12 14.7206C8.39794 14.7206 4.38235 17.6479 4.38235 21.25" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 11.4559C14.404 11.4559 16.3529 9.50701 16.3529 7.10294C16.3529 4.69888 14.404 2.75 12 2.75C9.59594 2.75 7.64706 4.69888 7.64706 7.10294C7.64706 9.50701 9.59594 11.4559 12 11.4559Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </div>
            <form id="loginForm" method="POST" action="">
                <div class="input-wrapper">
                    <div>
                        <input type="text" name="username" class="pin-input" placeholder="Username" required />
                    </div>
                    <div>
                        <input type="password" name="password" class="pin-input" placeholder="PIN" required />
                    </div>
                </div>
                <input type="submit" style="display: none;" />
            </form>
            <a href="#" class="forgot-pin">I forgot my PIN</a>
            <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        </div>
    </div>
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");
            const timeString = `${hours}:${minutes}:${seconds}`;
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const dayName = days[now.getDay()];
            const monthName = months[now.getMonth()];
            const dateString = `${dayName}, ${monthName} ${now.getDate()}, ${now.getFullYear()}`;
            document.getElementById("time").textContent = timeString;
            document.getElementById("date").textContent = dateString;
        }
        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display clock immediately

        // Add event listener for form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });

        // Add event listener for enter key on password field
        document.querySelector('input[name="password"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('loginForm').submit();
            }
        });
    </script>
</body>
</html>

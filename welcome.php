<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Windows Error Screen</title>
  </head>
  <body>
    <!-- Flag CTF{TESTER} -->
    <div class="welcome-container">
    <div>
        <div class="sad-face">:(</div>
        <div class="message">
          Your PC ran into a problem and needs to restart. We're <br />
          just collecting some error info, and then we'll restart for <br />
          you.
        </div>
        <div class="progress">20% complete</div>
      </div>

      <div class="qr-code-section">
        <div class="qr-code">
          <img
            src=""
            alt="QR Code"
          />
        </div>
        <div>
          <div class="qr-info">
            <div class="info">
              For more information about this issue and possible fixes, visit
              https://www.windows.com/stopcode
            </div>

            <div class="info">
              If you call a support person, give them this info:
            </div>
            <div class="stop-code">Stop code: CRITICAL_PROCESS_DIED</div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

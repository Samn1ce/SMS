<?php
session_start();        // Start the session
$slug = $_SESSION['school_slug'];
session_unset();     // Remove all session variables
session_destroy();      // Destroy the session (log the user out)

header("Location: /schoolManagementSystem/s/$slug/login"); // Send user back to login
exit();

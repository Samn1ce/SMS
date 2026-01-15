<?php
include './includes/dbh.inc.php';

$session = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT id FROM sessions WHERE is_active = 1 LIMIT 1")
);
// Get active term
$term = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT id FROM terms 
        WHERE session_id = {$session['id']} AND is_active = 1 
        LIMIT 1"
    )
);
<?php
// Make sure DB is available
require_once __DIR__ . '/dbh.inc.php';

// Only run in July
// if (date('n') != 7) {
//   return;
// }

// $year = date('Y');
// $session_name = $year + 1 . '/' . ($year + 2);

// // Check if session already exists
// $stmt = mysqli_prepare($conn, 'SELECT id FROM sessions WHERE session_name = ?');
// mysqli_stmt_bind_param($stmt, 's', $session_name);
// mysqli_stmt_execute($stmt);
// $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

// // If it exists, stop
// if ($result) {
//   return;
// }

// // Insert new session (NOT active)
// $stmt = mysqli_prepare($conn, 'INSERT INTO sessions (session_name) VALUES (?)');
// mysqli_stmt_bind_param($stmt, 's', $session_name);
// mysqli_stmt_execute($stmt);

echo 'worked!!';

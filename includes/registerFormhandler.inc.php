<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/api-error.log');
error_reporting(E_ALL);

include 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $confirmPwd = $_POST['confirmPwd'];
  $surname = $_POST['surname'];
  $firstname = $_POST['firstname'];
  $othername = $_POST['othername'];
  $role = $_POST['role'];
  $class = !empty($_POST['class_id']) ? $_POST['class_id'] : null;
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $slug = $_SESSION['school_slug'];
  $school_id = $_SESSION['school_id'];

  // Function to easily redirect with old input values
  function redirectWithData($error, $email, $surname, $firstname, $othername)
  {
    $slug = $_SESSION['school_slug'];

    $url =
      "/schoolManagementSystem/s/$slug/register" .
      '&email=' .
      urlencode($email) .
      '&surname=' .
      urlencode($surname) .
      '&firstname=' .
      urlencode($firstname) .
      '&othername=' .
      urlencode($othername);
    header("Location: $url");
    exit();
  }

  // Validate all fields
  if (
    empty($email) ||
    empty($surname) ||
    empty($firstname) ||
    empty($pwd) ||
    empty($confirmPwd) ||
    empty($role) ||
    empty($dob) ||
    empty($gender) ||
    empty($class)
  ) {
    if ($role === 'student') {
      redirectWithData('emptyfields', $email, $surname, $firstname, $othername, $role, $class);
    }
  }

  if ($pwd !== $confirmPwd) {
    redirectWithData(
      'verifyconfirmpassword',
      $email,
      $surname,
      $firstname,
      $othername,
      $role,
      $class,
    );
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  $status = $role === 'teacher' ? 'pending' : 'accepted';

  $sql =
    'INSERT INTO users (school_id, email, pwd, surname, firstname, othername, class_id, roles, gender, dob, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param(
    $stmt,
    'isssssissss',
    $school_id,
    $email,
    $hashedPwd,
    $surname,
    $firstname,
    $othername,
    $class,
    $role,
    $gender,
    $dob,
    $status,
  );

  if (mysqli_stmt_execute($stmt)) {
    header("Location: /schoolManagementSystem/s/$slug/login?register=success");
    exit();
  } else {
    redirectWithData('sqlerror', $email, $email, $surname, $firstname, $othername, $role, $class);
  }
}

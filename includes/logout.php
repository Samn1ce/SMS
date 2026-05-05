<?php
require_once __DIR__ . '/../config/bootstrap.php';
$slug = $school_slug;
session_unset();
session_destroy();

header("Location: /schoolManagementSystem/s/$slug/login");
exit();

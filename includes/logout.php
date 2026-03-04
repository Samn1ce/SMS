<?php
$slug = $school_slug;
session_unset();
session_destroy();

header("Location: /schoolManagementSystem/s/$slug/login");
exit();

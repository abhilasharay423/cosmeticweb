<?php
session_start();
include __DIR__ . '/../components/connect.php';

// clear session data
$_SESSION = [];

// destroy session
session_destroy();

// redirect
header('Location:../admin/home.php');
exit;
?>
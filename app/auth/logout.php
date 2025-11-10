<?php
session_start(); //session activated

// delete stored session variables
$_SESSION = [];

// destroy the session
session_destroy();

// redirect to login page
header("Location: ../../index.html");
exit;
?>

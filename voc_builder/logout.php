<?php
session_start();
// $_SESSION['id'] = $_SESSION['id'] ?? '';
unset($_SESSION['id']);
session_destroy();
header('location:index.php');
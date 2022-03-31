<?php
session_start();
$_SESSION['id'] = $_SESSION['id'] ?? '';
$id = $_SESSION['id'];
//
if ($id == '') {
    header('location:index.php');
} else {
    unset($_SESSION['id']);
    session_destroy();
    header('location:index.php');
}




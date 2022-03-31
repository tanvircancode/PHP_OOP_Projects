<?php

include_once 'config.php';
include_once 'functions.php';

session_start();
$_SESSION['loggedin'] = $_SESSION['loggedin'] ?? '';

$obj = new Database();
$connection = $obj->xxx();

if (!$connection) {
            $status = implode('', $obj->getResult());

}

$_POST['action'] = $_POST['action'] ?? '';
if ($_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $obj->login('myclass', ['email' => $email, 'password' => $password]);
    if ($result) {
        // echo "Sec";exit;
        header('location:home.php');
    } else {
        $status = implode('', $obj->getResult());
        header("location:index.php?status={$status}");
    }
} else if ($_POST['action'] == 'register') {

    // new code
    //
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $roll = $_POST['roll'] ?? '';
    $cgpa = $_POST['cgpa'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $password = password_hash($password, PASSWORD_BCRYPT);

    $result = $obj->insert('myclass', ['name' => $name, 'email' => $email, 'password' => $password, 'cgpa' => $cgpa, 'gender' => $gender, 'roll' => $roll]);
    if ($result) {
        $status = implode('', $obj->getResult());
    } else {
        $status = implode('', $obj->getResult());
    }
    header("location:index.php?status={$status}");
} else if ($_POST['action'] == 'editByAdmin') {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $roll = $_POST['roll'] ?? '';
    $cgpa = $_POST['cgpa'] ?? '';
    $id = $_POST['user-id'] ?? '';

    $result = $obj->update('myclass', ['name' => $name, 'email' => $email, 'cgpa' => $cgpa, 'roll' => $roll], $id);
    if ($result) {
        $status = implode('', $obj->getResult());
        header("location:home.php");
    } else {
        $status = implode('', $obj->getResult());
        header("location:edit.php?status={$status}&editId={$id}");
    }
} else if ($_POST['action'] == 'memberRequest') {
    $id = $_POST['taskid'];
    $result = $obj->update('myclass', ['status' => 3], $id);
    header('location:home.php');
} else if ($_POST['action'] == 'adminRequest') {
    $id = $_POST['taskid'];
    $result = $obj->update('myclass', ['status' => 2], $id);
    header('location:home.php');
} else if ($_POST['action'] == 'deleteRequest') {
    $id = $_POST['taskid'];
    $result = $obj->delete('myclass', $id);
    header('location:home.php');
}

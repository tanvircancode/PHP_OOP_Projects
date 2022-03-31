<?php

include_once 'config.php';

$connection = new Connection();


if(!isset($_SESSION)){
    session_start();
}


$statusCode = 0;

if(!$connection){
    throw new Exception("Not connected<br>");
}

else{

$action = $_POST['action'] ?? '';

if($action == 'register'){

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if($email && $password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = "insert into users(email,password) values ('$email','$password')" ;
        $res = mysqli_query($connection, $query);
        if(mysqli_error($connection)){
            $statusCode = 1;
            // Duplicate email entered
        }
        else{
            $statusCode = 2;
            // Created successfully
        }
    }
    else
    {
        $statusCode = 3;
        // Email or password empty
    }
    header("location:index.php?status={$statusCode}");
}
else if($action == 'login'){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if($email && $password){
        // $password = password_hash($password,PASSWORD_BCRYPT);
        $query = "select id,password from users where email = '{$email}' " ;
        $res = mysqli_query($connection,$query);
        if(mysqli_num_rows($res) > 0){
            $data = mysqli_fetch_assoc($res);
            $pass = $data['password'];
            $id = $data['id'];
            if(password_verify($password,$pass)){
                $_SESSION['id'] = $id;
                header('location:words.php');
                return;
                // successfully login
            }
            else{
                $statusCode = 4;
                // email and password not matched
            }
        }
        else{
            $statusCode = 5;
            // no user registered with this email
        }
    }
    else{
        $statusCode = 6;
        // Email or pass empty
    }
    header("location:index.php?status={$statusCode}");
}
else if($action == "addword"){
    

    $word = $_POST['word'] ?? '';
    $meaning = $_POST['meaning'] ?? '';
    $user_id = $_SESSION['id'] ?? '';

    if($word && $meaning && $user_id){
        $query = "insert into words(user_id,word,meaning) values('$user_id','$word','$meaning')" ;
        $res = mysqli_query($connection, $query);
    }
   header('location: words.php');
}

}


?>

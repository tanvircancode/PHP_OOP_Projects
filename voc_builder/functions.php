<?php

include_once 'config.php';


$connection = new Connection();

// $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
// mysqli_set_charset($connection, "utf8");
if(!$connection){
    throw new Exception("Not connected<br>");
}

function getStatusCode($status){
    if($status==1)
    {
        return "Duplicate email entered";
    }
    else if($status==2){
        return "Created successfully";
    }
    else if($status==3){
        return "Email or password empty";
    }
    else if($status==4){
        return "Email and password not matched";
    }
    else if($status==5){
        return "No user registered with this email";
    }
    else if($status==6){
        return "Email or password empty";
    }
}

function getWords($user_id, $search=null){
    $connection = new Connection();

    if($search){
       $query = "select * from words where user_id = '{$user_id}' and word like '{$search}%' order by word";
       $res = mysqli_query($connection->conn(), $query);
       return $res;
    }
    $query = "select * from words where user_id = '{$user_id}' order by word";
    $res = mysqli_query($connection->conn(), $query);
    return $res;
}
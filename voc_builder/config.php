<?php
session_start();

class Connection
{
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db_name = "words_oop";
    public $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->host,
            $this->user, $this->password, $this->db_name);
    }
    public function conn()
    {
        $connection = mysqli_connect($this->host,
            $this->user, $this->password, $this->db_name);
        return $connection;
    }
}

class Reg extends Connection
{
    public $statusCode;
    public function registration($email, $password)
    {

        if ($email && $password) {
            $obj = new Connection();
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "insert into users(email, password) values('$email','$password')";
            $res = mysqli_query($obj->conn(), $query);
            if (mysqli_error($this->connection)) {
                return $statusCode = 1;
                //Duplicate email entered
            } else {
                return $statusCode = 2;
                // Created successfully
            }
        } else {
            return $statusCode = 3;
            // Email or password empty
        }
    }

}

class Login
{

    public $statusCode;
    public function login($email = '', $password = '')
    {
        if ($email && $password) {
            $obj = new Connection();
            // print_r($obj->xxx());exit;

            $query = "select id,password from users where email='$email' ";
            // print_r($this->connection);exit;
            $res = mysqli_query($obj->conn(), $query);
            if (mysqli_num_rows($res) > 0) {

                $data = mysqli_fetch_assoc($res);
                $password_hash = $data['password'];
                $id = $data['id'];
                if (password_verify($password, $password_hash)) {
                    $_SESSION['id'] = $id;
                    header('location:words.php');
                    return;
                } else {
                    return $statusCode = 4;
                    // email and password not matched
                }
            } else {
                return $statusCode = 5;
                // no user registered with this email
            }
        } else {
            return $statusCode = 6;
            // Email or pass empty
        }

    }
}

class Addword
{

    public function add_word($word = '', $meaning = '', $user_id = '')
    {
        if ($word && $meaning && $user_id) {
            $obj = new Connection();
            $query = "insert into words(user_id,word,meaning) values('$user_id','$word','$meaning')";

            $res = mysqli_query($obj->conn(), $query);
            header('location:words.php');
            return;
        }
    }
}

class Word
{

    public function words($user_id, $search=null)
    {
        $obj = new Connection();
        if ($search) {
            $query = "Select * from words where user_id='$user_id' and word like '$search%' order by word";
            $res = mysqli_query($obj->conn(), $query);
            return $res;
        }

        $query = "Select * from words where user_id='$user_id' order by word";
        $res = mysqli_query($obj->conn(), $query);
        return $res;
    }
}

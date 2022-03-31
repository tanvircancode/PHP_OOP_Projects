<?php

class Database
{

    public $db_host = "localhost";
    public $db_user = "root";
    public $db_pass = "";
    public $db_name = "university_student_management_oop";
    public $conn = false;
    public $mysqli = '';
    public $result = array();

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            $this->conn = true;

            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }
    public function xxx()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            $this->conn = true;

            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    public function insert($table, $params = array())
    {
        // print_r($params);exit;
        if ($this->tableExists($table)) {
            $email = $params['email'];
            $password = $params['password'];

            if ($email && $password) {

                $table_columns = implode(', ', array_keys($params));
                $table_value = implode("', '", $params);
                $sql = "insert into $table($table_columns) values('$table_value')";

                if ($this->mysqli->query($sql)) {
                    array_push($this->result, "information saved successfully");

                    return true;
                } else {
                    array_push($this->result, "Duplicate Email or Roll Number entered");
                    return false;
                }
            } else {
                array_push($this->result, "email or password is empty");
                return false;
            }

        } else {
            return false;
        }
    }

    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExists($table)) {
            $email = $params['email'] ?? '';
            $name = $params['name'] ?? '';
            $roll = $params['roll'] ?? '';
            $cgpa = $params['cgpa'] ?? '';
            $status = $params['status'] ?? '';

            $args = array();
            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }
// print_r($args);exit;

            $str = implode(', ', $args);
            if ($where != null) {
                $sql = "update $table set $str where id='$where'";
                // echo $sql;exit;
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, "Information updated successfully");
                return true;
            } else {
                array_push($this->result, "Duplicate Email or Roll entered");
                return false;
            }

        } else {
            return false;
        }
    }
    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {

            if ($where != null) {
                $sql = "delete from $table where id='$where'";
                // echo $sql;exit;
            }
            if ($this->mysqli->query($sql)) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    public function login($table, $params = array())
    {
        if ($this->tableExists($table)) {
            $email = $params['email'];
            $password = $params['password'];
            if ($email && $password) {
                $sql = "select * from $table where email='$email' ";
                $info = $this->mysqli->query($sql);
                $data = $info->fetch_assoc();
                $pass = $data['password'];
                if ($info) {
                    if ($info->num_rows > 0) {
                        if (password_verify($password, $pass)) {
                            $_SESSION['id'] = $data['id'];

                            return true;
                        } else {
                            array_push($this->result, "email and password didn't match");
                            return false;
                        }

                    } else {
                        array_push($this->result, $email . " Does not exist in database");
                        return false;

                    }
                } else {
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            } else {
                array_push($this->result, "email or password is empty");
                return false;
            }
        } else {
            array_push($this->result, $table . " Does not exist in database");
            return false;
        }
    }

    private function tableExists($table)
    {
        $query = "show tables from $this->db_name like '$table'";
        $tableInDb = $this->mysqli->query($query);
        if ($tableInDb) {
            if ($tableInDb->num_rows > 0) {
                return true;
            } else {
                array_push($this->result, $table . " Does not exist in database");
                return false;
            }
        }
    }

    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }

    }
}

class smallQueries extends Database
{

    public function singleId($id, $val = null)
    {
        $sql = "select * from myclass where id='$id' ";
        $info = $this->mysqli->query($sql);
        if ($val == 5) {
            return $info;
        }
        if ($info && $info->num_rows > 0) {
            $data = $info->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
    public function rollOrder($val = null)
    {
        $sql = "select * from myclass order by roll";
        $info = $this->mysqli->query($sql);

        if ($val == 5) {
            return $info;
        }
        if ($info) {
            $data = $info->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
    public function top5cgpa($table,$params = array())
    {
        $name = $params['name'];
        $cgpa = $params['cgpa'];
        $gender = $params['gender'];
        $args =  array();
        foreach($params as $param){
            $args[] = $param;
        }
        $str = implode(', ',$args);
        // print_r($args);exit;
        $sql = "select $str from $table order by cgpa desc limit 5";
        if($this->mysqli->query($sql)){
            return $this->mysqli->query($sql);
        }
    }
    public function maleFemaleList($table, $params = array(),$sex=null)
    {
        $name = $params['name'];
        $cgpa = $params['cgpa'];
        $roll = $params['roll'];
        $gender = $params['gender'];
        // echo $gender;exit;
        $args =  array();

        $str = implode(', ',$params);
        if($gender == 'Male'){
            $sql = "select $str from $table where gender='$sex' order by roll asc";
        }else{
            $sql = "select $str from $table where gender='$sex' order by roll asc";
        }
        if($this->mysqli->query($sql)){
            return $this->mysqli->query($sql);
        }
    }
    public function topMaleFemaleList($table, $params = array(),$sex=null)
    {
        $name = $params['name'];
        $cgpa = $params['cgpa'];
        $roll = $params['roll'];
        $gender = $params['gender'];
        // echo $sex;exit;
        $args =  array();

        $str = implode(', ',$params);
        if($gender == 'Male'){
            $sql = "select $str from $table where gender='$sex' order by cgpa desc limit 5";
        }else{
            $sql = "select $str from $table where gender='$sex' order by cgpa desc limit 3";
        }
        if($this->mysqli->query($sql)){
            return $this->mysqli->query($sql);
        }
    }

}

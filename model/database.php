<?php
// creating a database connection
class Database
{
    private $host = "localhost";
    private $dbname = "db_natures_notebook";
    private $username = 'BusyBees';
    private $password = 'SierJerSDC480';
    private $conn;
    private $conn_error;

    function __construct()
    {
        try {
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        } catch (\Throwable $th) {
            $this->conn_error ="Failed to connect to DB: " . mysqli_connect_error();
        }
    }

    function __destruct()
    {
        if ($this->conn){
            mysqli_close($this->conn);
        }
    }

    function getDBConn(){
        return $this->conn;
    }

    function getDBError(){
        return $this->conn_error;
    }

    function getDbHost(){
        return $this->host;
    }

    function getDbName(){
        return $this->username;
    }

    function getDbUser(){
        return $this->username;
    }

    function getDbUserPw(){
        return $this->password;
    }
}
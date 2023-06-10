<?php

class Database
{

    private $mysqlConnect;
    private $stmt;

    public function __construct()
    {
        try {
            $this->mysqlConnect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query)
    {
        $this->stmt = mysqli_query($this->mysqlConnect, $query);
        return $this->stmt;
    }

    public function error()
    {
        return $this->mysqlConnect->error;
    }
}

<?php

namespace Core;

abstract class Model
{
    /**
     * Db connection.
     *
     * @var array
     */
    private $conn;

    /**
     * Create instance "Model".
     */
    public function __construct()
    {
        $this->conn = $this->getDbConnection();
    }

    /**
     * Raw sql query.
     *
     * @param string $string
     */
    protected function sqlQuery(string $string)
    {
        return $this->conn->query($string);
    }

    /**
     * Get db connection.
     *
     * @return \mysqli
     */
    protected function getDbConnection(): \mysqli
    {
        $serverName = "localhost";
        $username   = "mysql";
        $password   = "mysql";
        $dbname     = "zaitebaki";

        $conn = new \mysqli($serverName, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}

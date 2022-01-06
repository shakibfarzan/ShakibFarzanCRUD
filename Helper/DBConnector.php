<?php

namespace CRUD\Helper;

use mysqli;

class DBConnector
{

    /** @var mixed $db */
    private $db;
    private string $servername;
    private string $username;
    private string $password;
    private $conn;

    public function __construct($servername, $username, $password, $db)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect(): void
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
        if (!$this->conn) {
            $this->exceptionHandler("Connection failed");
        } else {
            echo "Connected successfully";
        }
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query): bool
    {
        if ($this->conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    /**
     * @param string $message
     * @throws \Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
        echo $message;
    }
}

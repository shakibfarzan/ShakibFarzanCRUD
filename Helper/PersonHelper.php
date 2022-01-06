<?php

namespace CRUD\Helper;

use CRUD\Helper\DBConnector;

class PersonHelper
{
    private static $instance;
    private $db;
    private final function __construct()
    {
        $db = new DBConnector("localhost", "username", "password", "db"); //fake db
        $db->connect();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new PersonHelper();
        }
        return self::$instance;
    }

    public function insert($person): bool
    {
        if ($this->db->execQuery("INSERT INTO Persons (id, firstName, lastName,username) VALUES ($person->getId(), $person->getFirstName(), $person->getLastName(), $person->getUsername())")) {
            return true;
        }
        return false;
    }

    public function fetch(int $id)
    {
        $res = $this->db->execQuery("SELECT firstName, lastName, username FROM Persons WHERE id = $id");
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "Name: " . $row["firstName"] . " " . $row["lastName"] . "Username: " . $row["username"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    public function fetchAll()
    {
        $res = $this->db->execQuery("SELECT * FROM Persons");
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "Id: " . $row["id"] . "Name: " . $row["firstName"] . " " . $row["lastName"] . "Username: " . $row["username"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    public function update($person): bool
    {
        if ($this->db->execQuery("UPDATE Persons SET firstName=$person->getFirstName() lastName=$person->getLastName() username=$person->getUsername() WHERE id = $person->getId()")) {
            return true;
        }
        return false;
    }

    public function delete(int $id): bool
    {
        if ($this->db->execQuery("DELETE FROM Persons WHERE id = $id")) {
            return true;
        }
        return false;
    }
}

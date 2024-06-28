<?php
class Database
{
    // private $db_host = "localhost";
    // private $db_user = "root";
    // private $db_pass = "";
    // private $db_name = "8_oop_crud";

    private const DB_HOST = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "8_oop_crud";

    private $conn;

    public function __construct()
    {
        // return $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        return $this->conn = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
    }

    public function get_all($table)
    {
        $sql = "SELECT * FROM `$table`;";
        $result = $this->conn->query($sql);
        $records = $result->fetch_all(MYSQLI_ASSOC);
        // if (count($records) > 0) {
        //     return $records;
        // } else {
        //     return false;
        // }
        return (count($records) > 0) ? $records : false;
    }

    public function get_single($table, $id)
    {
        $sql = "SELECT * FROM `$table` WHERE `id` = $id LIMIT 1;";
        $result = $this->conn->query($sql);
        $record = $result->fetch_assoc();
        return $record ? $record : false;
    }

    public function create($table, $data)
    {
        $keys = array_keys($data);
        $colums = implode("`, `", $keys);
        $values = array_values($data);
        $values = implode("', '", $values);

        $sql = "INSERT INTO `$table`(`$colums`) VALUES ('$values');";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function update($table, $data, $id)
    {
        $pairs = [];
        foreach ($data as $key => $value) {
            array_push($pairs, "`" . $key . "` = '" . $value . "'");
        }
        $pairs = implode(", ", $pairs);

        $sql = "UPDATE `$table` SET $pairs WHERE `id` = $id";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM `$table` WHERE `id` = $id;";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }
}

$database = new Database();
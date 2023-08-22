<?php

require_once('config.php');


class Media
{

    public $filename;
    public $image;
    public $file_type;
    public $username;

    private $conn;


    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function select_media()
    {
        $sql = mysqli_query($this->conn, "SELECT * FROM `media`");

        $data = array();

        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }

        return $data;
    }
}

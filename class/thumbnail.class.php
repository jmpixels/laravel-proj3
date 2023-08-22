<?php

require_once('config.php');

class Thumbnail
{

    public $img_name;
    public $table_name;
    public $file_type;

    private $conn;

    public function __construct()
    {
        global $db;
        $this->conn = $db->conn;
    }

    public function Add_thumbnail($table_name, $table_row_id)
    {
        if (isset($_FILES['thumbnail']['name']) && !empty($_FILES['thumbnail']['name'])) {


            $img_name = $_FILES['thumbnail']['name'];
            $file_type = $_FILES['thumbnail']['type'];
            $image_folder = "files/" . $img_name;
            $data = $_FILES['thumbnail']['tmp_name'];

            if (move_uploaded_file($data, $image_folder)) {
                $sql = mysqli_query($this->conn, "INSERT INTO `thumbnail`(`img_name`, `table_name`, `file_type`,`table_row_id`) VALUES ('$img_name','$table_name','$file_type','$table_row_id' )");

                return $sql;
            } else {
                echo "Error uploading file.";
            }
        }
    }

    public function Update_thumbnail($table_name, $table_row_id)
    {
        if (isset($_FILES['thumbnail']['name']) && !empty($_FILES['thumbnail']['name'])) {


            $img_name = $_FILES['thumbnail']['name'];
            $file_type = $_FILES['thumbnail']['type'];
            $image_folder = "files/" . $img_name;
            $data = $_FILES['thumbnail']['tmp_name'];

            if (move_uploaded_file($data, $image_folder)) {
                $sql = mysqli_query($this->conn, "UPDATE `thumbnail` SET `img_name`='$img_name' WHERE `table_name` = '$table_name' AND `table_row_id` ='$table_row_id' ");

                return $sql;
            } else {
                echo "Error uploading file.";
            }
        }
    }


    public function Get_thumbnail($table_row_id, $table_name)
    {
        $sql = mysqli_query($this->conn, "SELECT * FROM `thumbnail` WHERE table_row_id = '$table_row_id' AND table_name='$table_name' ");

        return $sql;
    }
}

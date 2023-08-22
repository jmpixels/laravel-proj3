<?php


require_once('../config.php');


class delete_img
{

    private $conn;

    public function __construct()
    {
        global $db;
        $this->conn = $db->conn;
    }

    public function delete_img($edit_id)
    {
        $sql = mysqli_query($this->conn, "UPDATE `article` SET `thumbnail` = NULL WHERE article_id = '$edit_id'");

        return $sql;
    }

    public function delete_multi_img($img_id, $edit_id, $collection_name)
    {

        $collection_name = mysqli_real_escape_string($this->conn, $collection_name); // Sanitize and escape the input
        $sql = mysqli_query($this->conn, "DELETE FROM `images` WHERE img_id = '$img_id' AND primary_img_id = '$edit_id' AND `collection_name` = '$collection_name'");

        return $sql;
    }
}



$delete_img = new delete_img();

if (isset($_GET['delete_thumb_id'])) {
    $thumb_id = $_GET['delete_thumb_id'];
    // echo $thumb_id;

    $delete_thumbnail = $delete_img->delete_img($thumb_id);

    if ($delete_thumbnail) {
        Header("Location:/admin/edit_article.php?edit_id=$thumb_id");
    }
}

if (isset($_GET['delete_multi_img_id'])) {

    $delete_multi_img = new delete_img();

    $multi_id = $_GET['delete_multi_img_id'];
    $img_id = $_GET['img_id'];
    $collection_name = 'article';

    // echo $multi_id;
    // echo $img_id;

    $delete_multi_img = $delete_multi_img->delete_multi_img($img_id, $multi_id, $collection_name);

    if ($delete_multi_img) {
        Header("Location:/admin/edit_article.php?edit_id=$multi_id");
    }
}

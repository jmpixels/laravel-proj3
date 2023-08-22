<?php

require_once('config.php');

class Article
{
    public $thubmnail;
    public $current_date;
    public $title;
    public $catagory;
    public $paragraph;

    public $intro_text;

    public $active;

    public $user;

    private $conn;
    // public $multi_img;

    public function __construct()
    {

        global $db;
        $this->conn = $db->conn;
    }

    function generate_slug($text) {
        // Remove any diacritics (accents) from the text and convert to lowercase
        $normalized_text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $normalized_text = strtolower($normalized_text);
        
        // Replace any non-word characters (except hyphen and underscore) with a space
        $text_with_spaces = preg_replace('/[^\w\s-]/u', ' ', $normalized_text);
        
        // Replace any whitespace with a hyphen
        $slug = preg_replace('/\s+/', '-', $text_with_spaces);
        
        // Remove leading and trailing hyphens (if any)
        $slug = trim($slug, '-');
        
        return $slug;
    }


    public function addArticle($article_id, $title, $catagory, $paragraph, $intro_text, $current_date, $active, $user_name)
    {
        $slug = $this->generate_slug($title);

        $sql = mysqli_query($this->conn, "INSERT INTO `article` (`article_id`, `title`, `category`, `paragraph`, `intro_text`, `current_date`, `active`,`user`, `slug`) VALUES ('$article_id', '$title', '$catagory','$paragraph', '$intro_text', '$current_date', '$active','$user_name','$slug')");

        if ($sql) {
            return "success";
        } else {
            return "error try again lmao !";
        }
    }


    public function selectArticle()
    {

        $sql = mysqli_query($this->conn, "SELECT * FROM `article` ORDER BY `article_id` DESC");

        if (!$sql) {
            return "error selecting data";
        } else {
            return $sql;
        }
    }

    public function FilterArticle($start_date, $end_date)
    {
        $sql = mysqli_query($this->conn, "SELECT * FROM `article` WHERE `current_date` BETWEEN '$start_date' AND '$end_date' ORDER BY `article_id` DESC");

        if (!$sql) {
            return "error selecting data";
        } else {
            return $sql;
        }
    }

    public function getLatestID()
    {
        $sql = mysqli_query($this->conn, "SELECT MAX(article_id) AS latest_id FROM article");
        $row = mysqli_fetch_assoc($sql);
        $latestID = $row['latest_id'] + 1;

        return $latestID;
    }



    public function getArticle_by_row($article_edit_id)
    {
        $sql = mysqli_query($this->conn, "SELECT * FROM `article` WHERE article_id = '$article_edit_id'");
        $row = mysqli_fetch_assoc($sql);

        return $row;
    }


    public function update_article($article_id, $title, $category, $paragraph, $intro_text, $active){

        $sql = mysqli_query($this->conn,"UPDATE `article` SET `title`='$title',`category`='$category',`paragraph`='$paragraph',`intro_text`='$intro_text',`active`='$active' WHERE `article_id`='$article_id' ");

        return $sql;
    }


}

?>

<?php
require_once('config.php');
// include



class MultiImage
{
    public $img_name;
    public $collection_name;

    public $collection_id;

    private $conn;
    private $db;



    public function __construct()
    {

        global $db;
        $this->conn = $db->conn;
    }




    public function getMulitImages_by_row($article_edit_id, $collection_name)
    {
        $sql = mysqli_query($this->conn, "SELECT * FROM `images` WHERE primary_img_id = '$article_edit_id' AND collection_name = '$collection_name' ");

        if ($sql) {
            $rows = array();
            while ($row = mysqli_fetch_assoc($sql)) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            // Handle the case where the query was not successful
            // For example, you can log the error or show an error message to the user
            return array(); // Return an empty array to indicate no results
        }
    }










    public function upload_images_form()
    {


        if (isset($_POST['submit_multi_img']) && isset($_FILES['img-media'])) {
            $current_date = date("Y-m-d");
            $uploadedImages = array();
            $allowedExtensions = array('jpg', 'jpeg', 'png');
            $successMessage =
                "
            <div class='alert-container media success '>
                <p class='success'>Images are successfully uploaded</p>
            </div>
            
            ";

            $username = $_SESSION['username'];


            // Loop through each uploaded file
            for ($i = 0; $i < count($_FILES['img-media']['name']); $i++) {
                $file = $_FILES['img-media']['name'][$i];
                $image_type = $_FILES['img-media']['type'][$i];
                $image_folder = "files/" . $file;
                $data = $_FILES['img-media']['tmp_name'][$i];

                $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedExtensions)) {
                    // echo "Error: Only JPG and PNG files are allowed.<br>";
                    echo '<script>alert("Error: Only JPG and PNG files are allowed.");</script>';
                    continue; // Skip the current file and move to the next one
                }

                if (move_uploaded_file($data, $image_folder)) {

                    $query_exists = mysqli_query($this->conn, "SELECT * FROM `media` WHERE `media_name` = '$file' ");
                    if (!mysqli_num_rows($query_exists) > 0) {
                        // Insert the image information into the database
                        $query = mysqli_query($this->conn, "INSERT INTO `media` (`media_name`, `media_type`, `date_uploaded`,`username`) VALUES ('$file', '$image_type', '$current_date','$username')");

                        if ($query) {
                            $uploadedImages[] = $file; // Store the uploaded image name in the array
                        } else {
                            echo "Error inserting image into the database for file $file: " . mysqli_error($this->conn) . "<br>";
                        }
                    }
                } else {
                    // Handle the error case for each uploaded file
                    echo "Error uploading file $file.<br>";
                }
            }

            if (!empty($successMessage)) {

                echo $successMessage;
            }
        }



        $upload_form = '';

        $upload_form .= '
            <form class="multi_upload_form" action="" id="uploadForm" name="multi_upload_form" method="POST" enctype="multipart/form-data">
                <div class="upload_conatiner">
                    <h3 class="heading-text">Upload New Media </h3>
                    <div class="input-wrapper">
                        <label for="img-media" class="form-label">Thumbnail</label>
                        <input id="multiple_img" name="img-media[]" type="file" class="input-field full" multiple required>
                        <div id="image-preview" class="multi-img"></div>
                    </div>
                </div>
                <button type="submit" name="submit_multi_img" class="btn" id="uploadButton" onsubmit="return onSubmitSuccess()">>Upload Images</button>
            </form>
            <script src="/script/file-upload.js"></script>

            <script>
            function onSubmitSuccess() {
              // You can perform any additional actions here before the page is refreshed (if needed).
              // For example, you might want to display a success message to the user.
              
              console.log("Form submitted successfully.");
            
              // Refresh the page after 1 second (1000 milliseconds)
              setTimeout(function() {
                location.reload();
              }, 1000);
            
              // Return false to prevent the form from being submitted through regular HTTP request
              return false;
            }
            </script>
            
        ';

        return $upload_form;
    }



    public function select_media()
    {
        $sql = mysqli_query($this->conn, "SELECT * FROM `media` ");

        if (!$sql) {
            return "error fetching data";
        } else {

            return $sql;

            $data = array();

            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }

            mysqli_free_result($sql);
            return $data;
        }
    }





    public function add_MulitImages($collection_name, $latestID)
    {


        if (isset($_FILES['multi-img']['name']) && !empty($_FILES['multi-img']['name'])) {

            $files = $_FILES['multi-img'];

            for ($i = 0; $i < count($files['name']); $i++) {
                $file_name = $files['name'][$i];
                $image_type = $files['type'][$i];
                $image_folder = "files/" . $file_name;
                $data = $files['tmp_name'][$i];

                if (move_uploaded_file($data, $image_folder)) {
                    $sql = mysqli_query($this->conn, "INSERT INTO `images` (`img_name`, `collection_name`, `primary_img_id`) VALUES (' $file_name','$collection_name','$latestID')");
                } else {
                    echo "error";
                }
            }
        }


        return $sql;
    }
}



// $files = $_FILES['multi-img'];


// for ($i = 0; $i < count($files['name']); $i++) 
// {

//      $file_name = $_FILES['multi-img']['name'];
//     $image_type = $_FILES['multi-img']['type'];
//     // $image_folder = "files/" .  $file_name;
//     $file_tmp = $_FILES['multi-img']['tmp_name'];

//     $image_folder = "files/" . $file_name;

//     move_uploaded_file($file_tmp, $image_folder);




// }



?>
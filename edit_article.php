<?php

// include 'class/function.class.php';
// include('class/media.class.php');
// include('class/multi_image.class.php');
// include('class/thumbnail.class.php');


include 'include/include_all.php';

require_once('config.php');

// Automatic load all classes
include 'autoloader.php';

$edit_id = $_GET['edit_id'];

date_default_timezone_set('America/Paramaribo');
// $current_date = date('d/m/Y');
$current_date = date("Y-m-d");
$current_time = date("h:i A");


// get thumbnail data
$thumbnail = new Thumbnail();
$thumbnail_row = mysqli_fetch_assoc($thumbnail->Get_thumbnail($edit_id, 'article'));

// article class
$article = new Article();
$latestID = $article->getLatestID();
$row = $article->getArticle_by_row($edit_id);


// Multiimg
$collection_name = 'article';
$multiimg = new MultiImage();
$multi_row = $multiimg->getMulitImages_by_row($edit_id, $collection_name);




// check if active/status field is active(1)
$active_field = "";

if ($row['active'] == 1) {
    $active_field .=
        "
        <input name='active' type='checkbox' class='checkbox' checked>
    ";
} else { {
        $active_field .=
            "
            <input name='active' type='checkbox' class='checkbox'>
        ";
    }
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $head_title ?></title>

    <?php echo $html_header; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body class="body">

    <div class="container nav">
        <?php
        echo $navbar; ?>
    </div>

    <div class="container">
        <?php print $header; ?>

        <div class="r-body">
            <div class="section article">
                <h3 class="heading-text">Edit Article </h3>

                <?php

                $success_alert = '';
                $error_alert = '';

                if (isset($_GET['success'])) {
                    $success_alert .= '
                        <div class="alert-container mar_bot_40 success">
                        <p class="sucess">
                        ' . $_GET['success'] . '
                      
                        </p>
                    </div>';

                    echo $success_alert;
                } elseif (isset($_GET['error'])) {

                    $error_alert .= '
                        <div class="alert-container mar_bot_40 error">
                        
                        <p class="error">
                            ' . $_GET['error'] . '
                        </p>
                        </div>
                        ';

                    echo $error_alert;
                }


                ?>


                <form action="code.php" class="form full" id="parentForm" method="POST" enctype="multipart/form-data">

                    <div class="input-wrapper">
                        <label for="thumbnail" class="form-label">Thumbnail</label>

                        <div class="display-area">
                            <input id="thumbnail" name="thumbnail" type="file" class="input-field full">


                            <?php

                            $data = "";

                            $data .= "
                                <div id='thumb-preview-container' class='thumb-img thumb_active'>
                                    <div class='image-container'>
                                        <img src='files/" . $thumbnail_row['img_name'] . "' alt=''>
                                  
                                    </div>
                                </div>
                            ";



                            echo $data;

                            ?>

                        </div>




                    </div>


                    <div class="input-wrapper">

                        <label for="" class="form-label">Current Date</label>

                        <input name="current_date" type="text" class="input-field full" value="<?= $row['current_date'] ?>" readonly>

                        <input name="edit_id" type="text" class="input-field full" value="<?= $_GET['edit_id'] ?>" hidden>

                        <input name="article_id" type="text" class="input-field full" value="<?= $latestID ?>" hidden>

                        <input name="user_name" type="text" class="input-field full" value="<?= $_SESSION['name']; ?>" hidden>

                    </div>

                    <div class="form-wrapper">

                        <div class="input-wrapper">
                            <label for="" class="form-label">Title</label>
                            <input name="title" type="text" class="input-field" value="<?= $row['title'] ?>">
                        </div>

                        <!-- <div class="input-wrapper">
                            <label for="" class="form-label">Slug</label>
                            <input name="slug" type="text" class="input-field" readonly>
                        </div> -->

                        <div class="input-wrapper">
                            <label for="" class="form-label">Category</label>
                            <select name="category" id="" class="select-field full">
                                <option class="option-field" value="<?= $row['category'] ?>" hidden><?php echo $row['category'] ?></option>
                                <option class="option-field" value="admin">Admin</option>
                                <option value="User" class="option-field">User</option>
                            </select>
                        </div>


                    </div>



                    <div class="input-wrapper">
                        <label for="intro_text" class="form-label">Intro Text</label>
                        <textarea name="intro_text" class="textarea" id="intro_text" cols="30" rows="4"><?= $row['intro_text'] ?></textarea>
                    </div>

                    <div class="input-wrapper">
                        <label for="paragraph" class="form-label">Paragraph</label>
                        <textarea name="paragraph" class="textarea" id="paragraph" cols="30" rows="10"><?= $row['paragraph'] ?></textarea>
                    </div>



                    <div class="input-wrapper">
                        <label for="multiple_img" class="form-label">Select multiple images</label>

                        <div class="display-area">
                            <input id="multiple_img" name="multi-img[]" type="file" class="input-field full" multiple>
                            <?php

                            $multi_data = " ";


                            $multi_data = ""; // Initialize the $multi_data variable

                            if (empty($multi_row)) {
                                $multi_data .= "<div id='image-preview' class='multi-img'>";
                            } else {
                                $multi_data .= "<div id='image-preview' class='multi-img active'>";
                            }


                            for ($i = 0; $i < count($multi_row); $i++) {
                                $row = $multi_row[$i];
                                $img_name = $row['img_name'];
                            
                                $multi_data .= "
                                    <div class='image-container'>
                                        <img src='files/" . str_replace(' ', '', $img_name) . "' alt=''>
                                        <a href='class/delete.class.php?delete_multi_img_id=" . $edit_id . "&img_id=" . $multi_row[$i]['img_id'] . "' class='remove_btn' onclick=\"return confirm('Are you sure you want to delete this image?')\">Remove Image</a>
                                    </div>
                                ";
                            }

                            $multi_data .= "</div>";

                            // Display the generated HTML content
                            echo $multi_data;


                            ?>
                        </div>

                    </div>

                    <div class="input-wrapper">
                        <label for="" class="form-label">Active</label>
                        <?= $active_field ?>

                    </div>

                    <button type="submit" id="parentSubmitButton" name='update_article' class="btn mar-top-20 ">Save Article</button>

                </form>
            </div>


        </div>
    </div>


    <script>

    </script>


    <!-- <script src="script/thumbnail.js"></script>-->
    <!-- <script src="script/file-upload.js"></script>  -->
    <script src="script/thumbnail.js"></script>
    <script src="script/multi_img.js"></script>



</body>

</html>



<!-- <div class="input-wrapper rich">
                        <label for="" class="form-label">Paragraph</label>
                        <div class="text-editor-header">
                            <button type="button" class="rich-btn" data-element="bold">
                                <i class="fa fa-bold"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="italic">
                                <i class="fa fa-italic"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="underline">
                                <i class="fa fa-underline"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="insertUnorderedList">
                                <i class="fa fa-list-ul"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="insertOrderedList">
                                <i class="fa fa-list-ol"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="createLink">
                                <i class="fa fa-link"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="justifyLeft">
                                <i class="fa fa-align-left"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="justifyCenter">
                                <i class="fa fa-align-center"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="justifyRight">
                                <i class="fa fa-align-right"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="justifyFull">
                                <i class="fa fa-align-justify"></i>
                            </button>

                            <button type="button" class="rich-btn" data-element="insertImage">
                                <i class="fa fa-image"></i>
                            </button>

                        </div>
                        <input type="text" class="content" contenteditable="true">
                    </div> -->
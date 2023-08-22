<?php

include 'include/include_all.php';
include 'class/function.class.php';
include('class/media.class.php');
include('class/multi_image.class.php');

date_default_timezone_set('America/Paramaribo');
// $current_date = date('d/m/Y');
$current_date = date("Y-m-d");
$current_time = date("h:i A");


$article = new Article();
$latestID = $article->getLatestID();


$form_upload = new MultiImage();




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
                <h3 class="heading-text">Add Article </h3>


                <form action="code.php" class="form full" id="parentForm" method="POST" enctype="multipart/form-data">

                    <div class="input-wrapper">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input id="thumbnail" name="thumbnail" type="file" class="input-field full">
                        <div id="thumb-preview-container" class="thumb-img"></div>
                    </div>


                    <div class="input-wrapper">

                        <label for="" class="form-label">Current Date</label>

                        <input name="current_date" type="text" class="input-field full" value="<?= $current_date ?>" readonly>

                        <input name="article_id" type="text" class="input-field full" value="<?= $latestID ?>" hidden>

                        <input name="user_name" type="text" class="input-field full" value="<?= $_SESSION['name']; ?>" hidden>

                    </div>

                    <div class="form-wrapper">

                        <div class="input-wrapper">
                            <label for="" class="form-label">Title</label>
                            <input name="title" type="text" class="input-field">
                        </div>

                        <!-- <div class="input-wrapper">
                            <label for="" class="form-label">Slug</label>
                            <input name="slug" type="text" class="input-field" readonly>
                        </div> -->

                        <div class="input-wrapper">
                            <label for="" class="form-label">Catagory</label>
                            <select name="category" id="" class="select-field full">
                                <option class="option-field" value="admin">Admin</option>
                                <option value="User" class="option-field">User</option>
                            </select>
                        </div>

                        
                    </div>



                    <div class="input-wrapper">
                        <label for="" class="form-label">Intro Text</label>
                        <textarea name="intro_text" class="textarea" id="" cols="30" rows="4">

                        </textarea>
                    </div>

                    <div class="input-wrapper">
                        <label for="" class="form-label">Paragraph</label>
                        <textarea name="paragraph" class="textarea" id="" cols="30" rows="10">

                        </textarea>
                    </div>



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

                    <div class="input-wrapper">
                        <label for="multiple_img" class="form-label">Select multiple images</label>

                        <input id="multiple_img" name="multi-img[]" type="file" class="input-field full" multiple>
                        <div id="image-preview" class="multi-img"></div>
                    </div>

                    <div class="input-wrapper">
                        <label for="" class="form-label">Active</label>
                        <input name="active" type="checkbox" class="checkbox" checked>
                    </div>

                    <button type="submit" id="parentSubmitButton" name='publish' class="btn mar-top-20 ">Publish Article</button>

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



    <script src="script/popup.js"></script>

    <script>
        let prevSelectedBox = null;

        // Get all .img_box elements
        const imgBoxes = document.querySelectorAll('#imageBoxContainer .img_box');

        // Add click event listener to each .img_box
        imgBoxes.forEach((imgBox) => {
            imgBox.addEventListener('click', () => {
                // Get the corresponding checkbox
                const checkbox = imgBox.querySelector('input[type="checkbox"]');

                // If there was a previously selected .img_box, remove its border
                if (prevSelectedBox) {
                    prevSelectedBox.classList.remove('selected');
                }

                // Update the previous .img_box reference to the current one
                prevSelectedBox = imgBox;

                // Uncheck all checkboxes except the current one
                const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
                allCheckboxes.forEach((cb) => {
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });

                // Toggle the 'selected' class on the clicked .img_box
                imgBox.classList.toggle('selected');

                // Update the checkbox state based on the .img_box selection
                checkbox.checked = imgBox.classList.contains('selected');
            });
        });
    </script>
</body>

</html>
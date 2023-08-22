<?php

include 'include/include_all.php';
include 'class/function.class.php';
include('class/multi_image.class.php');

date_default_timezone_set('America/Paramaribo');
// $current_date = date('d/m/Y');
$current_date = date("Y-m-d");
$current_time = date("h:i A");


$article = new Article();
$latestID = $article->getLatestID();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $head_title ?></title>

    <?php echo $html_header; ?>

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

                <?php

                $user_name;

                $form_upload = new MultiImage();
                print $form_upload->upload_images_form();

                ?>

            </div>


        </div>
    </div>






    <!-- <script src="script/file-upload.js"></script> -->
    <script src="script/file-upload.js"></script>


    <script>
        // elements
    </script>

</body>

</html>
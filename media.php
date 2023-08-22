<?php

// include 'security.php';
// include 'include/head_title.php';
// include 'config.php';

include 'include/include_all.php';
include 'class/function.class.php';
include('class/multi_image.class.php');


// SELECT data from table users
// $sql_select = "SELECT * FROM `users` ORDER BY `id` DESC" ;
// $result = mysqli_query($conn, $sql_select);

$media = new MultiImage();
$result = $media->select_media();




// table loop - users
$table = '';
$script = '';


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $maxCharLimit = 30; // Set the maximum character limit
        $mediaName = $row['media_name'];

        
        $max_mediaName = (strlen($mediaName) > $maxCharLimit) ?
        substr($mediaName, 0, $maxCharLimit) . '...' :
        $mediaName;


        $table .=
            '
            <tr>
            <td>
                <button id="btn-' . $row['media_id'] . '" class="tbl-btn"><img class="icon table" src="img/burger.svg" alt=""></button>

                <div id="menu-' . $row['media_id'] . '" class="menu menu-' . $row['media_id'] . '">

                    <button class="tbl-btn menu-btn">
                        <img class="icon table" src="img/burger_black.svg">
                    </button>

                    <a href="edit_article.php?edit_id=' . $row['media_id'] . '" class="tbl-btn">
                        <img class="icon table" src="img/edit.svg">
                    </a>

                    <a href="code.php?delete_id=' . $row['media_id'] . '" class="tbl-btn" onclick="return confirm(\'Are you sure you want to delete this item?\');">
                        <img class="icon table" src="img/trash.svg">
                    </a>
                </div>
            </td>

            <td> <img class="display-img" src="files/'.$row['media_name'].'" /> </td>
            <td><div class ="max_char_container">' . $max_mediaName . '</div></td>
        <td>' . $row['media_type'] . '</td>
        <td>' . $row['date_uploaded'] . '</td>
        <td>'.$row['username'].'</td>

        ';

        $script .=
            '
        <script>
        document.getElementById("btn-' . $row['media_id'] . '").addEventListener("click", function() {
            const menu = document.getElementById("menu-' . $row['media_id'] . '");
            menu.classList.toggle("active");
        });
        </script>

        ';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $head_title ?></title>
    <?php echo $html_header; ?>

</head>

<body class="body">

    <!-- navbar -->



    <div class="container nav">
        <!-- Sidenavbar -->
        <?php echo $navbar; ?>

    </div>


    <div class="container ">

        <?php print $header; ?>

        <div class="r-body">
            <div class="section head">
                <h3 class="heading-text">Media Library</h3>


                <div class="wrapper-functions">
                    <div class="wrapper-col">
                        <form action="" class="form">
                            <input type="text" id="searchInput" class="input-field search mar-20" placeholder="Search...">
                            <!-- <button id="searchButton" class="search btn"><img src="img/search.svg" alt="" class="icon"> Search</button> -->
                        </form>
                    </div>

                    <div class="wrapper-col btns">
                        <!-- <button class="btn">  alt="" class="icon">Add User</button> -->
                        <a href="add_media.php" class="btn"> <img class="icon" src="img/plus.svg"> Add Media File</a>

                    </div>
                </div>

                <div class="wrapper-functions filter">
                    <div class="wrapper-col">
                        <select name="" id="" class="select-field filter">
                            <option value="">Sport</option>
                        </select>
                    </div>

                    <div class="wrapper-col btns">

                        <form class="form-flex" action="">
                            <input type="text" class="input-field date" placeholder="Start-Date">
                            <input type="text" class="input-field date" placeholder="End-Date">

                            <button class="btn mar-bottom-0">Filter Date</button>
                        </form>

                    </div>
                </div>

                <?php

                $success_alert = '';
                $error_alert = '';

                if (isset($_GET['success'])) {
                    $success_alert .= '
                    <div class="alert-container success">
                    <p class="sucess">
                    ' . $_GET['success'] . '
                    <button onclick="removeQueryString()"><i class="fa-solid fa-xmark"></i></button>
                    </p>
                </div>';

                    echo $success_alert;
                } elseif (isset($_GET['error'])) {

                    $error_alert .= '
                    <div class="alert-container error">
                    
                    <p class="error">
                        ' . $_GET['error'] . '
                    </p>
                    </div>
                    ';

                    echo $error_alert;
                }


                ?>


            </div>

            <div class="section tbl">
                <div class="tbl-wrapper">
                    <table id="userTable" class="table users">
                        <thead>
                            <tr class="tr-header">
                                <th>Action</th>
                                <th>Image</th>
                                <th>File Name</th>
                                <th>File Type</th>
                                <th>Date Created</th>
                                <th>Username</th>
                                

                            </tr>
                        </thead>
                        <tbody class="tbody">

                            <?php
                            echo $table;
                            echo $script;
                            ?>


                        </tbody>
                    </table>
                </div>

                <div id="pagination"> </div>

            </div>
        </div>
    </div>



    <script src="script/script.js"></script>
</body>

</html>
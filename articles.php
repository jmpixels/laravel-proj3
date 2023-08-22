<?php

// include 'security.php';
// include 'include/head_title.php';
// include 'class/function.class.php';

include 'config.php';

include 'include/include_all.php';
include 'autoloader.php';

// SELECT data from table users
// $sql_select = "SELECT * FROM `users` ORDER BY `id` DESC" ;
// $result = mysqli_query($conn, $sql_select);

$article = new Article();




if (isset($_POST['filter'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if (empty($start_date) || empty($end_date)) {
        $result = $article->selectArticle();
    } else {
        $result = $article->FilterArticle($start_date, $end_date);
    }
} else {
    $result = $article->selectArticle();
}

// table loop - users
$table = '';
$script = '';


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table .=
            '
            <tr>
            <td>
                <button id="btn-' . $row['article_id'] . '" class="tbl-btn"><img class="icon table" src="img/burger.svg" alt=""></button>

                <div id="menu-' . $row['article_id'] . '" class="menu menu-' . $row['article_id'] . '">

                    <button class="tbl-btn menu-btn">
                        <img class="icon table" src="img/burger_black.svg">
                    </button>

                    <a href="edit_article.php?edit_id=' . $row['article_id'] . '" class="tbl-btn">
                        <img class="icon table" src="img/edit.svg">
                    </a>

                    <a href="code.php?delete_id=' . $row['article_id'] . '" class="tbl-btn" onclick="return confirm(\'Are you sure you want to delete this item?\');">
                        <img class="icon table" src="img/trash.svg">
                    </a>
                </div>
            </td>

            <td>' . $row['article_id'] . '</td>
            <td>' . $row['title'] . '</td>
        <td>' . $row['intro_text'] . '</td>
        <td>' . $row['current_date'] . '</td>
        <td>' . $row['user'] . '</td>
        <td>' . ($row['active'] == 0 ? "Not Active" : "Active") . '</td>
        
        ';

        $script .=
            '
        <script>
        document.getElementById("btn-' . $row['article_id'] . '").addEventListener("click", function() {
            const menu = document.getElementById("menu-' . $row['article_id'] . '");
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
                <h3 class="heading-text">Articles Overview</h3>


                <div class="wrapper-functions">
                    <div class="wrapper-col">
                        <form action="" class="form">
                            <input type="text" id="searchInput" class="input-field search mar-20" placeholder="Search...">
                            <!-- <button id="searchButton" class="search btn"><img src="img/search.svg" alt="" class="icon"> Search</button> -->
                        </form>
                    </div>

                    <div class="wrapper-col btns">
                        <!-- <button class="btn">  alt="" class="icon">Add User</button> -->
                        <a href="add_article.php" class="btn"> <img class="icon" src="img/plus.svg"> Add Article</a>

                    </div>
                </div>

                <div class="wrapper-functions filter">
                    <div class="wrapper-col">
                        <select name="" id="" class="select-field filter">
                            <option value="">Sport</option>
                        </select>
                    </div>

                    <div class="wrapper-col btns">

                        <form class="form-flex" action="" method="POST">
                            <input type="text"  class="input-field date datepicker" name="start_date" placeholder="Start-Date">
                            <input type="text"  class="input-field date datepicker" name="end_date" placeholder="End-Date">

                            <button class="btn mar-bottom-0" name="filter">Filter Date</button>
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
                    <button class="close-alert" onclick="removeQueryString()"><i class="fa-solid fa-xmark"></i></button>
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
                                <th>Article ID</th>
                                <th>Title</th>
                                <th>Intro Text</th>
                                <th>Date Created</th>
                                <th>User</th>
                                <th>Status</th>


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



    <script src="script/datepicker.js"></script>
    <script src="script/script.js"></script>
</body>

</html>
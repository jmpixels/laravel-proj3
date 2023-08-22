<?php
// include 'class/function.class.php';

include 'include/head_title.php';
include 'config.php';
include 'include/include_all.php';

// automatic load all classes include
include 'autoloader.php';


$user = new User();
$result = $user->selectUser();



// table loop - users
$table = '';
$script = '';


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table .=
            '
            <tr>
            <td>
                <button id="btn-' . $row['id'] . '" class="tbl-btn"><img class="icon table" src="img/burger.svg" alt=""></button>

                <div id="menu-' . $row['id'] . '" class="menu menu-' . $row['id'] . '">

                    <button class="tbl-btn menu-btn">
                        <img class="icon table" src="img/burger_black.svg">
                    </button>

                    <a href="edit.php?edit_id=' . $row['id'] . '" class="tbl-btn">
                        <img class="icon table" src="img/edit.svg">
                    </a>

                    <a href="code.php?delete_id=' . $row['id'] . '" class="tbl-btn" onclick="return confirm(\'Are you sure you want to delete this item?\');">
                        <img class="icon table" src="img/trash.svg">
                    </a>
                </div>
            </td>
            <td>' . $row['id'] . '</td>
            <td>' . $row['username'] . '</td>
            <td> <input readonly class="pass-form" type="password" value="' . $row['password'] . '"> </td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['user_role'] . '</td>
            <td>'.$row['username'].'</td>
        </tr>
        
        ';

        $script .=
            '
        <script>
        document.getElementById("btn-' . $row['id'] . '").addEventListener("click", function() {
            const menu = document.getElementById("menu-' . $row['id'] . '");
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
                <h3 class="heading-text">Users Overview</h3>


                <div class="wrapper-functions">
                    <div class="wrapper-col">
                        <form action="" class="form">
                            <input type="text" id="searchInput" class="input-field search mar-20" placeholder="Search...">
                            <!-- <button id="searchButton" class="search btn"><img src="img/search.svg" alt="" class="icon"> Search</button> -->
                        </form>
                    </div>

                    <div class="wrapper-col btns">
                        <!-- <button class="btn">  alt="" class="icon">Add User</button> -->
                        <a href="add-user.php" class="btn"> <img class="icon" src="img/add-user.svg"> Add User</a>
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
                                <th>UserID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Name</th>
                                <th>User Role</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">

                            <?php
                            echo $table;
                            echo $script;
                            ?>


                            <script>
                                const menuButtons = document.querySelectorAll('.menu-btn');
                                menuButtons.forEach(function(button) {
                                    button.addEventListener('click', function() {
                                        const menu = this.parentElement;
                                        menu.classList.remove('active');
                                    });
                                });
                            </script>

                        </tbody>
                    </table>
                </div>

                <div id="pagination"> </div>

            </div>
        </div>
    </div>


    <script>
        function paginateTable(itemsPerPage, currentPage) {
            var table = document.getElementById('userTable');
            var rows = table.tBodies[0].rows;
            var totalItems = rows.length;
            var pageCount = Math.ceil(totalItems / itemsPerPage);

            // Calculate the maximum pagination numbers to display
            var maxPaginationNumbers = 5; // Set the desired maximum pagination numbers
            var startPage = Math.max(currentPage - Math.floor(maxPaginationNumbers / 2), 1);
            var endPage = Math.min(startPage + maxPaginationNumbers - 1, pageCount);

            // Calculate the start and end indices for displaying table rows
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = Math.min(startIndex + itemsPerPage - 1, totalItems - 1);

            for (var i = 0; i < rows.length; i++) {
                rows[i].style.display = (i >= startIndex && i <= endIndex) ? 'table-row' : 'none';
            }

            // Generate pagination controls
            var paginationDiv = document.getElementById('pagination');
            paginationDiv.innerHTML = '';

            // Previous button
            var prevButton = document.createElement('a');
            prevButton.href = '#';
            prevButton.innerHTML = 'Previous';
            prevButton.classList.add('pag-btn')
            prevButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    paginateTable(itemsPerPage, currentPage - 1);
                }
            });
            paginationDiv.appendChild(prevButton);

            // Page numbers
            for (var i = startPage; i <= endPage; i++) {
                var pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.innerHTML = i;
                pageLink.className = (i === currentPage) ? 'active' : '';

                // Add additional class to the pageLink element
                pageLink.classList.add('pagination-link');

                pageLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    paginateTable(itemsPerPage, parseInt(this.innerHTML));
                });

                paginationDiv.appendChild(pageLink);
            }

            // Next button
            var nextButton = document.createElement('a');
            nextButton.href = '#';
            nextButton.innerHTML = 'Next';
            nextButton.classList.add('pag-btn')
            nextButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage < pageCount) {
                    paginateTable(itemsPerPage, currentPage + 1);
                }
            });
            paginationDiv.appendChild(nextButton);
        }

        var itemsPerPage = 6;
        var currentPage = 1;
        paginateTable(itemsPerPage, currentPage);













        // search function

        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', searchTable);


        function searchTable() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toUpperCase();
            var table = document.getElementById('userTable');
            var rows = table.tBodies[0].rows;
            var visibleCount = 0;

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var found = false;

                for (var j = 0; j < cells.length; j++) {
                    var cell = cells[j];
                    if (filter === '' || cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }

                rows[i].style.display = found ? 'table-row' : 'none';

                if (found) {
                    visibleCount++;
                    if (visibleCount > itemsPerPage) {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }

        function handleSearch() {
            searchTable();
        }

        var searchButton = document.getElementById('searchButton');
        searchButton.addEventListener('click', handleSearch);

        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', handleSearch);

        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', searchTable);
    </script>


</body>

</html>
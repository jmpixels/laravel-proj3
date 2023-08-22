<?php


$navbar = '';

$current_page = basename($_SERVER['PHP_SELF']);


$navbar .=
    '
<div class="sidebar" id="sidebar">

<div class="side-wrapper">

    <div class="logo-container">
        <img class="side-logo" src="img/logo_white.png" alt="">
    </div>
    <nav>
        <ul>

        <div class="link s-menu ' . (($current_page === 'articles.php' || $current_page === 'categories.php') ? 'active' : '') . '">
            <a href="" class="page-link ">
            <i class="fa-solid fa-file-lines icon"></i></i> Articles
            </a>

            <div class="sub-menu">
                <a href="articles.php" class="sub-link ' . (($current_page === 'articles.php' ) ? 'active' : '') . '" >All Articles</a>
                <a href="catagories.php" class="sub-link ' . (($current_page === 'articles.php' || $current_page === 'categories.php') ? 'active' : '') . '" >Catagories</a>
            </div>
         </div>

            <div class="link">
                <a href="" class="page-link">
                <i class="fa-solid fa-user-group icon"></i>  Team Members
                </a>
            </div>

            

            <div class="link s-menu">
                <a href="" class="page-link">
                <i class="fa-solid fa-box-archive icon"></i>  Products
                </a>

                <div class="sub-menu">
                    <a href="#">All Products</a>
                    <a href="#">Add Products</a>
                    <a href="#">Catagories</a>
                    <a href="#">Tags</a>
                </div>
            </div>

           

            <!-- <div class="link">
                <a href="" class="page-link">
                    Users
                </a>
            </div> -->

            <div class="link s-menu">
                <a href="" class="page-link">
                <i class="fa-solid fa-gear icon"></i> Settings
                </a>

                <div class="sub-menu">
                    <a href="users.php">
                    <i class="fa-solid fa-user icon"></i>Users</a>
                    <a href="#">Mail</a>
                    <a href="#">Languages</a>
                </div>
            </div>

            <div class="link">
                <a href="logout.php" class="page-link">
                <i class="fa-solid fa-right-from-bracket icon"></i>logout
                </a>
            </div>

        </ul>
    </nav>
</div>

</div>
<script src="script/nav.js"></script>



';



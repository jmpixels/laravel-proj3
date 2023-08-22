<!-- header.php -->

<?php

$name = $_SESSION['name'];


$header = '';
$header =
    '
<div class="nav-container">
<div class="wrapper nav-wrapper">
    <!-- <div class="col-wrapper">
        <button class="btn open" onclick="openSidebar()">Open</button>
    </div> -->
    <div class="col-wrapper right">
        <div class="profile">
            <div class="name">
                <h4 class="username">
                   '.$name.'
                </h4>
                <p class="user_role">Admin</p>
            </div>
            <div class="user-profile" style="
                background: url(img/bg.jpg);
                background-size: cover;
                background-repeat: bo-repeat;">
            </div>
        </div>
    </div>
</div>
</div>

';

?>
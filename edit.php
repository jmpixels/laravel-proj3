<?php

include 'include/include_all.php';
include 'code.php';

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
            <div class="section user">
                <h3 class="heading-text">Edit User</h3>

                <form action="code.php" class="form user" method="POST">


                    <?php


                    $edit_id = $_GET['edit_id'];


                    $edit_form =
                        '

                        <input name="edit_id" type="text" class="input-field " 
                                value="' . $edit_id . '" hidden>
                                

                            <div class="form-wrapper">
                            <div class="input-wrapper">
                                <label for="" class="form-label">Name</label>
                                <input name="name" type="text" class="input-field" value="' . $row['name'] . '" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="form-label">Username</label>
                                <input name="username" type="text" class="input-field " 
                                value="' . $row['username'] . '" required>
                            </div>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="form-label">Password</label>
                                <input name="password" type="password" class="input-field full" value="' . $row['password'] . '" required>
                            </div>

                            <div class="input-wrapper">
                                <label for="" class="form-label">User Role</label>

                                <select name="user_role" id="" class="select-field full">
                                 <option hidden class="option-field" value="' . $row['user_role'] . '">' . $row['user_role'] . '</option>
                                    <option class="option-field" value="admin">Admin</option>
                                    <option value="User" class="option-field">User</option>
                                </select>
                            </div>

                        ';

                    print $edit_form;
                    ?>


                    <button type="submit" name="edit_user" class="btn mar-top-20 full">Save</button>

                </form>
            </div>


        </div>
    </div>



</body>

</html>
<?php

include 'include/include_all.php';


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
        echo $navbar;
        ?>
    </div>

    <div class="container">
        <?php print $header; ?>

        <div class="r-body">
            <div class="section user">
                <h3 class="heading-text">Add User </h3>

                <form action="code.php" class="form user" method="POST">


                    <div class="form-wrapper">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Name</label>
                            <input name="name" type="text" class="input-field " required>
                        </div>

                        <div class="input-wrapper">
                            <label for="" class="form-label">Username</label>
                            <input name="username" type="text" class="input-field " required>
                        </div>
                    </div>

                    <div class="input-wrapper">
                        <label for="" class="form-label">Password</label>
                        <input name="password" type="password" class="input-field full" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="" class="form-label">User Role</label>

                        <select name="user_role" id="" class="select-field full">
                            <option class="option-field" value="admin">Admin</option>
                            <option value="User" class="option-field">User</option>
                        </select>
                    </div>

                    <button type="submit" name='add-user' class="btn mar-top-20 full">Save</button>

                </form>
            </div>


        </div>
    </div>



</body>

</html>
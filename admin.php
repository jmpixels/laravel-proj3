

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Login</title>
</head>

<body>


    <div class="full-container">


        <div class="form-container">
            

            <div class="content-wrapper">

            </div>

            <form action="login.php" method="POST" class="form login">

                <!-- <div class="logo-container">
                    <img class="logo" src="img/logo_black.png" alt="">
                </div> -->

                <h2 class="header">Login</h2>

                <?php
                // if (isset($_GET['error'])) {
                //     $errorMessage = $_GET['error'];
                //     echo '<div class="error-message">' . htmlspecialchars($errorMessage) . '</div>';
                // }
                ?>

                <div class="input-wrapper">
                    <label class="label bold" for="">Username</label>
                    <input type="text" class="input-field" name="username" placeholder="Username">
                </div>


                <div class="input-wrapper">
                    <label class="label bold" for="">Password</label>
                    <input type="password" class="input-field" name="password" placeholder="password">
                </div>

                <?php
                if (isset($_GET['error'])) {
                ?>
                    <div class="alert-container">
                        <p class="error">
                            <?php echo $_GET['error'] ?>
                        </p>
                    </div>
                <?php
                }
                ?>

                <button class="button " type="submit">Login</button>


            </form>


        </div>

        <div class="logo-container bottom">
            <div class="mark">
                <img class="logo" src="../admin/img/logo_white.png" alt="">
            </div>
        </div>

    </div>

</body>

</html>
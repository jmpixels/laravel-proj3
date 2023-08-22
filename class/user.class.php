<?php

require_once('config.php');




class User
{

    public $name;
    public $username;
    public $password;
    public $user_role;

    private $conn;

    public function __construct()
    {

        global $db;
        $this->conn = $db->conn;
    }






    public function addUser($name, $username, $password, $user_role)
    {

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users`(`username`, `password`, `name`, `user_role`) VALUES ('$username','$hashedpassword','$name','$user_role')";
        $query = mysqli_query($this->conn, $sql);

        if ($query) {
            header("Location: users.php?success=User successfully created");
        } else {
            header("Location: users.php?error=Error creating user");
        }
    }

    public function checkUsername($username)
    {
        $sanitizedUsername = mysqli_real_escape_string($this->conn, $username);

        $check_query = mysqli_query($this->conn, "SELECT * FROM `users` WHERE `username` = '$sanitizedUsername'");

        if (mysqli_num_rows($check_query) > 0) {
            header("Location: users.php?error=Username already exists");
            exit;
        }
    }


    public function selectUser()
    {
        // $conn =  $this->connect();

        $sql = "SELECT * FROM `users` ORDER BY `id` DESC";
        $query = mysqli_query($this->conn, $sql);

        if ($query) {
            return $query;
        } else {
            return "Error";
        }
    }

    public function LoginUser($username, $password)
    {

        $sql = "SELECT * FROM users WHERE username = '$username' ";
        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];

            if (password_verify($password, $storedPassword)) {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];

                return true;
            }
        }

        return false;
    }

    public function getUserByID($userid)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = '$userid'";
        $query = mysqli_query($this->conn, $sql);

        if ($query) {
            return $query;
        } else {
            return "Error";
        }
    }


    public function editUser($name, $username, $password, $user_role, $edit_id)
    {
        $sql = "UPDATE `users` SET `username`='$username',`password`='$password',`name`='$name',`user_role`='$user_role' WHERE `id` = $edit_id";
        $query = mysqli_query($this->conn, $sql);


        if ($query) {
            header("Location:users.php?success=User data is successfully updated");
        } else {
            header("Location:users.php?error=Somethng went wrong, User data is not updated");
        };
    }



    public function deleteUser($userid)
    {
        $sql = "DELETE FROM `users` WHERE `id` = $userid";
        $query = mysqli_query($this->conn, $sql);

        if ($query) {
            header("Location:users.php?error=User succesfully deleted");
        } else {
            header("Location:users.php?error=Error, user is not deleted");
        }
    }
}


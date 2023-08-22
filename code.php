<?php

// include 'include/include_all.php';

include 'config.php';
// include 'class/function.class.php';
// require_once('class/multi_image.class.php');
// require_once('class/thumbnail.class.php');

include 'autoloader.php';

$user = new User();
$article = new Article();
$multi_img = new MultiImage();

if (isset($_POST['add-user'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];


    if ($user->checkUsername($username)) {
        $user->checkUsername($username);
    } else {

        $user->addUser($name, $username, $password, $user_role);
    }
}


if (isset($_GET['edit_id'])) {
    $userid = $_GET['edit_id'];


    $select_data = $user->getUserByID($userid);
    $row = mysqli_fetch_assoc($select_data);
}


if (isset($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];

    $delete = $user->deleteUser($user_id);
}

if (isset($_POST['edit_user'])) {
    $edit_id = $_POST['edit_id'];


    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];


    if ($user->checkUsername($username)) {
        $user->checkUsername($username);
    } else {
        $edit = $user->editUser($name, $username, $password, $user_role, $edit_id);
    }
}


if (isset($_POST['publish'])) {

    $latestID = $_POST['article_id'];
    $collection_name = "article";
    $article_id = $_POST['article_id'];
    $active = isset($_POST['active']) ? 1 : 0;
    $user_name = $_POST['user_name'];


    $multiimg = new MultiImage();
    $thumbnail = new Thumbnail();


    $upload_multi_img = $multiimg->add_MulitImages($collection_name, $latestID);

    $upload_article = $article->addArticle($_POST['article_id'], $_POST['title'], $_POST['category'], $_POST['paragraph'], $_POST['intro_text'], $_POST['current_date'], $active, $user_name);

    $add_thumbnail = $thumbnail->Add_thumbnail($collection_name, $latestID);

    if ($upload_article && $add_thumbnail && $upload_multi_img) {
        header("Location: articles.php?success=Article successfully published");
    } else {
        header("Location: articles.php?error=Error, article not published");
    }









    // if (isset($_FILES['thumbnail']['name']) && !empty($_FILES['thumbnail']['name'])) {
    //     $file = $_FILES['thumbnail']['name'];
    //     $image_type = $_FILES['thumbnail']['type'];
    //     $image_folder = "files/" . $file;
    //     $data = $_FILES['thumbnail']['tmp_name'];


    //     if (move_uploaded_file($data, $image_folder)) {

    //         $upload_article = $article->addArticle($_POST['article_id'], $file, $_POST['title'], $_POST['category'], $_POST['paragraph'], $_POST['intro_text'], $_POST['current_date'], $active, $user_name);




    //         if ($upload_article) {
    //             header("Location: articles.php?success=Article successfully published");
    //         } else {
    //             header("Location: articles.php?error=Error, articles not published 3434");
    //         }
    //     } else {
    //         echo "Error uploading file.";
    //     }
    // } else {
    //     $upload_article = $article->addArticle($_POST['article_id'], '', $_POST['title'], $_POST['category'], $_POST['paragraph'], $_POST['intro_text'], $_POST['current_date'],  $active, $user_name);

    //     if ($upload_article) {
    //         header("Location: articles.php?success=Article successfully published");
    //     } else {
    //         header("Location: articles.php?error=Error, articles not published");
    //     }
    // }
}



if (isset($_POST['update_article'])) {

    $active = isset($_POST['active']) ? 1 : 0;
    $edit_id = $_POST['edit_id'];
    $collection_name = "article";

    $multiimg = new MultiImage();
    $thumbnail = new Thumbnail();

    $upload_multi_img = $multiimg->add_MulitImages($collection_name, $edit_id);

    $update_article = $article->update_article($edit_id, $_POST['title'], $_POST['category'], $_POST['paragraph'], $_POST['intro_text'], $active);

    $add_thumbnail = $thumbnail->Update_thumbnail($collection_name, $edit_id);


    if ($update_article) {
        Header("Location:edit_article.php?edit_id=$edit_id&success=Article data updated");
    } else {
        Header("Location:edit_article.php?edit_id=$edit_id&error=Error, data could not be updated");
    }
}

// if (isset($_POST['filter'])) {
//     $start_date = $_POST['start_date'];
//     $end_date = $_POST['end_date'];

//     $article->FilterArticle($start_date, $end_date);
// }







// if(isset($_POST['submit_multi_img']))
// {
//     $multi_img = new MultiImage();

//     if($multi_img->multi_images())
//     {
//         header("Location:media.php?success= Media files successfullu uploaded");
//     }else{
//         header("Location:media.php?Error= Error uploading file");
//     }
// }






























// upload media images / files

// if(isset($_POST['submit_multi_img']))
// {
//     $file = $_FILES['thumbnail']['name'];
//     $image_type = $_FILES['thumbnail']['type'];
//     $image_folder = "files/" . $file;
//     $data = $_FILES['thumbnail']['tmp_name'];

    
//     if (move_uploaded_file($data, $image_folder)) {

//         $upload_article = $article->addArticle($_POST['article_id'], $file, $_POST['title'], $_POST['category'], $_POST['paragraph'], $_POST['intro_text'], $_POST['current_date'], $active,$user_name);


//         $upload_img = $multiimg->add_MulitImages($collection_name, $latestID);
    
    
//         if ($upload_article ) {
//             header("Location: articles.php?success=Article successfully published");
//         } else {
//             header("Location: articles.php?error=Error, articles not published 3434");
//         }
//     } else {
//         echo "Error uploading file.";
//     }
// } else {
//     $upload_article = $article->addArticle($_POST['article_id'], '', $_POST['title'], $_POST['category'], $_POST['paragraph'], $_POST['intro_text'], $_POST['current_date'],  $active,$user_name);

//     if ($upload_article) {
//         header("Location: articles.php?success=Article successfully published");
//     } else {
//         header("Location: articles.php?error=Error, articles not published");
//     }
// }

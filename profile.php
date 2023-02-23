<?php
session_start();

require "connection.php";

$user = getUser();

function getUser(){
    $conn   = connection();
    
    $id     = $_SESSION['id'];
    $sql    = "SELECT * FROM users WHERE id = $id";

    if ($result = $conn->query($sql)) {
        return $result->fetch_assoc();
    } else {
        die('Error retrieving your data: ' . $conn->error);
    }
}

function updatePhoto($id, $photo_name, $photo_tmp){
    $conn = connection();
    $sql = "UPDATE users SET photo = '$photo_name' WHERE id = $id";

    if($conn->query($sql)){
        $destination = "assets/images/$photo_name";
        move_uploaded_file($photo_tmp, $destination);
        header("refresh: 0");
    } else {
        die("Error uploading photo: " . $conn->error);
    }
}

if(isset($_POST['btn_upload_photo'])){
    $id         = $_SESSION['id'];
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp  = $_FILES['photo']['tmp_name'];

    updatePhoto($id, $photo_name, $photo_tmp);
    /*
    $_FILES
    
    ['name'] - file name (mark.jpeg)
    ['size'] - size of the file
    ['tmp_name'] - location of the temporary file
    ['error'] - default is 0.
    */
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile</title>
</head>
<body>
    <?php
    include "main-nav.php";
    ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">

                <?php
                if ($user['photo']) {
                ?>
                    <img src="assets/images/<?= $user['photo'] ?>" alt="<?= $user['photo'] ?>" class="d-block mx-auto img-thumbnail profile-photo">
                <?php
                } else {
                ?>
                    <i class="fa-regular fa-user d-block text-center profile-icon"></i>
                <?php
                }
                ?>

                <div class="mt-2 mb-3 text-center">
                    <p class="h4 mb-0"><?= $user['username'] ?></p>
                    <p><?= $user['first_name'] . " " . $user['last_name'] ?></p>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="input-group mb-2">
                        <input type="file" name="photo" class="form-control">
                        <button type="submit" class="btn btn-outline-secondary" name="btn_upload_photo">Upload</button>
                    </div>
                </form>
            </div>  
        </div>
    </main>
</body>
</html>
<?php

use App\{Auth, Connection, HTML\Form, Model\Image};

Auth::check();
$item = new Image();
$success = false;
$errors = [];
$directory = UPLOAD_PATH . '/posts_multiple/';

if (isset($_POST['submit'])) {

    for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
        $image = $_FILES["image"]['name'][$i]; // name of image
        // verifier si elle existe déjà dans la bdd
        $checkIfExists = (new \App\Table\ImageTable(Connection::getPDO()))->findByName($image);
        if($checkIfExists === true) {
            header('Location: ' . $router->url('admin_images') . '?duplicated=1');
            die();
        }

        $item->setName($image);

        $f_maxsize = 41943040;
        $f_ext_allowed = ["jpg", "png", "gif", "svg", "jpeg"];

        $f_name_2 = str_replace(" ", "_", e($image));
        $f_size = $_FILES["image"]['size'][$i];
        $f_tmp = $_FILES["image"]['tmp_name'][$i];
        $f_error = $_FILES["image"]['error'][$i];
        $f_ext = pathinfo($f_name_2, PATHINFO_EXTENSION);

        if (!in_array($f_ext, $f_ext_allowed)) {
            echo 'not an image extension';
            exit();
        }
        if ($f_error !== 0) {
            echo 'There is an error';
            exit();
        }
        if ($f_size > $f_maxsize) {
            echo 'This image is too big';
            exit();
        }

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        //Put file in image table
        $item->setCreatedAt(date('Y-m-d H:i:s'));
        $pdo = Connection::getPDO();
        $query = $pdo->prepare("INSERT INTO image SET name= :name, created_at = :created");
        $statement = $query->execute([
            'name' => $image,
            'created' => $item->getCreatedAt()->format("Y-m-d H:i:s")
        ]);
        header('Location: ' . $router->url('admin_images') . '?created=1');
        move_uploaded_file($f_tmp, $directory . $image);
    }
}

$form = new Form($item, $errors);
?>
<h2 class="container mt4 medium-title">Ajouter des images</h2>
<hr>

<?php require('_form.php'); ?>


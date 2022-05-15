<?php

use App\{Auth, Connection, HTML\Form, Model\File};

Auth::check();
$item = new File();
$success = false;
$errors = [];
$directory = UPLOAD_PATH . '/files/';

if (isset($_POST['submit'])) {

    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
        $file = $_FILES["file"]['name'][$i]; // name of file

        $checkIfExists = (new \App\Table\FileTable(Connection::getPDO()))->findByName($file);
        if($checkIfExists === true) {
            header('Location: ' . $router->url('admin_files') . '?duplicated=1');
            die();
        }

        $item->setName($file);

        $f_maxsize = 41943040;
        $f_ext_allowed = ['pdf'];

        $f_name_2 = str_replace(" ", "_", htmlspecialchars($file));
        $f_size = $_FILES["file"]['size'][$i];
        $f_tmp = $_FILES["file"]['tmp_name'][$i];
        $f_error = $_FILES["file"]['error'][$i];
        $f_ext = pathinfo($f_name_2, PATHINFO_EXTENSION);

        if (!in_array($f_ext, $f_ext_allowed)) {
            header('Location: ' . $router->url('admin_files') . "?format=1");
            exit();
        }

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        //Put file in file table
        $item->setCreatedAt(date('Y-m-d H:i:s'));
        $pdo = Connection::getPDO();
        $query = $pdo->prepare("INSERT INTO file SET name= :name, created_at = :created ");
        $statement = $query->execute([
            'name' => $file,
            'created' => $item->getCreatedAt()->format("Y-m-d H:i:s")
        ]);
        header('Location: ' . $router->url('admin_files') . '?created=1');
        move_uploaded_file($f_tmp, $directory . $file);
    }
}

$form = new Form($item, $errors);
?>
<h2 class="container mt4 medium-title">Ajouter des documents</h2>
<hr>

<?php require('_form.php'); ?>


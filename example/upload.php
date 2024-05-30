<?php

require __DIR__ . '/../vendor/autoload.php';

use Filewizard\UploadWizard;

if(isset($_FILES['file'])) {
    $source      = $_FILES['file']['tmp_name'];
    $destination = __DIR__ . '/uploads/';

    $wizard = new UploadWizard(destination: $destination);
    $file   = $wizard::upload($source);

    echo '<pre>';
    print_r($file);
    echo '</pre>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileWizard - Upload Example</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>


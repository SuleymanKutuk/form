<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload</title>
</head>

<?php
if (!empty($_FILES['avatar'])) {

    $nameFile = $_FILES['avatar']['name'];
    $typeFile = $_FILES['avatar']['type'];
    $sizeFile = $_FILES['avatar']['size'];
    $tmpFile = $_FILES['avatar']['tmp_name'];
    $errFile = $_FILES['avatar']['error'];


    $extensions = ['png', 'jpg', 'jpeg', 'gif'];
    // Type 
    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

    $extension = explode('.', $nameFile);
    // Max size
    $max_size = 2000000;



    if (in_array($typeFile, $type)) {

        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
            // le poids de l'image
            if ($sizeFile < $max_size && getimagesize($tmpFile)) {

                if (move_uploaded_file($tmpFile, './uploads/' . uniqid() . '.' . strtolower(end($extension))))
                    echo "télécharger !";
                else
                    echo "non télécharger";
            } else {
                echo "Fichier trop lourd ou format incorrect";
            }
        } else {
            echo "Extension non aboutie";
        }
    } else {
        echo "Type non autorisé";
    }
}

$files = scandir('uploads');
foreach ($files as $file) {
    if ($file != '.' and $file != '..') echo '<img src="uploads/' . $file . '" /><br/>';
}
?>

<body>



    <form method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="avatar" id="imageUpload" />
        <button name="submit">Ajouter</button>
    </form>









</body>

</html>
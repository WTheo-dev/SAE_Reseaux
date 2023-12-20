<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'intervention</title>
    <link rel="stylesheet" href="banque.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>
<body>

    <form action="banque.php" method="post" enctype="multipart/form-data">

    <h1>BANQUE RESSOURCE</h1>

    <h2>ICON</h2>

    <input type="file" name="icon-file"/>

    <button class="noprint" type="submit" name="enregistrer_icon">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        <span>Ajouter icon</span>
    </button>

    <br>

    <?php
    if (!empty($_FILES)){
        $target_dir="icon/";
        $target_file=$target_dir.basename($_FILES["icon-file"]["name"]);
        $uploadOk=0;
        $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extAutoriser=array("jpeg", "jpg", "png");

        if(isset($_POST["enregistrer_icon"])) {
            if(in_array($imageFileType, $extAutoriser) === false){
                echo "extension non autorisé, choisisez parmis : jpeg, jpg, png<br>";
            } else {
                $check = getimagesize($_FILES["icon-file"]["tmp_name"]);
                if($check == false) {
                    echo "ce fichier n'est pas une image correct.";
                    $uploadOk = 1;
                } else {
                    $succes=move_uploaded_file($_FILES['icon-file']['tmp_name'][$key],getcwd()."/".$target_file);
                    if ($succes){
                        echo "success<br>";
                    } else {
                        echo "pas success<br>";
                    }
                    echo getcwd()."/".$target_file."<br>";
                    echo "icon enregistrée.";
                }
            }
        }
    }
    ?>

    <h3>Liste des icons :</h3>
    <div class="icon-container">
        <?php
            $files=scandir("icon");
            foreach ($files as $file){
                if ($file == "." || $file == "..") continue;
                echo "<img class='icon-img' src='icon/".$file."' />";
            }
        ?>
    </div>

    </form>

</body>
</html>
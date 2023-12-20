<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANQUE</title>
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

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ?>

    <?php
        if (isset($_POST['supprimer_icon'])){
            foreach ($_POST as $file => $check){
                if ($check == "on"){
                    $file="icon/".str_replace("_", ".", str_replace("checkimg-", "", $file));
                    unlink($file);
                }
            }
        }
    ?>

    <form action="banque.php" method="post" enctype="multipart/form-data">

    <h1>BANQUE RESSOURCE</h1>

    <div class="banque-icon">

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
        $name=basename($_FILES["icon-file"]["name"]);
        $target_file=$target_dir.$name;
        $uploadOk=0;
        $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extAutoriser=array("jpeg", "jpg", "png");

        if(isset($_POST["enregistrer_icon"])) {
            if(in_array($imageFileType, $extAutoriser) === false){
                echo "extension non autorisé, choisisez parmis : jpeg, jpg, png<br>";
            } else if (str_contains($name, "_") || str_contains($name, " ")) {
                echo $name." incorrect, ne pas mettre de _ ou d'espace dans le nom";
            } else {
                $check = getimagesize($_FILES["icon-file"]["tmp_name"]);
                if($check == false) {
                    echo "ce fichier n'est pas une image correct.";
                    $uploadOk = 1;
                } else {
                    try {
                        $succes=move_uploaded_file($_FILES['icon-file']['tmp_name'], $target_file);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    if (!$succes){
                        echo "erreur a l'enregistrement, verifier que l'image est bonne.<br>";
                    } else {
                        echo "icon enregistrée.<br>";
                    }
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
                echo "<input type='checkbox' id='checkimg-".$file."' name='checkimg-".$file."' class='img-check'>";
                echo "<label class='image-icon-container' for='checkimg-".$file."'>";
                echo "<img class='icon-img' src='icon/".$file."' name='".$file."' />";
                echo "<span>".$file."</span>";
                echo "</label>";
            }
        ?>
    </div>

    <button class="noprint" type="submit" name="supprimer_icon">
        <i class="fa fa-trash" aria-hidden="true"></i>
        <span>Supprimer icon selectionné</span>
    </button>
    <br>

    <?php
        if (isset($_POST['supprimer_icon'])){
            echo "Icon supprimées :<br>";
            echo "<ul>";
            foreach ($_POST as $file => $check){
                if ($check == "on"){
                    $file=str_replace("_", ".", str_replace("checkimg-", "", $file));
                    echo "<li>".$file."</li>";
                }
            }
            echo "</ul>";
        }
    ?>

    </div>

    <!--
    </div class="banque-audio">
    <h2>AUDIO</h2>

    <h3>Liste des audios :</h3>
    <div class="audio-container">
        <?php
            /*
            $files=scandir("audio");
            foreach ($files as $file){
                if ($file == "." || $file == "..") continue;
                echo "<div class='audio-container'>";
                echo "<p class='audio-img'> src='audio/".$file."' </p>";
                echo "</div>";
            }
            */
        ?>
    </div>
    </div>
    -->

    </form>

</body>
</html>
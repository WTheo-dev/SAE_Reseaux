<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque de ressources</title>
    <link rel="stylesheet" href="banque.css"><link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
</head>

<body class="body_page_banque_de_donnee">  
        <header class="header_page-banque-de-donnee">
            <div class="header_text"><img class="logo_page_postco_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
            <div class="child-info">
                <h2 class="header_text_pagebanque">Nom Prénom de l'admin</h2>
            </div>
        </header>

    <script src="fiche_audio.js"></script>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ?>

    <?php
        if (!is_dir("icon")){
            mkdir("icon");
            shell_exec("chmod 777 icon");
            shell_exec("chown www-data icon");
            shell_exec("chgrp www-data icon");
        }
        if (!is_dir("audio")){
            mkdir("audio");
            shell_exec("chmod 777 audio");
            shell_exec("chown www-data audio");
            shell_exec("chgrp www-data audio");
        }
    ?>


    <?php
        if (is_dir("audio")){
            $files=scandir("audio");
            foreach ($files as $file){
                if ($file == "." || $file == "..") continue;
                echo '<audio id="'.$file.'">';
                echo '<source src="audio/'.$file.'" type="audio/mp3">';
                echo '</audio>';
            }
        }
    ?>

    <?php
        if (isset($_POST['supprimer_icon'])){
            foreach ($_POST as $file => $check){
                if ($check == "on" && str_starts_with($file, "checkimg-")){
                    $file="icon/".str_replace("_", ".", str_replace("checkimg-", "", $file));
                    unlink($file);
                }
            }
        }

        if (isset($_POST['supprimer_audio'])){
            foreach ($_POST as $file => $check){
                if ($check == "on" && str_starts_with($file, "checkaud-")){
                    $file="audio/".str_replace("_", ".", str_replace("checkaud-", "", $file));
                    unlink($file);
                }
            }
        }
    ?>

    <form action="banque.php" method="post" enctype="multipart/form-data">
    <div class="h1-banque-ressources">
        <h1>Bienvenue sur votre banque de ressources</h1>
    </div>

    <div class="banque-icon">

    <h2 class="h2_textpagebanque">Ajoutez ici vos icônes / pictogrammes </h2>

    <input type="file" name="icon-file"/>

    <button class="noprint" type="submit" name="enregistrer_icon">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        <span>Ajouter le pictogramme</span>
    </button>

    <br>

    <?php
    if (!empty($_FILES) && isset($_POST['enregistrer_icon'])){
        $target_dir="icon/";
        $name=basename($_FILES["icon-file"]["name"]);
        $target_file=$target_dir.$name;
        $uploadOk=0;
        $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extAutoriser=array("jpeg", "jpg", "png");

        if(isset($_POST["enregistrer_icon"])) {
            if(in_array($imageFileType, $extAutoriser) === false){
                echo "Extension non autorisée, choisisez parmi : jpeg, jpg, png<br>";
            } else if (str_contains($name, "_") || str_contains($name, " ")) {
                echo $name." Nom incorrect, ne pas mettre de _ ou d'espace dans le nom";
            } else {
                $check = getimagesize($_FILES["icon-file"]["tmp_name"]);
                if($check == false) {
                    echo "Ce fichier n'est pas une image correcte.";
                    $uploadOk = 1;
                } else {
                    try {
                        $succes=move_uploaded_file($_FILES['icon-file']['tmp_name'], $target_file);
                    } catch (Exception $e) {
                        echo "Erreur : ".$e->getMessage();
                    }
                    if (!$succes){
                        echo "erreur a l'enregistrement, verifier que l'image est bonne.<br>";
                    } else {
                        echo "Pictogramme enregistré.<br>";
                    }
                }
            }
        }
    }
    ?>

    <h3 class="h2_textpagebanque">Liste de vos pictogrammes :</h3>
    <div class="icon-container">
        <?php
            if (is_dir("icon")){
                $files=scandir("icon");
                foreach ($files as $file){
                    if ($file == "." || $file == "..") continue;
                    echo "<input type='checkbox' id='checkimg-".$file."' name='checkimg-".$file."' class='img-check'>";
                    echo "<label class='image-icon-container' for='checkimg-".$file."'>";
                    echo "<img class='icon-img' src='icon/".$file."' name='".$file."' />";
                    echo "<span>".$file."</span>";
                    echo "</label>";
                }
            }
        ?>
    </div>

    <button class="noprint" type="submit" name="supprimer_icon">
        <i class="fa fa-trash" aria-hidden="true"></i>
        <span>Supprimer le/les pictogramme(s) sélectionné(s)</span>
    </button>
    <br>

    <?php
        if (isset($_POST['supprimer_icon'])){
            echo "Icon supprimées :<br>";
            echo "<ul>";
            foreach ($_POST as $file => $check){
                if ($check == "on" && str_starts_with($file, "checkimg-")){
                    $file=str_replace("_", ".", str_replace("checkimg-", "", $file));
                    echo "<li>".$file."</li>";
                }
            }
            echo "</ul>";
        }
    ?>

    </div>

    <div class="banque-audio">
    <h2>Ajoutez ici vos audios enregistrés</h2>

    <input type="file" name="audio-file"/>

    <button class="noprint" type="submit" name="enregistrer_audio">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        <span>Ajouter audio</span>
    </button>

    <br>

    <?php
    if (!empty($_FILES) && isset($_POST['enregistrer_audio'])){
        $target_dir="audio/";
        $name=basename($_FILES["audio-file"]["name"]);
        $target_file=$target_dir.$name;
        $uploadOk=0;
        $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extAutoriser=array("mp3", "wav", "ogg");

        if(isset($_POST["enregistrer_audio"])) {
            if(in_array($imageFileType, $extAutoriser) === false){
                echo "Extension non autorisée, choisisez parmi : mp3, wav, ogg<br>";
            } else if (str_contains($name, "_") || str_contains($name, " ")) {
                echo $name." Nom de fichier incorrect, ne pas mettre de _ ou d'espace dans le nom";
            } else {
                $check = explode("/", mime_content_type($_FILES['audio-file']['tmp_name']))[0] === "audio";
                if($check == false) {
                    echo "Ce fichier n'est pas un audio correct.";
                    $uploadOk = 1;
                } else {
                    try {
                        $succes=move_uploaded_file($_FILES['audio-file']['tmp_name'], $target_file);
                    } catch (Exception $e) {
                        echo "Erreur : ".$e->getMessage();
                    }
                    if (!$succes){
                        echo "Erreur a l'enregistrement, verifier que l'audio est bon.<br>";
                    } else {
                        echo "Votre audio a été enregistré avec succès.<br>";
                    }
                }
            }
        }
    }
    ?>

    <h3>Liste des audios :</h3>
    <div class="audio-container">
        <?php
            if (is_dir("audio")){
                $files=scandir("audio");
                foreach ($files as $file){
                    if ($file == "." || $file == "..") continue;
                    echo "<input type='checkbox' id='checkaud-".$file."' name='checkaud-".$file."' class='aud-check'>";
                    echo "<label class='aud-icon-container' for='checkaud-".$file."'>";
                    echo '<button type="button" class="audiobutton" onclick="toggleAudio(\''.$file.'\')"><i class="fa fa-volume-up" aria-hidden="true"></i></button>';
                    echo "<span>".$file."</span>";
                    echo "</label>";
                }
            }
        ?>
    </div>

    <button class="noprint" type="submit" name="supprimer_audio">
        <i class="fa fa-trash" aria-hidden="true"></i>
        <span>Supprimer le ou les audio(s) selectionnés</span>
    </button>
    <br>

    <?php
        if (isset($_POST['supprimer_audio'])){
            echo "Audio(s) supprimé(s) :<br>";
            echo "<ul>";
            foreach ($_POST as $file => $check){
                if ($check == "on" && str_starts_with($file, "checkaud-")){
                    $file=str_replace("_", ".", str_replace("checkaud-", "", $file));
                    echo "<li>".$file."</li>";
                }
            }
            echo "</ul>";
        }
    ?>

 </div>

    </form>

</body>
</html>
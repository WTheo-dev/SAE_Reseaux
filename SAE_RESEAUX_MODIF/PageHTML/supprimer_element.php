<?php

include_once "../../APIFinale/fonctions.php";

$delete=array();
$delete_len=0;

if (isset($_POST['supprimer_icon'])){
    foreach ($_POST as $file => $check){
        if ($check == "on" && str_starts_with($file, "checkimg-")){
            $file="icon/".str_replace("_", ".", str_replace("checkimg-", "", $file));
            unlink($file);
            $delete[$delete_len] = $file;
            $delete_len++;
        }
        elseif (str_starts_with($file, "id-") && str_replace("id-", "", $file)) {
            supprimerElement($check);
        }
    }
}



header("Location: banque.php");
exit();

?>
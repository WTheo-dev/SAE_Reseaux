<?php
session_start();
include_once "../../APIFinale/fonctions.php";

if (!isset($_SESSION['personnel']) && !isset($_SESSION['superadmin'])) {
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['superadmin'])) {
    header('Location: page_postco_superadmin.php');
    exit();
}

if (isset($_SESSION['personnel'])) {
    header('Location: page_postco_admin.php');
    exit();
}
?>

redirection...

<?php

require 'C:\xampp\htdocs\SAE_Reseaux\vendor\autoload.php';

$SERVER = '127.0.0.1';
$BD_NAME = 'apeaj';
$LOGIN = 'root';
$MDP = '';

try {
    $BD = new PDO("mysql:host=$SERVER;dbname=$BD_NAME", $LOGIN, $MDP);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}


$BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();


$activeSheet->setCellValue('A1', 'id_apprenti');
$activeSheet->setCellValue('B1', 'nom');
$activeSheet->setCellValue('C1', 'prénom');
$activeSheet->setCellValue('D1', 'login');
$activeSheet->setCellValue('E1', 'mdp');
$activeSheet->setCellValue('F1', 'photo');


$query = $BD->query("SELECT * FROM apprenti");

if ($query->rowCount() > 0) {
    $i = 2;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $activeSheet->setCellValue('A' . $i, $row['id_apprenti']);
        $activeSheet->setCellValue('B' . $i, $row['nom']);
        $activeSheet->setCellValue('C' . $i, $row['prenom']);
        $activeSheet->setCellValue('D' . $i, $row['login']);
        $activeSheet->setCellValue('E' . $i, $row['mdp']);
        $activeSheet->setCellValue('F' . $i, $row['photo']);
        $i++;
    }
}

$filename = 'eleves.csv';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');

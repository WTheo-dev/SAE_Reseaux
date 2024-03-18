<?php

require_once '../../vendor/autoload.php';
require_once '../../APIFinale/fonctions.php';
 
$bd=connexionBD();

$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();


$activeSheet->setCellValue('A1', 'id_apprenti');
$activeSheet->setCellValue('B1', 'id_fiche');
$activeSheet->setCellValue('C1', 'numero');
$activeSheet->setCellValue('D1', 'nom_du_demandeur');
$activeSheet->setCellValue('E1', 'date_demande');
$activeSheet->setCellValue('F1', 'date_intervention');
$activeSheet->setCellValue('G1', 'duree_intervention');
$activeSheet->setCellValue('H1', 'localisation');
$activeSheet->setCellValue('I1', 'description_demande');
$activeSheet->setCellValue('J1', 'degre_urgence');
$activeSheet->setCellValue('K1', 'type_intervention');
$activeSheet->setCellValue('L1', 'nature_intervention');
$activeSheet->setCellValue('M1', 'couleur_intervention');
$activeSheet->setCellValue('N1', 'etat_fiche');
$activeSheet->setCellValue('O1', 'date_creation');


$query = $bd->query("SELECT * FROM fiche_intervention");

if ($query->rowCount() > 0) {
    $i = 2;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $activeSheet->setCellValue('A' . $i, $row['id_apprenti']);
        $activeSheet->setCellValue('B' . $i, $row['id_fiche']);
        $activeSheet->setCellValue('C' . $i, $row['numero']);
        $activeSheet->setCellValue('D' . $i, $row['nom_du_demandeur']);
        $activeSheet->setCellValue('E' . $i, $row['date_demande']);
        $activeSheet->setCellValue('F' . $i, $row['date_intervention']);
        $activeSheet->setCellValue('G' . $i, $row['duree_intervention']);
        $activeSheet->setCellValue('H' . $i, $row['localisation']);
        $activeSheet->setCellValue('I' . $i, $row['description_demande']);
        $activeSheet->setCellValue('J' . $i, $row['degre_urgence']);
        $activeSheet->setCellValue('K' . $i, $row['type_intervention']);
        $activeSheet->setCellValue('L' . $i, $row['nature_intervention']);
        $activeSheet->setCellValue('M' . $i, $row['couleur_intervention']);
        $activeSheet->setCellValue('N' . $i, $row['etat_fiche']);
        $activeSheet->setCellValue('O' . $i, $row['date_creation']);
        $i++;
    }
}




$filename = 'fichesinterventions.csv';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');

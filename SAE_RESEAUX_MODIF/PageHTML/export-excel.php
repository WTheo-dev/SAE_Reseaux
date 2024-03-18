<?php

require_once '../../vendor/autoload.php';
require_once '../../APIFinale/fonctions.php';
 
$bd=connexionBD();

$BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();


$activeSheet->setCellValue('A1', 'id_apprenti');
$activeSheet->setCellValue('B1', 'nom');
$activeSheet->setCellValue('C1', 'prenom');
$activeSheet->setCellValue('D1', 'photo');


$query = $BD->query("SELECT * FROM apprenti");

if ($query->rowCount() > 0) {
    $i = 2;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $activeSheet->setCellValue('A' . $i, $row['id_apprenti']);
        $activeSheet->setCellValue('B' . $i, $row['nom']);
        $activeSheet->setCellValue('C' . $i, $row['prenom']);
        $activeSheet->setCellValue('D' . $i, $row['photo']);
        $i++;
    }
}

$filename = 'eleves.csv';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');

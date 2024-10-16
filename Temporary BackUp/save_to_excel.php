<?php
require 'vendor/autoload.php'; // Load PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Check if the file exists, if not create one
$filePath = 'test_results.xlsx';
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the headers for the Excel sheet
$sheet->setCellValue('A1', 'Person');
$sheet->setCellValue('B1', 'Correct');
$sheet->setCellValue('C1', 'Incorrect');

// Function to save results to Excel file
function saveResultsToExcel($person, $correct, $incorrect, $filePath) {
    global $spreadsheet, $sheet;

    // Find the next available row
    $highestRow = $sheet->getHighestRow() + 1;

    // Insert the result
    $sheet->setCellValue("A{$highestRow}", "Person {$person}");
    $sheet->setCellValue("B{$highestRow}", $correct);
    $sheet->setCellValue("C{$highestRow}", $incorrect);

    // Save the spreadsheet
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the AJAX request
    $person = $_POST['person'];
    $correct = $_POST['correct'];
    $incorrect = $_POST['incorrect'];

    // Save the test results to the Excel sheet
    saveResultsToExcel($person, $correct, $incorrect, $filePath);

    // Respond with success
    echo "Results saved to Excel.";
}
?>


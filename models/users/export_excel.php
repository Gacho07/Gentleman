<?php

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=users.xlsx");

require_once "../../config/connection.php";
require_once "functions.php";

$users = getAllUsers();

if (!class_exists("COM")) {
    throw new ErrorException("COM class is not enabled!");
}

$excel = new COM("Excel.Application");
$excel->Visible = 1;
$excel->DisplayAlerts = 1;

$workbook = $excel->Workbooks->Add();

$sheet = $workbook->Worksheets("Sheet1");
$sheet->activate;

$num = 1;
foreach($users as $u) {
    $cell = $sheet->Range("A{$num}");
    $cell->activate;
    $cell->value = $u->first_name;

    $cell = $sheet->Range("B{$num}");
    $cell->activate;
    $cell->value = $u->last_name;

    $cell = $sheet->Range("C{$num}");
    $cell->activate;
    $cell->value = $u->email;

    $cell = $sheet->Range("D{$num}");
    $cell->activate;
    $cell->value = $u->role_name;

    $num++;
}

# Number of inserted rows
$cell = $sheet->Range("F1");
$cell->activate;
$cell->value = $num - 1;

# Saving changes
$workbook->Save();
<?php
header("Location: ../../index.php?page=author");

require_once "../config/connection.php";
require_once "functions.php";

$author = getAuthor();
$a = $author[0];

$word = new COM("Word.Application") or die("Unable to instantiate Word");
$word->Visible = true;
$word->Documents->Add();
$word->Selection->TypeText("Name: $a->first_name \t $a->last_name \n Description: $a->description \n Index: $a->index_number");
$word->ActiveDocument->SaveAs("Author.docx");
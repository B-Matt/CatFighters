<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/catfighters/src/php/utils/fighter_edit.php');

if( !isset($_GET['id']) )
{
    header("Location: ../../../index.php");
    die();
}

$edit = new FighterEdit();
$edit->db_delete($_GET['id']);
$edit->remove_image($_GET['id']);

header("Location: ../../../index.php");
die();
<?php
require_once("../utils/fighter_edit.php");

if( !isset($_GET['id']) )
{
    header("Location: ../../../index.php");
    die();
}

$edit = new FighterEdit();
$edit->db_delete($_GET['id']);

header("Location: ../../../index.php");
die();
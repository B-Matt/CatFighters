<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/catfighters/src/php/utils/fighter_edit.php');

if( !isset($_POST['fighter-name']) || !isset($_POST['fighter-age']) ||
    !isset($_POST['fighter-skills']) || !isset($_POST['fighter-wins']) || 
    !isset($_POST['fighter-loss'])  || !isset($_POST['fighter-id']) || 
    !isset($_POST['fighter-uri']))
{
    header("Location: ../../../index.php");
    die();
}


$edit = new FighterEdit();
$image_uri = $edit->upload_image($_FILES['fighter-image'], $_POST['fighter-id'],  $_POST['fighter-uri']);
$edit->db_update($image_uri, $_POST['fighter-name'], $_POST['fighter-age'], $_POST['fighter-skills'], $_POST['fighter-wins'], $_POST['fighter-loss'], $_POST['fighter-id']);

header("Location: ../../../index.php");
die();
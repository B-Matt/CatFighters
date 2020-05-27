<?php
require_once("../utils/fighter_edit.php");

if( !isset($_POST['fighter-name']) || !isset($_POST['fighter-age']) ||
    !isset($_POST['fighter-skills']) || !isset($_POST['fighter-wins']) || 
    !isset($_POST['fighter-loss']) || !isset($_POST['fighter-uri']))
{
    header("Location: ../../../index.php");
    die();
}

$edit = new FighterEdit();
$fighter_id = $edit->db_insert("", $_POST['fighter-name'], $_POST['fighter-age'], $_POST['fighter-skills'], $_POST['fighter-wins'], $_POST['fighter-loss']);
$image_uri = $edit->upload_image($_FILES['fighter-image'], $fighter_id,  $_POST['fighter-uri']);
$edit->db_update($image_uri, $_POST['fighter-name'], $_POST['fighter-age'], $_POST['fighter-skills'], $_POST['fighter-wins'], $_POST['fighter-loss'], $fighter_id);

var_dump($image_uri);
var_dump($fighter_id);
//header("Location: ../../../index.php");
die();
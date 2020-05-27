<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/catfighters/src/php/utils/fighter_edit.php');

$json = file_get_contents('php://input');
$data = json_decode($json);

if(!isset($data->{'fighter-id'}) || !isset($data->{'fighter-wins'}) || !isset($data->{'fighter-loss'}))
{
    die(json_encode("SOMETHING MISSING!"));
}


$edit = new FighterEdit();
$edit->db_update_score($data->{'fighter-id'}, $data->{'fighter-wins'}, $data->{'fighter-loss'});
echo "OK";
<?php

require_once("..\config\config.php");
require_once("..\database\database.php");

class FighterEdit 
{
    private $db = null;

    public function __construct() 
    {
        $this->db = new Database();
    }

    public function update_database($image_uri, $name, $age, $skills, $wins, $loss, $id)
    {
        $this->db->update("UPDATE cf_fighters AS f, cf_fighter_stats AS s SET f.image_uri = :image, f.name = :name, f.age = :age, f.skills = :skills, s.wins = :wins, s.loss = :loss WHERE f.id = s.fighter_id AND f.id = :id", [
            'image' => $image_uri,
            'name' => $name,
            'age' => $age,
            'skills' => $skills,
            'wins' => $wins,
            'loss' => $loss,
            'id' => $id
        ]);
    }
    
    public function upload_image($file, $id, $uri)
    {
        if(empty($file["name"]))
        {
            return $uri;
        }
    
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $file_location = "../../../img/cat" . $id . ".png";
        $db_location = "./img/cat" . $id . ".png";
    
        if(file_exists($file_location))
        {
            unlink($file_location);
        }
    
        imagepng(imagecreatefromstring(file_get_contents($file["tmp_name"])), $file_location);
        return $db_location;
    }
}
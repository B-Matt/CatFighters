<?php 
require_once(__DIR__ . "\src\php\config\config.php");
require_once(__DIR__ . "\src\php\database\database.php");

if(isset($_GET["id"])) 
{
    $db = new Database();
    $fighter = $db->select(sprintf("SELECT f.image_uri, f.name, f.age, f.skills, s.wins, s.loss FROM cf_fighters AS f LEFT JOIN cf_fighter_stats AS s ON f.id = s.fighter_id WHERE f.id = %d", $_GET["id"]));
    
    if(!isset($fighter[0]))
    {
        header("Location: index.php");
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadatak 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
</head>

<body>
    <h1 class="mt-1 ml-3"><?php echo isset($_GET['id']) ? "CFC 3 - EDIT FIGHTER" : "CFC 3 - ADD NEW FIGHTER" ?></h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="mt-1 ml-3">
                    <form action="src/php/managers/<?php echo isset($_GET["id"]) ? "edit_fighter.php" : "add_fighter.php" ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" value="<?php echo $_GET["id"] ?>" name="fighter-id" />
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" name="fighter-name" value='<?php echo isset($fighter[0]) ? $fighter[0]["name"] : "" ?>' required />
                        </div>
                        <div class="form-group">
                            <label for="inputAge">Age</label>
                            <input type="numeric" class="form-control" id="inputAge" name="fighter-age" value='<?php echo isset($fighter[0]) ? $fighter[0]["age"] : "" ?>' required />
                        </div>
                        <div class="form-group">
                            <label for="inputInfo">Cat Info</label>
                            <input type="text" class="form-control" id="inputInfo" name="fighter-skills" value='<?php echo isset($fighter[0]) ? $fighter[0]["skills"] : "" ?>' required />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputWins">Wins</label>
                                <input type="numeric" class="form-control" id="inputWins" name="fighter-loss" value='<?php echo isset($fighter[0]) ? $fighter[0]["wins"] : "" ?>' required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputLoss">Loss</label>
                                <input type="numeric" class="form-control" id="inputLoss" name="fighter-wins" value='<?php echo isset($fighter[0]) ? $fighter[0]["loss"] : "" ?>' required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputImage">Cat Image</label>
                            <input type="file" class="form-control-file" id="inputImage" name="fighter-image" accept="image/jpeg, image/png" required />
                            <input type="hidden" name="fighter-uri" value='<?php echo isset($fighter[0]) ? $fighter[0]["image_uri"] : "" ?>' />
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <a href="index.php" class="float-right mr-5">Go back</a>
            </div>
        </div>
    </div>
</body>

</html>
<?php 
require_once(__DIR__ . "\src\php\config\config.php");
require_once(__DIR__ . "\src\php\database\database.php");

$db = new Database();
$fighters_img = $db->select("SELECT image_uri FROM cf_fighters WHERE 1");
$fighters = $db->select("SELECT f.name, f.age, f.skills, s.wins, s.loss FROM cf_fighters AS f LEFT JOIN cf_fighter_stats AS s ON f.id = s.fighter_id;");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFC 3 - Matej Arlović</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
</head>

<body>
    <section class="container d-flex flex-column  align-items-center mb-4">
        <h1>CFC 3</h1>
        <h2>Choose your cat</h2>
    </section>
    <div class="container d-flex flex-column  align-items-center">
        <div id="clock" class="clock display-4"></div>
        <div id="message" class="message"></div>
    </div>
    <div class="row">
        <div id="firstSide" class="fluid-container d-flex flex-column  align-items-center side first-side col-5">
            <div class="row d-flex justify-content-end">
                <div class="col-auto">
                    <ul class="cat-info list-group">
                        <li class="list-group-item name">Cat Name</li>
                        <li class="list-group-item age">Cat age</li>
                        <li class="list-group-item skills">Cat Info</li>
                        <li class="list-group-item record">Wins:<span class="wins"></span> Loss: <span
                                class="loss"></span></li>
                    </ul>
                </div>
                <div class="col-auto featured-cat-fighter">
                    <img class="featured-cat-fighter-image img-rounded" src="https://via.placeholder.com/300"
                        alt="Featured cat fighter" width=300 height=300>
                </div>
                <div class="col-auto w-100" style="margin-top: 24px">
                    <div class="row fighter-list">
                        <?php $i = 1 ?>
                        <?php foreach($fighters as $fighter): ?>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='<?php echo json_encode($fighter) ?>'>
                                <img src=<?php echo $fighters_img[$i - 1]["image_uri"] ?> alt="Figter Box "
                                    <?php echo $i ?> width="150" height="150">
                            </div>
                        </div>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 d-flex flex-column align-items-center">
            <p class="display-4">VS</p>
            <button id="generateFight" class="btn btn-primary mb-4 btn-lg">Fight</button>
            <button id="randomFight" class="btn btn-secondary">Select Random fighters</button>
        </div>
        <div id="secondSide" class="container d-flex flex-column align-items-center side second-side col-5">
            <div class="row">
                <div class="col-auto featured-cat-fighter">
                    <img class="featured-cat-fighter-image img-rounded" src="https://via.placeholder.com/300"
                        alt="Featured cat fighter" width=300 height=300>
                </div>
                <div class="col-auto">
                    <ul class="cat-info list-group">
                        <li class="list-group-item name">Cat Name</li>
                        <li class="list-group-item age">Cat age</li>
                        <li class="list-group-item skills">Cat Info</li>
                        <li class="list-group-item record">Wins: <span class="wins"></span>Loss: <span
                                class="loss"></span></li>
                    </ul>
                </div>
                <div class="col-auto w-100" style="margin-top: 24px">
                    <div class="row fighter-list">
                        <?php $i = 1 ?>
                        <?php foreach($fighters as $fighter): ?>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='<?php echo json_encode($fighter) ?>'>
                                <img src=<?php echo $fighters_img[$i - 1]["image_uri"] ?> alt="Figter Box "
                                    <?php echo $i ?> width="150" height="150">
                            </div>
                        </div>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <a href="fighter.php" class="mx-auto">
            <button type="submit" class="btn btn-primary">Add new fighter</button>
        </a>
    </div>

    <!-- JavaScript -->
    <script src="./src/js/fighters.js"></script>
    <script src="./src/js/ui.js"></script>
    <script src="./src/js/fighting.js"></script>
    <script src="./src/js/app.js"></script>
</body>

</html>
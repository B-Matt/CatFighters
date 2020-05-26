
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadatak 1</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
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
        <div id="firstSide" class="container d-flex flex-column  align-items-center side first-side col-5">
            <div class="row d-flex justify-content-end">
                <div class="col-auto">
                    <ul class="cat-info list-group">
                        <li class="list-group-item name">Cat Name</li>
                        <li class="list-group-item age">Cat age</li>
                        <li class="list-group-item skills">Cat Info</li>
                        <li class="list-group-item record">Wins:<span class="wins"></span> Loss: <span class="loss"></span></li>
                    </ul>
                </div>
                <div class="col-auto featured-cat-fighter">
                    <img class="featured-cat-fighter-image img-rounded" src="https://via.placeholder.com/300" alt="Featured cat fighter">
                </div>
                <div class="col-auto w-100" style="margin-top: 24px">
                    <div class="row fighter-list">
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box"
                            data-info = '{
                                "id": 1,
                                "name": "Cat McTerror" ,
                                "age" : 3,
                                "catInfo": "Very loud",
                                "record" : {
                                    "wins":  22,
                                    "loss": 4
                                }
                            }'>
                                <img src="./img/cat1.png" alt="Figter Box 1" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 2,
                                "name": "Caterson CatSpyder Silva" ,
                                "age" : 5,
                                "catInfo": "Slim, broke leg in past years",
                                "record" : {
                                    "wins":  34,
                                    "loss": 10
                                }
                            }'>
                                <img src="./img/cat02.png" alt="Figter Box 2" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 3,
                                "name": "Firko Cro Cat" ,
                                "age" : 5,
                                "catInfo": "Past his prime, doing seminars",
                                "record" : {
                                    "wins":  38,
                                    "loss": 11
                                }
                            }'>
                                <img src="./img/cat03.png" alt="Figter Box 3" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 4,
                                "name": "Catbib Furwmagomedov" ,
                                "age" : 2.5,
                                "catInfo": "Current champion, wrestle and catmbo is his style",
                                "record" : {
                                    "wins":  28,
                                    "loss": 0
                                }
                            }'>
                                <img src="./img/cat04.png" alt="Figter Box 4" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 5,
                                "name": "Kit Kitty Kones" ,
                                "age" : 3,
                                "catInfo": "Bad kitty, loves to use dog food better strength",
                                "record" : {
                                    "wins":  26,
                                    "loss": 1
                                }
                            }'>
                                <img src="./img/cat05.png" alt="Figter Box 5" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 6,
                                "name": "Coy BigCat Meowson" ,
                                "age" : 5,
                                "catInfo": "Big kitty, loves to fight",
                                "record" : {
                                    "wins":  23,
                                    "loss": 18
                                }
                            }'>
                                <img src="./img/cat06.png" alt="Figter Box 6" width="150" height="150">
                            </div>
                        </div>
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
                    <img class="featured-cat-fighter-image img-rounded" src="https://via.placeholder.com/300" alt="Featured cat fighter">
                </div>
                <div class="col-auto">
                    <ul class="cat-info list-group">
                        <li class="list-group-item name">Cat Name</li>
                        <li class="list-group-item age">Cat age</li>
                        <li class="list-group-item skills">Cat Info</li>
                        <li class="list-group-item record">Wins: <span class="wins"></span>Loss: <span class="loss"></span></li>
                    </ul>
                </div>
                <div class="col-auto w-100" style="margin-top: 24px">
                    <div class="row fighter-list">
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box"
                            data-info = '{
                                "id": 1,
                                "name": "Cat McTerror" ,
                                "age" : 3,
                                "catInfo": "Very loud",
                                "record" : {
                                    "wins":  22,
                                    "loss": 4
                                }
                            }'
                            >
                            <img src="./img/cat1.png" alt="Figter Box 1" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 2,
                                "name": "Caterson CatSpyder Silva" ,
                                "age" : 5,
                                "catInfo": "Slim, broke leg in past years",
                                "record" : {
                                    "wins":  34,
                                    "loss": 10
                                }
                            }'>
                                <img src="./img/cat02.png" alt="Figter Box 2" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 3,
                                "name": "Firko Cro Cat" ,
                                "age" : 5,
                                "catInfo": "Past his prime, doing seminars",
                                "record" : {
                                    "wins":  38,
                                    "loss": 11
                                }
                            }'>
                                <img src="./img/cat03.png" alt="Figter Box 3" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 4,
                                "name": "Catbib Furwmagomedov" ,
                                "age" : 2.5,
                                "catInfo": "Current champion, wrestle and catmbo",
                                "record" : {
                                    "wins":  28,
                                    "loss": 0
                                }
                            }'>
                                <img src="./img/cat04.png" alt="Figter Box 4" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 5,
                                "name": "Kit Kitty Kones" ,
                                "age" : 3,
                                "catInfo": "Bad kitty, loves to use dog food better strength",
                                "record" : {
                                    "wins":  26,
                                    "loss": 1
                                }
                            }'>
                                <img src="./img/cat05.png" alt="Figter Box 5" width="150" height="150">
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <div class="fighter-box" data-info='{
                                "id": 6,
                                "name": "Roy BigCat Meowson" ,
                                "age" : 5,
                                "catInfo": "Big kitty, loves to fight",
                                "record" : {
                                    "wins":  23,
                                    "loss": 18
                                }
                            }'>
                                <img src="./img/cat06.png" alt="Figter Box 6" width="150" height="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./src/app.js"></script>
</body>
</html>

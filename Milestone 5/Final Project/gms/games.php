<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Games tab</title>
    <link rel="stylesheet" type="text/css" href="gms/css/games_Styles.css">
    <link rel="stylesheet" type="text/css" href="gms/css/lightslider.css">
    <link rel="stylesheet" href="gms/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Days+One" />

    <script type="text/javascript"src="gms/js/JQuery.js"></script>
    <script type="text/javascript" src="gms/js/lightslider.js"></script>  

</head>
<body>
    <!--Navigation Bar-->
    <div class="holder">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!"><img src="img/New Project.png" alt="CC Pic" style="width:52px;height:52px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="forum/index.php">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="gms/games.php">Games</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Resources</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary">Log In/Log Out</button></ul>/li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Game Code-->
    <ul id="autoWidth" class="cs-hidden">
        <!--First Game-->
        <li class="item-a">
            <div class="box">
                <div class="image">
                    <img src="img/snake.jfif" alt="snake image">
                    <div class="play">
                        <!-- <div class="popup" id="popup-1"> -->
                            <!-- <div class="overlay"></div> -->
                            <!-- <div class="content"> -->
                                <!-- <div class="close-btn" onclick="togglePopup()">&times;</div> -->
                                <a href="snake/index.php" class="play-btn">Play</a>
                            <!-- </div> -->
                        <!-- </div> -->
                        <!-- <button onclick="togglePopup()">Play</button> -->
                    </div>
                </div>
                <div class="description">
                    <div class="type">
                        <a href="#">Snake Game</a>
                        <span>Easy</span>
                    </div>
                    <a href="#" class="level">LVL 5</a>        
                </div>
            </div>    
        </li>
        <!--Second Game-->
        <li class="item-b">
            <div class="box">
                <div class="image">
                    <img src="img/memory.jpg" alt="Memory image">
                    <div class="play">
                        <a href="memory/index.php" class="play-btn">Play</a>
                    </div>
                </div>
                <div class="description">
                    <div class="type">
                        <a href="#">Memory Game</a>
                        <span>Easy</span>
                    </div>
                    <a href="#" class="level">LVL 5</a>        
                </div>
            </div>    
        </li> 
        <!--Third Game-->   
        <li class="item-c">
            <div class="box">
                <div class="image">
                    <img src="img/trivia.jfif" alt="Trivia image">
                    <div class="play">
                        <a href="trivia/index.php" class="play-btn">Play</a>
                    </div>
                </div>
                <div class="description">
                    <div class="type">
                        <a href="#">Trivia Game</a>
                        <!--Copyright (c) 2021 by Matt Eaton (https://codepen.io/agnosticdev/pen/ZbWjaB)

                        Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files 
                        (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge,
                        publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
                        subject to the following conditions:

                        The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

                        THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
                        IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
                        OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

                        -->
                        <span>Easy</span>
                    </div>
                    <a href="#" class="level">LVL 5</a>        
                </div>
            </div>    
        </li>
        <!--Fourth Game-->
        <li class="item-d">
            <div class="box">
                <div class="image">
                    <img src="img/hangman.png" alt="Hangman image">
                    <div class="play">
                        <a href="hangman/index.php" class="play-btn">Play</a>
                    </div>
                </div>
                <div class="description">
                    <div class="type">
                        <a href="#">Hangman Game</a>
                        <span>Easy</span>
                    </div>
                    <a href="#" class="level">LVL 5</a>        
                </div>
            </div>    
        </li>       
        

    </ul>



<script type="text/javascript" src="gms/js/script.js"></script>
</body>


</html>
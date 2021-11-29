<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>CodePen - Web Trivia Game</title>
    <link href="//fonts.googleapis.com/css?family=Roboto+Mono:400,400italic,500,500italic,700,700italic|Roboto:400,400italic,500,500italic,700,700italic" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="styles.css" /><link rel="stylesheet" href="./style.css">

</head>
<body>

<!-- partial:index.partial.html -->
<div id="stage">
    <div id="container">
      <div id="gameContainer">
        <div id="gameHeader">
          <div class="left questions">
            <div class="container"><span></span></div>
          </div>
          <div class="left timer">
            <div class="container">TIME: <span></span></div>
          </div>
          <div class="left score">
            <div class="container">SCORE: <span></span></div>
          </div>
        </div>
        <div id="gameChoices">
          <div class="row">
            <div class="left half">
              <div class="container"><button id="buttonOne" data-index="0"></button></div>
            </div>
            <div class="left half">
              <div class="container"><button id="buttonTwo" data-index="1"></button></div>
            </div>
          </div>
          <div class="row">
            <div class="left half">
              <div class="container"><button id="buttonThree" data-index="2"></button></div>
            </div>
            <div class="left half">
              <div class="container"><button id="buttonFour" data-index="3"></button></div>
            </div>
          </div>
        </div>
        <h1 id="title">WEB TRIVIA GAME</h1>
      </div>
    <button id="startButton">START</button>
    <div class="play">
      <a href="../games.php" class="back-btn">Previous Page</a>
    </div>

  
  </div>
</div>
<div id="modal_window">
  <div class="modal_message">
    <p></p>
</div>


<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js'></script><script  src="./script.js"></script>



</body>
</html>

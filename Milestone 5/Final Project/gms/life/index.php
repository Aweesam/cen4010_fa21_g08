<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Game Of Life</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="game">
    
    <div class="control-panel">
      <div class="logo-container">
        <div class="logo"></div>
      </div>

      <a href="#" class="ctrl-button" id="ctrl_1">Start</a>
      <a href="#" class="ctrl-button" id="ctrl_2">Create world</a>
      <a href="#" class="ctrl-button" id="ctrl_3">Reset</a>
    </div>

    <canvas id="world">
      <!-- Hello World :) -->
    </canvas>

    <div class="info-panel">
      <span class="info_generation">Generation: </span>
      <span id="info_generation">0</span>

      <span class="separator">|</span>
      <span class="info_life-cell">Life cell: </span>
      <span id="info_life-cell">0</span>

      <span class="separator">|</span>
      <span class="info_speed">Speed: </span>
      <span id="info_speed">0</span>
      <span>ms</span>
      
    </div>
  </div>
  <div class="play">
    <a href="../games.php" class="back-btn">Previous Page</a>
  </div>

<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>

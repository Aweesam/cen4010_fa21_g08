<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - A simple Hangman-game</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<h1>Hangman<br>
  Your favorite classroom pastime returns!</h1>
<p id="ratefeld"></p>
<form name="rateformular">
<input name="ratezeichen" type="text" size="5" maxlength="1">
<input name="ratebutton" type="button" value="Guess" onClick="pruefeZeichen()">

<p id="gerateneBuchstaben">Wrong Letters:</p>
<img src="http://www.writteninpencil.de/Projekte/Hangman/hangman0.png" id="hangman"><br />
<input name="refresh" type="button" value="New Game" onClick="location.reload()">
</form><div class="play">
  <a href="../games.php" class="back-btn">Previous Page</a>
</div>

<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>

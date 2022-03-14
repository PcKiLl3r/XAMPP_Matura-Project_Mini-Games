<?php
include '../includes/sessSt_gameCount.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Menu</title>

    <?php 
    include './inc/incHead.php';
    ?>

    <link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>

<?php
include './inc/navbar.php';
?>

<!-- <p class="text-white">
    <?php
    echo "Games played:<br>TicTacToe: " . $_SESSION['gamesPlayedTicTacToe'] . " times<br>Memory game: " . $_SESSION['gamesPlayedMemoryGame'] . " times";
    ?>
</p> -->

<div class="MainMenu">
<div class="container">
        <div class="box box-1">
            <div onclick="location.href = '../TicTacToeV2/index.php';" class="cover"><img src="./TicTacToe.png" alt=""></div>
            <button onclick="location.href = '../TicTacToeV2/index.php';"><div></div></button>
        </div>
                <div class="box box-2">
            <div onclick="location.href = '../MemoryGame/index.php';" class="cover"><img src="./Memory.png" alt=""></div>
            <button onclick="location.href = '../MemoryGame/index.php';"><div></div></button>
        </div>
        <div class="box box-3">
            <div onclick="location.href = '../Chess/chess.php';" class="cover"><img src="./Chess.png" alt=""></div>
            <button onclick="location.href = '../Chess/index.php';"><div></div></button>
        </div>
        <div class="box box-4">
            <div onclick="location.href = '../MineSweeper/game.php';" class="cover"><img src="./MineSweeper.png" alt=""></div>
            <button onclick="location.href = '../MineSweeper/game.php';"><div></div></button>
        </div>
    </div>
    </div>

    <?php 
    include './inc/incBody.php';
    ?>
</body>
</html>
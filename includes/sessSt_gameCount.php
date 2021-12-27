<?php
session_start();
    if(!isset($_SESSION['gamesPlayedTicTacToe'])){
        $_SESSION['gamesPlayedTicTacToe'] = 0;
    }
    if(!isset($_SESSION['gamesPlayedMemoryGame'])){
        $_SESSION['gamesPlayedMemoryGame'] = 0;
    }
    if(!isset($_SESSION['gamesPlayedDiceHunter'])){
        $_SESSION['gamesPlayedDiceHunter'] = 0;
    }
?>
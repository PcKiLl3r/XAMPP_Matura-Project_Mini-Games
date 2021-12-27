<?php
session_start();
include_once '../../includes/dbInclude.php';
unset($_SESSION['user_name']);
unset($_SESSION['user_surname']);
unset($_SESSION['user_email']);
unset($_SESSION['user_isRole']);

$player_id = $_SESSION['user_id'];
$g_ticTacToe = $_SESSION['gamesPlayedTicTacToe'];
    $g_memoryGame = $_SESSION['gamesPlayedMemoryGame'];

$sqlCreatePlayedData = "UPDATE gamesplayed
set ticTacToe = '$g_ticTacToe', memoryGame = '$g_memoryGame'
where player_id = $player_id";

                    if ($conn->query($sqlCreatePlayedData) === TRUE) {
                        $msg = "Nov uporabnik je bil uspešno kreiran!";
                        $msgClass = 'alert-success';
                    } else {
                        $msg = 'Pri registraciji je prišlo do napake!';
                        $msgClass = 'alert-danger';
                    }

unset($_SESSION['user_id']);
unset($_SESSION['gamesPlayedTicTacToe']);
unset($_SESSION['gamesPlayedMemoryGame']);

header('Location: ../index.php');
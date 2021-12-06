<?php
session_start();

// Check if form was submitted
if(filter_has_var(INPUT_POST, 'process')) {


    // Start of Insert Tic/Tac
    if($_POST['process'] == "add_tic_tac") {

        if(isset($_POST['position']) && isset($_POST['tic_tac'])) {

            $position = trim(htmlspecialchars($_POST['position']));
            $tic_tac = trim(htmlspecialchars($_POST['tic_tac']));

            if(!empty($position) && !empty($tic_tac)) {

                if($position > 0 && $position < 10) {

                    if($tic_tac == "true") {

                        $_SESSION['tictacs'][$position] = true;

                    } else if($tic_tac == "false") {

                        $_SESSION['tictacs'][$position] = false;

                    } else {

                        $msg = "Error: Wrong symbol data!";
                    
                    }

                } else {

                    $msg = "Error: Wrong position data!";

                }

            } else {

                $msg = "Some data was empty!";

            }

        } else {

            $msg = "Some data was not sent!";

        }
    }
    // End of Insert Tic/Tac

    
    // Start of Reset
    if($_POST['process'] == "reset") {

        unset($_SESSION['tictacs']);

    }
    // End of Reset


}

$winnerMsg = null;

if(isset($_SESSION['tictacs'])){
    $isFull = true;
    for($i = 1; $i < 10; $i++) {
        if(!isset($_SESSION['tictacs'][$i])){
            $isFull = false;
        }
    }
    if($isFull == true) {
        $winnerMsg = "It's a tie no one wins!";
    }
}

if(!isset($msg)) { $msg = "No Error messages..."; }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body style="display: grid;">

    <div class="tic-tac-container">
        <div class="tic-tac-row">
            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][1])){
                    if($_SESSION['tictacs'][1] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][2] == true && $_SESSION['tictacs'][3] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][4] == true && $_SESSION['tictacs'][7] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][2] == false && $_SESSION['tictacs'][3] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][4] == false && $_SESSION['tictacs'][7] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe1" class="tic-tac-col">
                <?php
        if(isset($_SESSION['tictacs'][1])){
            if($_SESSION['tictacs'][1] == true){echo "X";}
            else {echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">


                        <div class="tic-tac-row d-flex flex-row">
                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="1">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="1">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][2])){
                    if($_SESSION['tictacs'][2] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][3] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][5] == true && $_SESSION['tictacs'][8] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][3] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][8] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe2" class="tic-tac-col tic-tac-black">
                <?php
        if(isset($_SESSION['tictacs'][2])){
            if($_SESSION['tictacs'][2] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="background: black; width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">
                        <div class="tic-tac-row d-flex flex-row">

                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="2">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="2">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][3])){
                    if($_SESSION['tictacs'][3] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][2])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][2] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][6]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][6] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][2])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][2] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][6]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][6] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe3" class="tic-tac-col">
                <?php
        if(isset($_SESSION['tictacs'][3])){
            if($_SESSION['tictacs'][3] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">


                        <div class="tic-tac-row d-flex flex-row">
                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="3">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="3">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tic-tac-row">
            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][4])){
                    if($_SESSION['tictacs'][4] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][7])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][7] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][5] == true && $_SESSION['tictacs'][6] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][7])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][7] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][6] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe4" class="tic-tac-col tic-tac-black">
                <?php
        if(isset($_SESSION['tictacs'][4])){
            if($_SESSION['tictacs'][4] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="background: black; width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">

                        <div class="tic-tac-row d-flex flex-row">

                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="4">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="4">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][5])){
                    if($_SESSION['tictacs'][5] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][8])){
                            if($_SESSION['tictacs'][2] == true && $_SESSION['tictacs'][8] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][4] == true && $_SESSION['tictacs'][6] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][8])){
                            if($_SESSION['tictacs'][2] == false && $_SESSION['tictacs'][8] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][4] == false && $_SESSION['tictacs'][6] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe5" class="tic-tac-col">
                <?php
        if(isset($_SESSION['tictacs'][5])){
            if($_SESSION['tictacs'][5] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">


                        <div class="tic-tac-row d-flex flex-row">
                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="5">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="5">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][6])){
                    if($_SESSION['tictacs'][6] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][9])){
                            if($_SESSION['tictacs'][3] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][5])) {
                            if($_SESSION['tictacs'][4] == true && $_SESSION['tictacs'][5] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][9])){
                            if($_SESSION['tictacs'][3] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][5])) {
                            if($_SESSION['tictacs'][4] == false && $_SESSION['tictacs'][5] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe6" class="tic-tac-col tic-tac-black">
                <?php
        if(isset($_SESSION['tictacs'][6])){
            if($_SESSION['tictacs'][6] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="background: black; width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">

                        <div class="tic-tac-row d-flex flex-row">

                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="6">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="6">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tic-tac-row">
            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][7])){
                    if($_SESSION['tictacs'][7] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][4])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][4] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][8]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][8] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][4])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][4] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][8]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][8] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe7" class="tic-tac-col">
                <?php
        if(isset($_SESSION['tictacs'][7])){
            if($_SESSION['tictacs'][7] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">


                        <div class="tic-tac-row d-flex flex-row">
                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="7">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="7">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][8])){
                    if($_SESSION['tictacs'][8] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][5])){
                            if($_SESSION['tictacs'][2] == true && $_SESSION['tictacs'][5] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][7] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][5])){
                            if($_SESSION['tictacs'][2] == false && $_SESSION['tictacs'][5] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][7] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe8" class="tic-tac-col tic-tac-black">
                <?php
        if(isset($_SESSION['tictacs'][8])){
            if($_SESSION['tictacs'][8] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="background: black; width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">

                        <div class="tic-tac-row d-flex flex-row">

                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="8">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col tic-tac-black">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="8">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <div style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][9])){
                    if($_SESSION['tictacs'][9] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][6])){
                            if($_SESSION['tictacs'][3] == true && $_SESSION['tictacs'][6] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        } else if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][7] == true && $_SESSION['tictacs'][8] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][6])){
                            if($_SESSION['tictacs'][3] == false && $_SESSION['tictacs'][6] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }else if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][7] == false && $_SESSION['tictacs'][8] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe9" class="tic-tac-col">
                <?php
        if(isset($_SESSION['tictacs'][9])){
            if($_SESSION['tictacs'][9] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
            </div>

            <div class="modal fade" id="addTicToe9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div style="width: fit-content; height: fit-content; margin: auto; margin-top: 40vh;"
                        class="modal-content p-1">


                        <div class="tic-tac-row d-flex flex-row">
                            <form class="d-flex flex-row" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    X
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="9">
                                <input type="hidden" name="tic_tac" value="true">

                            </form>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <button type="submit" class="tic-tac-col">
                                    O
                                </button>

                                <input type="hidden" name="process" value="add_tic_tac">
                                <input type="hidden" name="position" value="9">
                                <input type="hidden" name="tic_tac" value="false">

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-2">
        <?php echo $msg; ?>
    </div>

    <div class="container text-center mt-2">
        <?php echo $winnerMsg; ?>
    </div>

    <?php
    if($winnerMsg != null) {
?>
        <div class="container text-center mt-3">
        <form style="justify-content: center;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    
    <button type="submit" class="tic-tac-col">
    <i class="fas fa-biohazard"></i>
    </button>
    
    <input type="hidden" name="process" value="reset">
    
    </form>
        </div>
<?php
    }
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
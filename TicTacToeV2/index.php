<?php
session_start();

if(!isset($_SESSION['lastSign'])){
    $_SESSION['lastSign'] = "false";
}



// Check if form was submitted
if(filter_has_var(INPUT_POST, 'process')) {


    // Start of Insert Tic/Tac
    if($_POST['process'] == "add_tic_tac") {

        if(isset($_POST['position']) && isset($_SESSION['lastSign'])) {

            if(isset($_SESSION['isOver'])){
                if($_SESSION['isOver'] == true) {
                    header('Location: ./index.php');
                    exit;
                }
            }

            $position = trim(htmlspecialchars($_POST['position']));
            $lastSign = trim(htmlspecialchars($_SESSION['lastSign']));

            if(isset($_SESSION['tictacs'][$position])){
                header('Location: ./index.php');
                exit;
            }

            if(!empty($position) && !empty($lastSign)) {

                if($position > 0 && $position <= 9) {

                    if($lastSign == "false") {

                        $_SESSION['tictacs'][$position] = true;
                        $_SESSION['lastSign'] = "true";

                        header('Location: ./index.php');

                    } else if($lastSign == "true") {

                        $_SESSION['tictacs'][$position] = false;
                        $_SESSION['lastSign'] = "false";

                        header('Location: ./index.php');

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

            $msg = "Some data was not sent/set in session!";

        }
    }
    // End of Insert Tic/Tac

    
    // Start of Reset
    if($_POST['process'] == "reset") {

        unset($_SESSION['tictacs']);
        unset($_SESSION['lastSign']);
        $_SESSION['lastSign'] = "false";
        unset($_SESSION['isOver']);

    }
    // End of Reset


}

$winnerMsg = null;

if(isset($_SESSION['tictacs'])){
    $isFull = true;
    for($i = 1; $i <= 9; $i++) {
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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body style="display: grid;">

    <div class="tic-tac-container-out mt-5">
        <div class="tic-tac-container">
            <div class="tic-tac-row">

                <div class="tic-button tic-button-hoverable-lt">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php 
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][1])){
                    if($_SESSION['tictacs'][1] == "true") {
                        //Check for true

                        //Check vertical
                        if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][2] == true && $_SESSION['tictacs'][3] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }

                        //Check horizontal
                        } if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][4] == true && $_SESSION['tictacs'][7] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }

                        //Check digonal
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][5] == "true" && $_SESSION['tictacs'][9] == "true") {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false

                         //Check vertical
                         if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][2] == false && $_SESSION['tictacs'][3] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }

                        //Check for horizontal
                        } if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][4] == false && $_SESSION['tictacs'][7] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }

                        //Check for diagonal
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    }
                }
            } ?>" class="tic-tac-col   tic-tac-white">
                                <?php
        if(isset($_SESSION['tictacs'][1])){
            if($_SESSION['tictacs'][1] == true){echo "X";}
            else {echo "O";}
        }else{echo "&nbsp;";}
            ?>
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="1">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>

                <div class="tic-button tic-button-hoverable-t">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][2])){
                    if($_SESSION['tictacs'][2] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][3] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][5] == true && $_SESSION['tictacs'][8] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } 
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][3])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][3] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][8] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
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
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="2">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>

                <div class="tic-button tic-button-hoverable-rt">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][3])){
                    if($_SESSION['tictacs'][3] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][2])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][2] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][6]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][6] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][5] == true && $_SESSION['tictacs'][7] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][2])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][2] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][6]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][6] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][7] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe3" class="tic-tac-col  tic-tac-white">
                                <?php
        if(isset($_SESSION['tictacs'][3])){
            if($_SESSION['tictacs'][3] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="3">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>



            </div>
            <div class="tic-tac-row">

                <div class="tic-button tic-button-hoverable-l">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][4])){
                    if($_SESSION['tictacs'][4] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][7])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][7] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][5] == true && $_SESSION['tictacs'][6] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][7])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][7] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][6] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
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
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="4">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>

                <div class="tic-button tic-button-hoverable-m">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][5])){
                    if($_SESSION['tictacs'][5] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][8])){
                            if($_SESSION['tictacs'][2] == true && $_SESSION['tictacs'][8] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][4] == true && $_SESSION['tictacs'][6] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][3] == true && $_SESSION['tictacs'][7] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][8])){
                            if($_SESSION['tictacs'][2] == false && $_SESSION['tictacs'][8] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][6])) {
                            if($_SESSION['tictacs'][4] == false && $_SESSION['tictacs'][6] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][7])) {
                            if($_SESSION['tictacs'][3] == false && $_SESSION['tictacs'][7] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe5" class="tic-tac-col   tic-tac-white">
                                <?php
        if(isset($_SESSION['tictacs'][5])){
            if($_SESSION['tictacs'][5] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="5">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>

                <div class="tic-button tic-button-hoverable-r">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][6])){
                    if($_SESSION['tictacs'][6] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][9])){
                            if($_SESSION['tictacs'][3] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][5])) {
                            if($_SESSION['tictacs'][4] == true && $_SESSION['tictacs'][5] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][9])){
                            if($_SESSION['tictacs'][3] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][4]) && isset($_SESSION['tictacs'][5])) {
                            if($_SESSION['tictacs'][4] == false && $_SESSION['tictacs'][5] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
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
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="6">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>



            </div>
            <div class="tic-tac-row">

                <div class="tic-button tic-button-hoverable-lb">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][7])){
                    if($_SESSION['tictacs'][7] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][4])){
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][4] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][8]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][8] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][3])) {
                            if($_SESSION['tictacs'][5] == true && $_SESSION['tictacs'][3] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][4])){
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][4] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][8]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][8] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][5]) && isset($_SESSION['tictacs'][3])) {
                            if($_SESSION['tictacs'][5] == false && $_SESSION['tictacs'][3] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe7" class="tic-tac-col   tic-tac-white">
                                <?php
        if(isset($_SESSION['tictacs'][7])){
            if($_SESSION['tictacs'][7] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="7">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>

                <div class="tic-button tic-button-hoverable-b">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][8])){
                    if($_SESSION['tictacs'][8] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][5])){
                            if($_SESSION['tictacs'][2] == true && $_SESSION['tictacs'][5] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][7] == true && $_SESSION['tictacs'][9] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][2]) && isset($_SESSION['tictacs'][5])){
                            if($_SESSION['tictacs'][2] == false && $_SESSION['tictacs'][5] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][9])) {
                            if($_SESSION['tictacs'][7] == false && $_SESSION['tictacs'][9] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
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
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="8">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>

                <div class="tic-button tic-button-hoverable-rb">
                    <div class="tic-button-front">
                        <form style="display: inline-block;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <button type="submit" style="<?php
            if(isset($_SESSION['tictacs'])) {
                if(isset($_SESSION['tictacs'][9])){
                    if($_SESSION['tictacs'][9] == true) {
                        //Check for true
                        if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][6])){
                            if($_SESSION['tictacs'][3] == true && $_SESSION['tictacs'][6] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][7] == true && $_SESSION['tictacs'][8] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][5])) {
                            if($_SESSION['tictacs'][1] == true && $_SESSION['tictacs'][5] == true) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "X Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    } else {
                         //Check for false
                         if(isset($_SESSION['tictacs'][3]) && isset($_SESSION['tictacs'][6])){
                            if($_SESSION['tictacs'][3] == false && $_SESSION['tictacs'][6] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][7]) && isset($_SESSION['tictacs'][8])) {
                            if($_SESSION['tictacs'][7] == false && $_SESSION['tictacs'][8] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        } if(isset($_SESSION['tictacs'][1]) && isset($_SESSION['tictacs'][5])) {
                            if($_SESSION['tictacs'][1] == false && $_SESSION['tictacs'][5] == false) {
                                echo "text-decoration: line-through;";
                                $winnerMsg = "O Is The Winner!!!";
                                $_SESSION['isOver'] = true;
                            }
                        }
                    }
                }
            } ?>" type="button" data-bs-toggle="modal" data-bs-target="#addTicToe9" class="tic-tac-col   tic-tac-white">
                                <?php
        if(isset($_SESSION['tictacs'][9])){
            if($_SESSION['tictacs'][9] == true){echo "X";}
            else{echo "O";}
        }else{echo "&nbsp;";}
            ?>
                            </button>

                            <input type="hidden" name="process" value="add_tic_tac">
                            <input type="hidden" name="position" value="9">

                        </form>
                    </div>
                    <div class="tic-button-left">
                    </div>
                    <div class="tic-button-bot">
                    </div>
                    <div class="tic-button-right">
                    </div>
                    <div class="tic-button-back">
                    </div>
                    <div class="tic-button-top">
                    </div>
                </div>



            </div>
        </div>

    </div>

    <!-- <div class="container text-center mt-2">
        <?php echo $msg; ?>
    </div> -->

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
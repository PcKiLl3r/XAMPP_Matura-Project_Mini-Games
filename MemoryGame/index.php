<?php
include '../includes/sessSt_gameCount.php';

$_SESSION['Icons'] = [
    '<i class="fas fa-ambulance"></i>',
    '<i class="fas fa-ankh"></i>',
    '<i class="fab fa-apple"></i>',
    '<i class="fas fa-award"></i>',
    '<i class="fas fa-bell"></i>',
    '<i class="fas fa-bolt"></i>',

    '<i class="fas fa-bomb"></i>',
    '<i class="fas fa-cogs"></i>',
    '<i class="fas fa-laptop-code"></i>',
    '<i class="fas fa-car"></i>',
    '<i class="fas fa-campground"></i>',
    '<i class="fab fa-canadian-maple-leaf"></i>',

    '<i class="fas fa-dragon"></i>',
    '<i class="fas fa-cookie-bite"></i>',
    '<i class="fas fa-crow"></i>',
    '<i class="fas fa-dice"></i>',
    '<i class="fas fa-chess"></i>',
    '<i class="fas fa-gem"></i>'
];

if (isset($_SESSION['gameMode'])) {
} else {
    $_SESSION['gameMode'] = 0;
}

function GetUniqueRandomIcon($_usedIcons)
{
    $_icon = rand(0, 17);

    for ($i = 0; $i < count($_usedIcons); $i++) {
        if ($_usedIcons[$i] == $_icon) {
            $_icon = GetUniqueRandomIcon($_usedIcons);
            break;
        }
    }

    return ($_icon);
}

function Start($_cardCount = 6)
{
    if (isset($_SESSION['hasStarted'])) {
        unset($_SESSION['board']);
        unset($_SESSION['boardNums']);
        unset($_SESSION['hasStarted']);
        unset($_SESSION['won-cards']);
        unset($_SESSION['first-pick']);
        unset($_SESSION['pick1']);
        unset($_SESSION['pick2']);
    }
    $_icons = [];
    $_usedIcons = [];

    for ($i = 0; $i < $_cardCount; $i++) {
        $_icon = GetUniqueRandomIcon($_usedIcons);

        $_usedIcons[] = $_icon;
        $_icons[] = $_icon;
    }
    for ($i = 0; $i < $_cardCount; $i++) {
        $_icons[] = $_icons[$i];
    }
    shuffle($_icons);

    for ($i = 0; $i < count($_icons); $i++) {

        $_SESSION['board'][$i] = $_SESSION['Icons'][$_icons[$i]];

        $_SESSION['boardNums'][$i] = $_icons[$i];
    }

    $_SESSION['hasStarted'] = true;
    $_SESSION['gameMode'] = $_cardCount;
}

// Check if form was submitted
if (filter_has_var(INPUT_POST, 'process')) {

    // Start of Choose GameMode
    if ($_POST['process'] == "gameMode") {

        if (isset($_POST['cardNumber'])) {

            $cardNumber = trim(htmlspecialchars($_POST['cardNumber']));

            if (!empty($cardNumber)) {

                if ($cardNumber == 6) {

                    Start(6);
                } else if ($cardNumber == 12) {

                    Start(12);
                } else if ($cardNumber == 18) {

                    Start(18);
                } else {

                    $msg = "Error: Wrong GameMode data!";
                }
            } else {

                $msg = "Some data was empty!";
            }
        } else {

            $msg = "Some data was not sent/set in session!";
        }
    }
    // End of Choose GameMode

    // Start of PickCard
    if ($_POST['process'] == "pickCard") {

        if (isset($_POST['cardNumber'])) {

            $cardNumber = trim(htmlspecialchars($_POST['cardNumber']));

            if (!empty($cardNumber) || $cardNumber == 0) {

                if (isset($_SESSION['first-pick'])) {
                    if ($_SESSION['first-pick'] == "true") {

                        $_SESSION['pick1'] = $cardNumber;

                        if (isset($_SESSION['won-cards'])) {
                            if (is_array($_SESSION['won-cards'])) {
                                for ($i = 0; $i < count($_SESSION['won-cards']); $i++) {
                                    if ($_SESSION['won-cards'][$i] == $_SESSION['boardNums'][$_SESSION['pick1']]) {
                                        $_SESSION['pick1'] = null;
                                        $_SESSION['pick2'] = null;
                                        header('Location: ./index.php');
                                        exit;
                                    }
                                }
                            } else {
                                $_SESSION['won-cards'] = array();
                            }
                        } else {
                            $_SESSION['won-cards'] = array();
                        }

                        $_SESSION['first-pick'] = "false";
                    } else {

                        $_SESSION['pick2'] = $cardNumber;

                        if ($_SESSION['pick1'] == $_SESSION['pick2']) {
                            header('Location: ./index.php');
                            $_SESSION['pick2'] = null;
                            exit;
                        }

                        $pick1 = $_SESSION['pick1'];
                        $pick2 = $_SESSION['pick2'];

                        if ($_SESSION['boardNums'][$pick1] == $_SESSION['boardNums'][$pick2]) {
                            if (isset($_SESSION['won-cards'])) {
                                if (!is_array($_SESSION['won-cards'])) {
                                    $_SESSION['won-cards'] = array();
                                } else {
                                }
                            } else {
                                $_SESSION['won-cards'] = array();
                            }



                            array_push($_SESSION['won-cards'], $_SESSION['boardNums'][$pick1]);
                            $_SESSION['pick1'] = null;
                            $_SESSION['pick2'] = null;
                            if (count($_SESSION['won-cards']) == $_SESSION['gameMode']) {
                                $_SESSION['gamesPlayedMemoryGame']++;
                            }
                        } else {
                            $_SESSION['pick1'] = null;
                            $_SESSION['pick2'] = null;
                        }

                        $_SESSION['first-pick'] = "true";
                    }
                } else {
                    $_SESSION['pick1'] = $cardNumber;

                    if (isset($_SESSION['won-cards'])) {
                        if (is_array($_SESSION['won-cards'])) {
                            for ($i = 0; $i < count($_SESSION['won-cards']); $i++) {
                                if ($_SESSION['won-cards'][$i] == $_SESSION['boardNums'][$_SESSION['pick1']]) {
                                    $_SESSION['pick1'] = null;
                                    $_SESSION['pick2'] = null;
                                    header('Location: ./index.php');
                                    exit;
                                }
                            }
                        } else {
                            $_SESSION['won-cards'] = array();
                        }
                    } else {
                        $_SESSION['won-cards'] = array();
                    }

                    $_SESSION['first-pick'] = "false";
                }
            } else {

                $msg = "Some data was empty!";
            }
        } else {

            $msg = "Some data was not sent/set in session!";
        }
    }
    // End of PickCard

    // Start of Reset
    if ($_POST['process'] == "reset") {
        unset($_SESSION['board']);
        unset($_SESSION['boardNums']);
        unset($_SESSION['hasStarted']);
        unset($_SESSION['won-cards']);
        unset($_SESSION['first-pick']);
        unset($_SESSION['pick1']);
        unset($_SESSION['pick2']);
    }
    // End of Reset

}

$winnerMsg = null;

if (!isset($msg)) {
    $msg = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <button onclick="location.href = '../MainMenu/index.php';" class="back-btn">
        <div class="dices">

            <div class="dice dice1 dice-hoverable">
                <div class="dice-front">
                </div>
                <div class="dice-left">
                </div>
                <div class="dice-bot">
                    3
                </div>
                <div class="dice-right">
                    5
                </div>
                <div class="dice-back">
                    6
                </div>
                <div class="dice-top">
                    4
                </div>
            </div>

            <div class="dice dice2 dice-hoverable">
                <div class="dice-front">
                    1
                </div>
                <div class="dice-left">
                    2
                </div>
                <div class="dice-bot">
                    3
                </div>
                <div class="dice-right">
                    5
                </div>
                <div class="dice-back">
                    6
                </div>
                <div class="dice-top">
                    4
                </div>
            </div>

            <div class="dice dice3 dice-hoverable">
                <div class="dice-front">
                    1
                </div>
                <div class="dice-left">
                    2
                </div>
                <div class="dice-bot">
                    3
                </div>
                <div class="dice-right">
                    5
                </div>
                <div class="dice-back">
                    6
                </div>
                <div class="dice-top">
                    4
                </div>
            </div>

        </div>
    </button>

    <div style="margin-top: 10em !important;" class="scene text-center mt-5 mb-5">

        <?php
        /* if (isset($_SESSION['hasStarted'])) {
            if ($_SESSION['hasStarted'] == false) { */
                echo '<button class="button btn btn-purple" data-bs-toggle="modal" data-bs-target="#gameMode">New Game</button>

        <div class="modal fade" id="gameMode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div style="width: max-content; height: fit-content; margin: auto;"
                    class="modal-content p-1">
    
    
    
                    <div class="memory-cards">
    
                        <div class="memory-card d-menu memory-card-menu-hover">
    
                            <form class="memory-card-front d-side-menu" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    6
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="6">
    
                            </form>
    
                            <div class="memory-card-left d-side-menu">
                            </div>
                            <div class="memory-card-bot d-side-menu">
                            </div>
                            <div class="memory-card-right d-side-menu">
                            </div>
                            <div class="memory-card-back d-side-menu">
                                <i class="fab fa-apple"></i>
                            </div>
                            <div class="memory-card-top d-side-menu">
                            </div>
                        </div>
    
                        <div class="memory-card d-menu memory-card-menu-hover">
                            <form class="memory-card-front d-side-menu" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    12
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="12">
    
                            </form>
                            <div class="memory-card-left d-side-menu">
                            </div>
                            <div class="memory-card-bot d-side-menu">
                            </div>
                            <div class="memory-card-right d-side-menu">
                            </div>
                            <div class="memory-card-back d-side-menu">
                            </div>
                            <div class="memory-card-top d-side-menu">
                            </div>
                        </div>
    
                        <div class="memory-card d-menu memory-card-menu-hover">
                            <form class="memory-card-front d-side-menu" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    18
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="18">
    
                            </form>
                            <div class="memory-card-left d-side-menu">
                            </div>
                            <div class="memory-card-bot d-side-menu">
                            </div>
                            <div class="memory-card-right d-side-menu">
                            </div>
                            <div class="memory-card-back d-side-menu">
                                <i class="fab fa-apple"></i>
                            </div>
                            <div class="memory-card-top d-side-menu">
                            </div>
                        </div>
    
                    </div>
    
                </div>
            </div>
        </div>';
            /* }
        } else {
            echo '<button class="button btn btn-purple" data-bs-toggle="modal" data-bs-target="#gameMode">New Game</button>

        <div class="modal fade" id="gameMode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div style="width: max-content; height: fit-content; margin: auto;"
                    class="modal-content p-1">
    
    
    
                    <div class="memory-cards">
    
                        <div class="memory-card d-menu memory-card-menu-hover">
    
                            <form class="memory-card-front d-side-menu" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    6
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="6">
    
                            </form>
    
                            <div class="memory-card-left d-side-menu">
                            </div>
                            <div class="memory-card-bot d-side-menu">
                            </div>
                            <div class="memory-card-right d-side-menu">
                            </div>
                            <div class="memory-card-back d-side-menu">
                                <i class="fab fa-apple"></i>
                            </div>
                            <div class="memory-card-top d-side-menu">
                            </div>
                        </div>
    
                        <div class="memory-card d-menu memory-card-menu-hover">
                            <form class="memory-card-front d-side-menu" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    12
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="12">
    
                            </form>
                            <div class="memory-card-left d-side-menu">
                            </div>
                            <div class="memory-card-bot d-side-menu">
                            </div>
                            <div class="memory-card-right d-side-menu">
                            </div>
                            <div class="memory-card-back d-side-menu">
                            </div>
                            <div class="memory-card-top d-side-menu">
                            </div>
                        </div>
    
                        <div class="memory-card d-menu memory-card-menu-hover">
                            <form class="memory-card-front d-side-menu" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    18
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="18">
    
                            </form>
                            <div class="memory-card-left d-side-menu">
                            </div>
                            <div class="memory-card-bot d-side-menu">
                            </div>
                            <div class="memory-card-right d-side-menu">
                            </div>
                            <div class="memory-card-back d-side-menu">
                                <i class="fab fa-apple"></i>
                            </div>
                            <div class="memory-card-top d-side-menu">
                            </div>
                        </div>
    
                    </div>
    
                </div>
            </div>
        </div>';
        } */
        ?>



        <div class="memory-cards-main">

            <?php

            if (isset($_SESSION['board'])) {
                if (!empty($_SESSION['board'])) {
                    for ($i = 0; $i < count($_SESSION['board']); $i++) {

                        $class = '';

                        if (isset($_SESSION['won-cards'])) {
                            if (is_array($_SESSION['won-cards'])) {
                                for ($j = 0; $j < count($_SESSION['won-cards']); $j++) {
                                    if ($_SESSION['won-cards'][$j] == $_SESSION['boardNums'][$i]) {
                                        $class = 'won-card';
                                        break;
                                    } else {
                                        $class = 'memory-card-hoverable';
                                    }
                                }
                            } else {
                                $class = 'memory-card-hoverable';
                            }
                        } else {
                            $class = 'memory-card-hoverable';
                        }

                        if (isset($_SESSION['pick1'])) {
                            if ($_SESSION['pick1'] == $i) {
                                $class = 'revealed-card';
                            } else {
                                if ($class == 'won-card') {
                                } else {
                                    $class = 'memory-card-hoverable';
                                }
                            }
                        } else {
                            if ($class == 'won-card') {
                            } else {
                                $class = 'memory-card-hoverable';
                            }
                        }

                        if ($i == 0 || $i == 4 || $i == 8 || $i == 12 || $i == 16 || $i == 20 || $i == 24 || $i == 28 || $i == 32) {
                            echo '<div class="row">';
                        }

                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" id="mc-' . $i . '" class="memory-card d-lvl1 ' . $class . '">
            <input type="hidden" name="process" value="pickCard">
            <input type="hidden" name="cardNumber" value="' . $i . '">
    <button type="button" class="memory-card-front">
    ' . '?' .
                            '</button>
    <div class="memory-card-left">
    </div>
    <div class="memory-card-bot">
    </div>
    <div class="memory-card-right">
    </div>
    <div class="memory-card-back iconCard">' . $_SESSION['board'][$i] .
                            '</div>
    <div class="memory-card-top">
    </div>
</form>
            ';

                        if ($i == 3 || $i == 7 || $i == 11 || $i == 15 || $i == 19 || $i == 23 || $i == 27 || $i == 31 || $i == 35) {
                            echo '</div>';
                        }
                    }
                }
            }

            ?>

            <!-- <div class="memory-card memory-card-hoverable">
    <div class="memory-card-front">
        ?
    </div>
    <div class="memory-card-left">
    </div>
    <div class="memory-card-bot">
    </div>
    <div class="memory-card-right">
    </div>
    <div class="memory-card-back">
    <i class="fab fa-apple"></i>
    </div>
    <div class="memory-card-top">
    </div>
</div>

<div class="memory-card memory-card-hoverable">
    <div class="memory-card-front">
        ?
    </div>
    <div class="memory-card-left">
    </div>
    <div class="memory-card-bot">
    </div>
    <div class="memory-card-right">
    </div>
    <div class="memory-card-back">
    </div>
    <div class="memory-card-top">
    </div>
</div>

<div class="memory-card memory-card-hoverable">
    <div class="memory-card-front">
        ?
    </div>
    <div class="memory-card-left">
    </div>
    <div class="memory-card-bot">
    </div>
    <div class="memory-card-right">
    </div>
    <div class="memory-card-back">
    <i class="fab fa-apple"></i>
    </div>
    <div class="memory-card-top">
    </div>
</div>

<div class="memory-card memory-card-hoverable">
    <div class="memory-card-front">
        ?
    </div>
    <div class="memory-card-left">
    </div>
    <div class="memory-card-bot">
    </div>
    <div class="memory-card-right">
    </div>
    <div class="memory-card-back">
    </div>
    <div class="memory-card-top">
    </div>
</div> -->

        </div>
        <div class="container text-center mt-5 mb-5">
            <p id="outputMsg"> <?php

                                if (isset($_SESSION['won-cards']) && count($_SESSION['won-cards']) == $_SESSION['gameMode']) {
                                    $msg = "You have Won!";
                                }

                                echo $msg;
                                ?></p>


            <?php
            /* if(isset($_SESSION['board'])) {
            print_r($_SESSION['board']);
        } */
            ?>
            <form id="resetForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <button id="resetBtn" style="visibility: hidden;" type="submit" class="button btn btn-purple">
                    New Game
                </button>

                <input type="hidden" name="process" value="reset">

            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="./memoryHandler.js"></script>

    <script>
        let msgP = document.querySelector('#outputMsg');
        console.log(msgP.textContent);
        if (msgP.textContent.trim() == "You have Won!") {
            let resetBtn = document.querySelector('#resetBtn');
            resetBtn.style.visibility = "visible";
        }
    </script>

</body>

</html>
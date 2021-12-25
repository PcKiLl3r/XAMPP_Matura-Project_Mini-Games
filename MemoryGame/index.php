<?php
session_start();

/* $lvl1Icons = array('<i class="fas fa-ambulance"></i>',
'<i class="fas fa-ankh"></i>',
'<i class="fab fa-apple"></i>',
'<i class="fas fa-award"></i>',
'<i class="fas fa-bell"></i>',
'<i class="fas fa-bolt"></i>'); */



$_SESSION['lvl1Icons'][0] = '<i class="fas fa-ambulance"></i>';
$_SESSION['lvl1Icons'][1] = '<i class="fas fa-ankh"></i>';
$_SESSION['lvl1Icons'][2] = '<i class="fab fa-apple"></i>';
$_SESSION['lvl1Icons'][3] = '<i class="fas fa-award"></i>';
$_SESSION['lvl1Icons'][4] = '<i class="fas fa-bell"></i>';
$_SESSION['lvl1Icons'][5] = '<i class="fas fa-bolt"></i>';

$_SESSION['lvl1IconNum'][0] = 0;
$_SESSION['lvl1IconNum'][1] = 1;
$_SESSION['lvl1IconNum'][2] = 2;
$_SESSION['lvl1IconNum'][3] = 3;
$_SESSION['lvl1IconNum'][4] = 4;
$_SESSION['lvl1IconNum'][5] = 5;

/* $lvl1Icons[0] = '<i class="fas fa-ambulance"></i>';
$lvl1Icons[1] = '<i class="fas fa-ankh"></i>';
$lvl1Icons[2] = '<i class="fab fa-apple"></i>';
$lvl1Icons[3] = '<i class="fas fa-award"></i>';
$lvl1Icons[4] = '<i class="fas fa-bell"></i>';
$lvl1Icons[5] = '<i class="fas fa-bolt"></i>'; */

if(isset($_SESSION['gameMode'])){

} else {
    $_SESSION['gameMode'] = 0;
}

function Start6 () {
    $isChecked = false;
    $badNumber = true;
    $min = 0;
    $max = 5;
    $randomNums = array();

    for($i = 0; $i < 6; $i++){
    
        $randomN = rand($min, $max);
        while($isChecked == false){
            if(count($randomNums) != 0){
                while($badNumber == true) {
                    $randomN = rand($min, $max);
                    for($x = 0; $x < count($randomNums); $x++){
                        if($randomNums[$x] == $randomN){
                            $badNumber = true;
                            break;
                        } else if($x == count($randomNums) - 1) {
                            $badNumber = false;
                        }
                    }
                }
                $isChecked = true;
            } else {
                $isChecked = true;
            }
        }

        $randomNums[$i] = $randomN;
        $_SESSION['board'][$i] = $_SESSION['lvl1Icons'][$randomN];
        $_SESSION['boardNums'][$i] = $_SESSION['lvl1IconNum'][$randomN];
        $isChecked = false;
        $badNumber = true;
    }

    $isChecked = false;
    $badNumber = true;
    $randomNums2 = array();

for($i = 0; $i < 6; $i++){
    
        $randomN = rand($min, $max);
        while($isChecked == false){
            if(count($randomNums2) != 0){
                while($badNumber == true) {
                    $randomN = rand($min, $max);
                    for($x = 0; $x < count($randomNums2); $x++){
                        if($randomNums2[$x] == $randomN){
                            $badNumber = true;
                            break;
                        } else if($x == count($randomNums2) - 1) {
                            $badNumber = false;
                        }
                    }
                }
                $isChecked = true;
            } else {
                $isChecked = true;
            }
        }

        $randomNums2[$i] = $randomN;
        $_SESSION['board'][$i + 6] = $_SESSION['lvl1Icons'][$randomN];
        $_SESSION['boardNums'][$i + 6] = $_SESSION['lvl1IconNum'][$randomN];
        $isChecked = false;
        $badNumber = true;
    }
    $_SESSION['hasStarted'] = true;
    $_SESSION['gameMode'] = 6;
}

/* $lvl1Icons = Array (
    "0" => Array (
        "id" => "MMZ301",
        "name" => "Michael Bruce",
        "designation" => "System Architect"
    ),
    "1" => Array (
        "id" => "MMZ385",
        "name" => "Jennifer Winters",
        "designation" => "Senior Programmer"
    ),
    "2" => Array (
        "id" => "MMZ593",
        "name" => "Donna Fox",
        "designation" => "Office Manager"
    )
); */

/* $lvl2Icons = array(
    'ambulance' => '<i class="fas fa-ambulance"></i>',
    'ankh' => '<i class="fas fa-ankh"></i>',
    'apple' => '<i class="fab fa-apple"></i>',
    'award' => '<i class="fas fa-award"></i>',
    'bell' => '<i class="fas fa-bell"></i>',
    'bolt' => '<i class="fas fa-bolt"></i>',
);

$lvl3Icons = array(
    'ambulance' => '<i class="fas fa-ambulance"></i>',
    'ankh' => '<i class="fas fa-ankh"></i>',
    'apple' => '<i class="fab fa-apple"></i>',
    'award' => '<i class="fas fa-award"></i>',
    'bell' => '<i class="fas fa-bell"></i>',
    'bolt' => '<i class="fas fa-bolt"></i>',
); */

/* $_SESSION['board'] = $lvl1Icons; */

/* $i = 0;
foreach($lvl1Icons as $key => $value) {
    $_SESSION['board'][$i++] = array($key,$value);
}
foreach($lvl1Icons as $key => $value) {
    $_SESSION['board'][$i++] = array($key,$value);
} */

// Check if form was submitted
if(filter_has_var(INPUT_POST, 'process')) {

    // Start of Choose GameMode
    if($_POST['process'] == "gameMode") {

                if(isset($_POST['cardNumber'])) {
        
                    $cardNumber = trim(htmlspecialchars($_POST['cardNumber']));
        
                    if(!empty($cardNumber)) {
        
                        if($cardNumber == 6) {

                            Start6();
        
                            /* if($lastSign == "false") {
        
                                $_SESSION['tictacs'][$position] = true;
                                $_SESSION['lastSign'] = "true";
        
                                header('Location: ./index.php');
        
                            } else if($lastSign == "true") {
        
                                $_SESSION['tictacs'][$position] = false;
                                $_SESSION['lastSign'] = "false";
        
                                header('Location: ./index.php');
        
                            } else {
        
                                $msg = "Error: Wrong symbol data!";
                            
                            } */
        
                        } else if($cardNumber == 12) {

                            $msg = "GameMode 12!";
        
                            /* $_SESSION['board'] = $lvl1Icons . $lvl2Icons; */

                            /* if($lastSign == "false") {
        
                                $_SESSION['tictacs'][$position] = true;
                                $_SESSION['lastSign'] = "true";
        
                                header('Location: ./index.php');
        
                            } else if($lastSign == "true") {
        
                                $_SESSION['tictacs'][$position] = false;
                                $_SESSION['lastSign'] = "false";
        
                                header('Location: ./index.php');
        
                            } else {
        
                                $msg = "Error: Wrong symbol data!";
                            
                            } */
        
                        } else if($cardNumber == 18) {

                            /* $_SESSION['board'] = $lvl1Icons . $lvl2Icons . $lvl3Icons; */
        
                            /* if($lastSign == "false") {
        
                                $_SESSION['tictacs'][$position] = true;
                                $_SESSION['lastSign'] = "true";
        
                                header('Location: ./index.php');
        
                            } else if($lastSign == "true") {
        
                                $_SESSION['tictacs'][$position] = false;
                                $_SESSION['lastSign'] = "false";
        
                                header('Location: ./index.php');
        
                            } else {
        
                                $msg = "Error: Wrong symbol data!";
                            
                            } */
        
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
if($_POST['process'] == "pickCard") {

    if(isset($_POST['cardNumber'])) {

        $cardNumber = trim(htmlspecialchars($_POST['cardNumber']));

        if(!empty($cardNumber) || $cardNumber == 0) {

            if(isset($_SESSION['first-pick'])){
                if($_SESSION['first-pick'] == "true") {

                    $_SESSION['pick1'] = $cardNumber;

                    if(isset($_SESSION['won-cards'])){
                        if(is_array($_SESSION['won-cards'])) {
                            for ($i=0; $i < count($_SESSION['won-cards']); $i++) { 
                                if($_SESSION['won-cards'][$i] == $_SESSION['boardNums'][$_SESSION['pick1']]){
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

                    if($_SESSION['pick1'] == $_SESSION['pick2']) { header('Location: ./index.php'); $_SESSION['pick2'] = null; exit; }

                    $pick1 = $_SESSION['pick1'];
                    $pick2 = $_SESSION['pick2'];

                        if($_SESSION['boardNums'][$pick1] == $_SESSION['boardNums'][$pick2]){
                            if(isset($_SESSION['won-cards'])){
                                if(!is_array($_SESSION['won-cards'])){
                                    $_SESSION['won-cards'] = array();
                                } else {
                                    
                                }
                            } else {
                                $_SESSION['won-cards'] = array();
                            }



                            array_push($_SESSION['won-cards'], $_SESSION['boardNums'][$pick1]);
                            $_SESSION['pick1'] = null;
                            $_SESSION['pick2'] = null;
                        } else {
                            $_SESSION['pick1'] = null;
                            $_SESSION['pick2'] = null;
                        }

                    $_SESSION['first-pick'] = "true";
                }
            } else {
                $_SESSION['pick1'] = $cardNumber;

                if(isset($_SESSION['won-cards'])){
                    if(is_array($_SESSION['won-cards'])) {
                        for ($i=0; $i < count($_SESSION['won-cards']); $i++) { 
                            if($_SESSION['won-cards'][$i] == $_SESSION['boardNums'][$_SESSION['pick1']]){
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
    if($_POST['process'] == "reset") {
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

if(isset($_SESSION['board'])){
/*     $isFull = true;
    for($i = 1; $i <= 9; $i++) {
        if(!isset($_SESSION['tictacs'][$i])){
            $isFull = false;
        }
    }
    if($isFull == true) {
        $winnerMsg = "It's a tie no one wins!";
    } */
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

<body>

    <div class="container mt-5">

        <?php
if(isset($_SESSION['hasStarted'])){
    if($_SESSION['hasStarted'] == false) {
        echo '<button data-bs-toggle="modal" data-bs-target="#gameMode">Start</button>

        <div class="modal fade" id="gameMode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div style="width: max-content; height: fit-content; margin: auto; margin-top: 40vh;"
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
    }
} else {
    echo '<button data-bs-toggle="modal" data-bs-target="#gameMode">Start</button>

        <div class="modal fade" id="gameMode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div style="width: max-content; height: fit-content; margin: auto; margin-top: 40vh;"
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
}
?>



        <div class="memory-cards-main">

            <?php

if(isset($_SESSION['board'])){
    if(!empty($_SESSION['board'])){
        for ($i=0; $i < count($_SESSION['board']); $i++) { 

$class = '';

            if(isset($_SESSION['won-cards'])){
                if(is_array($_SESSION['won-cards'])){
                    for ($j=0; $j < count($_SESSION['won-cards']); $j++) { 
                        if($_SESSION['won-cards'][$j] == $_SESSION['boardNums'][$i]){
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

            if(isset($_SESSION['pick1'])){
                if($_SESSION['pick1'] == $i){
                    $class = 'revealed-card';
                } else {
                    if($class == 'won-card'){

                    } else {
                        $class = 'memory-card-hoverable';
                    }
                }
            } else {
                if($class == 'won-card'){

                } else {
                    $class = 'memory-card-hoverable';
                }
            }

            if($i == 0 || $i == 4 || $i == 8 || $i == 12 || $i == 16 || $i == 20 || $i == 24 || $i == 28 || $i == 32){
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

            if($i == 3 || $i == 7 || $i == 11 || $i == 15 || $i == 19 || $i == 23 || $i == 27 || $i == 31 || $i == 35){
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

        <p>        <?php
        echo $msg;
        ?></p>
 <p>
                won cards: <?php
            if(isset($_SESSION['won-cards'])){
                print_r($_SESSION['won-cards']);
                echo 'won: ' . count($_SESSION['won-cards']) . '/' . $_SESSION['gameMode'];
            }
            ?>
                </p>
                <p>
                1stPick?: <?php
            if(isset($_SESSION['first-pick'])){
                echo $_SESSION['first-pick'];
            }
            ?>
                </p>
                <p>
                pick1: <?php
            if(isset($_SESSION['pick1'])){
                echo $_SESSION['pick1'];
            }
            ?>
                </p>
                <p>
                pick2: <?php
            if(isset($_SESSION['pick2'])){
                echo $_SESSION['pick2'];
            }
            ?>
                </p>

        <?php
        if(isset($_SESSION['board'])) {
            print_r($_SESSION['board']);
        }
?>
    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" class="button">
            Reset
        </button>

        <input type="hidden" name="process" value="reset">

    </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="./memoryHandler.js"></script>

</body>

</html>
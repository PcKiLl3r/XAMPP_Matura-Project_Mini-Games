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

/* $lvl1Icons[0] = '<i class="fas fa-ambulance"></i>';
$lvl1Icons[1] = '<i class="fas fa-ankh"></i>';
$lvl1Icons[2] = '<i class="fab fa-apple"></i>';
$lvl1Icons[3] = '<i class="fas fa-award"></i>';
$lvl1Icons[4] = '<i class="fas fa-bell"></i>';
$lvl1Icons[5] = '<i class="fas fa-bolt"></i>'; */


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
        $isChecked = false;
        $badNumber = true;
    }
    $_SESSION['hasStarted'] = true;
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

    // Start of Insert Tic/Tac
    if($_POST['process'] == "add_tic_tac") {

/*         if(isset($_POST['position']) && isset($_SESSION['lastSign'])) {

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

        } */
    }
    // End of Insert Tic/Tac

    
    // Start of Reset
    if($_POST['process'] == "reset") {
        unset($_SESSION['board']);
        unset($_SESSION['hasStarted']);
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
    
                        <div class="memory-card memory-card-hoverable">
    
                            <form class="memory-card-front" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    6
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="6">
    
                            </form>
    
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
                            <form class="memory-card-front" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    12
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="12">
    
                            </form>
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
                            <form class="memory-card-front" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    18
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="18">
    
                            </form>
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
    
                        <div class="memory-card memory-card-hoverable">
    
                            <form class="memory-card-front" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    6
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="6">
    
                            </form>
    
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
                            <form class="memory-card-front" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    12
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="12">
    
                            </form>
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
                            <form class="memory-card-front" action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                <button type="submit" class="button">
                                    18
                                </button>
    
                                <input type="hidden" name="process" value="gameMode">
                                <input type="hidden" name="cardNumber" value="18">
    
                            </form>
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
    
                    </div>
    
                </div>
            </div>
        </div>';
}
?>

    <div class="container">
        <?php
        echo $msg;
        ?>

        <div class="memory-cards">

            <?php

if(isset($_SESSION['board'])){
    if(!empty($_SESSION['board'])){
        foreach($_SESSION['board'] as $key) {
            echo '<div class="memory-card memory-card-hoverable">
    <div class="memory-card-front">
    ' . '?' .
    '</div>
    <div class="memory-card-left">
    </div>
    <div class="memory-card-bot">
    </div>
    <div class="memory-card-right">
    </div>
    <div class="memory-card-back iconCard">' . $key .
    '</div>
    <div class="memory-card-top">
    </div>
</div>
            ';
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

        

        <?php
print_r($_SESSION['board']);
?>

    </div>

    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                <button type="submit" class="button">
                                    Reset
                                </button>
    
                                <input type="hidden" name="process" value="reset">
    
                            </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="./memoryHandler.js"></script>

</body>

</html>
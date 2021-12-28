<?php
include '../includes/sessSt_gameCount.php';

// Check if form was submitted
if(filter_has_var(INPUT_POST, 'process')) {

    // Start of Insert Tic/Tac
    if($_POST['process'] == "diceClick") {

        if(isset($_POST['diceValue'])) {
            
            $diceValue = trim(htmlspecialchars($_POST['diceValue']));

            if(!empty($diceValue)) {

                if($diceValue > 0 && $diceValue <= 6) {

                    if(isset($_SESSION['lastDiceValue'])){
                        if($diceValue == $_SESSION['lastDiceValue']){
                            $_SESSION['lastDiceValue'] = $diceValue;
                            $_SESSION['diceHunterScore']++;
                            $rndm = rand(1, 2);
                            $_SESSION['diceHunterAnim'] = $rndm;
                            if($_SESSION['diceHunterSpeed'] < 5){
                                $_SESSION['diceHunterSpeed']++;
                            }
                        } else {
                            $_SESSION['lastDiceValue'] = $diceValue;
                            if($_SESSION['diceHunterScore'] != 0){
                                $_SESSION['diceHunterScore']--;
                            }
                            if($_SESSION['diceHunterSpeed'] != 1){
                                $_SESSION['diceHunterSpeed']--;
                            }
                            $rndm = rand(1, 2);
                            $_SESSION['diceHunterAnim'] = $rndm;
                        }
                    } else {
                        $_SESSION['lastDiceValue'] = $diceValue;
                        $_SESSION['diceHunterScore'] = 0;
                        $_SESSION['diceHunterSpeed'] = 1;
                    }

                } else {

                    $msg = "Error: Wrong dice value data!";

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

        unset($_SESSION['lastDiceValue']);
        unset($_SESSION['diceHunterScore']);
        $_SESSION['gamesPlayedDiceHunter']++;

    }
    // End of Reset

    header("Location: ./index.php");

    unset($_POST);

}

if(!isset($_SESSION['diceHunterAnim'])){
    $rndm = rand(1, 2);
    $_SESSION['diceHunterAnim'] = $rndm;
}

if(!isset($_SESSION['diceHunterSpeed'])){
    $_SESSION['diceHunterSpeed'] = 1;
}

$winnerMsg = null;

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

<div style="visibility: hidden;"><?php echo $_SESSION['diceHunterAnim']; ?></div>
<div style="visibility: hidden;"><?php echo $_SESSION['diceHunterSpeed']; ?></div>

    <div class="container">

        <div class="dices">

            <div class="dice">

                <form action="./index.php" method="post">
                    <button type="submit" class="dice-front"></button>
                    <input type="hidden" name="diceValue" value="1">
                    <input type="hidden" name="process" value="diceClick">
                </form>

                <form action="./index.php" method="post">
                    <button type="submit" class="dice-left"></button>
                    <input type="hidden" name="diceValue" value="2">
                    <input type="hidden" name="process" value="diceClick">
                </form>

                <form action="./index.php" method="post">
                    <button type="submit" class="dice-bot"></button>
                    <input type="hidden" name="diceValue" value="3">
                    <input type="hidden" name="process" value="diceClick">
                </form>


                <form action="./index.php" method="post">
                    <button type="submit" class="dice-right"></button>
                    <input type="hidden" name="diceValue" value="5">
                    <input type="hidden" name="process" value="diceClick">
                </form>

                <form action="./index.php" method="post">
                    <button type="submit" class="dice-back"></button>
                    <input type="hidden" name="diceValue" value="6">
                    <input type="hidden" name="process" value="diceClick">
                </form>

                <form action="./index.php" method="post">
                    <button type="submit" class="dice-top"></button>
                    <input type="hidden" name="diceValue" value="4">
                    <input type="hidden" name="process" value="diceClick">
                </form>
            </div>

            <!-- <div class="dice dice-hoverable dice-2">
    <div class="dice-front">
    </div>
    <div class="dice-left">
    </div>
    <div class="dice-bot">
    </div>
    <div class="dice-right">
    </div>
    <div class="dice-back">
    </div>
    <div class="dice-top">
    </div>
</div>

<div class="dice dice-hoverable dice-3">
    <div class="dice-front">
    </div>
    <div class="dice-left">
    </div>
    <div class="dice-bot">
    </div>
    <div class="dice-right">
    </div>
    <div class="dice-back">
    </div>
    <div class="dice-top">
    </div>
</div>

<div class="dice dice-hoverable dice-4">
    <div class="dice-front">
    </div>
    <div class="dice-left">
    </div>
    <div class="dice-bot">
    </div>
    <div class="dice-right">
    </div>
    <div class="dice-back">
    </div>
    <div class="dice-top">
    </div>
</div>

<div class="dice dice-hoverable dice-5">
    <div class="dice-front">
    </div>
    <div class="dice-left">
    </div>
    <div class="dice-bot">
    </div>
    <div class="dice-right">
    </div>
    <div class="dice-back">
    </div>
    <div class="dice-top">
    </div>
</div>

<div class="dice dice-hoverable dice-6">
    <div class="dice-front">
    </div>
    <div class="dice-left">
    </div>
    <div class="dice-bot">
    </div>
    <div class="dice-right">
    </div>
    <div class="dice-back">
    </div>
    <div class="dice-top">
    </div>
</div> -->

        </div>

        <p class="container">
            <?php
    echo "Score: " . $_SESSION['diceHunterScore'];
    echo '<br>';
    echo "Last number: " . $_SESSION['lastDiceValue'];
?>
        </p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="./js/diceClickHandler.js"></script>

</body>

</html>
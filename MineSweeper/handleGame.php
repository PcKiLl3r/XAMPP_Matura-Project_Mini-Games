<?php
session_start();

if (filter_has_var(INPUT_POST, 'process')) {

    // Start of NewConn
    if ($_POST['process'] == "newConn") {
        NewConn();
    }
    // End of NewConn

    // Start of GameStatus
    else if ($_POST['process'] == "getGameStatus") {
        GetGameStatus();
    }
    // End of GameStatus

    // Start of GetFields
    else if ($_POST['process'] == "getFields") {
        SendFields();
    }
    // End of GetFields

    // Start of PlayerMove
    else if ($_POST['process'] == "playerMove") {
        HandlePlayerMove();
    }
    // End of PlayerMove

    // Start of NewGame
    else if ($_POST['process'] == "newGame") {
        NewGame();
    }
    // End of NewGame

    // Start of ResetBoard
    else if ($_POST['process'] == "reset") {
    }
    // End of Reset

    else {
        echo $_SESSION['msg'];
        unset($_POST);
        exit();
    } 
}
function NewConn()
{
    // send test response
    echo "ConnOK";
    exit();
}
function GetGameStatus()
{
    // SESSION gameStatus => inactive/inprogress
    if (isset($_SESSION['gameStatus'])) {
        if ($_SESSION['gameStatus'] == 'inactive') {
            /* NewGame();
            $_SESSION['gameStatus'] = 'inprogress'; */
            echo 'Inactive';
        } else if ($_SESSION['gameStatus'] == 'inprogress') {
            echo 'InProgress';
        } else {
            echo 'corruptedData';
        }
    } else {
        $_SESSION['gameStatus'] = 'inactive';
        echo 'Inactive';
    }
}
function NewGame()
{
    if (isset($_POST['type'])) {

        $_type = trim(htmlspecialchars($_POST['type']));

        if ($_type == 'small' || $_type == 'med' || $_type == 'big') {
            if ($_type == 'small') {

                CreatMineField(5);

                echo ('NewSmallOK');
            } else if ($_type == 'med') {

                CreatMineField(7);

                echo ('NewMedOK');
            } else if ($_type == 'big') {

                CreatMineField(9);

                echo ('NewBigOK');
            }
        } else {
            $_SESSION['msg'] .= "Error: NewGame data was wrong! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
function CreatMineField($_size)
{
    // Size also defines amount of mines
    $_SESSION['mineField'] = [];
    $_mineCount = 0;
    $_fieldCount = 0;

    for ($i = 0; $i < $_size; $i++) {
        for ($i2 = 0; $i2 < $_size; $i2++) {
            $_rand = rand(0, $_size);
            if($_mineCount < $_size){
                if($_rand == 1){
                    $_SESSION['mineField'][$i][$i2] = 'hide-mine';
                    $_mineCount++;

                } else if($_size * $_size - $_fieldCount == ($_size - $_mineCount) * 3) {
                    $_SESSION['mineField'][$i][$i2] = 'hide-mine';
                    $_mineCount++;
                } else {
                    $_SESSION['mineField'][$i][$i2] = 'hide-empty';
                    $_fieldCount++;
                }
            } else {
                $_SESSION['mineField'][$i][$i2] = 'hide-empty';
                $_fieldCount++;
            }
        }
    }

    $_SESSION['gameStatus'] = 'inprogress';
    $_SESSION['size'] = $_size;
}
function HandlePlayerMove()
{
    if (isset($_POST['field'])) {

        $_field = trim(htmlspecialchars($_POST['field']));

        if ($_field < count($_SESSION['mineField']) * count($_SESSION['mineField']) && $_field >= 0) {

            $_remapedNum = RemapFieldNum($_field);
            
            if(GetFieldStatus($_remapedNum) == 0){
                // Field hidden => can be reavealed!
                echo GetComputedFieldValue($_remapedNum);
            } else {
                echo("Field already revealed!");
            }
            

        } else {
            $_SESSION['msg'] .= "Error: Player Move Field data was wrong! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
function RemapFieldNum($_field){
    $_count = 0;
    $_remapedFieldNum = null;

    for ($i=0; $i < count($_SESSION['mineField']); $i++){
        for ($i2=0; $i2 < count($_SESSION['mineField']); $i2++) { 
            if($_count == $_field){
                $_remapedFieldNum = $i . ',' . $i2;
            }
            $_count++;
        }
    }
    return($_remapedFieldNum);
}
function GetFieldStatus($_field){
    $_i1 = substr($_field, 0, 1);
    $_i2 = substr($_field, 2, 1);
    $_status = 'undefined';
    $_status = substr($_SESSION['mineField'][$_i1][$_i2], 0, 5);

    if ($_status == "hide") {
        $_status = 0;
    } else if ($_status == "show") {
        $_status = 1;
    }
    return ($_status);
}
function GetFieldValue($_field){
    $_i1 = substr($_field, 0, 1);
    $_i2 = substr($_field, 2, 1);
    $_value = 'undefined';
    $_value = substr($_SESSION['mineField'][$_i1][$_i2], 5);

    return ($_value);
}
function GetComputedFieldValue($_field){
    $_i1 = substr($_field, 0, 1);
    $_i2 = substr($_field, 2, 1);
    $_value = 'undefined';
    $_value = substr($_SESSION['mineField'][$_i1][$_i2], 5);

    if($_value == 'empty'){
        // TODO Check for neighbours for number return
        $_value = CheckNeighboursForMine($_field);
    }

    return ($_value);
}
function CheckNeighboursForMine($_field){
    $_i1 = substr($_field, 0, 1);
    $_i2 = substr($_field, 2, 1);

    $_neighbMineCount = 0;

    //Check for max size min size offset

    if($_i1 - 1 > -1){
        $_i1Temp = $_i1;
        $_i1Temp--;
        $_fieldTemp = $_i1Temp . ',' . $_i2;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i2 - 1 > -1){
        $_i2Temp = $_i2;
        $_i2Temp--;
        $_fieldTemp = $_i1 . ',' . $_i2Temp;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i1 + 1 < $_SESSION['size']){
        $_i1Temp = $_i1;
        $_i1Temp++;
        $_fieldTemp = $_i1Temp . ',' . $_i2;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i2 + 1 < $_SESSION['size']){
        $_i2Temp = $_i2;
        $_i2Temp++;
        $_fieldTemp = $_i1 . ',' . $_i2Temp;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i1 - 1 > -1 && $_i2 - 1 > -1){
        $_i1Temp = $_i1;
        $_i2Temp = $_i2;
        $_i1Temp--;
        $_i2Temp--;
        $_fieldTemp = $_i1Temp . ',' . $_i2Temp;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i1 + 1 < $_SESSION['size'] && $_i2 - 1 > -1){
        $_i1Temp = $_i1;
        $_i2Temp = $_i2;
        $_i1Temp++;
        $_i2Temp--;
        $_fieldTemp = $_i1Temp . ',' . $_i2Temp;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i2 + 1 < $_SESSION['size'] && $_i1 - 1 > -1){
        $_i1Temp = $_i1;
        $_i2Temp = $_i2;
        $_i1Temp--;
        $_i2Temp++;
        $_fieldTemp = $_i1Temp . ',' . $_i2Temp;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }

    if($_i2 + 1 < $_SESSION['size'] && $_i1 + 1 < $_SESSION['size']){
        $_i1Temp = $_i1;
        $_i2Temp = $_i2;
        $_i1Temp++;
        $_i2Temp++;
        $_fieldTemp = $_i1Temp . ',' . $_i2Temp;
        if(GetFieldValue($_fieldTemp) == 'mine') $_neighbMineCount++;
    }    

    return($_neighbMineCount);
}
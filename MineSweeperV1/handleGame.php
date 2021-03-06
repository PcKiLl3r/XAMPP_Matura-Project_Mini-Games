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

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    unset($_POST);
    exit();
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
            $_SESSION['isFirstClick'] = true;
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
    $_mineCount = $_size;
    $_fieldCount = $_size * $_size - $_size;

    $_fieldArray = [];
    $_mineArray = [];

    for ($i = 0; $i < $_fieldCount; $i++) {
        $_fieldArray[$i] = 'hide-empty';
    }

    for ($i = 0; $i < $_mineCount; $i++) {
        $_mineArray[$i] = 'hide-mine';
    }

    $_SESSION['mineField'] = array_merge($_fieldArray, $_mineArray);
    shuffle($_SESSION['mineField']);

    /* for ($i = 0; $i < $_size; $i++) {
        for ($i2 = 0; $i2 < $_size; $i2++) {
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
    } */

    $_SESSION['gameStatus'] = 'inprogress';
    $_SESSION['size'] = $_size;
}
function HandlePlayerMove()
{
    if (isset($_POST['field'])) {

        $_field = trim(htmlspecialchars($_POST['field']));

        if ($_field < count($_SESSION['mineField']) && $_field >= 0) {
            if ($_SESSION['isFirstClick'] == true) {
                if (GetFieldStatus($_field) == 0) {
                    if (GetComputedFieldValue($_field) == 0) {
                        $_firstFields = [];
                        $_firstFields = CheckSurroundingFieldsForZero($_field);
                        print_r(json_encode(/* [ *//* 0,1,2,3] */ $_firstFields));
                        $_SESSION['isFirstClick'] = false;
                    } else {
                        echo GetComputedFieldValue($_field);
                    }
                } else {
                    $_SESSION['msg'] .= "Field already revealed!";
                }
            } else {
                if (GetFieldStatus($_field) == 0) {
                    echo GetComputedFieldValue($_field);
                } else {
                    $_SESSION['msg'] .= "Field already revealed!";
                }
            }
        } else {
            $_SESSION['msg'] .= "Error: Player Move Field data was wrong! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
/* function RemapFieldNum($_field){
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
} */
function GetFieldStatus($_field)
{
    $_status = 'undefined';
    $_status = substr($_SESSION['mineField'][$_field], 0, 5);

    if ($_status == "hide") {
        $_status = 0;
    } else if ($_status == "show") {
        $_status = 1;
    }
    return ($_status);
}
function GetFieldValue($_field)
{
    $_value = 'undefined';
    $_value = substr($_SESSION['mineField'][$_field], 5);

    return ($_value);
}
function GetComputedFieldValue($_field)
{
    $_value = 'undefined';
    $_value = substr($_SESSION['mineField'][$_field], 5);

    if ($_value == 'empty') {
        // TODO Check for neighbours for number return
        $_value = CheckNeighboursForMine($_field);
    }

    return ($_value);
}
function CheckNeighboursForMine($_field)
{

    $_neighbMineCount = 0;

    $_size = $_SESSION['size'];

    $_allFields = $_size * $_size;

    $_isLeftEdge = ($_field % $_size == 0);
    $_isRightEdge = ($_field % $_size == $_size - 1);

    if ($_field - 1 > -1 && !$_isLeftEdge && GetFieldValue($_field - 1) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field - $_size + 1 > -1 && !$_isRightEdge && GetFieldValue($_field - $_size + 1) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field - $_size > -1 && GetFieldValue($_field - $_size) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field - $_size - 1 > -1 && !$_isLeftEdge && GetFieldValue($_field - $_size - 1) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field + 1 < $_allFields && !$_isRightEdge && GetFieldValue($_field + 1) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field + $_size + 1 < $_allFields && !$_isRightEdge && GetFieldValue($_field + $_size + 1) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field + $_size < $_allFields && GetFieldValue($_field + $_size) == 'mine') {
        $_neighbMineCount++;
    }
    if ($_field + $_size - 1 < $_allFields && !$_isLeftEdge && GetFieldValue($_field + $_size - 1) == 'mine') {
        $_neighbMineCount++;
    }

    return ($_neighbMineCount);
}
function CheckSurroundingFieldsForZero($_field)
{
    $_field = intval($_field, $base = 10);
    ini_set('memory_limit', '128MB');
    $_size = $_SESSION['size'];

    $_allFields = $_size * $_size;

    $_isLeftEdge = ($_field % $_size == 0);
    $_isRightEdge = ($_field % $_size == $_size - 1);

    $_openFields = [];

    if ($_field > -1 && $_field < $_allFields && GetFieldValue($_field) != 'mine' && CheckNeighboursForMine($_field) == 0) {
        array_push($_openFields, $_field);
    }

    if ($_field - 1 > -1 && !$_isLeftEdge && GetFieldValue($_field - 1) != 'mine' && CheckNeighboursForMine($_field - 1) == 0) {
        array_push($_openFields, $_field - 1);
        $_openFields2 = CheckSurroundingFieldsForZero($_field - 1);
        array_merge($_openFields, $_openFields2);
    }
    if ($_field - $_size + 1 > -1 && !$_isRightEdge && GetFieldValue($_field - $_size + 1) != 'mine' && CheckNeighboursForMine($_field - $_size + 1) == 0) {
        array_push($_openFields, $_field - $_size + 1);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field - $_size + 1);
        if ($_openFields2 == []) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }
    if ($_field - $_size > -1 && GetFieldValue($_field - $_size) != 'mine' && CheckNeighboursForMine($_field - $_size) == 0) {
        array_push($_openFields, $_field - $_size);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field - $_size);
        if ($_openFields2 == false) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }
    if ($_field - $_size - 1 > -1 && !$_isLeftEdge && GetFieldValue($_field - $_size - 1) != 'mine' && CheckNeighboursForMine($_field - $_size - 1) == 0) {
        array_push($_openFields, $_field - $_size - 1);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field - $_size - 1);
        if ($_openFields2 == false) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }
    if ($_field + 1 < $_allFields && !$_isRightEdge && GetFieldValue($_field + 1) != 'mine' && CheckNeighboursForMine($_field + 1) == 0) {
        array_push($_openFields, $_field + 1);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field + 1);
        if ($_openFields2 == false) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }
    if ($_field + $_size + 1 < $_allFields && !$_isRightEdge && GetFieldValue($_field + $_size + 1) != 'mine' && CheckNeighboursForMine($_field + $_size + 1) == 0) {
        array_push($_openFields, $_field + $_size + 1);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field + $_size + 1);
        if ($_openFields2 == false) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }
    if ($_field + $_size < $_allFields && GetFieldValue($_field + $_size) != 'mine' && CheckNeighboursForMine($_field + $_size) == 0) {
        array_push($_openFields, $_field + $_size);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field + $_size);
        if ($_openFields2 == false) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }
    if ($_field + $_size - 1 < $_allFields && !$_isLeftEdge && GetFieldValue($_field + $_size - 1) != 'mine' && CheckNeighboursForMine($_field + $_size - 1) == 0) {
        array_push($_openFields, $_field + $_size - 1);
        /* $_openFields2 = CheckSurroundingFieldsForZero($_field + $_size - 1);
        if ($_openFields2 == false) {
        } else {
            $_openFields = array_merge($_openFields, $_openFields2);
        } */
    }

    /* if(count($_openFields) < 1){
        $_openFields = [];
    } */

    return ($_openFields);
}

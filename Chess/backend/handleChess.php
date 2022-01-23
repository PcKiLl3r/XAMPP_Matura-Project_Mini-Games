<?php
session_start();

if (!isset($_SESSION['playerTurn'])) {
    $_SESSION['playerTurn'] = 'unset';
}

$_SESSION['winner'] = 'unset';

$_SESSION['msg'] = '';

#region UTILITY METHODS
function TogglePlayer()
{
    if ($_SESSION['playerTurn'] == 1) $_SESSION['playerTurn'] = 2;
    else if ($_SESSION['playerTurn'] == 2) $_SESSION['playerTurn'] = 1;
    else $_SESSION['playerTurn'] = 'unset';
}
function GetFieldFigureColor($_field)
{
    $_color = 'noColor';
    $_color = substr($_SESSION['fields'][$_field], 0, 5);

    if ($_color == "white") {
        $_color = 1;
    } else if ($_color == "black") {
        $_color = 0;
    }
    return ($_color);
}
function GetFieldFigure($_field)
{
    if ($_SESSION['fields'][$_field] == "empty") {
        $_figure = "empty";
    } else {
        $_figure = substr($_SESSION['fields'][$_field], 6);
    }
    return ($_figure);
}
function CheckIfFieldEmpty($_field)
{
    if ($_SESSION['fields'][$_field] == "empty") {
        $_isEmpty = 1;
    } else {
        $_isEmpty = 0;
    }
    return ($_isEmpty);
}
function GetFieldRow($_field)
{
    $_row = 'unset';
    if ($_field >= 0 && $_field <= 7) {
        $_row = 1;
    } else if ($_field >= 8 && $_field <= 15) {
        $_row = 2;
    } else if ($_field >= 16 && $_field <= 23) {
        $_row = 3;
    } else if ($_field >= 24 && $_field <= 31) {
        $_row = 4;
    } else if ($_field >= 32 && $_field <= 39) {
        $_row = 5;
    } else if ($_field >= 40 && $_field <= 47) {
        $_row = 6;
    } else if ($_field >= 48 && $_field <= 55) {
        $_row = 7;
    } else if ($_field >= 56 && $_field <= 63) {
        $_row = 8;
    }
    return ($_row);
}
function MoveFigureToField($_startField, $_endField)
{
    if ($_SESSION['fields'][$_endField] != 'empty') {
        // Call Move To Grave Method
        MoveFigureToGrave($_endField);
        $_SESSION['fields'][$_endField] = $_SESSION['fields'][$_startField];
        $_SESSION['fields'][$_startField] = 'empty';
    } else {
        // Move figure
        $_SESSION['fields'][$_endField] = $_SESSION['fields'][$_startField];
        $_SESSION['fields'][$_startField] = 'empty';
    }
}
function MoveFigureToGrave($_field)
{
    if (GetFieldFigureColor($_field) == 1) {
        $_SESSION['whiteGrave'][] = $_SESSION['fields'][$_field];
    } else if (GetFieldFigureColor($_field) == 0) {
        $_SESSION['blackGrave'][] = $_SESSION['fields'][$_field];
    } else {
        $_SESSION['msg'] .= "Error: Color undefined can't be moved to grave.\r\n";
    }
    $_SESSION['fields'][$_field] = 'empty';
}
function GetPawnPromotionField()
{
    $_pawnPromField = null;
    if ($_SESSION['playerTurn'] == 1) {
        for ($i = 0; $i < count($_SESSION['fields']); $i++) {
            if (GetFieldFigure($i) == 'pawn') {
                if ($i <= 63 && $i >= 56) {
                    $_pawnPromField = $i;
                }
            }
        }
    } else if ($_SESSION['playerTurn'] == 2) {
        for ($i = 0; $i < count($_SESSION['fields']); $i++) {
            if (GetFieldFigure($i) == 'pawn') {
                if ($i <= 7 && $i >= 0) {
                    $_pawnPromField = $i;
                }
            }
        }
    }
    return ($_pawnPromField);
}
function CanTogglePlayer()
{
    // TODO
    // 1. CHECK FOR CHECK
    // 2. CHECK FOR PROMOTION - inPROG
    // 3. CHECK FOR END

    // CHECK FOR PROMOTION
    if (GetPawnPromotionField() != null) $_SESSION['breakOption'] = "Promotion";
    else $_SESSION['breakOption'] = "ToggleOK";
    return ($_SESSION['breakOption']);
}
#endregion END UTILITY METHODS

#region ServerHandle REQUEST
function NewConn()
{
    // send test response
    echo "ConnOK";
}
function CheckGameStatus()
{
    // SESSION gameStatus => inactive/inprogress
    if (isset($_SESSION['gameStatus'])) {
        if ($_SESSION['gameStatus'] == 'inactive') {
            /* NewGame();
            $_SESSION['gameStatus'] = 'inprogress'; */
            echo 'Inactive';
        } else if ($_SESSION['gameStatus'] == 'inprogress') {
            echo 'InProgress';
            exit();
            /* print_r($_SESSION['fields']); */
        } else {
            echo 'CantStartGame';
        }
    } else {
        $_SESSION['gameStatus'] = 'inactive';
        CheckGameStatus();
    }
}
function NewGameContinue()
{

    if (isset($_POST['selection'])) {

        $_selection = trim(htmlspecialchars($_POST['selection']));

        if ($_selection == 'new' || $_selection == 'old') {
            if ($_selection == 'new') {
                $_SESSION['gameStatus'] = "inprogress";
                $_SESSION['whiteGrave'] = [];
                $_SESSION['blackGrave'] = [];
                $_SESSION['playerTurn'] = 1;
                $_SESSION['fields'] = [];
                for ($i = 0; $i < 64; $i++) {
                    $_SESSION['fields'][$i] = 'empty';

                    if ($i > 7 && $i < 16) {
                        $_SESSION['fields'][$i] = 'white-pawn';
                    } else if ($i > 47 && $i < 56) {
                        $_SESSION['fields'][$i] = 'black-pawn';
                    } else if ($i == 0 || $i == 7) {
                        $_SESSION['fields'][$i] = 'white-rook';
                    } else if ($i == 56 || $i == 63) {
                        $_SESSION['fields'][$i] = 'black-rook';
                    } else if ($i == 1 || $i == 6) {
                        $_SESSION['fields'][$i] = 'white-knight';
                    } else if ($i == 57 || $i == 62) {
                        $_SESSION['fields'][$i] = 'black-knight';
                    } else if ($i == 2 || $i == 5) {
                        $_SESSION['fields'][$i] = 'white-bishop';
                    } else if ($i == 58 || $i == 61) {
                        $_SESSION['fields'][$i] = 'black-bishop';
                    } else if ($i == 3) {
                        $_SESSION['fields'][$i] = 'white-queen';
                    } else if ($i == 59) {
                        $_SESSION['fields'][$i] = 'black-queen';
                    } else if ($i == 4) {
                        $_SESSION['fields'][$i] = 'white-king';
                    } else if ($i == 60) {
                        $_SESSION['fields'][$i] = 'black-king';
                    }
                }
                echo ('NewGameOK');
            } else if ($_selection == 'old') {
                echo ('ContGameOK');
            }
        } else {
            $_SESSION['msg'] .= "Error: NewGame/Continue data was wrong! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
function SendFields()
{
    echo json_encode($_SESSION['fields']);
}
function SendCurrentPlayer()
{
    echo json_encode($_SESSION['playerTurn']);
}
function PlayerMove()
{
    if (isset($_POST['moveToField']) && isset($_POST['moveFromField'])) {

        if ($_SESSION['winner'] != "unset") {
            $_SESSION['msg'] .= "Error: Someone already won! \r\n";
            exit();
        }

        $MoveToField = trim(htmlspecialchars($_POST['moveToField']));
        $MoveFromField = trim(htmlspecialchars($_POST['moveFromField']));

        if ($MoveToField != null && $MoveFromField != null) {

            if ($MoveToField >= 0 && $MoveFromField <= 63 && $MoveFromField >= 0 && $MoveFromField <= 63) {
                if ($_SESSION['playerTurn'] == "1") {
                    if (GetFieldFigureColor($MoveFromField) == 1) {
                        HandleFigureMove($MoveToField, $MoveFromField, 1);
                    } else {
                        //Error NOT your turn!
                        echo ("Not your figure");
                    }
                } else if ($_SESSION['playerTurn'] == "2") {
                    if (GetFieldFigureColor($MoveFromField) == 0) {
                        HandleFigureMove($MoveToField, $MoveFromField, 0);
                    } else {
                        //Error NOT your turn!
                        echo ("Not your figure");
                    }
                } else if ($_SESSION['playerTurn'] == 'unset') {
                    header("Location: ../../index.php");
                }
            } else {
                $_SESSION['msg'] .= "Error: Wrong field data (Out of range)! \r\n";
            }
        } else {
            $_SESSION['msg'] .= "Error: MoveTo/From field data was empty! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
function SendPromotionPick()
{
    if (isset($_POST['figure'])) {

        if ($_SESSION['winner'] != "unset") {
            $_SESSION['msg'] .= "Error: Someone already won! \r\n";
            exit();
        }

        $promotionFigure = trim(htmlspecialchars($_POST['figure']));

        if (!empty($promotionFigure)) {
            /* echo($promotionFigure); */

            if (PromotePawn($promotionFigure) == "PromotionOK") {
                TogglePlayer();
            }
        } else {
            $_SESSION['msg'] .= "Error: Promotion Pick data was empty! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
function PromotePawn($_figure)
{
    $promField = GetPawnPromotionField();
    $_promOK = "PromotionOK";
    if ($_SESSION['playerTurn'] == 1) {
        $_SESSION['fields'][$promField] = 'white-' . $_figure;
    } else if ($_SESSION['playerTurn'] == 2) {
        $_SESSION['fields'][$promField] = 'black-' . $_figure;
    } else {
        $_promOK = "PromotionBAD";
    }
    $_SESSION['pawnPromotedTo'][0] = $_SESSION['fields'][$promField];
    $_SESSION['pawnPromotedTo'][1] = $promField;
    echo ($_promOK);
    return ($_promOK);
}
function SendPromotedFigure()
{
    echo $_SESSION['pawnPromotedTo'][0] . ' ' . $_SESSION['pawnPromotedTo'][1];
}
function GetBreakOption()
{
    echo ($_SESSION['breakOption']);
}
#endregion ServerHandle REQUEST

#region MOVEMENT CHECK METHODS
function GetFieldsHorizontally($_field, $_isRight = 1, $_isWhite = 1)
{
    $_fieldsAvail = [];

    $_row = GetFieldRow($_field);
    if ($_isRight) if ($_isWhite == 1) $_isWhite = 2;
    else $_isWhite = 1;

    if ($_isWhite == 1) {
        for ($i = 0; $i < 7; $i++) {
            if ($_field - 1 - $i < 0) {
                break;
            }
            if (GetFieldRow($_field - 1 - $i) == $_row) {
                $_fieldsAvail[] = $_field - 1 - $i;
            } else {
                break;
            }
        }
    } else {
        for ($i = 0; $i < 7; $i++) {
            if ($_field + 1 + $i > 63) {
                break;
            }
            if (GetFieldRow($_field + 1 + $i) == $_row) {
                $_fieldsAvail[] = $_field + 1 + $i;
            } else {
                break;
            }
        }
    }
    return ($_fieldsAvail);
}
function GetFieldsVertically($_field, $_isAhead = 1, $_isWhite = 1)
{
    $_fieldsAvail = [];
    $_row = GetFieldRow($_field);

    if ($_isWhite == 1) {
        if ($_isAhead == 1) {
            for ($i = 0; $i < 8 - $_row; $i++) {
                if ($i == 0) {
                    if ($_field + 8 > 63) {
                        break;
                    }
                    $_fieldsAvail[] = $_field + 8;
                } else {
                    if ($_fieldsAvail[$i - 1] + 8 > 63) {
                        break;
                    }
                    $_fieldsAvail[] = $_fieldsAvail[$i - 1] + 8;
                }
            }
        } else {
            for ($i = 0; $i < $_row - 1; $i++) {
                if ($i == 0) {
                    if ($_field - 8 < 0) {
                        break;
                    }
                    $_fieldsAvail[] = $_field - 8;
                } else {
                    if ($_fieldsAvail[$i - 1] - 8 < 0) {
                        break;
                    }
                    $_fieldsAvail[] = $_fieldsAvail[$i - 1] - 8;
                }
            }
        }
    } else {
        if ($_isAhead == 1) {
            for ($i = 0; $i < $_row - 1; $i++) {
                if ($i == 0) {
                    if ($_field - 8 < 0) {
                        break;
                    }
                    $_fieldsAvail[] = $_field - 8;
                } else {
                    if ($_fieldsAvail[$i - 1] - 8 < 0) {
                        break;
                    }
                    $_fieldsAvail[] = $_fieldsAvail[$i - 1] - 8;
                }
            }
        } else {
            for ($i = 0; $i < 8 - $_row; $i++) {
                if ($i == 0) {
                    if ($_field + 8 > 63) {
                        break;
                    }
                    $_fieldsAvail[] = $_field + 8;
                } else {
                    if ($_fieldsAvail[$i - 1] + 8 > 63) {
                        break;
                    }
                    $_fieldsAvail[] = $_fieldsAvail[$i - 1] + 8;
                }
            }
        }
    }
    return ($_fieldsAvail);
}
function GetFieldsDiagonally($_field, $_isAhead = 1, $_isRight = 1, $_isWhite = 1)
{
    $_fieldsAvail = [];

    if ($_isWhite == 0) {
        if ($_isRight == 1) $_isRight = 0;
        else $_isRight = 1;
        if ($_isAhead == 1) $_isAhead = 0;
        else $_isAhead = 1;
    }

    if ($_isRight == 1) {
        if ($_isAhead == 0) {
            for ($i = 0; $i < 7; $i++) {
                if ($_field - 7 - (7 * $i) < 0) {
                    break;
                }
                if (GetFieldRow($_field - 7 - (7 * $i)) >= GetFieldRow($_field - (7 * $i))) {
                    break;
                }
                if (GetFieldRow($_field - 7 - (7 * $i)) - GetFieldRow($_field - (7 * $i)) < -1) {
                    break;
                }
                $_fieldsAvail[] = $_field - 7 - (7 * $i);
                /* if($_field - 7 - (7 * $i) == 0 || $_field - 7 - (7 * $i) == 8 || $_field - 7 - (7 * $i) == 16 || $_field - 7 - (7 * $i) == 24 || $_field - 7 - (7 * $i) == 32 || $_field - 7 - (7 * $i) == 40 || $_field - 7 - (7 * $i) == 48 || $_field - 7 - (7 * $i) == 56){
                    break;
                }
                if($_field - 7 - (7 * $i) == 7 || $_field - 7 - (7 * $i) == 15 || $_field - 7 - (7 * $i) == 23 || $_field - 7 - (7 * $i) == 31 || $_field - 7 - (7 * $i) == 39 || $_field - 7 - (7 * $i) == 47 || $_field - 7 - (7 * $i) == 55 || $_field - 7 - (7 * $i) == 63){
                    break;
                } */
            }
        } else {
            for ($i = 0; $i < 7; $i++) {
                if ($_field + 9 + (9 * $i) > 63) {
                    break;
                }
                if (GetFieldRow($_field + 9 + (9 * $i)) <= GetFieldRow($_field + (9 * $i))) {
                    break;
                }
                if (GetFieldRow($_field + 9 + (9 * $i)) - GetFieldRow($_field + (9 * $i)) > 1) {
                    break;
                }
                $_fieldsAvail[] = $_field + 9 + (9 * $i);
                /* if($_field + 9 + (9 * $i) == 0 || $_field + 9 + (9 * $i) == 8 || $_field + 9 + (9 * $i) == 16 || $_field + 9 + (9 * $i) == 24 || $_field + 9 + (9 * $i) == 32 || $_field + 9 + (9 * $i) == 40 || $_field + 9 + (9 * $i) == 48 || $_field + 9 + (9 * $i) == 56){
                    break;
                }
                if($_field + 9 + (9 * $i) == 7 || $_field + 9 + (9 * $i) == 15 || $_field + 9 + (9 * $i) == 23 || $_field + 9 + (9 * $i) == 31 || $_field + 9 + (9 * $i) == 39 || $_field + 9 + (9 * $i) == 47 || $_field + 9 + (9 * $i) == 55 || $_field + 9 + (9 * $i) == 63){
                    break;
                } */
            }
        }
    } else {
        if ($_isAhead == 0) {
            for ($i = 0; $i < 7; $i++) {
                if ($_field - 9 - (9 * $i) < 0) {
                    break;
                }
                if (GetFieldRow($_field - 9 - (9 * $i)) >= GetFieldRow($_field - (9 * $i))) {
                    break;
                }
                if (GetFieldRow($_field - 9 - (9 * $i)) - GetFieldRow($_field - (9 * $i)) < -1) {
                    break;
                }
                $_fieldsAvail[] = $_field - 9 - (9 * $i);
                /* if($_field - 9 - (9 * $i) == 0 || $_field - 9 - (9 * $i) == 8 || $_field - 9 - (9 * $i) == 16 || $_field - 9 - (9 * $i) == 24 || $_field - 9 - (9 * $i) == 32 || $_field - 9 - (9 * $i) == 40 || $_field - 9 - (9 * $i) == 48 || $_field - 9 - (9 * $i) == 56){
                    break;
                }
                if($_field - 9 - (9 * $i) == 7 || $_field - 9 - (9 * $i) == 15 || $_field - 9 - (9 * $i) == 23 || $_field - 9 - (9 * $i) == 31 || $_field - 9 - (9 * $i) == 39 || $_field - 9 - (9 * $i) == 47 || $_field - 9 - (9 * $i) == 55 || $_field - 9 - (9 * $i) == 63){
                    break;
                } */
            }
        } else {
            for ($i = 0; $i < 7; $i++) {
                if ($_field + 7 + (7 * $i) > 63) {
                    break;
                }
                if (GetFieldRow($_field + 7 + (7 * $i)) <= GetFieldRow($_field + (7 * $i))) {
                    break;
                }
                if (GetFieldRow($_field + 7 + (7 * $i)) - GetFieldRow($_field + (7 * $i)) > 1) {
                    break;
                }
                $_fieldsAvail[] = $_field + 7 + (7 * $i);
                /* if($_field + 7 + (7 * $i) == 0 || $_field + 7 + (7 * $i) == 8 || $_field + 7 + (7 * $i) == 16 || $_field + 7 + (7 * $i) == 24 || $_field + 7 + (7 * $i) == 32 || $_field + 7 + (7 * $i) == 40 || $_field + 7 + (7 * $i) == 48 || $_field + 7 + (7 * $i) == 56){
                    break;
                }
                if($_field + 7 + (7 * $i) == 7 || $_field + 7 + (7 * $i) == 15 || $_field + 7 + (7 * $i) == 23 || $_field + 7 + (7 * $i) == 31 || $_field + 7 + (7 * $i) == 39 || $_field + 7 + (7 * $i) == 47 || $_field + 7 + (7 * $i) == 55 || $_field + 7 + (7 * $i) == 63){
                    break;
                } */
            }
        }
    }
    return ($_fieldsAvail);
}
function CutFieldsAtEnemyOrAlly($_fields, $_isWhite = 1, $_canKill = 1)
{
    // MAYBE SELECT CHILD USING QUERY SELECTOR
    if (count($_fields) == 0) {
        return ($_fields);
    }
    for ($index = 0; $index < count($_fields); $index++) {

        if ($_SESSION['fields'][$_fields[$index]] != 'empty') {
            if ($_isWhite == 1) {
                if (GetFieldFigureColor($_fields[$index]) == 0) {
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
                if (GetFieldFigureColor($_fields[$index]) == 1) {
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
            } else {
                if (GetFieldFigureColor($_fields[$index]) == 1) {
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
                if (GetFieldFigureColor($_fields[$index]) == 0) {
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
            }
        }
    }
    return ($_fields);
}
function GetAttackField($_fields, $_isWhite = 1, $_canKill = 1)
{
    $_canAttackFields = [];
    if (count($_fields) == 0) {
        return ($_fields);
    }
    for ($index = 0; $index < count($_fields); $index++) {

        if ($_SESSION['fields'][$_fields[$index]] != 'empty') {
            if ($_isWhite == 1) {
                if (GetFieldFigureColor($_fields[$index]) == 0) {
                    if ($_canKill) {
                        array_push($_canAttackFields, $_fields[$index]);
                    }
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
                if (GetFieldFigureColor($_fields[$index]) == 1) {
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
            } else {
                if (GetFieldFigureColor($_fields[$index]) == 1) {
                    if ($_canKill) {
                        array_push($_canAttackFields, $_fields[$index]);
                    }
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
                if (GetFieldFigureColor($_fields[$index]) == 0) {
                    $_fields = array_slice($_fields, 0, $index);
                    break;
                }
            }
        }
    }
    return ($_canAttackFields);
}
#endregion END MOVEMENT CHECK METHODS

if (filter_has_var(INPUT_POST, 'process')) {

    // Start of NewConn
    if ($_POST['process'] == "newConn") {
        NewConn();
    }
    // End of NewConn

    // Start of GameStatus
    if ($_POST['process'] == "gameStatus") {
        CheckGameStatus();
    }
    // End of GameStatus

    // Start of GetFields
    if ($_POST['process'] == "getFields") {
        SendFields();
    }
    // End of GetFields

    // Start of GetCurrentPlayer
    if ($_POST['process'] == "getCurrentPlayer") {
        SendCurrentPlayer();
    }
    // End of GetCurrentPlayer

    // Start of PlayerMove
    if ($_POST['process'] == "playerMove") {
        PlayerMove();
    }
    // End of PlayerMove

    // Start of CanTogglePlayer
    if ($_POST['process'] == "getBreakOption") {
        GetBreakOption();
    }
    // End of CanTogglePlayer

    // Start of SendPromotionPick
    if ($_POST['process'] == "sendPromotionPick") {
        SendPromotionPick();
    }
    // End of CanTogglePlayer

    // Start of GetPromotedPick
    if ($_POST['process'] == "getPromotedPick") {
        SendPromotedFigure();
    }
    // End of GetPromotedPick

    // Start of NewGame
    if ($_POST['process'] == "newGameContinue") {
        NewGameContinue();
    }
    // End of NewGame

    // Start of ResetBoard
    if ($_POST['process'] == "reset") {
    }
    // End of Reset

    // Start of WhiteMove
    /* if ($_POST['process'] == "WhiteMove") {
        if (isset($_POST['MoveToField']) && isset($_POST['MoveFromField'])) {

            if ($_SESSION['winner'] != "unset") {
                $_SESSION['msg'] .= "Error: Someone already won! \r\n";
                exit();
            }

            $MoveToField = trim(htmlspecialchars($_POST['MoveToField']));
            $MoveFromField = trim(htmlspecialchars($_POST['MoveFromField']));

            if (!empty($MoveToField) && !empty($MoveFromField)) {

                if ($MoveToField >= 0 && $MoveFromField <= 63 && $MoveFromField >= 0 && $MoveFromField <= 63) {
                } else {
                    $_SESSION['msg'] .= "Error: Wrong field data (Out of range)! \r\n";
                }
            } else {
                $_SESSION['msg'] .= "Error: Some data was empty! \r\n";
            }
        } else {
            $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
        }
    } */
    // End of WhiteMove

    // Start of BlackMove
    /* if ($_POST['process'] == "BlackMove") {
        if (isset($_POST['MoveToField']) && isset($_POST['MoveFromField'])) {

            if ($_SESSION['winner'] != "unset") {
                $_SESSION['msg'] .= "Error: Someone already won! \r\n";
                exit();
            }

            $MoveToField = trim(htmlspecialchars($_POST['MoveToField']));
            $MoveFromField = trim(htmlspecialchars($_POST['MoveFromField']));

            if (!empty($MoveToField) && !empty($MoveFromField)) {

                if ($MoveToField >= 0 && $MoveFromField <= 63 && $MoveFromField >= 0 && $MoveFromField <= 63) {
                } else {
                    $_SESSION['msg'] .= "Error: Wrong field data (Out of range)! \r\n";
                }
            } else {
                $_SESSION['msg'] .= "Error: Some data was empty! \r\n";
            }
        } else {
            $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
        }
    } */
    // End of BlackMove

    // Start of WhitePromote
    /* if ($_POST['process'] == "WhitePromote") {
        if (isset($_POST['PromotionField']) && isset($_POST['PromotionFigure'])) {

            if ($_SESSION['winner'] != "unset") {
                $_SESSION['msg'] .= "Error: Someone already won! \r\n";
                exit();
            }

            $PromotionField = trim(htmlspecialchars($_POST['PromotionField']));
            $PromotionFigure = trim(htmlspecialchars($_POST['PromotionFigure']));

            if (!empty($PromotionField) && !empty($PromotionFigure)) {

                if ($PromotionField >= 0 && $PromotionField <= 7) {

                    if ($PromotionFigure < count($graveWhite)) {
                    } else {
                        $_SESSION['msg'] .= "Error: Wrong grave figure data! \r\n";
                    }
                } else {
                    $_SESSION['msg'] .= "Error: Wrong field data! \r\n";
                }
            } else {
                $_SESSION['msg'] .= "Error: Some data was empty! \r\n";
            }
        } else {
            $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
        }
    } */
    // End of WhitePromote

    // Start of BlackPromote
    /* if ($_POST['process'] == "BlackPromote") {
        if (isset($_POST['PromotionField']) && isset($_POST['PromotionFigure'])) {

            if ($_SESSION['winner'] != "unset") {
                $_SESSION['msg'] .= "Error: Someone already won! \r\n";
                exit();
            }

            $PromotionField = trim(htmlspecialchars($_POST['PromotionField']));
            $PromotionFigure = trim(htmlspecialchars($_POST['PromotionFigure']));

            if (!empty($PromotionField) && !empty($PromotionFigure)) {

                if ($PromotionField >= 56 && $PromotionField <= 63) {

                    if ($PromotionFigure < count($graveBlack)) {
                    } else {
                        $_SESSION['msg'] .= "Error: Wrong grave figure data! \r\n";
                    }
                } else {
                    $_SESSION['msg'] .= "Error: Wrong field data! \r\n";
                }
            } else {
                $_SESSION['msg'] .= "Error: Some data was empty! \r\n";
            }
        } else {
            $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
        }
    } */
    // End of BlackPromote

    /* header("Location: ../index.php"); */
    echo $_SESSION['msg'];
    unset($_POST);
    exit();
}
#region HandleFigureMoves
function HandleFigureMove($_moveToField, $_moveFromField, $_isWhite = 1)
{
    $_canMoveToFields = [];
    $_canAttackFields = [];

    $_moveOK = "MoveBAD";

    $_moveFigure = GetFieldFigure($_moveFromField);
    switch ($_moveFigure) {
        case 'pawn':
            $_canMoveToFields = GetPawnMoveFields($_moveFromField, $_isWhite);
            $_canAttackFields = GetPawnAttackFields($_moveFromField, $_isWhite);
            break;
        case 'rook':
            $_canMoveToFields = GetRookMoveFields($_moveFromField, $_isWhite);
            $_canAttackFields = GetRookAttackFields($_moveFromField, $_isWhite);
            break;
        case 'knight':
            $_canMoveToFields = GetKnightMoveFields($_moveFromField, $_isWhite);
            $_canAttackFields = GetKnightAttackFields($_moveFromField, $_isWhite);
            break;
        case 'bishop':
            $_canMoveToFields = GetBishopMoveFields($_moveFromField, $_isWhite);
            $_canAttackFields = GetBishopAttackFields($_moveFromField, $_isWhite);
            break;
        case 'queen':
            $_canMoveToFields = GetQueenMoveFields($_moveFromField, $_isWhite);
            $_canAttackFields = GetQueenAttackFields($_moveFromField, $_isWhite);
            break;
        case 'king':
            $_canMoveToFields = GetKingMoveFields($_moveFromField, $_isWhite);
            $_canAttackFields = GetKingAttackFields($_moveFromField, $_isWhite);
            break;

        default:
            break;
    }

    // IF MOVE TO FIELD IS ON LIST MOVE OK
    for ($i = 0; $i < count($_canAttackFields); $i++) {
        if ($_moveToField == $_canAttackFields[$i]) {
            $_moveOK = "MoveOK";
        }
    }
    for ($i = 0; $i < count($_canMoveToFields); $i++) {
        if ($_moveToField == $_canMoveToFields[$i]) {
            $_moveOK = "MoveOK";
        }
    }

    // TODO FIX TO CHECK IF YOU CAN MOVE ON FIELD WITHOUT HAVING CHECK
    // IF  MOVE BAD
    $_check = CheckForCheck();
    if($_check[0] == "1"){
        if($_isWhite == 1){
            $_moveOK = "MoveBAD";
        }
    }
    if($_check[2] == "1"){
        if($_isWhite == 0){
            $_moveOK = "MoveBAD";
        }
    }
    echo ($_moveOK);
    if ($_moveOK == "MoveBAD") exit();
    MoveFigureToField($_moveFromField, $_moveToField);
    $_canTogglePlayer = CanTogglePlayer();
    switch ($_canTogglePlayer) {
        case 'Promotion':
            # code...
            break;
        case 'ToggleOK':
            TogglePlayer();
            break;

        default:
            # code...
            break;
    }
}
#endregion HandleFigureMoves

// TODO do this in check all figures method
// array_push($_SESSION['whiteAttackFields'], $_fields[$index])

// RENAME TO CutFieldsAtEnemyOrAlly

function CheckForCheck()
{
    $_SESSION['whiteCanAttack'] = [];
    $_SESSION['blackCanAttack'] = [];

    $_whiteKing = null;
    $_blackKing = null;

    for ($i = 0; $i < count($_SESSION['fields']); $i++) {
        if (CheckIfFieldEmpty($i) == 0) {
            
            if (GetFieldFigureColor($i) == 1) {

                $_whiteCanAttack = PerformAttackCheck($i, 1);
                
                if(count($_whiteCanAttack) > 0){
                    $_SESSION['whiteCanAttack'] = array_merge($_SESSION['whiteCanAttack'], PerformAttackCheck($i, 1));
                }
                

                if (GetFieldFigure($i) == "king") $_whiteKing = $i;
            } else if (GetFieldFigureColor($i) == 0) {

                $_blackCanAttack = PerformAttackCheck($i, 0);

                if(count($_blackCanAttack) > 0){
                    $_SESSION['blackCanAttack'] = array_merge($_SESSION['blackCanAttack'], $_blackCanAttack);
                }

                if (GetFieldFigure($i) == "king") $_blackKing = $i;
            }
        }
    }

    $_whiteHasCheck = 0;
    $_blackHasCheck = 0;

    /* print_r($_SESSION['blackCanAttack']); */
    /* print_r($_SESSION['whiteCanAttack']); */

    for ($i = 0; $i < count($_SESSION['whiteCanAttack']); $i++) {
        if ($_blackKing == $_SESSION['whiteCanAttack'][$i]) $_blackHasCheck = 1;
    }
    for ($i = 0; $i < count($_SESSION['blackCanAttack']); $i++) {
        if ($_whiteKing == $_SESSION['blackCanAttack'][$i]) $_whiteHasCheck = 1;
    }

    return($_whiteHasCheck . "," . $_blackHasCheck);
}

// Must return all fields a figure can attack
function PerformAttackCheck($_field, $_isWhite)
{
    $_figure = GetFieldFigure($_field);
    switch ($_figure) {
        case 'pawn':
            return(GetPawnAttackFields($_field, $_isWhite));
            break;
        case 'rook':
            return GetRookAttackFields($_field, $_isWhite);
            break;
        case 'bishop':
            return GetBishopAttackFields($_field, $_isWhite);
            break;
        case 'knight':
            return GetKnightAttackFields($_field, $_isWhite);
            break;
        case 'queen':
            return GetQueenAttackFields($_field, $_isWhite);
            break;
        case 'king':
            return GetKingAttackFields($_field, $_isWhite);
            break;

        default:
        return null;
            break;
    }
}

#region GetFigureMoveFields
function GetPawnMoveFields($_moveFromField, $_isWhite = 1)
{
    $_moveFieldsAvail = [];
    $_moveFieldsAvail = GetFieldsVertically($_moveFromField, 1, $_isWhite);

    if ($_isWhite == 1) {
        if ($_moveFromField >= 8 && $_moveFromField <= 15) {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 2);
        } else {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 1);
        }
    } else if ($_isWhite == 0) {
        if ($_moveFromField >= 47 && $_moveFromField <= 55) {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 2);
        } else {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 1);
        }
    }
    $_moveFieldsAvail = CutFieldsAtEnemyOrAlly($_moveFieldsAvail, $_isWhite, 0);
    return ($_moveFieldsAvail);
}
function GetRookMoveFields($_moveFromField, $_isWhite = 1)
{
    $_moveFieldsAvail = [];

    $_fieldsAhead = CutFieldsAtEnemyOrAlly(GetFieldsVertically($_moveFromField, 1, $_isWhite), $_isWhite);
    $_fieldsBehind = CutFieldsAtEnemyOrAlly(GetFieldsVertically($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsLeft = CutFieldsAtEnemyOrAlly(GetFieldsHorizontally($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsRight = CutFieldsAtEnemyOrAlly(GetFieldsHorizontally($_moveFromField, 1, $_isWhite), $_isWhite);

    $_moveFieldsAvail = array_merge($_fieldsAhead, $_fieldsBehind);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeft);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRight);

    return ($_moveFieldsAvail);
}
function GetBishopMoveFields($_moveFromField, $_isWhite = 1)
{
    $_moveFieldsAvail = [];

    $_fieldsLeftBot = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 0, 0, $_isWhite), $_isWhite);
    $_fieldsLeftTop = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 1, 0, $_isWhite), $_isWhite);
    $_fieldsRightBot = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 0, 1, $_isWhite), $_isWhite);
    $_fieldsRightTop = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 1, 1, $_isWhite), $_isWhite);

    $_moveFieldsAvail = array_merge($_fieldsLeftBot, $_fieldsLeftTop);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRightBot);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRightTop);

    return ($_moveFieldsAvail);
}
function GetKnightMoveFields($_moveFromField, $_isWhite = 1)
{
    $_moveFieldsAvail = [];

    $_fieldsAhead = array_slice(GetFieldsVertically($_moveFromField, 1, $_isWhite), 0, 2);
    $_fieldsBehind = array_slice(GetFieldsVertically($_moveFromField, 0, $_isWhite), 0, 2);
    $_fieldsLeft = array_slice(GetFieldsHorizontally($_moveFromField, 0, $_isWhite), 0, 2);
    $_fieldsRight = array_slice(GetFieldsHorizontally($_moveFromField, 1, $_isWhite), 0, 2);

    if (isset($_fieldsAhead[1])) {

        $_top1 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsHorizontally($_fieldsAhead[1], 1, $_isWhite), 0, 1), $_isWhite, 1);
        $_top2 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsHorizontally($_fieldsAhead[1], 0, $_isWhite), 0, 1), $_isWhite, 1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_top1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_top2);
    }

    if (isset($_fieldsRight[1])) {
        $_right1 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsVertically($_fieldsRight[1], 1, $_isWhite), 0, 1), $_isWhite, 1);
        $_right2 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsVertically($_fieldsRight[1], 0, $_isWhite), 0, 1), $_isWhite, 1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_right1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_right2);
    }

    if (isset($_fieldsLeft[1])) {
        $_left1 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsVertically($_fieldsLeft[1], 1, $_isWhite), 0, 1), $_isWhite, 1);
        $_left2 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsVertically($_fieldsLeft[1], 0, $_isWhite), 0, 1), $_isWhite, 1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_left1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_left2);
    }

    if (isset($_fieldsBehind[1])) {
        $_bot1 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsHorizontally($_fieldsBehind[1], 1, $_isWhite), 0, 1), $_isWhite, 1);
        $_bot2 = CutFieldsAtEnemyOrAlly(array_slice(GetFieldsHorizontally($_fieldsBehind[1], 0, $_isWhite), 0, 1), $_isWhite, 1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_bot1);
        $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_bot2);
    }

    return ($_moveFieldsAvail);
}
function GetQueenMoveFields($_moveFromField, $_isWhite = 1)
{
    $_moveFieldsAvail = [];

    $_fieldsAhead = CutFieldsAtEnemyOrAlly(GetFieldsVertically($_moveFromField, 1, $_isWhite), $_isWhite);
    $_fieldsBehind = CutFieldsAtEnemyOrAlly(GetFieldsVertically($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsLeft = CutFieldsAtEnemyOrAlly(GetFieldsHorizontally($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsRight = CutFieldsAtEnemyOrAlly(GetFieldsHorizontally($_moveFromField, 1, $_isWhite), $_isWhite);

    $_moveFieldsAvail = array_merge($_fieldsAhead, $_fieldsBehind);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeft);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRight);

    $_fieldsLeftBot = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 0, 0, $_isWhite), $_isWhite);
    $_fieldsLeftTop = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 1, 0, $_isWhite), $_isWhite);
    $_fieldsRightBot = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 0, 1, $_isWhite), $_isWhite);
    $_fieldsRightTop = CutFieldsAtEnemyOrAlly(GetFieldsDiagonally($_moveFromField, 1, 1, $_isWhite), $_isWhite);

    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeftTop);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRightBot);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeftBot);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRightTop);

    return ($_moveFieldsAvail);
}
function GetKingMoveFields($_moveFromField, $_isWhite = 1)
{
    $_moveFieldsAvail = [];

    $_fieldsAhead = GetFieldsVertically($_moveFromField, 1, $_isWhite);
    $_fieldsBehind = GetFieldsVertically($_moveFromField, 0, $_isWhite);
    $_fieldsLeft = GetFieldsHorizontally($_moveFromField, 0, $_isWhite);
    $_fieldsRight = GetFieldsHorizontally($_moveFromField, 1, $_isWhite);

    $_fieldsAhead = array_slice($_fieldsAhead, 0, 1);
    $_fieldsBehind = array_slice($_fieldsBehind, 0, 1);
    $_fieldsLeft = array_slice($_fieldsLeft, 0, 1);
    $_fieldsRight = array_slice($_fieldsRight, 0, 1);

    $_fieldsAhead = CutFieldsAtEnemyOrAlly($_fieldsAhead, $_isWhite);
    $_fieldsBehind = CutFieldsAtEnemyOrAlly($_fieldsBehind, $_isWhite);
    $_fieldsLeft = CutFieldsAtEnemyOrAlly($_fieldsLeft, $_isWhite);
    $_fieldsRight = CutFieldsAtEnemyOrAlly($_fieldsRight, $_isWhite);

    $_moveFieldsAvail = array_merge($_fieldsAhead, $_fieldsBehind);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeft);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRight);

    $_fieldsLeftBot = GetFieldsDiagonally($_moveFromField, 0, 0, $_isWhite);
    $_fieldsLeftTop = GetFieldsDiagonally($_moveFromField, 1, 0, $_isWhite);
    $_fieldsRightBot = GetFieldsDiagonally($_moveFromField, 0, 1, $_isWhite);
    $_fieldsRightTop = GetFieldsDiagonally($_moveFromField, 1, 1, $_isWhite);

    $_fieldsLeftBot = array_slice($_fieldsLeftBot, 0, 1);
    $_fieldsLeftTop = array_slice($_fieldsLeftTop, 0, 1);
    $_fieldsRightBot = array_slice($_fieldsRightBot, 0, 1);
    $_fieldsRightTop = array_slice($_fieldsRightTop, 0, 1);

    $_fieldsLeftBot = CutFieldsAtEnemyOrAlly($_fieldsLeftBot, $_isWhite);
    $_fieldsLeftTop = CutFieldsAtEnemyOrAlly($_fieldsLeftTop, $_isWhite);
    $_fieldsRightBot = CutFieldsAtEnemyOrAlly($_fieldsRightBot, $_isWhite);
    $_fieldsRightTop = CutFieldsAtEnemyOrAlly($_fieldsRightTop, $_isWhite);

    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeftTop);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRightBot);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsLeftBot);
    $_moveFieldsAvail = array_merge($_moveFieldsAvail, $_fieldsRightTop);

    return ($_moveFieldsAvail);
}
#endregion GetFigureMoveFields

#region GetFigureAttackFields
function GetPawnAttackFields($_moveFromField, $_isWhite = 1)
{
    $_attackFieldsAvail = [];
    $_attackFieldsAvail = GetAttackField(array_slice(getFieldsDiagonally($_moveFromField, 1, 0, $_isWhite), 0, 1), $_isWhite);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, GetAttackField(array_slice(getFieldsDiagonally($_moveFromField, 1, 1, $_isWhite), 0, 1), $_isWhite));
    return ($_attackFieldsAvail);
}
function GetRookAttackFields($_moveFromField, $_isWhite = 1)
{
    $_attackFieldsAvail = [];

    $_fieldsAhead = GetAttackField(GetFieldsVertically($_moveFromField, 1, $_isWhite), $_isWhite);
    $_fieldsBehind = GetAttackField(GetFieldsVertically($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsLeft = GetAttackField(GetFieldsHorizontally($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsRight = GetAttackField(GetFieldsHorizontally($_moveFromField, 1, $_isWhite), $_isWhite);

    $_attackFieldsAvail = array_merge($_fieldsAhead, $_fieldsBehind);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeft);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRight);

    return ($_attackFieldsAvail);
}
function GetBishopAttackFields($_moveFromField, $_isWhite = 1)
{
    $_attackFieldsAvail = [];

    $_fieldsLeftBot = GetAttackField(GetFieldsDiagonally($_moveFromField, 0, 0, $_isWhite), $_isWhite);
    $_fieldsLeftTop = GetAttackField(GetFieldsDiagonally($_moveFromField, 1, 0, $_isWhite), $_isWhite);
    $_fieldsRightBot = GetAttackField(GetFieldsDiagonally($_moveFromField, 0, 1, $_isWhite), $_isWhite);
    $_fieldsRightTop = GetAttackField(GetFieldsDiagonally($_moveFromField, 1, 1, $_isWhite), $_isWhite);

    $_attackFieldsAvail = array_merge($_fieldsLeftBot, $_fieldsLeftTop);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRightBot);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRightTop);

    return ($_attackFieldsAvail);
}
function GetKnightAttackFields($_moveFromField, $_isWhite = 1)
{
    $_attackFieldsAvail = [];

    $_fieldsAhead = array_slice(GetFieldsVertically($_moveFromField, 1, $_isWhite), 0, 2);
    $_fieldsBehind = array_slice(GetFieldsVertically($_moveFromField, 0, $_isWhite), 0, 2);
    $_fieldsLeft = array_slice(GetFieldsHorizontally($_moveFromField, 0, $_isWhite), 0, 2);
    $_fieldsRight = array_slice(GetFieldsHorizontally($_moveFromField, 1, $_isWhite), 0, 2);

    if (isset($_fieldsAhead[1])) {
        $_top1 = GetAttackField(array_slice(GetFieldsHorizontally($_fieldsAhead[1], 1, $_isWhite), 0, 1), $_isWhite);
        $_top2 = GetAttackField(array_slice(GetFieldsHorizontally($_fieldsAhead[1], 0, $_isWhite), 0, 1), $_isWhite);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_top1);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_top2);
    }

    if (isset($_fieldsRight[1])) {
        $_right1 = GetAttackField(array_slice(GetFieldsVertically($_fieldsRight[1], 1, $_isWhite), 0, 1), $_isWhite);
        $_right2 = GetAttackField(array_slice(GetFieldsVertically($_fieldsRight[1], 0, $_isWhite), 0, 1), $_isWhite);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_right1);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_right2);
    }

    if (isset($_fieldsLeft[1])) {
        $_left1 = GetAttackField(array_slice(GetFieldsVertically($_fieldsLeft[1], 1, $_isWhite), 0, 1), $_isWhite);
        $_left2 = GetAttackField(array_slice(GetFieldsVertically($_fieldsLeft[1], 0, $_isWhite), 0, 1), $_isWhite);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_left1);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_left2);
    }

    if (isset($_fieldsBehind[1])) {
        $_bot1 = GetAttackField(array_slice(GetFieldsHorizontally($_fieldsBehind[1], 1, $_isWhite), 0, 1), $_isWhite);
        $_bot2 = GetAttackField(array_slice(GetFieldsHorizontally($_fieldsBehind[1], 0, $_isWhite), 0, 1), $_isWhite);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_bot1);
        $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_bot2);
    }

    return ($_attackFieldsAvail);
}
function GetQueenAttackFields($_moveFromField, $_isWhite = 1)
{
    $_attackFieldsAvail = [];

    $_fieldsAhead = GetAttackField(GetFieldsVertically($_moveFromField, 1, $_isWhite), $_isWhite);
    $_fieldsBehind = GetAttackField(GetFieldsVertically($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsLeft = GetAttackField(GetFieldsHorizontally($_moveFromField, 0, $_isWhite), $_isWhite);
    $_fieldsRight = GetAttackField(GetFieldsHorizontally($_moveFromField, 1, $_isWhite), $_isWhite);

    $_attackFieldsAvail = array_merge($_fieldsAhead, $_fieldsBehind);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeft);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRight);

    $_fieldsLeftBot = GetAttackField(GetFieldsDiagonally($_moveFromField, 0, 0, $_isWhite), $_isWhite);
    $_fieldsLeftTop = GetAttackField(GetFieldsDiagonally($_moveFromField, 1, 0, $_isWhite), $_isWhite);
    $_fieldsRightBot = GetAttackField(GetFieldsDiagonally($_moveFromField, 0, 1, $_isWhite), $_isWhite);
    $_fieldsRightTop = GetAttackField(GetFieldsDiagonally($_moveFromField, 1, 1, $_isWhite), $_isWhite);

    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeftTop);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeftBot);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRightBot);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRightTop);

    return ($_attackFieldsAvail);
}
function GetKingAttackFields($_moveFromField, $_isWhite = 1)
{
    $_attackFieldsAvail = [];

    $_fieldsAhead = GetFieldsVertically($_moveFromField, 1, $_isWhite);
    $_fieldsBehind = GetFieldsVertically($_moveFromField, 0, $_isWhite);
    $_fieldsLeft = GetFieldsHorizontally($_moveFromField, 0, $_isWhite);
    $_fieldsRight = GetFieldsHorizontally($_moveFromField, 1, $_isWhite);

    $_fieldsAhead = array_slice($_fieldsAhead, 0, 1);
    $_fieldsBehind = array_slice($_fieldsBehind, 0, 1);
    $_fieldsLeft = array_slice($_fieldsLeft, 0, 1);
    $_fieldsRight = array_slice($_fieldsRight, 0, 1);

    $_fieldsAhead = GetAttackField($_fieldsAhead, $_isWhite);
    $_fieldsBehind = GetAttackField($_fieldsBehind, $_isWhite);
    $_fieldsLeft = GetAttackField($_fieldsLeft, $_isWhite);
    $_fieldsRight = GetAttackField($_fieldsRight, $_isWhite);

    $_attackFieldsAvail = array_merge($_fieldsAhead, $_fieldsBehind);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeft);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRight);

    $_fieldsLeftBot = GetFieldsDiagonally($_moveFromField, 0, 0, $_isWhite);
    $_fieldsLeftTop = GetFieldsDiagonally($_moveFromField, 1, 0, $_isWhite);
    $_fieldsRightBot = GetFieldsDiagonally($_moveFromField, 0, 1, $_isWhite);
    $_fieldsRightTop = GetFieldsDiagonally($_moveFromField, 1, 1, $_isWhite);

    $_fieldsLeftBot = array_slice($_fieldsLeftBot, 0, 1);
    $_fieldsLeftTop = array_slice($_fieldsLeftTop, 0, 1);
    $_fieldsRightBot = array_slice($_fieldsRightBot, 0, 1);
    $_fieldsRightTop = array_slice($_fieldsRightTop, 0, 1);

    $_fieldsLeftBot = GetAttackField($_fieldsLeftBot, $_isWhite);
    $_fieldsLeftTop = GetAttackField($_fieldsLeftTop, $_isWhite);
    $_fieldsRightBot = GetAttackField($_fieldsRightBot, $_isWhite);
    $_fieldsRightTop = GetAttackField($_fieldsRightTop, $_isWhite);

    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeftTop);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsLeftBot);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRightBot);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, $_fieldsRightTop);

    return ($_attackFieldsAvail);
}
#endregion GetFigureAttackFields
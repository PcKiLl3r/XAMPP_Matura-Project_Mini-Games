<?php
session_start();

$whiteCanAttackFields = [];
$blackCanAttackFields = [];

$graveWhite = [];
$graveBlack = [];

if (!isset($_SESSION['playerTurn'])) {
    $_SESSION['playerTurn'] = 'unset';
}

$_SESSION['winner'] = 'unset';

$_SESSION['msg'] = '';

#region UTILITY METHODS
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
            NewGame();
            $_SESSION['gameStatus'] = 'inprogress';
        }
        if ($_SESSION['gameStatus'] == 'inprogress') {
            echo 'InProgress';
            exit();
            /* print_r($_SESSION['fields']); */
        }
        echo 'CantStartGame';
    } else {
        $_SESSION['gameStatus'] = 'inactive';
        CheckGameStatus();
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

        if (!empty($MoveToField) && !empty($MoveFromField)) {

            if ($MoveToField >= 0 && $MoveFromField <= 63 && $MoveFromField >= 0 && $MoveFromField <= 63) {
                if ($_SESSION['playerTurn'] == "1") {
                    if (GetFieldFigureColor($MoveFromField) == 1) {
                        $_moveFigure = GetFieldFigure($MoveFromField);
                        switch ($_moveFigure) {
                            case 'pawn':
                                HandlePawnMove($MoveToField, $MoveFromField, 1);
                                break;
                            case 'rook':

                                break;
                            case 'knight':

                                break;
                            case 'bishop':

                                break;
                            case 'queen':

                                break;
                            case 'king':

                                break;

                            default:
                                break;
                        }
                    } else {
                        //Error NOT your turn!
                        echo("Not your figure");
                    }
                } else if ($_SESSION['playerTurn'] == "2") {
                    if (GetFieldFigureColor($MoveFromField) == 0) {
                        
                        $_moveFigure = GetFieldFigure($MoveFromField);
                        switch ($_moveFigure) {
                            case 'pawn':
                                HandlePawnMove($MoveToField, $MoveFromField, 0);
                                break;
                            case 'rook':

                                break;
                            case 'knight':

                                break;
                            case 'bishop':

                                break;
                            case 'queen':

                                break;
                            case 'king':

                                break;

                            default:
                                break;
                        }
                    } else {
                        //Error NOT your turn!
                        echo("Not your figure");
                    }
                } else if ($_SESSION['playerTurn'] == 'unset') {
                    header("Location: ../../index.php");
                }
            } else {
                $_SESSION['msg'] .= "Error: Wrong field data (Out of range)! \r\n";
            }
        } else {
            $_SESSION['msg'] .= "Error: Some data was empty! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
function NewGame()
{
    $_SESSION['fields'] = [];
    $graveWhite = [];
    $graveBlack = [];
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
}
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
    
    if($_color == "white") {$_color = 1;}
    else if($_color == "black") {$_color = 0;}
    return ($_color);
}
function GetFieldFigure($_field)
{
    $_figure = substr($_SESSION['fields'][$_field], 6);
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
        $graveWhite[] = $_SESSION['fields'][$_field];
        $_SESSION['fields'][$_field] = 'empty';
    } else if (GetFieldFigureColor($_field) == 0) {
        $graveBlack[] = $_SESSION['fields'][$_field];
        $_SESSION['fields'][$_field] = 'empty';
    } else {
        $_SESSION['msg'] .= "Error: Color undefined can't be moved to grave.\r\n";
    }
}
#endregion END UTILITY METHODS

#region MOVEMENT CHECK METHODS
function GetFieldsHorizontally($_field, $_isRight = 1, $_isWhite = 1)
{
    $_fieldsAvail = [];

    $_row = GetFieldRow($_field);
    if ($_isRight) $_isWhite = !$_isWhite;

    if ($_isWhite) {
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
    if ($_isAhead) $_isWhite = !$_isWhite;

    if ($_isWhite) {
        for ($i = 0; $i < $_row; $i++) {
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
        for ($i = 0; $i < $_row; $i++) {
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
    return ($_fieldsAvail);
}
function GetFieldsDiagonally($_field, $_isAhead = 1, $_isRight = 1, $_isWhite = 1)
{
    $_fieldsAvail = [];

    if (!$_isWhite) {
        $_isRight = !$_isRight;
        $_isAhead = !$_isAhead;
    }

    if ($_isRight) {
        if ($_isAhead) {
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
        if ($_isAhead) {
            for ($i = 0; $i < 7; $i++) {
                if ($_field - 9 - (9 * $i) < 0) {
                    break;
                }
                if (GetFieldRow($_field - 9 - (9 * $i)) >= GetFieldRow($_field + (9 * $i))) {
                    break;
                }
                if (GetFieldRow($_field - 9 - (9 * $i)) - GetFieldRow($_field + (9 * $i)) < -1) {
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
                if (GetFieldRow($_field + 7 + (7 * $i)) <= GetFieldRow($_field + (9 * $i))) {
                    break;
                }
                if (GetFieldRow($_field + 7 + (7 * $i)) - GetFieldRow($_field + (9 * $i)) > 1) {
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
#endregion END MOVEMENT CHECK METHODS
function PromotePawn($_figure)
{
    $promField = GetPawnPromotionField();
    $_promOK = "PromotionOK";
    if($_SESSION['playerTurn'] == 1){
        $_SESSION['fields'][$promField] = 'white-' . $_figure;
    } else if($_SESSION['playerTurn'] == 2){
        $_SESSION['fields'][$promField] = 'black-' . $_figure;
    } else {
        $_promOK = "PromotionBAD";
    }
    $_SESSION['pawnPromotedTo'][0] = $_SESSION['fields'][$promField];
    $_SESSION['pawnPromotedTo'][1] = $promField;
    echo($_promOK);
    return($_promOK);
}
function SendPromotedFigure()
{
    echo $_SESSION['pawnPromotedTo'][0] . ' ' . $_SESSION['pawnPromotedTo'][1];
}
function GetPawnPromotionField()
{
    $_pawnPromField = null;
    if($_SESSION['playerTurn'] == 1){
        for ($i=0; $i < count($_SESSION['fields']); $i++){
            if(GetFieldFigure($i) == 'pawn'){
                if($i <= 63 && $i >= 56){
                    $_pawnPromField = $i;
                }
            }
        }
    } else if($_SESSION['playerTurn'] == 2){
        for ($i=0; $i < count($_SESSION['fields']); $i++){
            if(GetFieldFigure($i) == 'pawn'){
                if($i <= 7 && $i >= 0){
                    $_pawnPromField = $i;
                }
            }
        }
    }
    return($_pawnPromField);
}
function CanTogglePlayer()
{
    // TODO
    // 1. CHECK FOR CHECK
    // 2. CHECK FOR PROMOTION - inPROG
    // 3. CHECK FOR END

    // CHECK FOR PROMOTION
    if(GetPawnPromotionField() != null) $_SESSION['breakOption'] = "Promotion";
    else $_SESSION['breakOption'] = "ToggleOK";
    return($_SESSION['breakOption']);
}
function GetBreakOption()
{
    echo($_SESSION['breakOption']);
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
            
            if(PromotePawn($promotionFigure) == "PromotionOK"){
                TogglePlayer();
            }
        } else {
            $_SESSION['msg'] .= "Error: Some data was empty! \r\n";
        }
    } else {
        $_SESSION['msg'] .= "Error: Some data was not sent/set in session! \r\n";
    }
}
// Check if form was submitted
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
    if ($_POST['process'] == "newGame") {
        NewGame();
    }
    // End of NewGame

    // Start of ResetBoard
    if ($_POST['process'] == "reset") {
    }
    // End of Reset

    // Start of WhiteMove
    if ($_POST['process'] == "WhiteMove") {
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
    }
    // End of WhiteMove

    // Start of BlackMove
    if ($_POST['process'] == "BlackMove") {
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
    }
    // End of BlackMove

    // Start of WhitePromote
    if ($_POST['process'] == "WhitePromote") {
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
    }
    // End of WhitePromote

    // Start of BlackPromote
    if ($_POST['process'] == "BlackPromote") {
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
    }
    // End of BlackPromote

    /* header("Location: ../index.php"); */
    echo $_SESSION['msg'];
    unset($_POST);
    exit();
}
// TODO Remake to HandleMove and pass figure
function HandlePawnMove($_moveToField, $_moveFromField, $_isWhite = 1)
{

    $_moveOK = "MoveBAD";

        $_canMoveToFields = GetPawnMoveFields($_moveFromField, $_isWhite);

        $_canAttackFields = GetPawnAttackFields($_moveFromField, $_isWhite);

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

    echo ($_moveOK);
    if($_moveOK == "MoveBAD") exit();
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
// TODO do this in check all figures method
// array_push($_SESSION['whiteAttackFields'], $_fields[$index])

// RENAME TO CutFieldsAtEnemyOrAlly
function CutFieldsAtEnemyOrAlly($_fields, $_isWhite = 1, $_canKill = 1)
{
    // MAYBE SELECT CHILD USING QUERY SELECTOR
    if (count($_fields) == 0) {
        return ($_fields);
    }
    for ($index = 0; $index < count($_fields); $index++) {

        if ($_SESSION['fields'][$_fields[$index]] != 'empty') {
            if ($_isWhite) {
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
function GetAttackFields($_fields, $_isWhite = 1, $_canKill = 1)
{
    $_canAttackFields = [];
    if (count($_fields) == 0) {
        return ($_fields);
    }
    for ($index = 0; $index < count($_fields); $index++) {

        if ($_SESSION['fields'][$_fields[$index]] != 'empty') {
            if ($_isWhite) {
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
function CheckForCheck(){
    $_SESSION['whiteCanAttack'] = [];
    $_SESSION['blackCanAttack'] = [];
    $_whiteKing = null;
    $_blackKing = null;
    for ($i=0; $i < count($_SESSION['fields']); $i++) {
        if(CheckIfFieldEmpty($_SESSION['fields'][$i]) == 0){
            if(GetFieldFigureColor($_SESSION['fields'][$i]) == 1){
                $_SESSION['whiteCanAttack'][] = PerformAttackCheck($_SESSION['fields'][$i]);

                if(GetFieldFigure($_SESSION['fields'][$i]) == "king") $_whiteKing = $i;
            } else if(GetFieldFigureColor($_SESSION['fields'][$i]) == 0) {
                $_SESSION['blackCanAttack'][] = PerformAttackCheck($_SESSION['fields'][$i]);

                if(GetFieldFigure($_SESSION['fields'][$i]) == "king") $_blackKing = $i;
            }
        }
    }
    $_whiteHasCheck = 0;
    $_blackHasCheck = 0;
    for ($i=0; $i < count($_SESSION['whiteCanAttack']); $i++) { 
        if($_blackKing == $_SESSION['whiteCanAttack'][$i]) $_blackHasCheck = 1;
    }
    for ($i=0; $i < count($_SESSION['blackCanAttack']); $i++) { 
        if($_whiteKing == $_SESSION['blackCanAttack'][$i]) $_whiteHasCheck = 1;
    }
}
// Must return all fields a figure can attack
function PerformAttackCheck($_field){
    $_figure = GetFieldFigure($_field);
    $_isWhite = GetFieldFigureColor($_field);
    switch ($_figure) {
        case 'pawn':
            if($_isWhite == 1) $_SESSION['whiteCanAttackFields'] = GetPawnAttackFields($_field, $_isWhite);
            else if($_isWhite == 0) $_SESSION['blackCanAttackFields'] = GetPawnAttackFields($_field, $_isWhite);
        break;
        
        default:
            # code...
            break;
    }
}

#region GetFigureMoveFields
function GetPawnMoveFields($_moveFromField, $_isWhite = 1){
    $_moveFieldsAvail = [];
    $_moveFieldsAvail = GetFieldsVertically($_moveFromField, 1, $_isWhite);
    
    if($_isWhite == 1){
        if ($_moveFromField >= 8 && $_moveFromField <= 15) {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 2);
        } else {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 1);
        }
    } else if($_isWhite == 0){
        if ($_moveFromField >= 47 && $_moveFromField <= 55) {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 2);
        } else {
            $_moveFieldsAvail = array_slice($_moveFieldsAvail, 0, 1);
        }
    }
    $_moveFieldsAvail = CutFieldsAtEnemyOrAlly($_moveFieldsAvail, $_isWhite, 0);
    return($_moveFieldsAvail);
}
#endregion GetFigureMoveFields

#region GetFigureAttackFields
function GetPawnAttackFields($_moveFromField, $_isWhite = 1){
    $_attackFieldsAvail = [];
    $_attackFieldsAvail = [];
    $_attackFieldsAvail = GetAttackFields(array_slice(getFieldsDiagonally($_moveFromField, 1, 0, !$_isWhite), 0, 1), $_isWhite);
    $_attackFieldsAvail = array_merge($_attackFieldsAvail, GetAttackFields(array_slice(getFieldsDiagonally($_moveFromField, 1, 1, !$_isWhite), 0, 1), $_isWhite));
    return($_attackFieldsAvail);
}
#endregion GetFigureAttackFields
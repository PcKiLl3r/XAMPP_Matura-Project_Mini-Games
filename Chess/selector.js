document.addEventListener('DOMContentLoaded', () => {

    let whiteFigure = document.createElement('div');
    whiteFigure.classList.add('figure','figure-white');

    let blackFigure = document.createElement('div');
    blackFigure.classList.add('figure','figure-black');

let whitePawnText = `<div class="chessCard">
    <div class="card-top bg-pawn-white"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let whiteRookText = `<div class="chessCard">
    <div class="card-top bg-rook-white"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let whiteKnightText = `<div class="chessCard">
    <div class="card-top bg-knight-white"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let whiteBishopText = `<div class="chessCard">
    <div class="card-top bg-bishop-white"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let whiteKingText = `<div class="chessCard">
    <div class="card-top bg-king-white"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let whiteQueenText = `<div class="chessCard">
    <div class="card-top bg-queen-white"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let blackPawnText = `<div class="chessCard">
    <div class="card-top bg-pawn"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let blackRookText = `<div class="chessCard">
    <div class="card-top bg-rook"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let blackKnightText = `<div class="chessCard">
    <div class="card-top bg-knight"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let blackBishopText = `<div class="chessCard">
    <div class="card-top bg-bishop"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let blackKingText = `<div class="chessCard">
    <div class="card-top bg-king"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

let blackQueenText = `<div class="chessCard">
    <div class="card-top bg-queen"></div>
    <div class="card-bot"></div>
    <div class="card-left"></div>
    <div class="card-right"></div>
    <div class="card-front"></div>
    <div class="card-back"></div>
</div>`;

const fields = document.querySelectorAll('.field');

const quickActWhite = document.querySelector('.whiteQuickActions');
const quickActBlack = document.querySelector('.blackQuickActions');

let scene = document.querySelector('.scene');

let currentPlayer = 1;

let highlightedFields = [];

let enemylightedFields = [];

function setup(){
    switchToPlayer1();
    let _isOdd = true;
    let _count = 0;
    fields.forEach(field => {

        if(_count == 8 || _count == 16 ||_count == 24 ||_count == 32
            ||_count == 40 ||_count == 48 ||_count == 56){
                _isOdd = !_isOdd;
            }
        if(!_isOdd){
            field.classList.add('field-white');
            _isOdd = !_isOdd;
        } else {
            field.classList.add('field-black');
            _isOdd = !_isOdd;
        }

        _count++;

        field.addEventListener('click', handleFieldClick);
    });

    quickActWhite.children[1].addEventListener('click', () => {

    });

    quickActWhite.children[0].addEventListener('click', () => {
        toggleUIMenu();
    });

    quickActBlack.children[1].addEventListener('click', () => {

    });

    quickActBlack.children[0].addEventListener('click', () => {
        toggleUIMenu();
    });

    

    // DEV BUTTONS
    for (let index = 0; index < fields.length; index++) {
        if(index == fields.length - 1){
            fields[index].addEventListener('click', () => {
                resetBoard();
            });
        }
        if(index == fields.length - 2){
            fields[index].addEventListener('click', () => {
                wipeBoard();
            });
        }
        if(index == fields.length - 3){
            fields[index].addEventListener('click', () => {
                if(currentPlayer == 1) {
                    switchToPlayer2();
                } else {
                    switchToPlayer1();
                }
            });
        }
        if(index == fields.length - 4){
            fields[index].addEventListener('click', () => {
                killFigure(55);
                    setTimeout(() => {
                        moveFigureToGrave(55);
                    }, 1000)
                fields[47].children[0].classList.add('figure-attack');
            });
        }
    }
}
function toggleUIMenu(){
    const uiBoard = document.querySelector('.ui-board');

    if(uiBoard.classList.contains('ui-board-shown')){
        uiBoard.classList.remove('ui-board-shown');
        uiBoard.classList.add('ui-board-hidden');
    } else {
        uiBoard.classList.remove('ui-board-hidden');
        uiBoard.classList.add('ui-board-shown');
    }
}
function switchToPlayer2(){
    scene.classList.add('scene-playerTwo');
    scene.classList.remove('scene-playerOne');
    currentPlayer = 2;
    quickActBlack.classList.add('blackQuickActions-shown');
    quickActBlack.classList.remove('blackQuickActions-hidden');
    quickActWhite.classList.remove('whiteQuickActions-shown');
    quickActWhite.classList.add('whiteQuickActions-hidden');
}
function switchToPlayer1(){
    scene.classList.add('scene-playerOne');
    scene.classList.remove('scene-playerTwo');
    currentPlayer = 1;
    quickActWhite.classList.add('whiteQuickActions-shown');
    quickActWhite.classList.remove('whiteQuickActions-hidden');
    quickActBlack.classList.remove('blackQuickActions-shown');
    quickActBlack.classList.add('blackQuickActions-hidden');
}
    function resetBoard(){
        console.log("Board Reset!");
        let fields = document.querySelectorAll('.field');
        for(let i = 0; i < fields.length; i++){
            fields[i].innerHTML = '';
            if(i < 16 && i > 7){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whitePawnText;
                fields[i].appendChild(figure);
            }
            if(i == 0 || i == 7){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteRookText;
                fields[i].appendChild(figure);
            }
            if(i == 1 || i == 6){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteKnightText;
                fields[i].appendChild(figure);
            }
            if(i == 2 || i == 5){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteBishopText;
                fields[i].appendChild(figure);
            }
            if(i == 3)
            {
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteQueenText;
                fields[i].appendChild(figure);
            }
            if(i == 4)
            {
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteKingText;
                fields[i].appendChild(figure);
            }
            if(56 > i && i > 47) {
                figure = whiteFigure.cloneNode();
                figure.innerHTML = blackPawnText;
                fields[i].appendChild(figure);
            }
            if(i == 63 || i == 56){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackRookText;
                fields[i].appendChild(figure);
            }
            if(i == 62 || i == 57){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackKnightText;
                fields[i].appendChild(figure);
            }
            if(i == 61 || i == 58){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackBishopText;
                fields[i].appendChild(figure);
            }
            if(i == 59){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackQueenText;
                fields[i].appendChild(figure);
            }
            if(i == 60){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackKingText;
                fields[i].appendChild(figure);
            }
        }
    }
    function wipeBoard(){
        console.log("Board Reset!");
        let fields = document.querySelectorAll('.field');
        for(let i = 0; i < fields.length; i++){
            fields[i].innerHTML = i;
        }
    }
    function killFigure(_fieldNumber){
        if(fields[_fieldNumber].children[0].classList.contains('figure-white')){
            fields[_fieldNumber].children[0].classList.add('figure-white-dead');
            setTimeout(() => {
            fields[_fieldNumber].children[0].classList.remove('figure-white-dead');
            }, 1000)
        } else if(fields[_fieldNumber].children[0].classList.contains('figure-white')) {
            fields[_fieldNumber].children[0].classList.add('figure-black-dead');
            setTimeout(() => {
                fields[_fieldNumber].children[0].classList.remove('figure-black-dead');
                }, 1000)
        }
    }
    function moveFigureToGrave(_fieldNumber){
        
        if(fields[_fieldNumber].children[0].classList.contains('figure-white')){
            const _whiteGrave = document.querySelector('.whiteGraveyard');
            _whiteGrave.appendChild(fields[_fieldNumber].children[0].cloneNode(1));
            fields[_fieldNumber].innerHTML = '';
        } else if(fields[_fieldNumber].children[0].classList.contains('figure-black')) {
            const _blackGrave = document.querySelector('.blackGraveyard');
            _blackGrave.appendChild(fields[_fieldNumber].children[0].cloneNode(1));
            fields[_fieldNumber].innerHTML = '';
        }
    }
    function clearHighlightedFields(){
        for (let index = 0; index < highlightedFields.length; index++) {
            if(fields[highlightedFields[index]].classList.contains('focusedFieldBlack')){
                fields[highlightedFields[index]].classList.remove('focusedFieldBlack');
            } else {
                fields[highlightedFields[index]].classList.remove('focusedFieldWhite');
            }
            /* console.log("Clearing Highlighted Field: " + highlightedFields[index]); */
        }
        highlightedFields = [];
    }
    function clearEnemylightedFields(){
        for (let index = 0; index < enemylightedFields.length; index++) {
            if(fields[enemylightedFields[index]].classList.contains('enemyFieldWhite')){
                fields[enemylightedFields[index]].classList.remove('enemyFieldWhite');
            } else {
                fields[enemylightedFields[index]].classList.remove('enemyFieldBlack');
            }
            /* console.log("Clearing Highlighted Field: " + highlightedFields[index]); */
        }
        enemylightedFields = [];
    }
    function enemylightFields(_fields, isWhite, canKill = true){
        // MAYBE SELECT CHILD USING QUERY SELECTOR
        if(_fields.length == 0){
            return(_fields);
        }
            for (let index = 0; index < _fields.length; index++) {

                if(fields[_fields[index]].childNodes.length > 0){
                    if(isWhite){
                if(fields[_fields[index]].children[0].classList.contains('figure-black')){
                    if(canKill){
                        enemylightedFields.push(_fields[index]);
                        if(fields[_fields[index]].classList.contains('field-white')){
                            fields[_fields[index]].classList.add('enemyFieldWhite');
                        } else if(fields[_fields[index]].classList.contains('field-black')){
                            fields[_fields[index]].classList.add('enemyFieldBlack');
                        }
                    }
                    _fields = _fields.slice(0, index);
                    break;
                }
                if(fields[_fields[index]].children[0].classList.contains('figure-white')){
                    _fields = _fields.slice(0, index);
                    break;
                }
            } else if(fields[_fields[index]].children[0].classList.contains('figure-white')){
                if(canKill){
                    enemylightedFields.push(_fields[index]);   
                if(fields[_fields[index]].classList.contains('field-white')){
                    fields[_fields[index]].classList.add('enemyFieldWhite');
                } else if(fields[_fields[index]].classList.contains('field-black')){
                    fields[_fields[index]].classList.add('enemyFieldBlack');
                }
                }
                _fields = _fields.slice(0, index);
                break;
            }
            if(fields[_fields[index]].children[0].classList.contains('figure-black')){
                _fields = _fields.slice(0, index);
                break;
            }
            }
            }
        return(_fields);
    }
    function highlightFieldsInLine(_fields, isRow){
        if(_fields.length == 0){
            return;
        }
        if(isRow){
            let _isOdd;
            if(fields[_fields[0]].classList.contains('field-white')){
                _isOdd = false;
            } else if(fields[_fields[0]].classList.contains('field-black')){
                _isOdd = true;
            }
            for (let index = 0; index < _fields.length; index++) {
                if(_isOdd){
                    fields[_fields[index]].classList.add('focusedFieldBlack');
                } else {
                    fields[_fields[index]].classList.add('focusedFieldWhite');
                }
                highlightedFields.push(_fields[index]);
                _isOdd = !_isOdd;
            }
        } else {
            let _isBlack;
            if(fields[_fields[0]].classList.contains('field-white')){
                _isBlack = false;
            } else if(fields[_fields[0]].classList.contains('field-black')){
                _isBlack = true;
            }
            for (let index = 0; index < _fields.length; index++) {
                if(_isBlack){
                    fields[_fields[index]].classList.add('focusedFieldBlack');
                } else {
                    fields[_fields[index]].classList.add('focusedFieldWhite');
                }
                highlightedFields.push(_fields[index]);
            }
        }
    }
    function getFieldsVertically(_fieldNumber, isWhite, isAhead){
        let _fieldsAvail = [];
        let row = parseInt(fields[_fieldNumber].parentNode.id.slice(3, 4));
        if (!isAhead) isWhite = !isWhite;
            if(isWhite){
                // isWhite num of field should first decrement by 1
                for (let index = 0; index < row; index++) {
                    
                    if(index == 0){
                        if(_fieldNumber - 8 < 0){
                            break;
                        }
                        _fieldsAvail[index] = _fieldNumber - 8;
                    } else {
                        if(_fieldsAvail[index - 1] - 8 < 0){
                            break;
                        }
                        _fieldsAvail[index] = _fieldsAvail[index - 1] - 8;
                    }
                }
            } else {
                // isWhite NOT TRUE num of field first should increment by 1
                for (let index = 0; index < 8 - row; index++) {
                    if(index == 0){
                        if(_fieldNumber + 8 > 63){
                            break;
                        }
                        _fieldsAvail[index] = _fieldNumber + 8;
                    } else {
                        if(_fieldsAvail[index - 1] + 8 > 63){
                            break;
                        }
                        _fieldsAvail[index] = _fieldsAvail[index - 1] + 8;
                    }
                }
            }
         /* for (let index = 0; index < fieldsAhead.length; index++) {
            console.log("Can move on: " + fieldsAhead[index]);
         } */
         return(_fieldsAvail);
    }
    function getFieldsHorizontally(_fieldNumber, isWhite, isRight){
        let _fieldsAvail = [];
        let _row = parseInt(fields[_fieldNumber].parentNode.id.slice(3, 4));
        if (isRight) isWhite = !isWhite;
        if(isWhite){
        for (let index = 0; index < 7; index++) {
            if(_fieldNumber - 1 - index < 0) {
                break;
            }
            if(fields[_fieldNumber - 1 - index].parentNode.id.slice(3, 4) == _row)
            {
                _fieldsAvail[index] = _fieldNumber - 1 - index;
            } else {
                break;
            }
        }
    } else {
        for (let index = 0; index < 7; index++) {
            if(_fieldNumber + 1 + index > 63) {
                break;
            }
            if(fields[_fieldNumber + 1 + index].parentNode.id.slice(3, 4) == _row)
            {
                _fieldsAvail[index] = _fieldNumber + 1 + index;
            } else {
                break;
            }
        }
    }
         return(_fieldsAvail);
    }
    function getFieldsDiagonally(_fieldNumber, isWhite, isRight, isTop){
        let _fieldsAvail = [];
        
        if (!isWhite){
            isRight = !isRight;
            isTop = !isTop;
        }

        /* if(isWhite){ */
            if(isRight){
                if(isTop){
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber - 7 - (7 * index) < 0) {
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber - 7 - (7 * index);
                            if(fields[_fieldNumber - 7 - (7 * index)].nextElementSibling == null || fields[_fieldNumber - 7 - (7 * index)].previousElementSibling == null) {
                                break;
                            }
                    }
                } else {
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber + 9 + (9 * index) > 63) {
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber + 9 + (9 * index);
                            if(fields[_fieldNumber + 9 + (9 * index)].nextElementSibling == null || fields[_fieldNumber + 9 + (9 * index)].previousElementSibling == null) {
                                break;
                            }
                    }
                }
            } else {
                if(isTop){
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber - 9 - (9 * index) < 0) {
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber - 9 - (9 * index);
                            if(fields[_fieldNumber - 9 - (9 * index)].nextElementSibling == null || fields[_fieldNumber - 9 - (9 * index)].previousElementSibling == null) {
                                break;
                            }
                    }
                } else {
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber + 7 + (7 * index) > 63) {
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber + 7 + (7 * index);
                            if(fields[_fieldNumber + 7 + (7 * index)].nextElementSibling == null || fields[_fieldNumber + 7 + (7 * index)].previousElementSibling == null) {
                            break;
                        }
                    }
                }
            }
        /* } else {
            if(isRight){
                if(isTop){

                } else {

                }
            } else {
                if(isTop){

                } else {
                    
                }
            }
        } */
         return(_fieldsAvail);
    }
    function handleFieldClick(e) {
        let figureType;

        let _fieldNumber;

        clearHighlightedFields();

        clearEnemylightedFields();

        if(e.target.classList.contains('field')){
            if(e.target.children[0] == undefined){
                
                _fieldNumber = parseInt(e.target.tabIndex);
                console.log("Empty field: " + _fieldNumber);
                return;
            } else {
                figureType = e.target.children[0].children[0].children[0].classList;
                figureType = figureType[1];
                _fieldNumber = parseInt(e.target.tabIndex);
            }
        } else if(e.target.classList.contains('figure')){
            figureType = e.target.children[0].children[0].classList;
            figureType = figureType[1];
                _fieldNumber = parseInt(e.target.parentNode.tabIndex);
        } else if(e.target.classList.contains('chessCard')){
            figureType = e.target.children[0].classList;
            figureType = figureType[1];
                _fieldNumber = parseInt(e.target.parentNode.parentNode.tabIndex);
        } else if(e.target.classList.contains('card-top')){
            figureType = e.target.classList;
            figureType = figureType[1];
                _fieldNumber = parseInt(e.target.parentNode.parentNode.parentNode.tabIndex);

        } else if(e.target.classList.contains('card-front') || e.target.classList.contains('card-back') || e.target.classList.contains('card-left') || e.target.classList.contains('card-right') || e.target.classList.contains('card-bot')){
            figureType = e.target.parentNode.children[0].classList;
            figureType = figureType[1];
                _fieldNumber = parseInt(e.target.parentNode.parentNode.parentNode.tabIndex);
        }

        _fieldNumber--;

        figureType = figureType.slice(3, figureType.length);

        console.log("Field Nr: " + _fieldNumber + "\r\nFigure: " + figureType);

        // Switch figureType

        let _fieldsAhead;
        let _fieldsBehind;
        let _fieldsLeft;
        let _fieldsLeftTop;
        let _fieldsLeftBot;
        let _fieldsRight;
        let _fieldsRightTop;
        let _fieldsRightBot;

        switch (figureType) {

            case 'pawn':

                _fieldsAhead = getFieldsVertically(_fieldNumber, 1, 1);
                if(_fieldNumber >= 48 && _fieldNumber <= 55){
                    _fieldsAhead = _fieldsAhead.slice(0, 2);
                } else {
                    _fieldsAhead = _fieldsAhead.slice(0, 1);
                }
                _fieldsAhead = enemylightFields(_fieldsAhead, 1, false);
                
                highlightFieldsInLine(_fieldsAhead, 1);

                _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 1), 1).slice(0, 1);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 1), 1).slice(0, 1);

                    enemylightFields(_fieldsLeftTop, 1, 1);
                    enemylightFields(_fieldsRightTop, 1, 1);

                // TODO ATTACK CHECK PAWN
                
                break;
                case 'pawn-white':

                    _fieldsAhead = getFieldsVertically(_fieldNumber, 0, 1);
                    if(_fieldNumber >= 8 && _fieldNumber <= 15){
                            _fieldsAhead = _fieldsAhead.slice(0, 2);
                        } else {
                            _fieldsAhead = _fieldsAhead.slice(0, 1);
                        }
                        _fieldsAhead = enemylightFields(_fieldsAhead, 0, false);

                        highlightFieldsInLine(_fieldsAhead, 1);

                        _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 1), 0).slice(0, 1);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 1), 0).slice(0, 1);

                    enemylightFields(_fieldsLeftTop, 0, 1);
                    enemylightFields(_fieldsRightTop, 0, 1);

                break;
                case 'rook':

                    _fieldsAhead = enemylightFields(getFieldsVertically(_fieldNumber, 1, 1), 1);
                    _fieldsBehind = enemylightFields(getFieldsVertically(_fieldNumber, 1, 0), 1);
                    _fieldsLeft = enemylightFields(getFieldsHorizontally(_fieldNumber, 1, 0), 1);
                    _fieldsRight = enemylightFields(getFieldsHorizontally(_fieldNumber, 1, 1), 1);
                    
                    highlightFieldsInLine(_fieldsAhead, 1);
                    highlightFieldsInLine(_fieldsBehind, 1);
                    highlightFieldsInLine(_fieldsLeft, 1);
                    highlightFieldsInLine(_fieldsRight, 1);
                
                break;
                case 'rook-white':

                    _fieldsAhead = enemylightFields(getFieldsVertically(_fieldNumber, 0, 1), 0);
                    _fieldsBehind = enemylightFields(getFieldsVertically(_fieldNumber, 0, 0), 0);
                    _fieldsLeft = enemylightFields(getFieldsHorizontally(_fieldNumber, 0, 0), 0);
                    _fieldsRight = enemylightFields(getFieldsHorizontally(_fieldNumber, 0, 1), 0);
                    
                    highlightFieldsInLine(_fieldsAhead, 1);
                    highlightFieldsInLine(_fieldsBehind, 1);
                    highlightFieldsInLine(_fieldsLeft, 1);
                    highlightFieldsInLine(_fieldsRight, 1);

                break;
                case 'queen':

                _fieldsAhead = enemylightFields(getFieldsVertically(_fieldNumber, 1, 1), 1);
                _fieldsBehind = enemylightFields(getFieldsVertically(_fieldNumber, 1, 0), 1);
                _fieldsLeft = enemylightFields(getFieldsHorizontally(_fieldNumber, 1, 0), 1);
                _fieldsRight = enemylightFields(getFieldsHorizontally(_fieldNumber, 1, 1), 1);

                _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 0), 1);
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 1), 1);
                    _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 0), 1);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 1), 1);

                    highlightFieldsInLine(_fieldsLeftBot, 0);
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    highlightFieldsInLine(_fieldsRightBot, 0);
                    highlightFieldsInLine(_fieldsRightTop, 0);

                highlightFieldsInLine(_fieldsAhead, 1);
                highlightFieldsInLine(_fieldsBehind, 1);
                highlightFieldsInLine(_fieldsLeft, 1);
                highlightFieldsInLine(_fieldsRight, 1);
                
                break;
                case 'queen-white':

                    _fieldsAhead = enemylightFields(getFieldsVertically(_fieldNumber, 0, 1), 0);
                    _fieldsBehind = enemylightFields(getFieldsVertically(_fieldNumber, 0, 0), 0);
                    _fieldsLeft = enemylightFields(getFieldsHorizontally(_fieldNumber, 0, 0), 0);
                    _fieldsRight = enemylightFields(getFieldsHorizontally(_fieldNumber, 0, 1), 0);

                    _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 0), 0);
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 1), 0);
                    _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 0), 0);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 1), 0);

                    highlightFieldsInLine(_fieldsLeftBot, 0);
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    highlightFieldsInLine(_fieldsRightBot, 0);
                    highlightFieldsInLine(_fieldsRightTop, 0);
    
                    highlightFieldsInLine(_fieldsAhead, 1);
                    highlightFieldsInLine(_fieldsBehind, 1);
                    highlightFieldsInLine(_fieldsLeft, 1);
                    highlightFieldsInLine(_fieldsRight, 1);

                break;
                case 'king':

                    _fieldsAhead = enemylightFields(getFieldsVertically(_fieldNumber, 1, 1).slice(0, 1), 1);
                    _fieldsBehind = enemylightFields(getFieldsVertically(_fieldNumber, 1, 0).slice(0, 1), 1);
                    _fieldsLeft = enemylightFields(getFieldsHorizontally(_fieldNumber, 1, 0).slice(0, 1), 1);
                    _fieldsRight = enemylightFields(getFieldsHorizontally(_fieldNumber, 1, 1).slice(0, 1), 1);

                    _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 0).slice(0, 1), 1);
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 1).slice(0, 1), 1);
                    _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 0).slice(0, 1), 1);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 1).slice(0, 1), 1);

                    highlightFieldsInLine(_fieldsAhead, 1);
                    highlightFieldsInLine(_fieldsBehind, 1);
                    highlightFieldsInLine(_fieldsLeft, 1);
                    highlightFieldsInLine(_fieldsRight, 1);

                    highlightFieldsInLine(_fieldsLeftBot, 0);
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    highlightFieldsInLine(_fieldsRightBot, 0);
                    highlightFieldsInLine(_fieldsRightTop, 0);
                
                break;
                case 'king-white':

                    _fieldsAhead = enemylightFields(getFieldsVertically(_fieldNumber, 0, 1).slice(0, 1), 0);
                    _fieldsBehind = enemylightFields(getFieldsVertically(_fieldNumber, 0, 0).slice(0, 1), 0);
                    _fieldsLeft = enemylightFields(getFieldsHorizontally(_fieldNumber, 0, 0).slice(0, 1), 0);
                    _fieldsRight = enemylightFields(getFieldsHorizontally(_fieldNumber, 0, 1).slice(0, 1), 0);

                    _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 0).slice(0, 1), 0);
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 1).slice(0, 1), 0);
                    _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 0).slice(0, 1), 0);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 1).slice(0, 1), 0);

                    highlightFieldsInLine(_fieldsAhead, 1);
                    highlightFieldsInLine(_fieldsBehind, 1);
                    highlightFieldsInLine(_fieldsLeft, 1);
                    highlightFieldsInLine(_fieldsRight, 1);

                    highlightFieldsInLine(_fieldsLeftBot, 0);
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    highlightFieldsInLine(_fieldsRightBot, 0);
                    highlightFieldsInLine(_fieldsRightTop, 0);

                break;
                case 'bishop':

                    _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 0), 1);
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 1), 1);
                    _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 0), 1);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 1), 1);

                    /* highlightFieldsInLine(_fieldsLeftBot, 0); */
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    /* highlightFieldsInLine(_fieldsRightBot, 0); */
                    highlightFieldsInLine(_fieldsRightTop, 0);
                
                break;
                case 'bishop-white':

                    _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 0), 0);
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 1), 0);
                    _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 0), 0);
                    _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 1), 0);

                    highlightFieldsInLine(_fieldsLeftBot, 0);
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    highlightFieldsInLine(_fieldsRightBot, 0);
                    highlightFieldsInLine(_fieldsRightTop, 0);

                break;
                case 'knight':

                    _fieldsAhead = getFieldsVertically(_fieldNumber, 1, 1).slice(0, 2);
                    _fieldsBehind = getFieldsVertically(_fieldNumber, 1, 0).slice(0, 2);
                    _fieldsLeft = getFieldsHorizontally(_fieldNumber, 1, 0).slice(0, 2);
                    _fieldsRight = getFieldsHorizontally(_fieldNumber, 1, 1).slice(0, 2);

                    if(_fieldsAhead[1] != null){
                        let top1 = enemylightFields(getFieldsHorizontally(_fieldsAhead[1], 1, 0).slice(0,1), 1);
                        let top2 = enemylightFields(getFieldsHorizontally(_fieldsAhead[1], 1, 1).slice(0,1), 1)
                        highlightFieldsInLine(top1, 1);
                        highlightFieldsInLine(top2, 1);
                    }
                    
                    if(_fieldsRight[1] != null){
                        let right1 = enemylightFields(getFieldsVertically(_fieldsRight[1], 1, 1).slice(0,1), 1);
                        let right2 = enemylightFields(getFieldsVertically(_fieldsRight[1], 1, 0).slice(0,1), 1)
                        highlightFieldsInLine(right1, 1);
                        highlightFieldsInLine(right2, 1);
                    }

                    if(_fieldsLeft[1] != null){
                        let left1 = enemylightFields(getFieldsVertically(_fieldsLeft[1], 1, 1).slice(0,1), 1);
                        let left2 = enemylightFields(getFieldsVertically(_fieldsLeft[1], 1, 0).slice(0,1), 1)
                        highlightFieldsInLine(left1, 1);
                        highlightFieldsInLine(left2, 1);
                    }

                    if(_fieldsBehind[1] != null){
                        let bot1 = enemylightFields(getFieldsVertically(_fieldsBehind[1], 1, 1).slice(0,1), 1);
                        let bot2 = enemylightFields(getFieldsVertically(_fieldsBehind[1], 1, 0).slice(0,1), 1)
                        highlightFieldsInLine(bot1, 1);
                        highlightFieldsInLine(bot2, 1);
                    }
                
                break;
                case 'knight-white':

                    _fieldsAhead = getFieldsVertically(_fieldNumber, 0, 1).slice(0, 2);
                    _fieldsBehind = getFieldsVertically(_fieldNumber, 0, 0).slice(0, 2);
                    _fieldsLeft = getFieldsHorizontally(_fieldNumber, 0, 0).slice(0, 2);
                    _fieldsRight = getFieldsHorizontally(_fieldNumber, 0, 1).slice(0, 2);

                    if(_fieldsAhead[1] != null){
                        let top1 = enemylightFields(getFieldsHorizontally(_fieldsAhead[1], 0, 0).slice(0,1), 0);
                        let top2 = enemylightFields(getFieldsHorizontally(_fieldsAhead[1], 0, 1).slice(0,1), 0)
                        highlightFieldsInLine(top1, 1);
                        highlightFieldsInLine(top2, 1);
                    }
                    
                    if(_fieldsRight[1] != null){
                        let right1 = enemylightFields(getFieldsVertically(_fieldsRight[1], 0, 1).slice(0,1), 0);
                        let right2 = enemylightFields(getFieldsVertically(_fieldsRight[1], 0, 0).slice(0,1), 0)
                        highlightFieldsInLine(right1, 1);
                        highlightFieldsInLine(right2, 1);
                    }

                    if(_fieldsLeft[1] != null){
                        let left1 = enemylightFields(getFieldsVertically(_fieldsLeft[1], 0, 1).slice(0,1), 0);
                        let left2 = enemylightFields(getFieldsVertically(_fieldsLeft[1], 0, 0).slice(0,1), 0)
                        highlightFieldsInLine(left1, 1);
                        highlightFieldsInLine(left2, 1);
                    }

                    if(_fieldsBehind[1] != null){
                        let bot1 = enemylightFields(getFieldsVertically(_fieldsBehind[1], 0, 1).slice(0,1), 0);
                        let bot2 = enemylightFields(getFieldsVertically(_fieldsBehind[1], 0, 0).slice(0,1), 0)
                        highlightFieldsInLine(bot1, 1);
                        highlightFieldsInLine(bot2, 1);
                    }

            default:
                break;
        }
    }

    setup();

});

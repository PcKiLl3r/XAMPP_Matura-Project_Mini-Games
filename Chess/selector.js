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

let scene = document.querySelector('.scene');

let currentPlayer = 1;

let highlightedFields = [];

function setup(){
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
            });
        }
    }
}
function switchToPlayer2(){
    scene.classList.add('scene-playerTwo');
    scene.classList.remove('scene-playerOne');
    currentPlayer = 2;
}
function switchToPlayer1(){
    scene.classList.add('scene-playerOne');
    scene.classList.remove('scene-playerTwo');
    currentPlayer = 1;
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
        } else if(fields[_fieldNumber].children[0].classList.contains('figure-white')) {
            fields[_fieldNumber].children[0].classList.add('figure-black-dead');
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
    function getFieldsVertically(field, _fieldNumber, isWhite, isAhead){
        let _fieldsAvail = [];
        let row = parseInt(field.parentNode.id.slice(3, 4));
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
    function getFieldsHorizontally(field, _fieldNumber, isWhite, isRight){
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
    function getFieldsDiagonally(field, _fieldNumber, isWhite, isRight, isTop){
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

                _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 1);
                if(_fieldNumber >= 46 && _fieldNumber <= 55){
                        _fieldsAhead = _fieldsAhead.slice(0, 2);
                    } else {
                        _fieldsAhead = _fieldsAhead.slice(0, 1);
                    }
                highlightFieldsInLine(_fieldsAhead, 1);
                
                break;
                case 'pawn-white':

                    _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 0, 1);
                    if(_fieldNumber >= 8 && _fieldNumber <= 15){
                            _fieldsAhead = _fieldsAhead.slice(0, 2);
                        } else {
                            _fieldsAhead = _fieldsAhead.slice(0, 1);
                        }
                        highlightFieldsInLine(_fieldsAhead, 1);

                break;
                case 'rook':

                    _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 1);
                    _fieldsBehind = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 0);
                    _fieldsLeft = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 1, 0);
                    _fieldsRight = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 1, 1);
                    
                    highlightFieldsInLine(_fieldsAhead, 1);
                    highlightFieldsInLine(_fieldsBehind, 1);
                    highlightFieldsInLine(_fieldsLeft, 1);
                    highlightFieldsInLine(_fieldsRight, 1);
                
                break;
                case 'rook-white':

                    _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 0, 1);
                    highlightFieldsInLine(_fieldsAhead, 1);

                break;
                case 'queen':

                _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 1);
                _fieldsBehind = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 0);
                _fieldsLeft = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 1, 0);
                _fieldsRight = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 1, 1);

                _fieldsLeftBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 0, 0);
                    _fieldsLeftTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 0, 1)
                    _fieldsRightBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 1, 0);
                    _fieldsRightTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 1, 1);

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

                    _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 0, 1);
                    _fieldsBehind = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 0, 0);
                    _fieldsLeft = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 0, 0);
                    _fieldsRight = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 0, 1);

                    _fieldsLeftBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 0, 0);
                    _fieldsLeftTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 0, 1)
                    _fieldsRightBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 1, 0);
                    _fieldsRightTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 1, 1);

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

                    _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 1);
                    _fieldsBehind = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 1, 0);
                    _fieldsLeft = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 1, 0);
                    _fieldsRight = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 1, 1);

                    _fieldsLeftBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 0, 0);
                    _fieldsLeftTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 0, 1)
                    _fieldsRightBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 1, 0);
                    _fieldsRightTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 1, 1);

                    _fieldsAhead = _fieldsAhead.slice(0, 1);
                    _fieldsBehind = _fieldsBehind.slice(0, 1);
                    _fieldsLeft = _fieldsLeft.slice(0, 1);
                    _fieldsRight = _fieldsRight.slice(0, 1);

                    _fieldsLeftBot = _fieldsLeftBot.slice(0, 1);
                    _fieldsLeftTop = _fieldsLeftTop.slice(0, 1);
                    _fieldsRightBot = _fieldsRightBot.slice(0, 1);
                    _fieldsRightTop = _fieldsRightTop.slice(0, 1);

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

                    _fieldsAhead = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 0, 1);
                    _fieldsBehind = getFieldsVertically(fields[_fieldNumber], _fieldNumber, 0, 0);
                    _fieldsLeft = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 0, 0);
                    _fieldsRight = getFieldsHorizontally(fields[_fieldNumber], _fieldNumber, 0, 1);

                    _fieldsLeftBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 0, 0);
                    _fieldsLeftTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 0, 1)
                    _fieldsRightBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 1, 0);
                    _fieldsRightTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 1, 1);

                    _fieldsAhead = _fieldsAhead.slice(0, 1);
                    _fieldsBehind = _fieldsBehind.slice(0, 1);
                    _fieldsLeft = _fieldsLeft.slice(0, 1);
                    _fieldsRight = _fieldsRight.slice(0, 1);

                    _fieldsLeftBot = _fieldsLeftBot.slice(0, 1);
                    _fieldsLeftTop = _fieldsLeftTop.slice(0, 1);
                    _fieldsRightBot = _fieldsRightBot.slice(0, 1);
                    _fieldsRightTop = _fieldsRightTop.slice(0, 1);

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

                    /* _fieldsLeftBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 0, 0); */
                    _fieldsLeftTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 0, 1)
                    /* _fieldsRightBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 1, 0); */
                    _fieldsRightTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 1, 1, 1);

                    /* highlightFieldsInLine(_fieldsLeftBot, 0); */
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    /* highlightFieldsInLine(_fieldsRightBot, 0); */
                    highlightFieldsInLine(_fieldsRightTop, 0);
                
                break;
                case 'bishop-white':

                    _fieldsLeftBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 0, 0);
                    _fieldsLeftTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 0, 1)
                    _fieldsRightBot = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 1, 0);
                    _fieldsRightTop = getFieldsDiagonally(fields[_fieldNumber], _fieldNumber, 0, 1, 1);

                    highlightFieldsInLine(_fieldsLeftBot, 0);
                    highlightFieldsInLine(_fieldsLeftTop, 0);
                    highlightFieldsInLine(_fieldsRightBot, 0);
                    highlightFieldsInLine(_fieldsRightTop, 0);

                break;
        
            default:
                break;
        }
    }

    setup();

});
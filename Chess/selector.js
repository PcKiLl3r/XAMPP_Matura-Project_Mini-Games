//#region Variables
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

const quickActWhite = document.querySelector('.whiteQuickActions');
const quickActBlack = document.querySelector('.blackQuickActions');

const whiteGrave = document.querySelector('.whiteGraveyard');
const blackGrave = document.querySelector('.blackGraveyard');

let scene = document.querySelector('.scene');

let currentPlayer = 'unset';

let highlightedFields = [];

let enemylightedFields = [];

const uiBoard = document.querySelector('.ui-board');

let lastClickedField = undefined;

let whitePawnEndField;
let blackPawnEndField;

let hasCheck = 1;

function reverseChildren(parent) {
    for (var i = 1; i < parent.childNodes.length; i++){
        parent.insertBefore(parent.childNodes[i], parent.firstChild);
    }
}

function fixFields() {

    for (var i = 0; i < 8; i++){
        for (let i2 = 0; i2 < 8; i2++) {
            
            rows[i].insertBefore(rows[i].childNodes[i2], rows[i].firstChild);
        }
    }
}

let rows = document.querySelectorAll('.row');

let _fieldTemplate = document.createElement('div');
_fieldTemplate.classList.add('field');

_fieldCounter = 64;
for (let index = 0; index < rows.length; index++) {
    for (let indexField = 8; indexField > 0; indexField--) {
        _fieldTemplate.setAttribute('tabindex', _fieldCounter);
        rows[index].appendChild(_fieldTemplate.cloneNode());
        _fieldCounter--;
    }
    reverseChildren(rows[index]);
}

let fields = document.querySelectorAll('.field');

/* fixFields(); */

let connStatus = 'Unset';

let gameStatus = 'Unknown';

let infoMsg = '';

let fieldData = [];
//#endregion Variables
//#region UI Methods

function toggleUIMenu(){
    if(uiBoard.classList.contains('ui-board-shown')){
        uiBoard.classList.remove('ui-board-shown');
        uiBoard.classList.add('ui-board-hidden');
    } else {
        uiBoard.classList.remove('ui-board-hidden');
        uiBoard.classList.add('ui-board-shown');
    }
}
function togglePlayer(){
    if(currentPlayer == 1){
        scene.classList.add('scene-playerTwo');
        scene.classList.remove('scene-playerOne');
        currentPlayer = 2;
        quickActBlack.classList.add('blackQuickActions-shown');
        quickActBlack.classList.remove('blackQuickActions-hidden');
        quickActWhite.classList.remove('whiteQuickActions-shown');
        quickActWhite.classList.add('whiteQuickActions-hidden');
    } else {
        scene.classList.add('scene-playerOne');
    scene.classList.remove('scene-playerTwo');
    currentPlayer = 1;
    quickActWhite.classList.add('whiteQuickActions-shown');
    quickActWhite.classList.remove('whiteQuickActions-hidden');
    quickActBlack.classList.remove('blackQuickActions-shown');
    quickActBlack.classList.add('blackQuickActions-hidden');
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
        } else if(fields[_fieldNumber].children[0].classList.contains('figure-black')) {
            fields[_fieldNumber].children[0].classList.add('figure-black-dead');
            setTimeout(() => {
                fields[_fieldNumber].children[0].classList.remove('figure-black-dead');
                }, 1000)
        }
    }
    function moveFigureToGrave(_fieldNumber){
        
        if(fields[_fieldNumber].children[0].classList.contains('figure-white')){
            fields[_fieldNumber].children[0].id = "graveW" + (whiteGrave.children.length + 1);
            whiteGrave.appendChild(fields[_fieldNumber].children[0].cloneNode(1));

            fields[_fieldNumber].innerHTML = '';
            
            /* whiteGrave.lastChild.addEventListener('click', (e) => {
                e.stopPropagation();
                let _isWhite = null;
        if(e.target.classList.contains('figure')){
            _graveNumber = e.target.id.slice(5, e.target.id.length);
            _isWhite = e.target.classList.contains('figure-white');
        } else if(e.target.classList.contains('chessCard')){
            _graveNumber = e.target.parentNode.id.slice(5, e.target.parentNode.id.length);
            _isWhite = e.target.parentNode.classList.contains('figure-white');
        } else if(e.target.classList.contains('card-top')){
            _graveNumber = e.target.parentNode.parentNode.id.slice(5, e.target.parentNode.parentNode.id.length);
            _isWhite = e.target.parentNode.parentNode.classList.contains('figure-white');
        } else if(e.target.classList.contains('card-front') || e.target.classList.contains('card-back') || e.target.classList.contains('card-left') || e.target.classList.contains('card-right') || e.target.classList.contains('card-bot')){
            _graveNumber = e.target.parentNode.parentNode.id.slice(5, e.target.parentNode.parentNode.id.length);
            _isWhite = e.target.parentNode.parentNode.classList.contains('figure-white');
        }
        _graveNumber = parseInt(_graveNumber.slice(1, _graveNumber.length)) - 1;

        if(_isWhite){
            if(whitePawnEndField == null) return;
            console.log("whitePawnEndField: " + whitePawnEndField + "\r\n");
            whiteGrave.children[_graveNumber].classList.add('figure-white-revieve');
            setTimeout(() => {
            whiteGrave.children[_graveNumber].classList.remove('figure-white-revieve');
            
            let _figure = whiteGrave.children[_graveNumber].cloneNode(1);
            whiteGrave.children[_graveNumber].remove();

            if(fields[whitePawnEndField].children[0].classList.contains('figure-white')){
                whiteGrave.appendChild(fields[whitePawnEndField].children[0].cloneNode(1));
                fields[whitePawnEndField].innerHTML = '';
            } else {
                blackGrave.appendChild(fields[whitePawnEndField].children[0].cloneNode(1));
                fields[whitePawnEndField].innerHTML = '';
            }

            fields[whitePawnEndField].appendChild(_figure);
            whitePawnEndField = null;
            togglePlayer();
            }, 1000)
            
        } else {
            if(blackPawnEndField == null) return;
            console.log("blackPawnEndField: " + blackPawnEndField + "\r\n");
            blackGrave.children[_graveNumber].classList.add('figure-black-revieve');
            setTimeout(() => {
            blackGrave.children[_graveNumber].classList.remove('figure-black-revieve');

            let _figure = blackGrave.children[_graveNumber].cloneNode(1);
            blackGrave.children[_graveNumber].remove();
            if(fields[whitePawnEndField].children[0].classList.contains('figure-white')){
                whiteGrave.appendChild(fields[whitePawnEndField].children[0].cloneNode(1));
                fields[whitePawnEndField].innerHTML = '';
            } else {
                blackGrave.appendChild(fields[whitePawnEndField].children[0].cloneNode(1));
                fields[whitePawnEndField].innerHTML = '';
            }
            fields[blackPawnEndField].appendChild(_figure);
            blackPawnEndField = null;
            togglePlayer();
            }, 1000)

            
        }
            }); */

        } else if(fields[_fieldNumber].children[0].classList.contains('figure-black')) {
            fields[_fieldNumber].children[0].id = "graveB" + (blackGrave.children.length + 1);
            blackGrave.appendChild(fields[_fieldNumber].children[0].cloneNode(1));

            fields[_fieldNumber].innerHTML = '';

            /* blackGrave.lastChild.addEventListener('click', (e) => {
                e.stopPropagation();
                let _isWhite = null;
        if(e.target.classList.contains('figure')){
            _graveNumber = e.target.id.slice(5, e.target.id.length);
            _isWhite = e.target.classList.contains('figure-white');
        } else if(e.target.classList.contains('chessCard')){
            _graveNumber = e.target.parentNode.id.slice(5, e.target.parentNode.id.length);
            _isWhite = e.target.parentNode.classList.contains('figure-white');
        } else if(e.target.classList.contains('card-top')){
            _graveNumber = e.target.parentNode.parentNode.id.slice(5, e.target.parentNode.parentNode.id.length);
            _isWhite = e.target.parentNode.parentNode.classList.contains('figure-white');
        } else if(e.target.classList.contains('card-front') || e.target.classList.contains('card-back') || e.target.classList.contains('card-left') || e.target.classList.contains('card-right') || e.target.classList.contains('card-bot')){
            _graveNumber = e.target.parentNode.parentNode.id.slice(5, e.target.parentNode.parentNode.id.length);
            _isWhite = e.target.parentNode.parentNode.classList.contains('figure-white');
        }
        _graveNumber = parseInt(_graveNumber.slice(1, _graveNumber.length)) - 1;

        if(_isWhite){
            if(whitePawnEndField == null) return;
            console.log("whitePawnEndField: " + whitePawnEndField + "\r\n");
            whiteGrave.children[_graveNumber].classList.add('figure-white-revieve');
            setTimeout(() => {
            whiteGrave.children[_graveNumber].classList.remove('figure-white-revieve');
            
            let _figure = whiteGrave.children[_graveNumber].cloneNode(1);
            whiteGrave.children[_graveNumber].remove();
            fields[whitePawnEndField].innerHTML = '';
            fields[whitePawnEndField].appendChild(_figure);
            whitePawnEndField = null;
            togglePlayer();
            }, 1000)
            
        } else {
            if(blackPawnEndField == null) return;
            console.log("blackPawnEndField: " + blackPawnEndField + "\r\n");
            blackGrave.children[_graveNumber].classList.add('figure-black-revieve');
            setTimeout(() => {
            blackGrave.children[_graveNumber].classList.remove('figure-black-revieve');

            let _figure = blackGrave.children[_graveNumber].cloneNode(1);
            blackGrave.children[_graveNumber].remove();
            fields[blackPawnEndField].innerHTML = '';
            fields[blackPawnEndField].appendChild(_figure);
            blackPawnEndField = null;
            togglePlayer();
            }, 1000)

            
        }
            }); */
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
                        if(parseInt(fields[_fieldNumber - 7 - (7 * index)].parentNode.id.slice(3, 4)) >= parseInt(fields[_fieldNumber - (7 * index)].parentNode.id.slice(3, 4))){
                            break;
                        }
                        if(parseInt(fields[_fieldNumber - 7 - (7 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber - (7 * index)].parentNode.id.slice(3, 4)) < -1){
                            break;
                        }
                        /* if(parseInt(fields[_fieldNumber - (7 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber - 7 - (7 * index)].parentNode.id.slice(3, 4)) > 1){
                            break;    
                        } */
                            _fieldsAvail[index] = _fieldNumber - 7 - (7 * index);
                            
                            /* if(fields[_fieldNumber - 7 - (7 * index)].nextElementSibling == null || fields[_fieldNumber - 7 - (7 * index)].previousElementSibling == null) {
                                break;
                            } */
                    }
                } else {
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber + 9 + (9 * index) > 63) {
                            break;
                        }
                        if(parseInt(fields[_fieldNumber + 9 + (9 * index)].parentNode.id.slice(3, 4)) <= parseInt(fields[_fieldNumber + (9 * index)].parentNode.id.slice(3, 4))){
                            break;
                        }
                        if(parseInt(fields[_fieldNumber + 9 + (9 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber + (9 * index)].parentNode.id.slice(3, 4)) > 1){
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber + 9 + (9 * index);
                            /* if(parseInt(fields[_fieldNumber + 9 + (9 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber + 9 + 9 + (9 * index)].parentNode.id.slice(3, 4)) < -1){
                                break;    
                            } */
                            /* if(fields[_fieldNumber + 9 + (9 * index)].nextElementSibling == null || fields[_fieldNumber + 9 + (9 * index)].previousElementSibling == null) {
                                break;
                            } */
                    }
                }
            } else {
                if(isTop){
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber - 9 - (9 * index) < 0) {
                            break;
                        }
                        if(parseInt(fields[_fieldNumber - 9 - (9 * index)].parentNode.id.slice(3, 4)) >= parseInt(fields[_fieldNumber - (9 * index)].parentNode.id.slice(3, 4))){
                            break;
                        }
                        if(parseInt(fields[_fieldNumber - 9 - (9 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber - (9 * index)].parentNode.id.slice(3, 4)) < -1){
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber - 9 - (9 * index);
                            /* if(parseInt(fields[_fieldNumber - 9 - (9 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber - 9 - 9 - (9 * index)].parentNode.id.slice(3, 4)) > 1){
                                break;    
                            } */
                            /* if(fields[_fieldNumber - 9 - (9 * index)].nextElementSibling == null || fields[_fieldNumber - 9 - (9 * index)].previousElementSibling == null) {
                                break;
                            } */
                    }
                } else {
                    for (let index = 0; index < 7; index++) {
                        if(_fieldNumber + 7 + (7 * index) > 63) {
                            break;
                        }
                        if(parseInt(fields[_fieldNumber + 7 + (7 * index)].parentNode.id.slice(3, 4)) <= parseInt(fields[_fieldNumber + (7 * index)].parentNode.id.slice(3, 4))){
                            break;
                        }
                        if(parseInt(fields[_fieldNumber + 7 + (7 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber + (7 * index)].parentNode.id.slice(3, 4)) > 1){
                            break;
                        }
                            _fieldsAvail[index] = _fieldNumber + 7 + (7 * index);
                            /* if(parseInt(fields[_fieldNumber + 7 + (7 * index)].parentNode.id.slice(3, 4)) - parseInt(fields[_fieldNumber + 7 + 7 + (7 * index)].parentNode.id.slice(3, 4)) < -1){
                                break;    
                            } */
                            /* if(fields[_fieldNumber + 7 + (7 * index)].nextElementSibling == null || fields[_fieldNumber + 7 + (7 * index)].previousElementSibling == null) {
                            break;
                        } */
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
    function performMove(_desiredFieldNum, _lastFieldNum){
        let _figure = fields[_lastFieldNum].lastChild.cloneNode(1);
        fields[_lastFieldNum].innerHTML = '';
        fields[_desiredFieldNum].appendChild(_figure);
        
        clearEnemylightedFields();
        clearHighlightedFields();
        
        if(fields[_desiredFieldNum].children[0].children[0].children[0].classList.contains('bg-pawn')) {
                        
            if(_desiredFieldNum - 1 >= 0 && _desiredFieldNum - 1 < 8){
                whitePawnEndField = _desiredFieldNum;
            }
        } else if(fields[_desiredFieldNum].children[0].children[0].children[0].classList.contains('bg-pawn-white')) {
            if(_desiredFieldNum - 1 > 55 && _desiredFieldNum - 1 < 64){
                blackPawnEndField = _desiredFieldNum;
            }
        }

        /* if(whitePawnEndField == null && blackPawnEndField == null){
            togglePlayer();
        } */

        // TODO FIX EMPTY GRAVE WAIT
        // TODO FIX PAWN KILL PAWN
    }
    function performAttack(_desiredFieldNum, _lastFieldNum){
        // fix pawn reaching end
        let _figureAttacker = fields[_lastFieldNum].innerHTML;

        killFigure(_desiredFieldNum);
        setTimeout(() => {
            moveFigureToGrave(_desiredFieldNum);
            fields[_desiredFieldNum].innerHTML = _figureAttacker;
            fields[_lastFieldNum].innerHTML = '';

            if(fields[_desiredFieldNum].children[0].children[0].children[0].classList.contains('bg-pawn')) {
                if(_desiredFieldNum >= 0 && _desiredFieldNum < 8){
                    whitePawnEndField = _desiredFieldNum;
                }
            } else if(fields[_desiredFieldNum].children[0].children[0].children[0].classList.contains('bg-pawn-white')) {
                if(_desiredFieldNum  > 55 && _desiredFieldNum < 64){
                    blackPawnEndField = _desiredFieldNum;
                }
            }
            /* if(whitePawnEndField == null && blackPawnEndField == null){
                togglePlayer();
            } */
        }, 1000)

        clearEnemylightedFields();
        clearHighlightedFields();
    }
    function remapFieldNumber(_fieldNum, _isReverse = false){
        let _fixedNum;
        if(_isReverse){
            switch (_fieldNum) {
                case 0:
                    _fixedNum = 56;
                break;
                case 1:
                    _fixedNum = 57;
                break;
                case 2:
                    _fixedNum = 58;
                break;
                case 3:
                    _fixedNum = 59;
                break;
                case 4:
                    _fixedNum = 60;
                break;
                case 5:
                    _fixedNum = 61;
                break;
                case 6:
                    _fixedNum = 62;
                break;
                case 7:
                    _fixedNum = 63;
                break;

                case 8:
                    _fixedNum = 48;
                break;
                case 9:
                    _fixedNum = 49;
                break;
                case 10:
                    _fixedNum = 50;
                break;
                case 11:
                    _fixedNum = 51;
                break;
                case 12:
                    _fixedNum = 52;
                break;
                case 13:
                    _fixedNum = 53;
                break;
                case 14:
                    _fixedNum = 54;
                break;
                case 15:
                    _fixedNum = 55;
                break;

                case 16:
                    _fixedNum = 40;
                break;
                case 17:
                    _fixedNum = 41;
                break;
                case 18:
                    _fixedNum = 42;
                break;
                case 19:
                    _fixedNum = 43;
                break;
                case 20:
                    _fixedNum = 44;
                break;
                case 21:
                    _fixedNum = 45;
                break;
                case 22:
                    _fixedNum = 46;
                break;
                case 23:
                    _fixedNum = 47;
                break;

                case 24:
                    _fixedNum = 32;
                break;
                case 25:
                    _fixedNum = 33;
                break;
                case 26:
                    _fixedNum = 34;
                break;
                case 27:
                    _fixedNum = 35;
                break;
                case 28:
                    _fixedNum = 36;
                break;
                case 29:
                    _fixedNum = 37;
                break;
                case 30:
                    _fixedNum = 38;
                break;
                case 31:
                    _fixedNum = 39;
                break;

                case 32:
                    _fixedNum = 24;
                break;
                case 33:
                    _fixedNum = 25;
                break;
                case 34:
                    _fixedNum = 26;
                break;
                case 35:
                    _fixedNum = 27;
                break;
                case 36:
                    _fixedNum = 28;
                break;
                case 37:
                    _fixedNum = 29;
                break;
                case 38:
                    _fixedNum = 30;
                break;
                case 39:
                    _fixedNum = 31;
                break;
// jure
                case 40:
                    _fixedNum = 16;
                break;
                case 41:
                    _fixedNum = 17;
                break;
                case 42:
                    _fixedNum = 18;
                break;
                case 43:
                    _fixedNum = 19;
                break;
                case 44:
                    _fixedNum = 20;
                break;
                case 45:
                    _fixedNum = 21;
                break;
                case 46:
                    _fixedNum = 22;
                break;
                case 47:
                    _fixedNum = 23;
                break;

                case 48:
                    _fixedNum = 8;
                break;
                case 49:
                    _fixedNum = 9;
                break;
                case 50:
                    _fixedNum = 10;
                break;
                case 51:
                    _fixedNum = 11;
                break;
                case 52:
                    _fixedNum = 12;
                break;
                case 53:
                    _fixedNum = 13;
                break;
                case 54:
                    _fixedNum = 14;
                break;
                case 55:
                    _fixedNum = 15;
                break;

                case 56:
                    _fixedNum = 0;
                break;
                case 57:
                    _fixedNum = 1;
                break;
                case 58:
                    _fixedNum = 2;
                break;
                case 59:
                    _fixedNum = 3;
                break;
                case 60:
                    _fixedNum = 4;
                break;
                case 61:
                    _fixedNum = 5;
                break;
                case 62:
                    _fixedNum = 6;
                break;
                case 63:
                    _fixedNum = 7;
                break;
        
            default:
                break;
        }
        } else {
        switch (_fieldNum) {
                case 56:
                    _fixedNum = 0;
                break;
                case 57:
                    _fixedNum = 1;
                break;
                case 58:
                    _fixedNum = 2;
                break;
                case 59:
                    _fixedNum = 3;
                break;
                case 60:
                    _fixedNum = 4;
                break;
                case 61:
                    _fixedNum = 5;
                break;
                case 62:
                    _fixedNum = 6;
                break;
                case 63:
                    _fixedNum = 7;
                break;

                case 48:
                    _fixedNum = 8;
                break;
                case 49:
                    _fixedNum = 9;
                break;
                case 50:
                    _fixedNum = 10;
                break;
                case 51:
                    _fixedNum = 11;
                break;
                case 52:
                    _fixedNum = 12;
                break;
                case 53:
                    _fixedNum = 13;
                break;
                case 54:
                    _fixedNum = 14;
                break;
                case 55:
                    _fixedNum = 15;
                break;

                case 40:
                    _fixedNum = 16;
                break;
                case 41:
                    _fixedNum = 17;
                break;
                case 42:
                    _fixedNum = 18;
                break;
                case 43:
                    _fixedNum = 19;
                break;
                case 44:
                    _fixedNum = 20;
                break;
                case 45:
                    _fixedNum = 21;
                break;
                case 46:
                    _fixedNum = 22;
                break;
                case 47:
                    _fixedNum = 23;
                break;

                case 32:
                    _fixedNum = 24;
                break;
                case 33:
                    _fixedNum = 25;
                break;
                case 34:
                    _fixedNum = 26;
                break;
                case 35:
                    _fixedNum = 27;
                break;
                case 36:
                    _fixedNum = 28;
                break;
                case 37:
                    _fixedNum = 29;
                break;
                case 38:
                    _fixedNum = 30;
                break;
                case 39:
                    _fixedNum = 31;
                break;

                case 24:
                    _fixedNum = 32;
                break;
                case 25:
                    _fixedNum = 33;
                break;
                case 26:
                    _fixedNum = 34;
                break;
                case 27:
                    _fixedNum = 35;
                break;
                case 28:
                    _fixedNum = 36;
                break;
                case 29:
                    _fixedNum = 37;
                break;
                case 30:
                    _fixedNum = 38;
                break;
                case 31:
                    _fixedNum = 39;
                break;

                case 16:
                    _fixedNum = 40;
                break;
                case 17:
                    _fixedNum = 41;
                break;
                case 18:
                    _fixedNum = 42;
                break;
                case 19:
                    _fixedNum = 43;
                break;
                case 20:
                    _fixedNum = 44;
                break;
                case 21:
                    _fixedNum = 45;
                break;
                case 22:
                    _fixedNum = 46;
                break;
                case 23:
                    _fixedNum = 47;
                break;

                case 8:
                    _fixedNum = 48;
                break;
                case 9:
                    _fixedNum = 49;
                break;
                case 10:
                    _fixedNum = 50;
                break;
                case 11:
                    _fixedNum = 51;
                break;
                case 12:
                    _fixedNum = 52;
                break;
                case 13:
                    _fixedNum = 53;
                break;
                case 14:
                    _fixedNum = 54;
                break;
                case 15:
                    _fixedNum = 55;
                break;

                case 0:
                    _fixedNum = 56;
                break;
                case 1:
                    _fixedNum = 57;
                break;
                case 2:
                    _fixedNum = 58;
                break;
                case 3:
                    _fixedNum = 59;
                break;
                case 4:
                    _fixedNum = 60;
                break;
                case 5:
                    _fixedNum = 61;
                break;
                case 6:
                    _fixedNum = 62;
                break;
                case 7:
                    _fixedNum = 63;
                break;
        
            default:
                break;
        }
    }
        return(_fixedNum);
    }
    function getFieldIndex(_field){
        for (let index = 0; index < fields.length; index++) {
            if(_field.isEqualNode(fields[index])){
                return index;
            }
        }
        return ('error');
    }
    async function handleFieldClick(e) {
        let figureType;

        let _fieldNumber;

        let _selectedField;

        if(e.target.classList.contains('field')){
            _selectedField = e.target;
            if(e.target.children[0] == undefined){
                _fieldNumber = getFieldIndex(e.target);
                _remapedFieldNumber = remapFieldNumber(_fieldNumber);
                console.log("Field Nr: " + _remapedFieldNumber + "\r\nFigure: " + "empty");
            } else {
                figureType = e.target.children[0].children[0].children[0].classList;
                figureType = figureType[1];
                _fieldNumber = getFieldIndex(e.target);
            }
        } else if(e.target.classList.contains('figure')){
            figureType = e.target.children[0].children[0].classList;
            figureType = figureType[1];
            _fieldNumber = getFieldIndex(e.target.parentNode);
        } else if(e.target.classList.contains('chessCard')){
            figureType = e.target.children[0].classList;
            figureType = figureType[1];
            _fieldNumber = getFieldIndex(e.target.parentNode.parentNode);
        } else if(e.target.classList.contains('card-top')){
            figureType = e.target.classList;
            figureType = figureType[1];
            _fieldNumber = getFieldIndex(e.target.parentNode.parentNode.parentNode);
        } else if(e.target.classList.contains('card-front') || e.target.classList.contains('card-back') || e.target.classList.contains('card-left') || e.target.classList.contains('card-right') || e.target.classList.contains('card-bot')){
            figureType = e.target.parentNode.children[0].classList;
            figureType = figureType[1];
            _fieldNumber = getFieldIndex(e.target.parentNode.parentNode.parentNode);
        }

        _remapedFieldNumber = remapFieldNumber(_fieldNumber);
        _remapedLastFieldNumber = remapFieldNumber(lastClickedField);
        _selectedField = fields[_fieldNumber];
/*         _fieldNumber =

        _fieldNumber--;

        _fieldNumber = 62 - _fieldNumber; */

        if(_selectedField.classList.contains('focusedFieldWhite') || _selectedField.classList.contains('focusedFieldBlack')){
            // IF FIELD IS HIGHLIGHTED REGISTER MOVE
            if(currentPlayer == 1){
                if(fields[lastClickedField].children[0].classList.contains('figure-white')){
                    let _moveRes = await SendPlayerMove(_remapedFieldNumber, _remapedLastFieldNumber);
                    if(_moveRes == "MoveOK"){
                        performMove(_fieldNumber, lastClickedField);
                        console.log("White player moved:\r\nFrom: " + _remapedLastFieldNumber + "\r\nTo: " + _remapedFieldNumber);
                        let _getPlayer = await GetCurrentPlayer();
                        if(_getPlayer == currentPlayer){
                            // Send req to figure what caused break
                            let _breakOption = await GetBreakOption();
                            console.log("Break option data recieved!");
                            switch (_breakOption) {
                                case 'Promotion':
                                    // Popup Promotion UI
                                    let _promotionPickForm = document.querySelector('#sendPromotionPickForm');
                                    _promotionPickForm.style.visibility = 'visible';
                                    /* let _promotionFigure = prompt("Select Figure:\r\n- queen,\r\n- knight", "queen");
                                    let _promotionRes = await PromotePawn(_remapedFieldNumber, _promotionFigure);
                                    if(_promotionRes == "PromotionOK"){
                                        togglePlayer();
                                    } */
                                break;
                            
                                default:
                                break;
                            }
                        } else {
                            togglePlayer();
                        }
                        /* let _canTogglePlayer = await GetBreakOption();
                        if(_canTogglePlayer == "ToggleOK"){
                            togglePlayer();
                        } else {
                            console.log("Cant toggle cuz: " + _canTogglePlayer);
                        } */
                    } else {
                        console.log("Server: Invalid Move!");
                    }
                    //performMove(_fieldNumber, lastClickedField);
                }
            } else {
                if(fields[lastClickedField].children[0].classList.contains('figure-black')){
                    let _moveRes = await SendPlayerMove(_remapedFieldNumber, _remapedLastFieldNumber);
                    if(_moveRes == "MoveOK"){
                        performMove(_fieldNumber, lastClickedField);
                        console.log("Black player moved:\r\nFrom: " + _remapedLastFieldNumber + "\r\nTo: " + _remapedFieldNumber);
                        let _getPlayer = await GetCurrentPlayer();
                        if(_getPlayer == currentPlayer){
                            let _breakOption = await GetBreakOption();
                            console.log("Break option data recieved!");
                            switch (_breakOption) {
                                case 'Promotion':
                                    // Popup Promotion UI
                                    let _promotionPickForm = document.querySelector('#sendPromotionPickForm');
                                    _promotionPickForm.style.visibility = 'visible';
                                    /* let _promotionFigure = await prompt("Select Figure:\r\n- queen,\r\n- knight", "queen");
                                    let _promotionRes = await PromotePawn(_remapedFieldNumber, _promotionFigure);
                                    if(_promotionRes == "PromotionOK"){
                                        togglePlayer();
                                    } */
                                break;
                            
                                default:
                                break;
                            }
                        } else {
                            togglePlayer();
                        }
                        /* let _canTogglePlayer = await GetBreakOption();
                        if(_canTogglePlayer == "ToggleOK"){
                            togglePlayer();
                        } else {
                            console.log("Cant toggle cuz: " + _canTogglePlayer);
                        } */
                    } else {
                        console.log("Server: Invalid Move!");
                    }
                    //performMove(_fieldNumber, lastClickedField);
                }
            }
        } else if(_selectedField.classList.contains('enemyFieldBlack') || _selectedField.classList.contains('enemyFieldWhite')){
            if(currentPlayer == 1){
                if(fields[lastClickedField].children[0].classList.contains('figure-white')){
                    let _moveRes = await SendPlayerMove(_remapedFieldNumber, _remapedLastFieldNumber);
                    if(_moveRes == "MoveOK"){
                        performAttack(_fieldNumber, lastClickedField);
                        let _getPlayer = await GetCurrentPlayer();
                        if(_getPlayer == currentPlayer){
                            let _breakOption = await GetBreakOption();
                            console.log("Break option data recieved!");
                            switch (_breakOption) {
                                case 'Promotion':
                                    // Popup Promotion UI
                                    let _promotionPickForm = document.querySelector('#sendPromotionPickForm');
                                    _promotionPickForm.style.visibility = 'visible';
                                    /* let _promotionFigure = prompt("Select Figure:\r\n- queen,\r\n- knight", "queen");
                                    let _promotionRes = await PromotePawn(_remapedFieldNumber, _promotionFigure);
                                    if(_promotionRes == "PromotionOK"){
                                        togglePlayer();
                                    } */
                                break;
                            
                                default:
                                break;
                            }
                        } else {
                            togglePlayer();
                        }
                        console.log("White player attacked:\r\nFrom: " + _remapedLastFieldNumber + "\r\nTo: " + _remapedFieldNumber);
                        /* let _canTogglePlayer = await GetBreakOption();
                        if(_canTogglePlayer == "ToggleOK"){
                            togglePlayer();
                        } else {
                            console.log("Cant toggle cuz: " + _canTogglePlayer);
                        } */
                    } else {
                        console.log("Server: Invalid Move!");
                    }
                    //performAttack(_fieldNumber, lastClickedField);
                }
            } else {
                if(fields[lastClickedField].children[0].classList.contains('figure-black')){
                    let _moveRes = await SendPlayerMove(_remapedFieldNumber, _remapedLastFieldNumber);
                    if(_moveRes == "MoveOK"){
                        performAttack(_fieldNumber, lastClickedField);
                        let _getPlayer = await GetCurrentPlayer();
                        if(_getPlayer == currentPlayer){
                            let _breakOption = await GetBreakOption();
                            console.log("Break option data recieved!");
                            switch (_breakOption) {
                                case 'Promotion':
                                    // Popup Promotion UI
                                    let _promotionPickForm = document.querySelector('#sendPromotionPickForm');
                                    _promotionPickForm.style.visibility = 'visible';
                                    /* let _promotionFigure = await prompt("Select Figure:\r\n- queen,\r\n- knight", "queen");
                                    let _promotionRes = await PromotePawn(_remapedFieldNumber, _promotionFigure);
                                    if(_promotionRes == "PromotionOK"){
                                        togglePlayer();
                                    } */
                                break;
                            
                                default:
                                break;
                            }
                        } else {
                            togglePlayer();
                        }
                        console.log("Black player attacked:\r\nFrom: " + _remapedLastFieldNumber + "\r\nTo: " + _remapedFieldNumber);
                        /* let _canTogglePlayer = await GetBreakOption();
                        if(_canTogglePlayer == "ToggleOK"){
                            togglePlayer();
                        } else {
                            console.log("Cant toggle cuz: " + _canTogglePlayer);
                        } */
                    } else {
                        console.log("Server: Invalid Move!");
                    }
                    //performAttack(_fieldNumber, lastClickedField);
                }
            }
        } else {
            // ELSE PERFORM NORMAL CLICK
        clearHighlightedFields();

        clearEnemylightedFields();

        

        if(figureType != null){
            figureType = figureType.slice(3, figureType.length);
            console.log("Field Nr: " + _remapedFieldNumber + "\r\nFigure: " + figureType);
        }

        // Switch figureType

        let _fieldsAhead;
        let _fieldsBehind;
        let _fieldsLeft;
        let _fieldsLeftTop;
        let _fieldsLeftBot;
        let _fieldsRight;
        let _fieldsRightTop;
        let _fieldsRightBot;

        

        if(figureType != null){
            if(currentPlayer == 1){
                if(fields[_fieldNumber].children[0].classList.contains('figure-white')){
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
    
                    _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 1).slice(0, 1), 1);
                        _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 1).slice(0, 1), 1);
    
                        enemylightFields(_fieldsLeftTop, 1, 1);
                        enemylightFields(_fieldsRightTop, 1, 1);
                    
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
                    case 'bishop':
    
                        _fieldsLeftBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 0), 1);
                        _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 0, 1), 1);
                        _fieldsRightBot = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 0), 1);
                        _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 1, 1, 1), 1);
    
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
                            let bot1 = enemylightFields(getFieldsHorizontally(_fieldsBehind[1], 1, 1).slice(0,1), 1);
                            let bot2 = enemylightFields(getFieldsHorizontally(_fieldsBehind[1], 1, 0).slice(0,1), 1)
                            highlightFieldsInLine(bot1, 1);
                            highlightFieldsInLine(bot2, 1);
                        }
                    break;
                    
                default:
                    break;
                    }
                }
                
            } else {
                if(fields[_fieldNumber].children[0].classList.contains('figure-black')){
                    switch (figureType) {
                        case 'pawn-white':
    
                            _fieldsAhead = getFieldsVertically(_fieldNumber, 0, 1);
                            if(_fieldNumber >= 8 && _fieldNumber <= 15){
                                    _fieldsAhead = _fieldsAhead.slice(0, 2);
                                } else {
                                    _fieldsAhead = _fieldsAhead.slice(0, 1);
                                }
                                _fieldsAhead = enemylightFields(_fieldsAhead, 0, false);
    
                                highlightFieldsInLine(_fieldsAhead, 1);
    
                                _fieldsLeftTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 0, 1).slice(0, 1), 0);
                            _fieldsRightTop = enemylightFields(getFieldsDiagonally(_fieldNumber, 0, 1, 1).slice(0, 1), 0);
    
                            enemylightFields(_fieldsLeftTop, 0, 1);
                            enemylightFields(_fieldsRightTop, 0, 1);
    
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
                        case 'knight-white':
    
                                        _fieldsAhead = getFieldsVertically(_fieldNumber, 0, 1).slice(0, 2);
                                        _fieldsBehind = getFieldsVertically(_fieldNumber, 0, 0).slice(0, 2);
                                        _fieldsLeft = getFieldsHorizontally(_fieldNumber, 0, 0).slice(0, 2);
                                        _fieldsRight = getFieldsHorizontally(_fieldNumber, 0, 1).slice(0, 2);
    
                                        if(_fieldsAhead[1] != null){
                                            let top1 = enemylightFields(getFieldsHorizontally(_fieldsAhead[1], 0, 0).slice(0,1), 0);
                                            let top2 = enemylightFields(getFieldsHorizontally(_fieldsAhead[1], 0, 1).slice(0,1), 0);
                                            highlightFieldsInLine(top1, 1);
                                            highlightFieldsInLine(top2, 1);
                                        }
                                        
                                        if(_fieldsRight[1] != null){
                                            let right1 = enemylightFields(getFieldsVertically(_fieldsRight[1], 0, 1).slice(0,1), 0);
                                            let right2 = enemylightFields(getFieldsVertically(_fieldsRight[1], 0, 0).slice(0,1), 0);
                                            highlightFieldsInLine(right1, 1);
                                            highlightFieldsInLine(right2, 1);
                                        }
    
                                        if(_fieldsLeft[1] != null){
                                            let left1 = enemylightFields(getFieldsVertically(_fieldsLeft[1], 0, 1).slice(0,1), 0);
                                            let left2 = enemylightFields(getFieldsVertically(_fieldsLeft[1], 0, 0).slice(0,1), 0);
                                            highlightFieldsInLine(left1, 1);
                                            highlightFieldsInLine(left2, 1);
                                        }
    
                                        if(_fieldsBehind[1] != null){
                                            let bot1 = enemylightFields(getFieldsHorizontally(_fieldsBehind[1], 0, 1).slice(0,1), 0);
                                            let bot2 = enemylightFields(getFieldsHorizontally(_fieldsBehind[1], 0, 0).slice(0,1), 0);
                                            highlightFieldsInLine(bot1, 1);
                                            highlightFieldsInLine(bot2, 1);
                                        }
                                    break;
    
                        default:
                            break;
                    }
                }
            }
        }

        
    }
        lastClickedField = _fieldNumber;
    }
    function toggleHighlightKing(_isWhite = true){
        if(_isWhite){
            if(fields[getKingFieldNum(_isWhite)].classList.contains('checkFieldWhite')){
                fields[getKingFieldNum(_isWhite)].classList.remove('checkFieldWhite');
            } else {
                fields[getKingFieldNum(_isWhite)].classList.add('checkFieldWhite');
            }
        } else {
            if(fields[getKingFieldNum(_isWhite)].classList.contains('checkFieldBlack')){
                fields[getKingFieldNum(_isWhite)].classList.remove('checkFieldBlack');
            } else {
                fields[getKingFieldNum(_isWhite)].classList.add('checkFieldBlack');
            }
        }
    }
    function getKingFieldNum(_isWhite = true){
        _king = 'empty';
        if(_isWhite){
            for (let index = 0; index < fields.length; index++) {
                if(fields[index].childElementCount > 0){
                    if(fields[index].childNodes[0].children[0].children[0].classList.contains('bg-king')){
                        _king = index;
                    }
                }
            }
        } else {
            for (let index = 0; index < fields.length; index++) {
                if(fields[index].childElementCount > 0){
                    if(fields[index].childNodes[0].children[0].children[0].classList.contains('bg-king-white')){
                        _king = index;
                    }
                }
            }
        }
        return(_king);
    }
    function NewTurn(){
        if(currentPlayer == 1 && hasCheck == 1){
            toggleHighlightKing(1);
        }
        if(currentPlayer == 1 && hasCheck == 2){
            // Player One wins
        }
        if(currentPlayer == 2 && hasCheck == 2){
            /* figureType = "bg-king-white";
            _fieldNumber = getKingFieldNum(0); */
            toggleHighlightKing(0);
        }
        if(currentPlayer == 2 && hasCheck == 1){
            // Player Two wins
        }
    }
//#endregion UI Methods



async function NewConn(){
    const _connForm = document.querySelector('#connForm');
    const _formattedFormData = new FormData(_connForm);
    connStatus = 'NotConnected';
    let _res = await PostData(_formattedFormData);
    if(_res == 'ConnOK') connStatus = 'Connected';
    else infoMsg += "Could not connect!\r\n";
    return(connStatus);
}
async function CheckGameStatus(){
        const _statusForm = document.querySelector('#statusForm');
        const _formattedFormData = new FormData(_statusForm);
        let _res = await PostData(_formattedFormData);
        if(_res == null){
            infoMsg += "No response for Game Status Check!\r\n";
            gameStatus = "No response for Game Status Check!";
        } else gameStatus = _res;
        return(gameStatus);
}
async function GetFields(){
    const _getFieldsForm = document.querySelector('#getFieldsForm');
    const _formattedFormData = new FormData(_getFieldsForm);
    let _res = await PostDataArray(_formattedFormData);

    if(_res == []) infoMsg += "No response for Get Fields!\r\n";
    else infoMsg += "Field data recieved!\r\n";
    return(_res);
}
async function SendPlayerMove(_moveToField, _moveFromField){
    const _playerMoveForm = document.querySelector('#playerMoveForm');
    let _formattedFormData = new FormData(_playerMoveForm);
    _formattedFormData.append('moveToField', _moveToField);
    _formattedFormData.append('moveFromField', _moveFromField);
    let _res = await PostData(_formattedFormData);
    if(_res == null){
        infoMsg += "No response for Player Move!\r\n";
        /* gameStatus = "No response for Player Move!"; */
    } else if(_res == "MoveBAD") infoMsg += "Player Move Response: Bad Move!\r\n";
    return(_res);
}
async function GetBreakOption(){
    const _getBreakOptionForm = document.querySelector('#getBreakOptionForm');
    let _formattedFormData = new FormData(_getBreakOptionForm);
    let _res = await PostData(_formattedFormData);
    if(_res == null){
        infoMsg += "No response for getBreakOption!\r\n";
        /* gameStatus = "No response for Player Move!"; */
    } else {
        // _res: (Error, Check, Promotion, ToggleOK, End(Win, Lose, Tie))
        /* switch (_res) {
            case "Promotion":
                console.log("Promotion!");
            break;
            case "Check":
                console.log("Check!");
            break;
            case "End":
                // TODO CHECK FOR WIN, LOSE, TIE
                console.log("End!");
            break;
            case "ToggleOK":
                togglePlayer();
            break;
        
            // Error
            default:
                break;
        } */
        infoMsg += "Player Move Response: Bad Move!\r\n";
    }
    return(_res);
}
async function PromotePawn(/* _remapedFieldNumber *//* ,  */_promotionFigure){
    const _getBreakOptionForm = document.querySelector('#sendPromotionPickForm');
    let _formattedFormData = new FormData(_getBreakOptionForm);
    _formattedFormData.append("figure", _promotionFigure);
    let _res = await PostData(_formattedFormData);
    if(_res == null){
        infoMsg += "No response for getBreakOption!\r\n";
        /* gameStatus = "No response for Player Move!"; */
    } else {
        // _res: (Error, Check, Promotion, ToggleOK, End(Win, Lose, Tie))
        /* switch (_res) {
            case "Promotion":
                console.log("Promotion!");
            break;
            case "Check":
                console.log("Check!");
            break;
            case "End":
                // TODO CHECK FOR WIN, LOSE, TIE
                console.log("End!");
            break;
            case "ToggleOK":
                togglePlayer();
            break;
        
            // Error
            default:
                break;
        } */
        infoMsg += "Player Move Response: Bad Move!\r\n";
    }
    return(_res);
}
async function GetCurrentPlayer(){
    const _getPlayerForm = document.querySelector('#getPlayerForm');
    const _formattedFormData = new FormData(_getPlayerForm);
    let _res = await PostDataArray(_formattedFormData);

    if(_res == null) infoMsg += "No response for Get Current Player!\r\n";
    else infoMsg += "Current Player data recieved!\r\n";
    return(_res);
}
async function PostData(formattedFormData){
    const response = await fetch('./backend/handleChess.php',{
        method: 'POST',
        body: formattedFormData,
        mode:"cors"
    });
    const data = await response.text();
    if(Array.isArray(data)){
        data.forEach(el => {
            console.log(el);
        });
    } else {
        console.log(data);
    }
    return(data);
}
async function PostDataArray(formattedFormData){
    const response = await fetch('./backend/handleChess.php',{
        method: 'POST',
        body: formattedFormData,
        mode:"cors"
    });
    const data = await response.json();
    console.log(data);
    /* if(Array.isArray(data)){
        data.forEach(el => {
            console.log(el);
        });
    } else {
        console.log(data);
    } */
    return(data);
}
async function init(){
    Setup();
    if(await NewConn() == 'Connected'){
        console.log("Connection established!");
        if(await CheckGameStatus() == 'InProgress'){
            console.log("Game Status: InProgress");
            fieldData = await GetFields();
            if(fieldData.length == 64){
                console.log("Field data recieved!");
                SyncFields(fieldData);
                console.log("Fields sync complete!");
                currentPlayer = parseInt(await GetCurrentPlayer());
                console.log("Current player data recieved!");
                if(currentPlayer == 1){
                    switchToPlayer1();
                } else if(currentPlayer == 2){
                    switchToPlayer2();
                } 
                console.log("Current player: " + currentPlayer);
                /* PlayerMove(); */
            } else {
                // Popup msg
            }
        } else if(gameStatus == 'inactive') {
            // Popup somethin
        }
    } else {
        // Popup retry btn
    }
}
function SyncFields(_fieldData){
        for(let i = 0; i < fields.length; i++){
            if(_fieldData[i] == 'black-rook'){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteRookText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'black-knight'){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteKnightText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'black-bishop'){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteBishopText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'black-queen'){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteQueenText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'black-king'){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteKingText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'black-pawn'){
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whitePawnText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }

            if(_fieldData[i] == 'white-rook'){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackRookText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'white-knight'){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackKnightText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'white-bishop'){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackBishopText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'white-queen'){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackQueenText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'white-king'){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackKingText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }
            if(_fieldData[i] == 'white-pawn'){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackPawnText;
                fields[remapFieldNumber(i, true)].appendChild(figure);
            }

            if(_fieldData[i] == 'empty'){
                fields[remapFieldNumber(i, true)].innerHTML = '';
            }
        }
}
async function GetPromotedPick(){
    const _getPromotedPickForm = document.querySelector('#getPromotedPickForm');
    const _formattedFormData = new FormData(_getPromotedPickForm);
    let _res = await PostData(_formattedFormData);

    if(_res == null) infoMsg += "No response for Get Promoted Pick!\r\n";
    else infoMsg += "Get Promoted Pick data recieved!\r\n";
    return(_res);
}
function Setup(){

    whiteGrave.innerHTML = "White Graveyard";
blackGrave.innerHTML = "Black Graveyard";

    /* switchToPlayer1(); */

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

    /* resetBoard(); */

    // DEV BUTTONS
    for (let index = 0; index < uiBoard.children[0].children.length; index++) {
        if(index == uiBoard.children[0].children.length - 1){
            uiBoard.children[0].children[index].addEventListener('click', () => {
                resetBoard();
            });
        }
        if(index == uiBoard.children[0].children.length - 2){
            uiBoard.children[0].children[index].addEventListener('click', () => {
                wipeBoard();
            });
        }
        if(index == uiBoard.children[0].children.length - 3){
            uiBoard.children[0].children[index].addEventListener('click', () => {
                toggleHighlightKing(1);
            });
        }
        if(index == uiBoard.children[1].children.length - 1){
            uiBoard.children[1].children[index].addEventListener('click', () => {
                resetBoard();
            });
        }
        if(index == uiBoard.children[1].children.length - 2){
            uiBoard.children[1].children[index].addEventListener('click', () => {
                wipeBoard();
            });
        }
        if(index == uiBoard.children[1].children.length - 3){
            uiBoard.children[1].children[index].addEventListener('click', () => {
                toggleHighlightKing(0);
            });
        }
    }

    let _promForm = document.querySelector('#sendPromotionPickForm');
    let _promBtns = _promForm.querySelectorAll('button');

    for (let index = 0; index < _promBtns.length; index++) {
        
            _promBtns[index].addEventListener('click', async (e) => {
                e.preventDefault();
                let _promotionRes;
                if(_promBtns[index].id == "queen-btn"){
                    _promotionRes = await PromotePawn('queen');
                    
                } else if(_promBtns[index].id == "knight-btn"){
                    _promotionRes = await PromotePawn('knight');
                }

                if(_promotionRes == "PromotionOK"){
                    let _promotionPickForm = document.querySelector('#sendPromotionPickForm');
                    _promotionPickForm.style.visibility = 'hidden';
                    let _promotedPick = await GetPromotedPick();
                    if(_promotedPick != null){
                        let _splitPick = _promotedPick.split(" ");
                        console.log(_splitPick[0]);
                        console.log(_splitPick[1]);
                        _splitPick[1] = parseInt(_splitPick[1]);
                        _splitPick[1] = remapFieldNumber(_splitPick[1], true);
                        console.log("Promoted figure data recieved!");

                        killFigure(_splitPick[1]);
                        moveFigureToGrave(_splitPick[1]);
                        /* fields[_splitPick[1]].innerHTML = ''; */
                        if(_splitPick[0] == 'black-rook'){
                            let figure = blackFigure.cloneNode();
                            figure.innerHTML = whiteRookText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
                        if(_splitPick[0] == 'black-knight'){
                            let figure = blackFigure.cloneNode();
                            figure.innerHTML = whiteKnightText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
                        if(_splitPick[0] == 'black-bishop'){
                            let figure = blackFigure.cloneNode();
                            figure.innerHTML = whiteBishopText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
                        if(_splitPick[0] == 'black-queen'){
                            let figure = blackFigure.cloneNode();
                            figure.innerHTML = whiteQueenText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
            
                        if(_splitPick[0] == 'white-rook'){
                            let figure = whiteFigure.cloneNode();
                            figure.innerHTML = blackRookText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
                        if(_splitPick[0] == 'white-knight'){
                            let figure = whiteFigure.cloneNode();
                            figure.innerHTML = blackKnightText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
                        if(_splitPick[0] == 'white-bishop'){
                            let figure = whiteFigure.cloneNode();
                            figure.innerHTML = blackBishopText;
                            fields[_splitPick[1]].appendChild(figure);
                        }
                        if(_splitPick[0] == 'white-queen'){
                            let figure = whiteFigure.cloneNode();
                            figure.innerHTML = blackQueenText;
                            fields[_splitPick[1]].appendChild(figure);
                        }

                    }
                    togglePlayer();
                } 
            });
        
        
    }
}
/* async function SendPromotionPick(e, _promotionFigure){
    e.preventDefault();
    let _promotionRes = await PromotePawn(_remapedFieldNumber, _promotionFigure);
    if(_promotionRes == "PromotionOK"){
        togglePlayer();
    } 
} */




document.addEventListener('DOMContentLoaded', () => {
    
    init();

});
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

let fields = document.querySelectorAll('.field');

let highlightedFields = [];

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
    }

    let isOdd = true;

    fields.forEach(field => {

        if(!isOdd){
            field.classList.add('field-white');
            isOdd = !isOdd;
        } else {
            field.classList.add('field-black');
            isOdd = !isOdd;
        }

        field.addEventListener('click', (e) => {

            let figureType;

            let fieldNumber;

            clearHighlightedFields();

            if(e.target.classList.contains('field')){
                if(e.target.children[0] == undefined){
                    console.log("Empty field clicked!");
                    return;
                } else {
                    console.log(e.target);
                    figureType = e.target.children[0].children[0].children[0].classList;
                    figureType = figureType[1];
                    fieldNumber = parseInt(e.target.tabIndex);
                    console.log(figureType);
                    console.log(fieldNumber);
                }
            } else if(e.target.classList.contains('figure')){

                console.log(e.target);

                console.log(e.target.children[0].children[0]);
                figureType = e.target.children[0].children[0].classList;
                figureType = figureType[1];

                /* let figureColor = e.target.classList;
                    figureColor = figureColor[1]; */
    
                    // logs bg-queen
                    console.log(figureType);

                    fieldNumber = parseInt(e.target.parentNode.tabIndex);
                console.log(fieldNumber);
                    /* console.log(figureColor); */
                
            } else if(e.target.classList.contains('chessCard')){
                
                console.log(e.target);
                figureType = e.target.children[0].classList;
                figureType = figureType[1];

                /* let figureColor = e.target.parentNode.classList;
                    figureColor = figureColor[1]; */
    
                    // logs bg-queen
                    console.log(figureType);

                    fieldNumber = parseInt(e.target.parentNode.parentNode.tabIndex);
                console.log(fieldNumber);
                    /* console.log(figureColor); */

            } else if(e.target.classList.contains('card-top')){

                console.log(e.target);
                figureType = e.target.classList;
                figureType = figureType[1];

                /* let figureColor = e.target.parentNode.parentNode.classList;
                    figureColor = figureColor[1]; */
    
                    // logs bg-queen
                    console.log(figureType);
                    fieldNumber = parseInt(e.target.parentNode.parentNode.parentNode.tabIndex);
                console.log(fieldNumber);
                    /* console.log(figureColor); */

            } else if(e.target.classList.contains('card-front') || e.target.classList.contains('card-back') || e.target.classList.contains('card-left') || e.target.classList.contains('card-right') || e.target.classList.contains('card-bot')){

                console.log(e.target);
                figureType = e.target.parentNode.children[0].classList;
                figureType = figureType[1];

                /* let figureColor = e.target.parentNode.parentNode.classList;
                    figureColor = figureColor[1]; */
    
                    // logs bg-queen
                    console.log(figureType);
                    fieldNumber = parseInt(e.target.parentNode.parentNode.parentNode.tabIndex);
                console.log(fieldNumber);
                    /* console.log(figureColor); */

            }

            fieldNumber--;

            // Switch figureType

            switch (figureType) {
                case 'bg-pawn':

                    let fieldsAhead = getFieldsAhead(fields[fieldNumber], fieldNumber, 1)

                    console.log(fieldNumber);

                    if(fieldNumber >= 46 && fieldNumber <= 55){
                            fieldsAhead = fieldsAhead.slice(0, 2);
                        } else {
                            fieldsAhead = fieldsAhead.slice(0, 1);
                        }

                    highlightFieldsAhead(fieldsAhead);
                    
                    break;

                    case 'bg-pawn-white':



                    break;
            
                default:
                    break;
            }



        })
    });

    function clearHighlightedFields(){
        for (let index = 0; index < highlightedFields.length; index++) {
            if(fields[highlightedFields[index]].classList.contains('focusedFieldBlack')){
                fields[highlightedFields[index]].classList.remove('focusedFieldBlack');
            } else {
                fields[highlightedFields[index]].classList.remove('focusedFieldWhite');
            }
            console.log("Clearing Highlighted Field: " + highlightedFields[index]);
        }
        highlightedFields = [];
    }

    function highlightFieldsAhead(_fields){
        let isOdd = false;
        if(fields[_fields[0]].classList.contains('field-white')){
            isOdd = true;
        }
        for (let index = 0; index < _fields.length; index++) {
            if(isOdd){
                fields[_fields[index]].classList.add('focusedFieldBlack');
            } else {
                fields[_fields[index]].classList.add('focusedFieldWhite');
            }
            highlightedFields.push(_fields[index]);
            isOdd = !isOdd;
        }
    }

    function getFieldsBehind(isWhite){
        
    }

    function getFieldsAhead(field, fieldNumber, isWhite){
         let isOdd = field.parentNode.id;
         let fieldsAhead = [];
         isOdd = isOdd.slice(3, 4);
         isOdd = parseInt(isOdd);
         let row = isOdd;
         /* isOdd = isOdd % 2;
         console.log(isOdd); */
            if(isWhite){
                // isWhite num of field should first decrement by 1
                for (let index = 0; index < row; index++) {

                    if(index == 0){
                        fieldsAhead[index] = fieldNumber - 8;
                    } else {
                        if(fieldsAhead[index - 1] - 8 < 0){
                            break;
                        }
                        fieldsAhead[index] = fieldsAhead[index - 1] - 8;
                        /* if(isOdd){
                            if(fieldsAhead[index - 1] - 15 < 0){
                                break;
                            }
                            fieldsAhead[index] = fieldsAhead[index - 1] - 15;
                        } else {
                            if(fieldsAhead[index - 1] - 1 < 0){
                                break;
                            }
                            fieldsAhead[index] = fieldsAhead[index - 1] - 1;
                        } */
                    }
                    /* isOdd = !isOdd; */

                }
                
            } else {
                // isWhite NOT TRUE num of field first should increment by 1
                for (let index = 0; index < 8 - row; index++) {

                    if(index == 0){
                        fieldsAhead[index] = fieldNumber + 8;
                    } else {
                        if(fieldsAhead[index - 1] + 8 > 64){
                            break;
                        }
                        fieldsAhead[index] = fieldsAhead[index - 1] + 8;
                    }
                    
                }
                fieldsAhead.reverse();
            }
         for (let index = 0; index < fieldsAhead.length; index++) {
             
            console.log("Can move on: " + fieldsAhead[index]);

            return(fieldsAhead);
             
         }
     }

    function getFieldsLeft(isWhite){
        
    }

    function getFieldsRight(isWhite){
        
    }

    /* let figures = document.querySelectorAll('.figure');

    figures.forEach(figure => {
        figure.addEventListener('click', (e) => {
            e.target.parentNode.click();
        })
    }); */





})


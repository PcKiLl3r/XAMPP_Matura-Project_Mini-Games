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
            if(i == 4)
            {
                let figure = blackFigure.cloneNode();
                figure.innerHTML = whiteQueenText;
                fields[i].appendChild(figure);
            }
            if(i == 3)
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
            if(i == 60){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackQueenText;
                fields[i].appendChild(figure);
            }
            if(i == 59){
                let figure = whiteFigure.cloneNode();
                figure.innerHTML = blackKingText;
                fields[i].appendChild(figure);
            }
        }
    }

    for (let index = 0; index < fields.length; index++) {
        if(index == fields.length - 1){
            fields[index].addEventListener('click', () => {
                resetBoard();
            });
        }
    }

    fields.forEach(field => {
        field.addEventListener('click', (e) => {
            e.target.focus();
        })
    });





})


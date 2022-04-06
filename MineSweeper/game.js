document.addEventListener('DOMContentLoaded', () => {

    const grid = document.querySelector('.grid');
    let squares = [];
    let isGameOver = false;
    let width;
    let mineAmount;
    let flags = 0;

    // Create board
    function CreateBoard(boardSize) {
        width = boardSize;
        mineAmount = Math.round(boardSize * 1.5);

        // Set proper button size based on size of field set in style.css
        let fieldSize = getComputedStyle(document.documentElement)
            .getPropertyValue('--fieldSize');
        fieldSize = fieldSize.substring(0, fieldSize.length - 2);
        fieldSize = parseInt(fieldSize);
        let boxSize = (fieldSize / boardSize) - 2;
        document.documentElement.style.setProperty('--boxSize', boxSize + 'px');

        /* // Set font size based on boardSize
        let fontSize = (boardSize / 1.5);
        grid.style.fontSize = fontSize + "px"; */

        // Get shuffled array with random bombs
        const minesArray = Array(mineAmount).fill('mine');
        const emptyArray = Array(width * width - mineAmount).fill('valid');
        const gameArray = emptyArray.concat(minesArray);
        const shuffledArray = gameArray.sort(() => Math.random() - 0.5)

        for (let i = 0; i < width * width; i++) {
            const square = document.createElement('div');
            square.setAttribute('id', i);
            square.classList.add(shuffledArray[i]);
            grid.appendChild(square);
            squares.push(square);

            square.addEventListener('click', () => {
                FieldClick(square);
            });

            square.oncontextmenu = function(e) {
                e.preventDefault()
                AddFlag(square);
            }
        }

        // Add numbers
        for (let i = 0; i < width * width; i++) {

            const isLeftEdge = (i % width === 0);
            const isRightEdge = (i % width === width - 1);

            if (squares[i].classList.contains('mine')) continue;

            let total = 0;

            if (i > 0 && !isLeftEdge && squares[i - 1].classList.contains('mine')) total++;
            if (i > width - 1 && !isRightEdge && squares[i + 1 - width].classList.contains('mine')) total++;
            if (i > width && squares[i - width].classList.contains('mine')) total++;
            if (i > width + 1 && !isLeftEdge && squares[i - 1 - width].classList.contains('mine')) total++;

            if (i < width * width - 2 && !isRightEdge && squares[i + 1].classList.contains('mine')) total++;
            if (i < width * width - width && !isLeftEdge && squares[i - 1 + width].classList.contains('mine')) total++;
            if (i < width * width - width - 2 && !isRightEdge && squares[i + 1 + width].classList.contains('mine')) total++;
            if (i < width * width - width && squares[i + width].classList.contains('mine')) total++;

            squares[i].setAttribute('data', total);
        }
    }

    const startBtn = document.querySelector('#startButton');
    const fieldSizeInput = document.querySelector('#fieldSizeInput');

    const timer = document.querySelector('.timer');

    startBtn.addEventListener("click", StartGame);

    function StartGame() {

        if (fieldSizeInput.value < 5 /* || fieldSizeInput.value > 20 */ /* || isNaN(parseInt(fieldSizeInput.value)) */) {
            return;
        }

        isGameOver = false;
        squares = [];
        flags = 0;

        StartTimer();
        grid.innerHTML = '';
        let boardSize = parseInt(fieldSizeInput.value);

        CreateBoard(boardSize);
    }

    function AddFlag(square){
        if(isGameOver) return;
        if(!square.classList.contains('checked') && (flags < mineAmount)){
            if(!square.classList.contains('flag')){
                square.classList.add('flag');
                flags++;
                checkForWin();
            } else {
                square.classList.remove('flag');
                flags--;
                checkForWin();
            }
        }
    }

    function StartTimer() {
        if (typeof myTimer !== 'undefined') {
            clearInterval(myTimer);
        }
        let time = 0;

        let mins = 0;

        timer.innerHTML = time + 's';

        myTimer = setInterval(() => {
            time++;
            if (time > 59 || mins > 0) {
                if (time % 60 == 0) {
                    mins++;
                    time = 0;

                    if (time < 10) {
                        timer.innerHTML = mins + ':0' + time;
                    } else {
                        timer.innerHTML = mins + ':' + time;
                    }
                } else {
                    if (time < 10) {
                        timer.innerHTML = mins + ':0' + time;
                    } else {
                        timer.innerHTML = mins + ':' + time;
                    }
                }
            } else {
                timer.innerHTML = time + 's';
            }

        }, 1000);
    }

    function FieldClick(square){
        let currentId = square.id;
        if(isGameOver) return;
        if(square.classList.contains('checked') || square.classList.contains('flag')) return;
        if(square.classList.contains('mine')){
            GameOver();
            return;
        }
        else {
            let total = square.getAttribute('data');
            if(total != 0){
                square.classList.add('checked');
                square.innerHTML = total;
                return;
            }
            CheckSquare(square, currentId);
        }
        square.classList.add('checked');
    }
    // BUG: failed to recursively open last field
    //      failed to recursively open first field
    
    //      failed to check for bomb in last field
    //      potentially first field as well
    function CheckSquare(square, currentId){
        
        const isLeftEdge = (currentId % width === 0);
        const isRightEdge = (currentId % width === width - 1);

        setTimeout(() => {
            if(currentId > 0 && !isLeftEdge){
                const newId = squares[parseInt(currentId) - 1].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }
            if(currentId > width - 1 && !isRightEdge){
                const newId = squares[parseInt(currentId) + 1 - width].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }
            if(currentId > width){
                const newId = squares[parseInt(currentId) - width].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }
            if(currentId > width + 1 && !isLeftEdge){
                const newId = squares[parseInt(currentId) - width - 1].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }

            if(currentId < width*width - 2 && !isRightEdge){
                const newId = squares[parseInt(currentId) + 1].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }
            if(currentId < width*width - width && !isLeftEdge){
                const newId = squares[parseInt(currentId) + width - 1].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }
            if(currentId < width*width - width - 2 && !isRightEdge){
                const newId = squares[parseInt(currentId) + width + 1].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }
            if(currentId < width*width - width){
                const newId = squares[parseInt(currentId) + width].id;
                const newSquare = document.getElementById(newId);
                FieldClick(newSquare);
            }

        }, 10);
    }

    function GameOver()
    {
        isGameOver = true;

        // Show all the bombs
        squares.forEach(square => {
            if(square.classList.contains('mine'))
            square.classList.add("checked");
        });

        clearInterval(myTimer);

        timer.innerHTML += " - Game Over - You Lost!";
    }

    function checkForWin(){
        let matches = 0;
        let matchWon = false;
        for(let i = 0; i < squares.length; i++){
            if(squares[i].classList.contains('flag') && squares[i].classList.contains('mine')){
                matches++;
            }
            if(matches === mineAmount){
                isGameOver = true;
                matchWon = true;
            }
        }
        if(matchWon == true){
            clearInterval(myTimer);

            timer.innerHTML += " - Game Over - You Won!";
            for(let i = 0; i < squares.length; i++){
            if(!squares[i].classList.contains('checked') && !squares[i].classList.contains('flag')){
                squares[i].classList.add('checked');
            }
        }
        }
    }

});
const _mineField = document.querySelector('#mineField');
const _newGameForm = document.querySelector('#newGameForm');

const formActionURL = './handleGame.php';

let infoMsg;

function Setup() {
    let _newGameButtons = _newGameForm.querySelectorAll('button');
    for (let index = 0; index < _newGameButtons.length; index++) {
        _newGameButtons[index].addEventListener('click', async (e) => {
            e.preventDefault();
            let _newGameRes;
            if (e.target.id == 'SmallField') {
                _newGameRes = await StartNewGame('small');
            } else if (e.target.id == 'MedField') {
                _newGameRes = await StartNewGame('med');
            } else if (e.target.id == 'BigField') {
                _newGameRes = await StartNewGame('big');
            }

            if (_newGameRes == 'NewSmallOK') {
                CreateTable(5);
            } else if (_newGameRes == 'NewMedOK') {
                CreateTable(7);
            } else if (_newGameRes == 'NewBigOK') {
                CreateTable(9);
            }
            _newGameForm.style.visibility = 'hidden';
        });
    }
}
function CreateTable(_size) {
    let _td = document.createElement('td');
    let _button = document.createElement('button');
    _button.classList.add('Field');
    _button.classList.add('HiddenField');
    _td.appendChild(_button.cloneNode(1));

    for (let index = 0; index < _size; index++) {
        let _tr = document.createElement('tr');
        for (let index2 = 0; index2 < _size; index2++) {

            _tr.appendChild(_td.cloneNode(1));

        }
        _mineField.appendChild(_tr.cloneNode(1));
    }

    const _fields = document.querySelectorAll('.Field');


    for (let index = 0; index < _fields.length; index++) {
        _fields[index].innerHTML = '&nbsp;';
        _fields[index].id = index;
        _fields[index].addEventListener('click', async (e) => {
            e.preventDefault();

            let _moveRes = await SendMove(e.target.id);
            if(/* Array.isArray(_moveRes) */ 0){

            } else {
                if (_moveRes >= 0 && _moveRes < 9 || _moveRes == 'mine') {
                    if(_moveRes == 0){
                        e.target.innerHTML = '&nbsp;'
                    } else if(_moveRes == 'mine'){
                        e.target.innerHTML = '<i class="fas fa-bomb"></i>';
                    } else {
                        e.target.innerHTML = _moveRes
                    }
                    
                    e.target.style.backgroundColor = "#ddd";
                } else {
                    /* console.log(_moveRes); */
                }
            }
        });
        
        _fields[index].addEventListener('contextmenu', function(el) {
        el.preventDefault();

        if(_fields[index].innerHTML == '<i class="fas fa-flag-checkered"></i>'){
            _fields[index].innerHTML = _fields[index].data;
            _fields[index].data = '<i class="fas fa-flag-checkered"></i>';
        } else {
            _fields[index].data = _fields[index].innerHTML;
            _fields[index].innerHTML = '<i class="fas fa-flag-checkered"></i>';
        }

        return false;
        }, false);
    }
}
async function PostData(formattedFormData) {
    const response = await fetch(formActionURL, {
        method: 'POST',
        body: formattedFormData,
        mode: "cors"
    });
    const data = await response.text();
    if (Array.isArray(data)) {
        data.forEach(el => {
            console.log(el);
        });
    } else {
        console.log(data);
    }
    return (data);
}
async function PostDataArray(formattedFormData) {
    const response = await fetch(formActionURL, {
        method: 'POST',
        body: formattedFormData,
        mode: "cors"
    });
    const data = await response.json();
    console.log(data);
    if(Array.isArray(data)){
        data.forEach(el => {
            console.log(el);
        });
    } else {
        console.log(data);
    }
    return (data);
}
async function GetGameStatus() {
    let _getGameStatusForm = document.createElement('form');
    let _formattedFormData = new FormData(_getGameStatusForm);
    _formattedFormData.append("process", 'getGameStatus');
    let _res = await PostData(_formattedFormData);

    if (_res == null) infoMsg += "No response for Get Game Status!\r\n";
    else infoMsg += "Current Game Status data recieved!\r\n";
    return (_res);
}
async function GetConnStatus() {
    let _newConnForm = document.createElement('form');
    let _formattedFormData = new FormData(_newConnForm);
    _formattedFormData.append("process", 'newConn');
    let _res = await PostData(_formattedFormData);

    if (_res == null) infoMsg += "No response for Conn Test!\r\n";
    else infoMsg += "Conn Test data recieved!\r\n";
    return (_res);
}
async function StartNewGame(_selection) {
    let _newGameForm = document.createElement('form');
    let _formattedFormData = new FormData(_newGameForm);
    _formattedFormData.append("process", 'newGame');
    _formattedFormData.append("type", _selection);
    let _res = await PostData(_formattedFormData);

    if (_res == null) infoMsg += "No response for New Game!\r\n";
    else infoMsg += "New Game response data recieved!\r\n";
    return (_res);
}
async function SendMove(_field) {
    let _moveForm = document.createElement('form');
    let _formattedFormData = new FormData(_moveForm);
    _formattedFormData.append("process", 'playerMove');
    _formattedFormData.append("field", _field);
    let _res = await PostData(_formattedFormData);

    if (_res == null) infoMsg += "No response for Player Move!\r\n";
    else infoMsg += "Player Move response data recieved!\r\n";
    return (_res);
}

document.addEventListener("DOMContentLoaded", async () => {

    Setup();
    let _connOK = await GetConnStatus();
    if (_connOK == 'ConnOK') {
        let _gameStatus = await GetGameStatus();
        if (_gameStatus == "InProgress") {
            // GetFieldData();
        } else if (_gameStatus == "Inactive") {
            _newGameForm.style.visibility = 'visible';
        }
    }

});
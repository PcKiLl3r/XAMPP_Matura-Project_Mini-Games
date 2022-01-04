var cursor_x = -1;
            var cursor_y = -1;

            /* function getMouse() {
                cursor_x = window.currentMouseX;
                cursor_y = window.currentMouseY;
                console.log("MouseX: " + cursor_x);
                console.log("MouseY: " + cursor_y);
            } */

            /* function getMouse() {
                window.currentMouseX = 0;
                window.currentMouseY = 0;
            
                // Guess the initial mouse position approximately if possible:
                var hoveredElement = document.querySelectorAll(':hover');
                hoveredElement = hoveredElement[hoveredElement.length - 1]; // Get the most specific hovered element
            
                if (hoveredElement != null) {
                    var rect = hoveredElement.getBoundingClientRect();
                    // Set the values from hovered element's position
                    cursor_x = window.scrollX + rect.x;
                    cursor_y = window.scrollY + rect.y;
                }
            } */
            
            /* getMouse(); */
            
            function onMouseUpdate(e) {
                cursor_x = e.pageX;
                cursor_y = e.pageY;
              }

document.addEventListener('mousemove', onMouseUpdate, false);

document.addEventListener('load', () => {

    document.addEventListener('mouseover', onMouseUpdate, false);
});

document.addEventListener("DOMContentLoaded", () => {

    

    let animDiv = document.body.children[0];
    let animation = animDiv.textContent;

    let speedDiv = document.body.children[1];
    let animSpeed = parseInt(speedDiv.textContent);
    let speed = 0;
    let frameSkip = 0;
    switch (animSpeed) {
            case 1:
                speed = 8;
                frameSkip = 5;
            break;
            case 2:
                speed = 6;
                frameSkip = 10;
            break;
            case 3:
                speed = 5;
                frameSkip = 15;
            break;
            case 4:
                speed = 4;
                frameSkip = 20;
            break;
            case 5:
                speed = 3;
                frameSkip = 25;
            break;
            case 6:
                speed = 2.5;
                frameSkip = 25;
            break;
    
        default:
            speed = 10;
            break;
    }

let currentSides;

let side1Size = 1;
let side2Size = 1;
let side3Size = 1;
let side4Size = 1;
let side5Size = 1;
let side6Size = 1;

function Anim1to2(globIndex, speed, isRev) {
    if(!isRev){
    for (let index = 1; index <= 90; index++) {
        setTimeout(function(){
            side2Size = index / 90;
            side1Size = 1 - side2Size;
            if(index == 1) currentSides = "2,1";
            document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(0deg)';
          }, globIndex * speed);
          globIndex++;
    }
} else {
    for (let index = 89; index >= 0; index--) {
        setTimeout(function(){
            side2Size = index / 90;
            side1Size = 1 - side2Size;
            if(index == 89) currentSides = "2,1";
            document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(0deg)';
          }, globIndex * speed);
          globIndex++;
    }
}
    return(globIndex);
}

function Anim2to3(globIndex, speed, isRev) {
    if(!isRev){
    for (let index = 1; index <= 90; index++) {
        setTimeout(function(){
            side3Size = index / 90;
            side2Size = 1 - side3Size;
            if(index == 1) currentSides = "3,2";
            document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
          }, globIndex * speed);
          globIndex++;
    }
} else {
    for (let index = 89; index >= 0; index--) {
        setTimeout(function(){
            side3Size = index / 90;
            side2Size = 1 - side3Size;
            if(index == 89) currentSides = "3,2";
            document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
          }, globIndex * speed);
          globIndex++;
    }
}
    return(globIndex);
}

function Anim3to5(globIndex, speed, isRev) {
    if(!isRev){
    for (let index = 91; index <= 180; index++) {
        setTimeout(function(){
            side5Size = (index - 90) / 90;
            side3Size = 1 - side5Size;
            if(index == 91) currentSides = "5,3";
            document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
          }, globIndex * speed);
          globIndex++;
    }
} else {
    for (let index = 179; index >= 90; index--) {
        setTimeout(function(){
            side5Size = (index - 90) / 90;
            side3Size = 1 - side5Size;
            if(index == 179) currentSides = "5,3";
            document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
          }, globIndex * speed);
          globIndex++;
    }
}
return(globIndex);
}

function Anim5to4(globIndex, speed, isRev) {
    if(!isRev){
        for (let index = 181; index <= 270; index++) {
            setTimeout(function(){
                side4Size = (index - 180) / 90;
                side5Size = 1 - side4Size;
                if(index == 181) currentSides = "4,5";
                document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
            }, globIndex * speed);
            globIndex++;
        }
    } else {
        for (let index = 269; index >= 180; index--) {
            setTimeout(function(){
                side4Size = (index - 180) / 90;
                side5Size = 1 - side4Size;
                if(index == 269) currentSides = "4,5";
                document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
            }, globIndex * speed);
            globIndex++;
        } 
    }
    return(globIndex);
}

function Anim4to6(globIndex, speed, isRev) {
    if(!isRev){
        for (let index = 91; index <= 180; index++) {
            setTimeout(function(){
                side6Size = (index - 90) / 90;
                side4Size = 1 - side6Size;
                if(index == 91) currentSides = "4,6";
                document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(270deg)';
              }, globIndex * speed);
              globIndex++;
        }
    } else {
        for (let index = 179; index >= 90; index--) {
            setTimeout(function(){
                side6Size = (index - 90) / 90;
                side4Size = 1 - side6Size;
                if(index == 179) currentSides = "4,6";
                document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(270deg)';
              }, globIndex * speed);
              globIndex++;
        }
    }
    
    return(globIndex);
}

function FrameSkip(globIndex, frameSkip, speed){
    for (let index = 1; index <= frameSkip; index++) {
        setTimeout(function(){

          }, globIndex * speed);
          globIndex++;
    }
    return(globIndex);
}

let globIndex = 0;

function playAnimation1(isRev, frameSkip){

    /* console.log(globIndex); */

    if(!isRev){
        setTimeout(function(){
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim1to2(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim2to3(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim3to5(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim5to4(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim4to6(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim4to6(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim5to4(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim3to5(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim2to3(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim1to2(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);

            playAnimation1(0, frameSkip);
    
          }, globIndex * speed );
    
          globIndex /= 512;
    } else {
        setTimeout(function(){
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim4to6(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim5to4(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim3to5(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim2to3(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim1to2(globIndex, speed, 1);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim1to2(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim2to3(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim3to5(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim5to4(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
            globIndex = Anim4to6(globIndex, speed, 0);
            globIndex = FrameSkip(globIndex, frameSkip, speed);
    
            playAnimation1(1, frameSkip);
    
          }, globIndex * speed );
    
          globIndex /= 512;
    }
}

            switch (animation) {
                case '1':
                    document.querySelector('.dice').classList.add('dice-1');
                    playAnimation1(0, frameSkip);
                    /* document.querySelector('.dice').animate([
                        //keyframes
                            {transform: 'rotateY(0deg) rotateX(0deg) rotateZ(0deg)'},
                            {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(0deg)'},
                            {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(90deg)'},
                            {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(180deg)'},
                            {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(270deg)'},
                            {transform: 'rotateY(180deg) rotateX(0deg) rotateZ(270deg)'}
                    ], {
                        // timing options
                        duration: 5000,
                        iterations: Infinity
                      }); */
                    break;
        
                case '2':
                    document.querySelector('.dice').classList.add('dice-6');
                    playAnimation1(1, frameSkip);
                    /* document.querySelector('.dice').animate([
                        //keyframes
                        {transform: 'rotateY(180deg) rotateX(0deg) rotateZ(270deg)'},
                        {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(270deg)'},
                        {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(180deg)'},
                        {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(90deg)'},
                        {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(0deg)'},
                        {transform: 'rotateY(90deg) rotateX(0deg) rotateZ(0deg)'},
                        {transform: 'rotateY(0deg) rotateX(0deg) rotateZ(0deg)'}
                    ], {
                        // timing options
                        duration: 5000,
                        iterations: Infinity
                      }); */
                    break;
            
                default:
                    break;
            }


            



            
            
            /* document.onmousemove = function(event)
            {
             cursor_x = event.pageX;
             cursor_y = event.pageY;
            } */
            
            
            
            setInterval(check_cursor, 1);
            
            const diceFront = document.querySelector('.dice-front');
            const diceTop = document.querySelector('.dice-top');
            const diceLeft = document.querySelector('.dice-left');
            const diceRight = document.querySelector('.dice-right');
            const diceBot = document.querySelector('.dice-bot');
            const diceBack = document.querySelector('.dice-back');
            
            function check_cursor(){
                
                /* if(diceFront.classList.contains('dice-front-black')){
                    diceFront.classList.remove('dice-front-black');
                }
                if(diceLeft.classList.contains('dice-left-black')){
                    diceLeft.classList.remove('dice-left-black');
                }
                if(diceBot.classList.contains('dice-bot-black')){
                    diceBot.classList.remove('dice-bot-black');
                }
                if(diceTop.classList.contains('dice-top-black')){
                    diceTop.classList.remove('dice-top-black');
                }
                if(diceRight.classList.contains('dice-right-black')){
                    diceRight.classList.remove('dice-right-black');
                }
                if(diceBack.classList.contains('dice-back-black')){
                    diceBack.classList.remove('dice-back-black');
                } */
            
            let side1 = parseInt(currentSides.slice(0,1));
            let side2 = parseInt(currentSides.slice(2, 3));
            
            switch (side1) {
                    case 1:
                        if(UnderElement(diceFront, side1Size)){
                            if(!diceFront.classList.contains('dice-front-black'))
                            {
                            diceFront.classList.add('dice-front-black');
                            }
                        } else if(diceFront.classList.contains('dice-front-black')){
                            diceFront.classList.remove('dice-front-black');
                        }
                    break;
                    case 2:
                        if(UnderElement(diceLeft, side2Size)){
                            if(!diceLeft.classList.contains('dice-left-black')){
                                diceLeft.classList.add('dice-left-black');
                            }
                        } else if(diceLeft.classList.contains('dice-left-black')){
                            diceLeft.classList.remove('dice-left-black');
                        }
                    break;
                    case 3:
                        if(UnderElement(diceBot, side3Size)){
                            if(!diceBot.classList.contains('dice-bot-black')){
                                diceBot.classList.add('dice-bot-black');
                            }
                        } else if(diceBot.classList.contains('dice-bot-black')){
                            diceBot.classList.remove('dice-bot-black');
                        }
                    break;
                    case 4:
                        if(UnderElement(diceTop, side4Size)){
                            if(!diceTop.classList.contains('dice-top-black')) {
                                diceTop.classList.add('dice-top-black');
                            }
                        } else if(diceTop.classList.contains('dice-top-black')){
                            diceTop.classList.remove('dice-top-black');
                        }
                    break;
                    case 5:
                        if(UnderElement(diceRight, side5Size)){
                            if(!diceRight.classList.contains('dice-right-black')) {
                                diceRight.classList.add('dice-right-black');
                            }
                        } else if(diceRight.classList.contains('dice-right-black')) {
                            diceRight.classList.remove('dice-right-black');
                        }
                    break;
                    case 6:
                        if(UnderElement(diceBack, side6Size)){
                            if(!diceBack.classList.contains('dice-back-black')) {
                                diceBack.classList.add('dice-back-black');
                            }
                        } else if(diceBack.classList.contains('dice-back-black')){
                            diceBack.classList.remove('dice-back-black');
                        }
                    break;
            
                default:
                    break;
            }
            
            switch (side2) {
                case 1:
                        if(UnderElement(diceFront, side1Size)){
                            if(!diceFront.classList.contains('dice-front-black'))
                            {
                            diceFront.classList.add('dice-front-black');
                            }
                        } else if(diceFront.classList.contains('dice-front-black')){
                            diceFront.classList.remove('dice-front-black');
                        }
                    break;
                    case 2:
                        if(UnderElement(diceLeft, side2Size)){
                            if(!diceLeft.classList.contains('dice-left-black')){
                                diceLeft.classList.add('dice-left-black');
                            }
                        } else if(diceLeft.classList.contains('dice-left-black')){
                            diceLeft.classList.remove('dice-left-black');
                        }
                    break;
                    case 3:
                        if(UnderElement(diceBot, side3Size)){
                            if(!diceBot.classList.contains('dice-bot-black')){
                                diceBot.classList.add('dice-bot-black');
                            }
                        } else if(diceBot.classList.contains('dice-bot-black')){
                            diceBot.classList.remove('dice-bot-black');
                        }
                    break;
                    case 4:
                        if(UnderElement(diceTop, side4Size)){
                            if(!diceTop.classList.contains('dice-top-black')) {
                                diceTop.classList.add('dice-top-black');
                            }
                        } else if(diceTop.classList.contains('dice-top-black')){
                            diceTop.classList.remove('dice-top-black');
                        }
                    break;
                    case 5:
                        if(UnderElement(diceRight, side5Size)){
                            if(!diceRight.classList.contains('dice-right-black')) {
                                diceRight.classList.add('dice-right-black');
                            }
                        } else if(diceRight.classList.contains('dice-right-black')) {
                            diceRight.classList.remove('dice-right-black');
                        }
                    break;
                    case 6:
                        if(UnderElement(diceBack, side6Size)){
                            if(!diceBack.classList.contains('dice-back-black')) {
                                diceBack.classList.add('dice-back-black');
                            }
                        } else if(diceBack.classList.contains('dice-back-black')){
                            diceBack.classList.remove('dice-back-black');
                        }
                    break;
            
                default:
                    break;
            }
            
            /* console.log(side1 + " " + side2); */
            
            }
            
            function getCoords(elem) { // crossbrowser version
                var box = elem.getBoundingClientRect();
            
                var body = document.body;
                var docEl = document.documentElement;
            
                var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
                var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
            
                var clientTop = docEl.clientTop || body.clientTop || 0;
                var clientLeft = docEl.clientLeft || body.clientLeft || 0;
            
                var top  = box.top +  scrollTop - clientTop;
                var left = box.left + scrollLeft - clientLeft;
            
                return { top: Math.round(top), left: Math.round(left) };
            }
            
            function UnderElement(elem, modifier) {
                var elemWidth = elem.offsetWidth * modifier;
                /* console.log("Element Width: " + elemWidth); */
                var elemHeight = elem.offsetHeight * modifier;
                /* console.log("Element Height: " + elemHeight); */
                var elemPosition = getCoords(elem);
                /* console.log("Element Coords: " + elemPosition); */
                var elemPosition2 = new Object;
                /* console.log("Element Position2: " + elemPosition2); */
                elemPosition2.top = elemPosition.top + elemHeight;
                elemPosition2.left = elemPosition.left + elemWidth;
            
                return ((cursor_x > elemPosition.left && cursor_x < elemPosition2.left) && (cursor_y > elemPosition.top && cursor_y < elemPosition2.top))
            }

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', (e) => {
                    /* e.preventDefault(); */
                    
                    // Send dice click info

                })
            });

});

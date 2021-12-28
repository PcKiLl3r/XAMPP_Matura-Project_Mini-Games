
document.addEventListener("DOMContentLoaded", () => {

    let animDiv = document.body.children[0];
    let animation = animDiv.textContent;

    let speedDiv = document.body.children[1];
    let animSpeed = parseInt(speedDiv.textContent);
    let speed = 0;
    switch (animSpeed) {
        case 1:
            speed = 10;
            break;
            case 2:
                speed = 8;
            break;
            case 3:
                speed = 6;
            break;
            case 4:
                speed = 4;
            break;
            case 5:
                speed = 2;
            break;
    
        default:
            speed = 10;
            break;
    }

function Anim1to2(globIndex, speed, isRev) {
    if(!isRev){
    for (let index = 1; index <= 90; index++) {
        setTimeout(function(){
            document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(0deg)';
          }, globIndex * speed);
          globIndex++;
    }
} else {
    for (let index = 89; index >= 0; index--) {
        setTimeout(function(){
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
            document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
          }, globIndex * speed);
          globIndex++;
    }
} else {
    for (let index = 89; index >= 0; index--) {
        setTimeout(function(){
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
            document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
          }, globIndex * speed);
          globIndex++;
    }
} else {
    for (let index = 179; index >= 90; index--) {
        setTimeout(function(){
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
                document.querySelector('.dice').style.transform = 'rotateY(90deg) rotateX(0deg) rotateZ(' + index + 'deg)';
            }, globIndex * speed);
            globIndex++;
        }
    } else {
        for (let index = 269; index >= 180; index--) {
            setTimeout(function(){
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
                document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(270deg)';
              }, globIndex * speed);
              globIndex++;
        }
    } else {
        for (let index = 179; index >= 90; index--) {
            setTimeout(function(){
                document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(270deg)';
              }, globIndex * speed);
              globIndex++;
        }
    }
    
    return(globIndex);
}

let globIndex = 0;

function playAnimation1(isRev){

    if(!isRev){
        setTimeout(function(){

            globIndex = Anim1to2(globIndex, speed, 0);
    
            globIndex = Anim2to3(globIndex, speed, 0);
        
            globIndex = Anim3to5(globIndex, speed, 0);
        
            globIndex = Anim5to4(globIndex, speed, 0);
        
            globIndex = Anim4to6(globIndex, speed, 0);
        
            globIndex = Anim4to6(globIndex, speed, 1);
        
            globIndex = Anim5to4(globIndex, speed, 1);
        
            globIndex = Anim3to5(globIndex, speed, 1);
        
            globIndex = Anim2to3(globIndex, speed, 1);
        
            globIndex = Anim1to2(globIndex, speed, 1);
    
            playAnimation1(0);
    
          }, globIndex * speed );
    
          globIndex /= 512;
    } else {
        setTimeout(function(){

            globIndex = Anim4to6(globIndex, speed, 1);
            globIndex = Anim5to4(globIndex, speed, 1);
            globIndex = Anim3to5(globIndex, speed, 1);
            globIndex = Anim2to3(globIndex, speed, 1);
            globIndex = Anim1to2(globIndex, speed, 1);
            globIndex = Anim1to2(globIndex, speed, 0);
            globIndex = Anim2to3(globIndex, speed, 0);
            globIndex = Anim3to5(globIndex, speed, 0);
            globIndex = Anim5to4(globIndex, speed, 0);
            globIndex = Anim4to6(globIndex, speed, 0);
    
            playAnimation1(1);
    
          }, globIndex * speed );
    
          globIndex /= 512;
    }
}

            switch (animation) {
                case '1':
                    document.querySelector('.dice').classList.add('dice-1');
                    playAnimation1(0);
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
                    playAnimation1(1);
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



    document.querySelector('.dice').childNodes.forEach(element => {
        element.addEventListener('mouseenter', () => {
            console.log("jure");
        })
    });

});

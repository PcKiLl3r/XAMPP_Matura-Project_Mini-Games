
document.addEventListener("DOMContentLoaded", () => {

    let animDiv = document.body.children[0];
    let animation = animDiv.textContent;

    let speedDiv = document.body.children[1];
    let speed = speedDiv.textContent;

    async function timeFunction1() {
        document.querySelector('.dice').style.transform = 'rotateY(0deg) rotateX(0deg) rotateZ(0deg)';
            
                for (let index = 1; index <= 90; index++) {
                    setTimeout(() => {
                    document.querySelector('.dice').style.transform = 'rotateY(' + index + 'deg) rotateX(0deg) rotateZ(0deg)';
                }, 1000);
                }

    }

    var i = 1;                  //  set your counter to 1

function timeFunction1() {         //  create a loop function
  setTimeout(function() {   //  call a 3s setTimeout when the loop is called
    document.querySelector('.dice').style.transform = 'rotateY(' + i + 'deg) rotateX(0deg) rotateZ(0deg)';
    i++;                    //  increment the counter
    if (i <= 90) {           //  if the counter < 10, call the loop function
      timeFunction1();             //  ..  again which will trigger another 
    }                       //  ..  setTimeout()
  }, 10)
}
    
    switch (speed) {
        case '1':
            switch (animation) {
                case '1':
                    document.querySelector('.dice').classList.add('dice-1');
                    timeFunction1();
                    
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
                    timeFunction1();

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
            break;
            case '2':
            
                break;
                case '3':
            
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

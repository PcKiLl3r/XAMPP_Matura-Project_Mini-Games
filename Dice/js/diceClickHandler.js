
document.addEventListener("DOMContentLoaded", () => {

    let animDiv = document.body.children[0];
    let animation = animDiv.textContent;

    switch (animation) {
        case '1':
            document.querySelector('.dice').classList.add('dice-anim1');
            document.querySelector('.dice').classList.add('dice-1');
            break;

        case '2':
            document.querySelector('.dice').classList.add('dice-anim2');
            document.querySelector('.dice').classList.add('dice-6');
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

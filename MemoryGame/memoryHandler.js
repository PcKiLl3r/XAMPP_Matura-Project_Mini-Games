document.addEventListener("DOMContentLoaded", func => {
    let memoryCards = document.querySelectorAll('.memory-card');
    memoryCards.forEach(memoryCard => {
        memoryCard.addEventListener("click", revealCard);
    });

    function revealCard(memoryCard){
        this.animate([
     {transform: 'rotateY(0deg)'},
     {transform: 'rotateY(160deg)'}
        ], {
            duration: 1000,
            iterations: 1
        });
        this.style.transform = 'rotateY(160deg)';
        this.
    }
})


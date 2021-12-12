function revealCard(memoryCard){
    this.animate([
 {transform: 'rotateY(0deg)'},
 {transform: 'rotateY(160deg)'}
    ], {
        duration: 1000,
        iterations: 1
    });
    this.style.transform = 'rotateY(180deg)';
    this.classList.remove("memory-card-hoverable");
}

function formSubmit(form){
    form.submit();
}

document.addEventListener("DOMContentLoaded", func => {
    let memoryCards = document.querySelectorAll('.memory-card');

    memoryCards.forEach(memoryCard => {
        memoryCard.addEventListener("click", revealCard);
    });



  let memoryCardsMain = document.querySelector('.memory-cards-main');
  let memoryCardsM = memoryCardsMain.querySelectorAll('.memory-card');
  memoryCardsM.forEach(memoryCard => {
      /* let button = memoryCard.children.item(2); */
      memoryCard.addEventListener("click", function(event) {
          event.preventDefault();

          memoryCards.forEach(memoryCard => {
memoryCard.removeEventListener("click", revealCard);
memoryCard.classList.remove("memory-card-hoverable");
          });

          setTimeout( function () {
            memoryCard.submit();
          }, 1200 + 1000);
      });
  });

});


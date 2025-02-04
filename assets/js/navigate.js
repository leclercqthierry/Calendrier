// Le but du script va être de permettre à l'utilisateur de naviguer entre les mois grâce à des flèches.

const divs = document.querySelectorAll('div');
const leftArrow = document.getElementById('leftArrow');
const rightArrow = document.getElementById('rightArrow');

// la fonction montre le mois suivant
function showNextMonth(){
    let current = 0;

    // on parcourt toutes les div et cherche celle avec la classe show
    for (let i = 0; i < divs.length; i++) {
        if (divs[i].classList.contains('show')) {
            // on récupère son index
            current = i;

            // on ajoute la classe hidden
            divs[i].classList.add('hide');

            // puis retire la classe show
            divs[i].classList.remove('show');
            // on break pour ne pas continuer à chercher une div avec la classe show vu qu'il n'y en a qu'une à la fois qui la possède
            break;
        }
    }

    // si on est au dernier mois, on masque la flèche de droite
    if (current == divs.length - 1) {
        rightArrow.style.display = 'none';
    }
    // On attends 300 millisecondes pour que l'image ne disparaisse pas instantanément (j'utilise donc une fonction anonyme vide vu qu'on ne fait rien d'autre qu'attendre 300 millisecondes)
    setTimeout(()=>{},300);

    // on ajoute la  classe show à la div suivante
    divs[current+1].classList.add('show');

    // On retire la classe hide à la div suivante
    divs[current+1].classList.remove('hide');
}

rightArrow.addEventListener('click',showNextMonth);

// la fonction montre le mois précédent
function showPrevMonth(){
    // Même principe qu'au dessus
    let current = 0;
    for (let i = 0; i < divs.length; i++) {
        if (divs[i].classList.contains('show')) {
            current = i;
            divs[i].classList.add('hide');
            divs[i].classList.remove('show');
            break;
        }
    }

    // Cette fois ci on arrive au premier mois du calendrier
    if (current == 0) {
        leftArrow.style.display = 'none';
    }
    setTimeout(()=>{},300);
    divs[current-1].classList.add('show');
    divs[current-1].classList.remove('hide');
}

leftArrow.addEventListener('click',showPrevMonth);
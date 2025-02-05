// Le but du script va être de permettre à l'utilisateur de naviguer entre les mois grâce à des flèches.

const divs = document.querySelectorAll('div');
const leftArrow = document.getElementById('leftArrow');
const rightArrow = document.getElementById('rightArrow');

// on récupère l'année courante
let currentYear = new Date().getFullYear();

// on va afficher (ou pas) les flèches selon le mois et l'année sélectionnée avant navigation
let currentH2 = document.querySelector('div.show h2');


// Si le h2 affiché est celui du tout premier mois disponible à l'affichage initial du calendrier on n'affiche pas la flèche gauche sinon on l'affiche
leftArrow.style.display = (currentH2.textContent === `Calendrier de Janvier ${currentYear-5}`) ? 'none' : 'block';
console.log(leftArrow.style.display);

// Si le h2 affiché est celui du tout dernier mois disponible à l'affichage initial du calendrier on n'affiche pas la flèche gauche sinon on l'affiche
rightArrow.style.display = (currentH2.textContent === `Calendrier de Décembre ${currentYear+5}`)? 'none' : 'block';

// la fonction montre le mois suivant
function showNextMonth(){
    let current = 0;

    // on récupère l'index du mois affiché
    for (let i = 0; i < divs.length; i++) {
        if (divs[i].classList.contains('show')) {
            current = i;

            // 
            divs[i].classList.add('hide');
            divs[i].classList.remove('show');
            break;
        }
    }

    // On attends 300 millisecondes pour que l'image ne disparaisse pas instantanément (j'utilise donc une fonction anonyme vide vu qu'on ne fait rien d'autre qu'attendre 300 millisecondes)
    setTimeout(()=>{},300);

    // on ajoute la  classe show à la div suivante
    divs[current+1].classList.add('show');

    // On retire la classe hide à la div suivante
    divs[current+1].classList.remove('hide');

    // On récupère le nouveau h2 affiché
    currentH2 = document.querySelector('div.show h2');
    rightArrow.style.display = (currentH2.textContent === `Calendrier de Décembre ${currentYear+5}`)? 'none' : 'block';
    leftArrow.style.display = 'block';
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

    setTimeout(()=>{},300);
    divs[current-1].classList.add('show');
    divs[current-1].classList.remove('hide');
    currentH2 = document.querySelector('div.show h2');
    leftArrow.style.display = (currentH2.textContent === `Calendrier de Janvier ${currentYear-5}`) ? 'none' : 'block';
    rightArrow.style.display = 'block';
}

leftArrow.addEventListener('click',showPrevMonth);
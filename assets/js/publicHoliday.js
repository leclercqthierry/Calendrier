// Le but du script va être d'ajouter une classe publicHoliday à tous les td du calendrier qui contiennent un jour férié

const form = document.querySelector('form');
const tables = document.querySelectorAll('table');

let monthTds = [];

// On récupère tous les td à chaque table (qui correspond à un mois d'une année)
tables.forEach((table) => {
    const tds = table.querySelectorAll('td');
    monthTds.push(tds);
});

// Si pas de formulaire alors on c'est qu'on a afficher le calendrier
if (form===null) {
    // On récupère le titre du calendrier
    const h2 = document.querySelector('h2');

    // On en récupère le mois et l'année
    let month = h2.textContent.split(' ')[2];
    let year = h2.textContent.split(' ')[3];

    switch (month) {
        case 'Janvier': monthNumber = '01'; break;
        case 'Février': monthNumber = '02'; break;
        case 'Mars': monthNumber = '03'; break;
        case 'Avril': monthNumber = '04'; break;
        case 'Mai': monthNumber = '05'; break;
        case 'Juin': monthNumber = '06'; break;
        case 'Juillet': monthNumber = '07'; break;
        case 'Aout': monthNumber = '08'; break;
        case 'Septembre': monthNumber = '09'; break;
        case 'Octobre': monthNumber = '10'; break;
        case 'Novembre': monthNumber = '11'; break;
        case 'Décembre': monthNumber = '12';
    }

    let word = year+"-"+monthNumber;

    // On initialise un tableau vide pour stocker les jours fériés
    let publicHolidays = [];

    // On récupère l'année en cours
    let currentDate = new Date().getFullYear();

    // On veut les 5 années précédentes et les 5 suivantes
    yearsWanted = [];
    for (let i = -5; i <= 5; i++) {
        yearsWanted.push(currentDate + i);
    }
    
    // On récupère les jours fériés en passant par l'API du gouvernement (elle fournie les fériés des 20 années précédentes et les 5 suivantes)
    fetch(`https://calendrier.api.gouv.fr/jours-feries/metropole.json`)
       .then(response => response.json())
       .then(data => {
            // On ne récupére que les années qui nous intéressent
            // NB: on aurait pu récupérer chaque année qui nous intéresse cependant celà aurait fait autant d'appel à l'API !
            yearsWanted.forEach(year => {
                for (let date in data){
                    if (date.includes(year)) {
                        publicHolidays.push(date);
                    }
                }  
            });

            // Pour chaque année qui nous intéressent et pour chaque mois de celles ci
            for (let i = 0; i < yearsWanted.length; i++) {
                for (let j = 1; j <= 12; j++) {
                    if (j < 10){
                        monthString = '0'+j;
                    } else {
                        monthString = j;
                    }
                    // On parcourt les td du mois et on ajoute une classe 'publicHoliday' aux td correspondant aux jours fériés de publicholidays
                    publicHolidays.forEach(holiday => {
                        if (holiday.includes(yearsWanted[i]+'-'+monthString)) {
                            let tds = monthTds[i*12+j-1];
                            tds.forEach(td =>{
                                // Le cast en Number permet de supprimer le 0 devant si inférieur à 10, on recast en String ensuite pour la comparaison avec le textContent du td
                                if (td.textContent === String(Number(holiday.split('-')[2]))) {
                                    td.classList.add('publicHoliday');
                                }
                            });
                        }
                    });
                }
            }
        });
}
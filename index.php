<?php
    // Affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

echo'<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Calendrier des évènement de laManuEcology</title>
</head>
<body>';
    // Si pas de données soumises on affiche le formulaire de choix du calendrier
    if (count($_POST)==0){
        echo'
        <h1>Calendrier des évènements</h1>
        <p>Veuillez choisir un mois et une année pour voir le calendrier des évènements.</p>
        <form action="index.php" method="post">
            <label for="month">Choisissez un mois:</label>
            <select name="month" id="month">
                <option value="01">Janvier</option>
                <option value="02">Février</option>
                <option value="03">Mars</option>
                <option value="04">Avril</option>
                <option value="05">Mai</option>
                <option value="06">Juin</option>
                <option value="07">Juillet</option>
                <option value="08">Août</option>
                <option value="09">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="12">Décembre</option>
            </select>
            <label for="year">Choisissez une année</label>
            <select name="year" id="year">';
        // On affiche les années précédentes et suivantes de -5 à +5
        $year = date("Y");
        for ($i = (int)$year - 5; $i < (int)$year + 6; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
        echo '
            </select>
            <input type="submit" value="Afficher le calendrier">
        </form>';
    } else {// On affiche le calendrier du mois choisi
        $chosenMonth = $_POST['month'];
        $chosenYear = $_POST['year'];
        $year = date("Y");

        // on récupère le contenu du fichier JSON des évènements
        $json = file_get_contents('./assets/json/events.json');

        $events = json_decode($json, true)['evenements'];

        for ($i = (int)($year) - 5; $i < (int)($year) + 6; $i++){
            for ($j = 1; $j <= 12; $j++){
                // On calcule le nombre de jours dans le mois
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $j, $i);

                // On traduit le mois en français
                switch ($j){
                    case 1: $monthFr = 'Janvier'; break;
                    case 2: $monthFr = 'Février'; break;
                    case 3: $monthFr = 'Mars'; break;
                    case 4: $monthFr = 'Avril'; break;
                    case 5: $monthFr = 'Mai'; break;
                    case 6: $monthFr = 'Juin'; break;
                    case 7: $monthFr = 'Juillet'; break;
                    case 8: $monthFr = 'Aout'; break;
                    case 9: $monthFr = 'Septembre'; break;
                    case 10: $monthFr = 'Octobre'; break;
                    case 11: $monthFr = 'Novembre'; break;
                    case 12: $monthFr = 'Décembre';
                }
                // On affiche ou masque le calendrier en fonction du mois et de l'année choisies
                 $showHide = ($i === (int)$chosenYear && $j === (int)$chosenMonth) ? 'show' : 'hide';
                echo '
                <div class="'.$showHide.'">
                    <h2>Calendrier de '.$monthFr.' '.$i.'</h2>
                    <table>
                        <tr>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                            <th>Dimanche</th>
                        </tr>';

                // On calcule le jour du 1er du mois
                $firstDay = (int)date("N", strtotime($year.'-'.(string)$j.'-01'));
                echo '<tr>';

                // le nombre maximales de cases (vides incluses) étant atteint lorsque le 1er du mois est un dimanche soit 35 cases
                for ($k = 1; $k < 36; $k++){

                    // on affiche des cases vides les jours précédents le 1er du mois
                    if ($k < $firstDay){
                        echo '<td></td>';
                    } else{

                        // on affiche les jours du mois (on retire les cases vides du décompte)
                        $tmp = $k - $firstDay + 1;
                        if ($tmp <= $daysInMonth){

                            // On vérifie si il y a un évènement pour celà on remet au format "YYYY-MM-DD"
                            $mon = $j < 10 ? '0'.$j : $j;
                            $day = $tmp < 10 ? '0'.$tmp : $tmp;
                            foreach ($events as $event) {
                                if ($event['date'] === (string)($i).'-'.(string)($mon).'-'.(string)($day)){

                                    // On ajoute un lien vers la page détaillée de l'évènement
                                    $link = '<a href="details.php?date='.$event['date'].'">'.$tmp.'</a>';

                                    // on sort de la boucle si on a trouvé un évènement pour ce jour puisqu'il y en a qu'un dans la même journée
                                    break;
                                } else {
                                    $link = $tmp;
                                }
                            }
                            echo '<td>'.$link.'</td>';
                        } else{

                            // on affiche à nouveau des cases vides après la fin du mois
                            echo '<td></td>';
                        }

                        // on ferme la ligne si on arrive si on a atteint la fin de la semaine
                        if ($k % 7 == 0){
                            echo '</tr>';
                        }
                    }
                }
                echo '</table></div>';
            }
        }
        // On récupère les données
        echo '<p>Légende: En rouge férié, en vert évènement.</p>';
     } 
echo '
<script src="./assets/js/publicHoliday.js"></script>
</body>
</html>';
?>
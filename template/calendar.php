<?php 

function createCalendar(string $currentYear, string $chosenMonth, string $chosenYear, string $today, array $monthFr, array $events) {
    for ($i = (int)$currentYear - 5; $i < (int)$currentYear + 6; $i++){
        for ($j = 1; $j <= 12; $j++){
            // On calcule le nombre de jours dans le mois
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $j, (int)$i);
    
            // On affiche ou masque le calendrier en fonction du mois et de l'année choisies
                $showHide = ($i === (int)$chosenYear && $j === (int)$chosenMonth) ? 'show' : 'hide';
            echo '
            <div class="'.$showHide.'">
                <h2>Calendrier de '.$monthFr[$j].' '.$i.'</h2>
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
            $firstDay = (int)date("N", strtotime((string)$i.'-'.(string)$j.'-01'));
            echo '<tr>';
    
            // le nombre maximales de cases (vides incluses) étant atteint lorsque le 1er du mois est un dimanche
            for ($k = 1; $k < 43; $k++){
    
                // on affiche des cases vides les jours précédents le 1er du mois
                if ($k < $firstDay){
                    echo '<td></td>';
                } else{
    
                    // on affiche les jours du mois (on retire les cases vides du décompte)
                    $tmp = $k - $firstDay + 1;
                    if ($tmp <= $daysInMonth){
    
                        // On vérifie s'il y a un évènement pour celà on comparera au format "YYYY-MM-DD"
                        $mon = $j < 10 ? '0'.$j : $j;
                        $day = $tmp < 10 ? '0'.$tmp : $tmp;
    
                        // On ajoute une classe si c'est aujourd'hui
                        $class = $today === (string)($i).'-'.(string)($mon).'-'.(string)($day) ? ' class="today"' : '';
    
                        foreach ($events as $event) {
                            // On vérifie s'il y a un évènement ce jour
                            if ($event['date'] === (string)($i).'-'.(string)($mon).'-'.(string)($day)){
    
                                // On ajoute un lien vers la page détaillée de l'évènement et son titre
                                $link = '<a href="./index.php?action=event&date='.$event['date'].'">'.$tmp.'</a>';
                                break;
                            } else {
                                // pas de lien si aucun évènement pour ce jour juste le numéro du jour
                                $link = $tmp;
                            }
                        }
                        echo '<td'.$class.'>'.$link.'</td>';
                    } else{
    
                        // on affiche à nouveau des cases vides après la fin du mois
                        echo '<td></td>';
                    }
    
                    // on ferme la ligne si on a atteint la fin de la semaine
                    if ($k % 7 == 0){
                        echo '</tr>';
                    }
                }
            }
            echo '</table></div>';
        }
    }
}

?>
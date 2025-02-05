<?php
    // Affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // on récupère le contenu du fichier JSON des évènements
    $json = file_get_contents('./assets/json/events.json');
    $events = json_decode($json, true)['evenements'];

    // Si problème de passage par l'url on redirige vers l'accueil
    if (!isset($_GET['date'])){
        header:("Location: index.php");
     } else{
        // on nettoie la donnée reçue
        $date = htmlspecialchars($_GET['date']);

        $eventDetails = [];
        // on cherche si les évènement(s) existent dans la liste des évènements
        foreach ($events as $event){
            if ($event['date'] === $date){
                array_push($eventDetails, $event);
            }
        }

        echo'        
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./assets/css/event.css">
            <title>Evènement</title>
        </head>
        <body>
        <div class="container">
            <h1>Evènement(s) du '.date('d/m/Y', strtotime($date)).'</h1>';
            foreach ($eventDetails as $event){
                echo'<h2>'.$event['titre'].'</h2>
                <p><span>Date:</span> '.date('d/m/Y', strtotime($event['date'])).'</p>
                <p><span>Ville:</span> '.$event['ville'].'</p>
                <p><span>latitude:</span> '.$event['latitude'].' <span>longitude:</span> '.$event['longitude'].'</p>
                <p><span>Description:</span> '.$event['description'].'</p>';
                $hr = count($eventDetails) > 1? '<hr>' : '';
                echo $hr;
            }
            echo'
        </div>
        </body>
        </html>';
    }
?>
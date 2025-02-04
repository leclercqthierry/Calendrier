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
        // on cherche si l'évènement existe dans la liste des évènements
        foreach ($events as $event){
            if ($event['date'] === $date){
                $eventDetails = $event;
                break;
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
            <h1>'.$eventDetails['titre'].'</h1>
            <p><span>Date:</span> '.date('d/m/Y', strtotime($eventDetails['date'])).'</p>
            <p><span>Ville:</span> '.$eventDetails['ville'].'</p>
            <p><span>latitude:</span> '.$eventDetails['latitude'].' <span>longitude:</span> '.$eventDetails['longitude'].'</p>
            <p><span>Description:</span> '.$eventDetails['description'].'</p>
        </div>
        </body>
        </html>';
    }
?>
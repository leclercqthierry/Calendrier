<?php

// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__."/../model/events.php";

function event($date){

    // on cherche si les évènement(s) existent dans la liste des évènements
    $eventDetails = getEvents($date);
    $eventDate = $date;
    include __DIR__."/../view/event_view.php";
}

?>
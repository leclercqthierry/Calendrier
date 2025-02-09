<?php

require_once __DIR__."/model/events.php";

try{
    if(isset($_GET['action']) && $_GET['action'] !== ''){

        if ($_GET['action'] == 'form'){

            require_once __DIR__."/controller/form_controller.php";
            form();

        } elseif ($_GET['action'] == 'event' && isset($_GET['date'])){

            if (!empty($_GET['date']) && (in_array($_GET['date'], getAllDates() ))) {

                $date = htmlspecialchars($_GET['date']);
                require_once __DIR__."/controller/event_controller.php";
                event($date);

            } else{
                throw new Exception("La date ne correspond à aucun événèment !");
            }

        } else {
            throw new Exception("Action inconnue.");
        }

    } else{
        require_once __DIR__."/controller/index_controller.php";
        index();
    }

} catch (Exception $e) {
    echo "Une erreur est survenue : ".$e->getMessage();
    exit;
}

?>
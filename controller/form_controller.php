<?php 
// Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__."/../model/events.php";


function form(){
        // Si pas de données soumises on renvoit vers l'index
    if (count($_POST)==0){
        header("Location: index.php");
    } else {
        try{
            // Validation des données
            if(!is_numeric($_POST['month']) ||!is_numeric($_POST['year'])){
                throw new Exception("Les données du formulaire sont incorrectes.");
            }
            if($_POST['month'] < 1 || $_POST['month'] > 12){
                throw new Exception("Le mois choisi est incorrect.");
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue : ". $e->getMessage();
            exit;
        }

        // Récupération des données du formulaire
        $chosenMonth = htmlspecialchars($_POST['month']);
        $chosenYear = htmlspecialchars($_POST['year']);

        $currentYear = date("Y");
        $today = date("Y-m-d");
        $monthFr = [null,'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        $events = getAllEvents();
        require __DIR__."/../template/calendar.php";
        include __DIR__."/../view/calendar_view.php";
    }
}

?>
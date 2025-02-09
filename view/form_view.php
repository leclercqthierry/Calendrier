<?php
    $currentYear = date("Y");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/form.css">
    <title>Mon super calendar MVC en grid</title>
</head>

<body>
    <h1>Calendrier des évènements</h1>
    <p>Veuillez choisir un mois et une année pour voir le calendrier des évènements.</p>
    <form action="index.php?action=form" method="post">
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
        <select name="year" id="year">
    <?php
        // On affiche les années précédentes et suivantes de -5 à +5
        for ($i = (int)$currentYear - 5; $i < (int)$currentYear + 6; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    ?>
        </select>
        <input type="submit" value="Afficher le calendrier">
    </form>
</body>

</html>
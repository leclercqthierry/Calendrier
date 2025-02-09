<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/calendar.css">
    <title>Calendrier des évènements de laManuEcology</title>
</head>
<body>
    <!-- flèche gauche pour la navigation vers le mois précédent -->
    <i class="fas fa-chevron-left" id="leftArrow"></i>
    <?php echo createCalendar($currentYear, $chosenMonth, $chosenYear, $today, $monthFr, $events) ?>
    <i class="fas fa-chevron-right" id="rightArrow"></i>
    <p>Légende: En rouge férié, en vert évènement, fond en bleu aujourd'hui.</p>
    <script src="./assets/js/publicHoliday.js"></script>
    <script src="./assets/js/navigate.js"></script>
</body>
</html>
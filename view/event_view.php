<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Map WebAcappella -->
    <link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css" />
    <script src="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js"></script>
    <link rel="stylesheet" type="text/css" href="./plugins/mapWebacappella/css/style.css" />
    <!-- Map WebAcappella -->
    <link rel="stylesheet" href="./assets/css/event.css">
    <title>Evènement</title>
</head>
<body>
    <div class="container">
<?php
echo'<h1>Evènement(s) du '.date('d/m/Y', strtotime($date)).'</h1>';
$counter = 0;
foreach ($eventDetails as $event){
    echo'
        <span style="display:none">'.$counter.'</span>
        <h2>'.$event['titre'].'</h2>
        <p><span>Date:</span> '.date('d/m/Y', strtotime($event['date'])).'</p>
        <p><span>Ville:</span> '.$event['ville'].'</p>
        <p class="location" hidden><span>latitude:</span> '.$event['latitude'].', <span>longitude:</span> '.$event['longitude'].'</p>
        <p><span>Description:</span> '.$event['description'].'</p>';
    $hr = count($eventDetails) > 1? '<hr>' : '';
    echo $hr;
    $counter++;
}
?>
        <div id="map"></div>
    </div>
    <script src="./assets/js/map.js"></script>
    <script type="text/javascript" src="./plugins/mapWebacappella/js/style.js"></script>
</body>
</html>
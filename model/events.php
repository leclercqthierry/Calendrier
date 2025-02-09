<?php

function loadEventsData() {
  // simulation de la connection à la base de données
  include __DIR__.'/../assets/datas/events.php'; // Inclure le fichier events.php
  return $database_events; // Retourner le tableau $database_events à la place d'une instance de la base de données
}

function getEvent($id) {
    // simulation de la requête SQL
  $events = loadEventsData();
  foreach ($events as $event) {
    if ($event['id'] == $id) {
      return $event;
    }
  }
  return null; // Retourne null si l'événement n'est pas trouvé
}

function getEvents(string $date) : array{
  // simulation de la requête SQL
  $events = loadEventsData();
  $eventsThisDay = [];
  foreach ($events as $event) {
    if ($event['date'] == $date) {
      array_push($eventsThisDay, $event);
    }
  }
  return (count($eventsThisDay) > 0) ? $eventsThisDay : null; // Retourne null si aucun événement n'est prévu ce jour
}

function getAllEvents() {
    // simulation de la requête SQL
  $events = loadEventsData();
  return array_map(function ($event) {
    return [
      'id' => $event['id'],
      'titre' => $event['titre'],
      'date' => $event['date'],
      'latitude' => $event['latitude'],
      'longitude' => $event['longitude'],
      'ville' => $event['ville'],
      'description' => $event['description']
    ];
  }, $events);
}

function getAllDates(){
  $events = loadEventsData();
  $dates = [];
  foreach ($events as $event) {
    if (!in_array($event['date'], $dates)) {
      array_push($dates, $event['date']);
    }
  }
  return $dates;
}
?>
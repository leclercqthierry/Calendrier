// Carte Open Street Map Pour WebAcappella
// Copyright 2018 : Tonton du Web

span = document.querySelector('h1+span');
index = span.textContent;

var lat = latArr[index];
var lon = longArr[index];
var macarte = null;

function initMap(lat, lon) {
	var iconBase = 'plugins/mapWebacappella/markers/';

	macarte = L.map('map').setView([lat, lon], 8);
	macarte.scrollWheelZoom.disable();


	L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
		attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>',
		minZoom: 1,
		maxZoom: 20,

	}).addTo(macarte);
		var myIcon = L.icon({
			iconUrl: iconBase + "red-flat-marker.png",
			iconSize: [38, 58],
		});
		var marker = L.marker([lat, lon],{ icon: myIcon }).addTo(macarte)
	span.remove();
}
window.onload = function(){
	initMap(lat, lon);
};
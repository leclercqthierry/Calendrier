// Carte Open Street Map Pour WebAcappella
// Copyright 2018 : Tonton du Web

var macarte = null;

function average(array) {
	array.forEach(element => {
		result = array.reduce((a, b) => a + b, 0) / array.length;
	});
	return result;
}

function initMap(latArr, longArr) {
	//var iconBase = 'plugins/mapWebacappella/markers/';
	var iconBase = './assets/img/';
 

	// macarte = L.map('map').setView([latArr[0], longArr[0]], 7);
	macarte = L.map('map').setView([average(latArr), average(longArr)], 5);
	macarte.scrollWheelZoom.disable();


	L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
		attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>',
		minZoom: 1,
		maxZoom: 20,

	}).addTo(macarte);
		var myIcon = L.icon({
			iconUrl: iconBase + "red-flat-marker.png",
			iconSize: [15, 20],
		});


		for (let i = 0; i < latArr.length; i++) {
			L.marker([latArr[i], longArr[i]],{ icon: myIcon }).addTo(macarte);
		}
}
window.onload = function(){
	initMap(latArr, longArr);
};
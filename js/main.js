/**
 * Main JS file for the application
 *
 * Asil Cetin
 */

// Init map
var mainMap = L.map('mainMap').setView([48.2091, 16.3717], 15);

// Historical map layer
var wmsLayer = L.tileLayer.wms('https://data.wien.gv.at/daten/wms?version=1.1.1', {
  layers: 'BOMBENSCHADENOGD'
}).addTo(mainMap);

// Modern map layer
var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap<\/a> contributors'
}).addTo(mainMap);

// Init both layers side by side
L.control.sideBySide(wmsLayer, osmLayer).addTo(mainMap);

// markerPhilipphof
var markerPhilipphof = L.marker([48.20459, 16.36898]).addTo(mainMap);

markerPhilipphof.bindPopup("An dieser Stelle stand der Philipphof, ein repräsentativer Großwohnbau der Gründerzeit, der am 12. März 1945 durch einen Bombenangriff zerstört wurde. Hunderte Menschen, die in den Kellern Schutz gesucht hatten, fanden den Tod. Hier wurde im österreichischen Bedenkjahr 1988 von der Stadt Wien auf Initiative von Bürgermeister Helmut Zilk das „Mahnmal gegen Krieg und Faschismus“ errichtet.");

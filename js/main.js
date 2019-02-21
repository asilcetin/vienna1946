/**
 * Main JS file for the application
 *
 * Asil Cetin
 */

var mainMap = L.map('mainMap').setView([48.209, 16.369], 13);

var wmsLayer = L.tileLayer.wms('https://data.wien.gv.at/daten/wms?version=1.1.1', {
  layers: 'BOMBENSCHADENOGD'
}).addTo(mainMap);

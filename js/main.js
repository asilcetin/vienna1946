/**
 * Main JS file for the application
 *
 * Asil Cetin
 */

// Init feather icons
feather.replace();

// Init map
var mainMap = L.map('mainMap').setView([48.2094, 16.3725], 15);

// Historical map layer
var wmsLayer = L.tileLayer.wms('https://data.wien.gv.at/daten/wms?version=1.1.1', {
  layers: 'BOMBENSCHADENOGD'
}).addTo(mainMap);

// Modern map layer
var mapboxLayer = L.tileLayer('https://api.mapbox.com/styles/v1/acetin/cjsg631ow0n9a1fnytvsia3jv/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWNldGluIiwiYSI6ImNqYjIybG5xdTI4OWYyd285dmsydGFkZWQifQ.xG4sN5u8h-BoXaej6OjkXw', { tileSize: 512, zoomOffset: -1, attribution: '© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mainMap);
/*
var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap<\/a> contributors'
}).addTo(mainMap);
*/

// Init both layers side by side
L.control.sideBySide(wmsLayer, mapboxLayer).addTo(mainMap);

// Geo location search
L.Control.geocoder().addTo(mainMap);

// Icons
var defaultIconSVG = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="255.646px" height="462px" viewBox="0.497 0 255.646 462" enable-background="new 0.497 0 255.646 462" xml:space="preserve"><g><g><path fill="#FFFFFF" d="M248.154,7.989v66.178l-39.945,77.892H48.431L8.486,74.167V7.989L128.32,61.914L248.154,7.989z"/><path fill="#FFFFFF" d="M202.097,286.923c0.062,19.095,0.128,32.853,0.222,34.3c0,38.041-18.326,101.321-73.999,132.789c-55.673-31.468-73.999-94.748-73.999-132.789v-34.3H202.097z"/><path fill="#FFFFFF" d="M202.097,286.923H54.321v-59.917h147.686C202.026,247.887,202.058,269.596,202.097,286.923z"/><path fill="#FFFFFF" d="M202.007,227.006H54.321v-74.947h147.655v0.64C201.976,153.557,201.976,188.898,202.007,227.006z"/></g><path fill="#000000" d="M252.492,1.279c-2.279-1.471-5.146-1.689-7.619-0.577L128.32,53.153L11.763,0.702C9.293-0.41,6.426-0.191,4.148,1.279C1.87,2.754,0.497,5.278,0.497,7.989v66.178c0,1.268,0.3,2.516,0.877,3.647l39.996,77.892c1.081,1.97,2.902,3.433,5.063,4.057v161.459c0,35.518,16.388,104.918,78.005,139.744c2.426,1.377,5.399,1.377,7.825,0c61.614-34.826,78.048-104.227,78.048-139.744c0-0.164-0.004-0.296-0.015-0.464c-0.043-0.882-0.109-6.265-0.184-25.847h0.094v-15.979h-0.137c-0.027-13.414-0.051-28.714-0.066-43.939h0.199v-15.977h-0.215c-0.015-25.141-0.023-48.027-0.023-59.184c2.305-0.515,4.267-2.029,5.352-4.127l39.945-77.892c0.576-1.127,0.881-2.379,0.881-3.647V7.989C256.143,5.278,254.77,2.754,252.492,1.279z M194.33,321.398c-0.055,31.332-14.082,91.506-65.959,123.341c-51.979-31.894-65.959-92.235-65.959-123.517v-26.311h131.724C194.209,314.783,194.271,319.92,194.33,321.398z M194.092,278.934H62.411v-43.939H194.03C194.042,250.216,194.065,265.516,194.092,278.934z M62.411,219.017v-58.918h131.576c0,10.985,0.008,33.934,0.027,58.918H62.411z M240.165,72.24l-36.836,71.881H135.31V92.192c0-4.412-3.577-7.989-7.989-7.989c-4.412,0-7.989,3.577-7.989,7.989v51.928H53.311L16.475,72.24V20.343l108.564,48.854c2.087,0.94,4.475,0.94,6.558,0l108.568-48.854V72.24z"/></g></svg>';
var defaultIconURL = 'data:image/svg+xml;base64,' + btoa(defaultIconSVG);

var defaultIcon = L.icon( {
  iconUrl: defaultIconURL,
  iconSize:     [36, 65], // size of the icon
  iconAnchor:   [18, 64] // point of the icon which will correspond to marker's location
} );

var activeIconSVG = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="255.646px" height="462px" viewBox="0.497 0 255.646 462" enable-background="new 0.497 0 255.646 462" xml:space="preserve"><g><g><path fill="#B71616" d="M248.154,7.989v66.178l-39.945,77.892H48.431L8.486,74.167V7.989L128.32,61.914L248.154,7.989z"/><path fill="#B71616" d="M202.097,286.923c0.062,19.095,0.128,32.853,0.222,34.3c0,38.041-18.326,101.321-73.999,132.789c-55.673-31.468-73.999-94.748-73.999-132.789v-34.3H202.097z"/><path fill="#B71616" d="M202.097,286.923H54.321v-59.917h147.686C202.026,247.887,202.058,269.596,202.097,286.923z"/><path fill="#B71616" d="M202.007,227.006H54.321v-74.947h147.655v0.64C201.976,153.557,201.976,188.898,202.007,227.006z"/></g><path fill="#000000" d="M252.492,1.279c-2.279-1.471-5.146-1.689-7.619-0.577L128.32,53.153L11.763,0.702C9.293-0.41,6.426-0.191,4.148,1.279C1.87,2.754,0.497,5.278,0.497,7.989v66.178c0,1.268,0.3,2.516,0.877,3.647l39.996,77.892c1.081,1.97,2.902,3.433,5.063,4.057v161.459c0,35.518,16.388,104.918,78.005,139.744c2.426,1.377,5.399,1.377,7.825,0c61.614-34.826,78.048-104.227,78.048-139.744c0-0.164-0.004-0.296-0.015-0.464c-0.043-0.882-0.109-6.265-0.184-25.847h0.094v-15.979h-0.137c-0.027-13.414-0.051-28.714-0.066-43.939h0.199v-15.977h-0.215c-0.015-25.141-0.023-48.027-0.023-59.184c2.305-0.515,4.267-2.029,5.352-4.127l39.945-77.892c0.576-1.127,0.881-2.379,0.881-3.647V7.989C256.143,5.278,254.77,2.754,252.492,1.279z M194.33,321.398c-0.055,31.332-14.082,91.506-65.959,123.341c-51.979-31.894-65.959-92.235-65.959-123.517v-26.311h131.724C194.209,314.783,194.271,319.92,194.33,321.398z M194.092,278.934H62.411v-43.939H194.03C194.042,250.216,194.065,265.516,194.092,278.934z M62.411,219.017v-58.918h131.576c0,10.985,0.008,33.934,0.027,58.918H62.411z M240.165,72.24l-36.836,71.881H135.31V92.192c0-4.412-3.577-7.989-7.989-7.989c-4.412,0-7.989,3.577-7.989,7.989v51.928H53.311L16.475,72.24V20.343l108.564,48.854c2.087,0.94,4.475,0.94,6.558,0l108.568-48.854V72.24z"/></g></svg>';
var activeIconURL = 'data:image/svg+xml;base64,' + btoa(activeIconSVG);

var activeIcon = L.icon( {
  iconUrl: activeIconURL,
  iconSize:     [36, 65], // size of the icon
  iconAnchor:   [18, 64] // point of the icon which will correspond to marker's location
} );

// Markers from data
var markersLayerGroup = L.layerGroup();
$.getJSON("annotations.json", function(data) {
  var annotations = data["annotations"];
  for (var i = 0; i < annotations.length; i++) {
    window["marker"+annotations[i]["id"]] = L.marker(annotations[i]["coordinates"], {icon: defaultIcon, markerID: annotations[i]["id"]}).addTo(markersLayerGroup).addTo(mainMap).on('click', onMarkerClick);
  }
});

function onMarkerClick(e) {
  var markerID = e.target.options.markerID;
  // Set default icon for all icons
  markersLayerGroup.eachLayer(function (marker) {
    marker.setIcon(defaultIcon);
  });
  // Set active icon for selected icon
  e.target.setIcon(activeIcon);
  mainMap.flyTo(e.target.getLatLng(), 18);
  $('.annotation-detail').hide();
  $('#annotation-detail-'+markerID).show();
  $('.annotation-list').hide();
  $('#annotation-list-heading').hide();
  $('#annotation-back-btn').show();
}

// Annotation list interaction
$('.annotation-list').click(function(){
  var annotationID = $(this).attr('data-annotationID');
  $('.annotation-list').hide();
  $('#annotation-list-heading').hide();
  $('#annotation-back-btn').show();
  $('#annotation-detail-'+annotationID).show();
  // Set default icon for all icons & set active icon for selected icon
  var markerToPan;
  var markerID = annotationID;
  markersLayerGroup.eachLayer(function (marker) {
    console.log(marker);
    if (marker.options.markerID == markerID) {
      marker.setIcon(activeIcon);
      mainMap.flyTo(marker.getLatLng(), 18);
    } else {
      marker.setIcon(defaultIcon);
    }
  });
});

$('#annotation-back-btn').click(function(){
  $('.annotation-list').show();
  $('#annotation-list-heading').show();
  $(this).hide();
  $('.annotation-detail').hide();
});






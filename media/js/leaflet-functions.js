function moveToLocation(lat, lng, zoom) {
    if (zoom == undefined) zoom = 18;
    map.setView(new L.LatLng(lat, lng), zoom);
}

function addPoint(lat, lng, description) {
    var geoJsonPoint = {
        "type"          : "Point",
        "coordinates"   : [lng, lat],
        "properties"    : { "popupContent": description }
    };
    geoJsonLayer.addGeoJSON(geoJsonPoint);
}

function markerPos() {
    $('#'+inputLatID).val(marker.getLatLng().lat.toFixed(7));
    $('#'+inputLngID).val(marker.getLatLng().lng.toFixed(7));
}
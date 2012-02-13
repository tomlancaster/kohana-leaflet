<script src="<?php echo URL::site(Route::get('leaflet_media')->uri(array('file' => 'js/leaflet-package.js')), TRUE); ?>" type="text/javascript" charset="utf-8"></script>
<div>
    <input type="text" id="lat" name="lat" />
    <input type="text" id="lng" name="lng" />
</div>
<div id="map" style="height:<?php echo $height; ?>px"></div>
<script type="text/javascript">
    var lat = <?php echo number_format($lat, 8, '.', ''); ?>;
    var lng = <?php echo number_format($lng, 8, '.', '');; ?>;
    var zoom = <?php echo $zoom; ?>;
    
    <?php foreach ($tiles as $tileName => $tileParams): ?>
    var tile<?php echo $tileName; ?>_URL            = '<?php echo $tileParams['url']; ?>';
    var tile<?php echo $tileName; ?>_Attribution    = '<?php echo $tileParams['attribution']; ?>';
    var tile<?php echo $tileName; ?>                = new L.TileLayer(tile<?php echo $tileName; ?>_URL, {maxZoom: <?php echo $maxZoom; ?>, attribution: tile<?php echo $tileName; ?>_Attribution});
    <?php endforeach; ?>

    var map = new L.Map('map', {
        center: new L.LatLng(lat, lng),
        zoom: zoom,
        layers: [tile<?php echo $defTile; ?>]
    });
    map.setView(new L.LatLng(lat, lng), zoom);

    var markerLocation = new L.LatLng(lat, lng),
    marker = new L.Marker(markerLocation, {"draggable":"true"});
    marker.on('dragend', markerPos)
    
    map.addLayer(marker);
    
    var overlayMaps = {
    <?php foreach ($tiles as $tileName => $tileParams): ?>
        "<?php echo $tileName; ?>": tile<?php echo $tileName; ?>,
    <?php endforeach; ?>
    };
    
    var layersControl = new L.Control.Layers(
        overlayMaps
    );
    map.addControl(layersControl);
    markerPos()
</script>
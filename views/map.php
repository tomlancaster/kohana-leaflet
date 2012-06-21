<script src="<?php echo URL::site(Route::get('leaflet_media')->uri(array('file' => 'js/leaflet.js')), TRUE); ?>" type="text/javascript" charset="utf-8"></script>
<div id="map" style="height:<?php echo $height; ?>px"></div>
<script type="text/javascript">
    var lat = <?php echo number_format($lat, 8, '.', ''); ?>;
    var lng = <?php echo number_format($lng, 8, '.', ''); ?>;
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

    var geoJsonLayer = new L.GeoJSON();
    map.addLayer(geoJsonLayer);
    
    geoJsonLayer.on("featureparse", function (e) {
        if (e.properties && e.properties.popupContent){
            e.layer.bindPopup(e.properties.popupContent);
        }
    });
    
    <?php 
    if(count($points) > 0)
        foreach ($points as $point):
        $description = (isset($point['description'])) ? $point['description'] : NULL;
    ?>
        addPoint(<?php echo number_format($point['lat'], 8, '.', ''); ?>, <?php echo number_format($point['lng'], 8, '.', ''); ?>, '<?php echo $description; ?>');
    <?php endforeach; ?>
    map.addLayer(geoJsonLayer);

    
    var overlayMaps = {
    <?php foreach ($tiles as $tileName => $tileParams): ?>
        "<?php echo $tileName; ?>": tile<?php echo $tileName; ?>,
    <?php endforeach; ?>
    };
    
    var layersControl = new L.Control.Layers(
        overlayMaps
    );
        
    map.addControl(layersControl);
</script>
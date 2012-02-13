<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Leaflet {
    public $config              = NULL;
    private static $_instance   = NULL;

    public function __construct() {
        $this->config = Kohana::$config->load('leaflet');
    }

    public static function instance() {
        if (!isset(self::$_instance))
            self::$_instance = new Kohana_Leaflet();

        return self::$_instance;
    }

    public function map($points = array()) {
        $lat = (isset($points['0']['lat'])) ? $points['0']['lat'] : $this->config->lat; 
        $lng = (isset($points['0']['lng'])) ? $points['0']['lng'] : $this->config->lng; 
        
        $view = View::factory('map')
                ->bind('points', $points)
                ->bind('lat', $lat)
                ->bind('lng', $lng)
                ->bind('zoom', $this->config->zoom)
                ->bind('maxZoom', $this->config->maxZoom)
                ->bind('tiles', $this->config->tiles)
                ->bind('defTile', $this->config->defTile)
                ->bind('height', $this->config->height);
        return $view;
    }
    
    public function mapDraggableMarker($lat, $lng, $zoom = 18) {
        $view = View::factory('mapDraggableMarker')
                ->bind('lat', $lat)
                ->bind('lng', $lng)
                ->bind('zoom', $zoom)
                ->bind('maxZoom', $this->config->maxZoom)
                ->bind('tiles', $this->config->tiles)
                ->bind('defTile', $this->config->defTile)
                ->bind('height', $this->config->height);
        return $view;
    }
}
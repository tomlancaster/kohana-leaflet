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

    public function map($points = array(), $options = NULL) {
        $lat = (isset($points['0']['lat'])) ? $points['0']['lat'] : $this->config->lat; 
        $lng = (isset($points['0']['lng'])) ? $points['0']['lng'] : $this->config->lng; 
        if ($options) 
        {
	        	foreach ($options as $k => $v)
	        	{
	        		$this->config->$k = $v;
	        	}
	        	if (Arr::get($options, 'lat'))
	        	{
	        		$lat = $options['lat'];
	        	}
	        	if (Arr::get($options,'lng'))
	        	{
	        		$lng = $options['lng'];
	        	}
        }
        
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
    
    public function mapDraggableMarker($lat, $lng, $mapOptions = array()) {
        $defaultMapOptions = array(
            'zoom'      => 18,
            'height'    => $this->config->height,
            'maxZoom'   => $this->config->maxZoom,
            
            // CUSTOM
            'showLatLngInput'   => TRUE,
            'inputLatName'      => 'lat',
            'inputLngName'      => 'lng'
        );
        
        $zoom               = (isset($mapOptions['zoom']) && is_integer($mapOptions['zoom']))
                                ? $mapOptions['zoom']
                                : $defaultMapOptions['zoom'];
        $height             = (isset($mapOptions['height']) && is_integer($mapOptions['height']))
                                ? $mapOptions['height']
                                : $defaultMapOptions['height'];
        $maxZoom            = (isset($mapOptions['maxZoom']) && is_integer($mapOptions['maxZoom']))
                                ? $mapOptions['maxZoom']
                                : $defaultMapOptions['maxZoom'];
        $showLatLngInput    = (isset($mapOptions['showLatLngInput']) && is_bool($mapOptions['showLatLngInput']))
                                ? $mapOptions['showLatLngInput']
                                : $defaultMapOptions['showLatLngInput'];
        $inputLatName       = (isset($mapOptions['inputLatName']) && $mapOptions['inputLatName'] != '')
                                ? $mapOptions['inputLatName']
                                : $defaultMapOptions['inputLatName'];
        $inputLngName       = (isset($mapOptions['inputLngName']) && $mapOptions['inputLngName'] != '')
                                ? $mapOptions['inputLngName']
                                : $defaultMapOptions['inputLngName'];
        
        $view = View::factory('mapDraggableMarker')
                ->bind('lat', $lat)
                ->bind('lng', $lng)
                ->bind('maxZoom', $maxZoom)
                ->bind('tiles', $this->config->tiles)
                ->bind('defTile', $this->config->defTile)
                ->bind('showLatLngInput', $showLatLngInput)
                ->bind('inputLatName', $inputLatName)
                ->bind('inputLngName', $inputLngName)
                ->bind('zoom', $zoom)
                ->bind('height', $height);
        return $view;
    }
}
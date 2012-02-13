<?php defined('SYSPATH') or die('No direct script access.');

if (!defined('CURRENT_YEAR'))
    define('CURRENT_YEAR', date("Y"));

if (!defined('CLOUDMADE_API_KEY'))
    define('CLOUDMADE_API_KEY', '');

return array(
    'lat'       => 54.3583693,
    'lng'       => 18.6465454,
    'zoom'      => 15,
    'maxZoom'   => 18,
    'height'    => 500,
    'defTile'   => 'OSM',
    'tiles'     => array(
        'OSM'   => array(
            'url'           => 'http://tile.openstreetmap.org/{z}/{x}/{y}.png',
            'attribution'   => 'OpenStreetMap &copy; '.CURRENT_YEAR,
        ),
        'UMP'   => array(
            'url'           => 'http://tiles.ump.waw.pl/ump_tiles/{z}/{x}/{y}.png',
            'attribution'   => 'UMP &copy; '.CURRENT_YEAR,
        ),
        'CM'    => array(
            'url'           => 'http://{s}.tile.cloudmade.com/'.CLOUDMADE_API_KEY.'/997/256/{z}/{x}/{y}.png',
            'attribution'   => 'Map data, Imagery CloudMade, OpenStreetMap contributors &copy; '.CURRENT_YEAR,
        ),
    ),
);
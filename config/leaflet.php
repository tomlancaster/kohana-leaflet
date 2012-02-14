<?php defined('SYSPATH') or die('No direct script access.');

$currentYear        = date("Y"); 
$cloudmadeApiKey    = '';

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
            'attribution'   => 'OpenStreetMap &copy; '.$currentYear,
        ),
        'UMP'   => array(
            'url'           => 'http://tiles.ump.waw.pl/ump_tiles/{z}/{x}/{y}.png',
            'attribution'   => 'UMP &copy; '.$currentYear,
        ),
        'CM'    => array(
            'url'           => 'http://{s}.tile.cloudmade.com/'.$cloudmadeApiKey.'/997/256/{z}/{x}/{y}.png',
            'attribution'   => 'Map data, Imagery CloudMade, OpenStreetMap contributors &copy; '.$currentYear,
        ),
    ),
);
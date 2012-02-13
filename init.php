<?php defined('SYSPATH') or die('No direct script access.');


Route::set('leaflet_media', 'leaflet/media(/<file>)', array('file' => '.+'))
	->defaults(array(
            'controller' => 'leaflet',
            'action'     => 'media',
            'file'       => NULL,
	)
);
Route::set('leaflet', 'leaflet/<action>')
	->defaults(array(
            'controller' => 'leaflet',
            'action'     => NULL,
	)
);
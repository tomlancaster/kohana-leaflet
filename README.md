# kohana-elrte

Leaflet CloudMade integration module for Kohana 3.2.
Leaflet configuration see http://leaflet.cloudmade.com/reference.html

# Requirements
* API_KEY from http://cloudmade.com/

# Setup

* Add elrte.css to <head> when you start elRTE. 
```php
    <link rel="stylesheet" href="<?php echo URL::site(Route::get('leaflet_media')->uri(array('file' => 'css/leaflet.css')), TRUE); ?>" type="text/css" media="screen" charset="utf-8">
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo URL::site(Route::get('leaflet_media')->uri(array('file' => 'css/leaflet.ie.css')), TRUE); ?>" /><![endif]-->
```
* Chmod 777 media/js for generating new js file from /leaflet/makeJS

# Examples
* Default
```php
<?php echo Leaflet::instance()->map(); ?>
```
* Points
```php
$points = array(
0 => array(
    'lat'       => 54.3583693,
    'lng'       => 18.6465454,
    'description'=> 'Description',
));
<?php echo Leaflet::instance()->map($points); ?>
```
* Draggable marker ( finding lat + lng )
```php
<?php echo Leaflet::instance()->mapDraggableMarker(54.3583693, 18.6465454); ?>
```
    
# Author
Developer: Mateusz "retio" Lerczak - kiki.diavo@gmail.com

#License
Kohana-leaflet is issued under a MIT license.
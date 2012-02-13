<?php defined('SYSPATH') or die('No direct script access.');
    
class Controller_Leaflet extends Controller {
    private $_jsFiles   = array(
        'media/js/leaflet.js',
        'media/js/leaflet-functions.js',
    );
    
    public function action_media() {
        $file   = $this->request->param('file');

        $ext    = pathinfo($file, PATHINFO_EXTENSION);
        $file   = substr($file, 0, -(strlen($ext) + 1));

        if (($file = Kohana::find_file('media', $file, $ext))) {
            $this->response->check_cache(sha1($this->request->uri()).filemtime($file), $this->request);
            $this->response->body(file_get_contents($file));
            $this->response->headers('content-type',  File::mime_by_ext($ext));
            $this->response->headers('last-modified', date('r', filemtime($file)));
        } else {
            throw new HTTP_Exception_404('File not found.');
        }
    }
    
    public function action_makeJS() {
        $this->generateJS();
    }

    private function generateJS($cacheFileName = 'leaflet-package.js'){
        $modulePath = Arr::get(Kohana::modules(), 'kohana-leaflet');
        
        $dir = $modulePath . 'media/js/';
        
        $jsContent = '/* Created :'.date('Y-m-d H:i:s').' */';
        foreach ($this->_jsFiles as $jsFile) {
            $fJSFile = $modulePath . $jsFile;
            if (file_exists($fJSFile)) {
                $jsFileContent = preg_replace('/\s+/', ' ', file_get_contents($fJSFile));
                $jsContent .= "\n\n".'/* JS from: '.  basename($fJSFile).' */'."\n".$jsFileContent;
            }
        }
        file_put_contents($dir . $cacheFileName, $jsContent);
    }
}
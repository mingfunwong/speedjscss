<?php
final class Cache { 
    private $expire = 3600; 
    private $cache = array(); 

    public function __construct() {
        $files = glob(DIR_CACHE . 'cache.*');
        
        if ($files) {
            foreach ($files as $file) {
                $time = substr(strrchr($file, '.'), 1);

                if ($time < time()) {
                    if (file_exists($file)) {
                        unlink($file);
                        clearstatcache();
                    }
                }
            }
        }
    }

    public function get($key) {
        $cache = '';
        
        if (isset($this->cache[$key]))
        {
            $cache = $this->cache[$key];
        }else{
            $files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

            if ($files) {
                $cache = file_get_contents($files[0]);
                $cache = unserialize($cache);
            }
            $this->cache[$key] = $cache;
        }
        return $cache;
    }

    public function set($key, $value) {
        $this->delete($key);
        
        $file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $this->expire);
        if(!file_exists($file)){
            $handle = fopen($file, 'w');
    
            fwrite($handle, serialize($value));
            
            fclose($handle);
        }
        $this->cache[$key] = $value;
    }
    
    public function delete($key) {
        $files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
        
        if ($files) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                    clearstatcache();
                }
            }
        }
    }
    
    public function flush() {
        $files = glob(DIR_CACHE . 'cache.*');

        if ($files) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                    clearstatcache();
                }
            }
        }
    }
}
?>
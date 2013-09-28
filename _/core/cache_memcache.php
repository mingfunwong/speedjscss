<?php
final class Cache { 
    private $expire = 3600; 
    private $memcache;
    private $prefix;

    public function __construct() {
        $this->memcache = new Memcache;
        $this->memcache->connect(MC_HOSTNAME, MC_HOSTPORT);
        $this->prefix = MC_PREFIX;
    }

    public function get($key) {
        return $this->memcache->get($this->toKey($key));
    }

    public function set($key, $value) {
        $this->memcache->set($this->toKey($key), $value, false, $this->expire);
    }
    
    public function delete($key) {
        return $this->memcache->delete($this->toKey($key));
    }
    
    /**
     * 转化为memcache的key
     */
    public function toKey($key){
        return $this->prefix . $key;
    }
}
?>
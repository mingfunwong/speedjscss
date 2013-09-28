<?php
// CONFIG

// 是否压缩
define('IS_MINIFY', TRUE);
// 是否缓存
define('IS_CAHCE', TRUE);
// 是否保存错误记录
define('IS_ERROR', TRUE);
// 默认cdn地址
define('DIR_CDN', '../');
// 缓存驱动
define('CACHE_DRIVER', 'memcache'); // file,memcache
// 缓存目录
define('DIR_CACHE', 'cache/');
// 错误文件
define('ERROR_FILE', 'error.log');

// MEMCACHE配置，如果选择MEMCACHE缓存请设置
define('MC_HOSTNAME', 'localhost');
define('MC_HOSTPORT', 11211);
define('MC_PREFIX', 'SpeedJSCSS_');

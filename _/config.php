<?php
// CONFIG

// �Ƿ�ѹ��
define('IS_MINIFY', TRUE);
// �Ƿ񻺴�
define('IS_CAHCE', TRUE);
// �Ƿ񱣴�����¼
define('IS_ERROR', TRUE);
// Ĭ��cdn��ַ
define('DIR_CDN', '../');
// ��������
define('CACHE_DRIVER', 'memcache'); // file,memcache
// ����Ŀ¼
define('DIR_CACHE', 'cache/');
// �����ļ�
define('ERROR_FILE', 'error.log');

// MEMCACHE���ã����ѡ��MEMCACHE����������
define('MC_HOSTNAME', 'localhost');
define('MC_HOSTPORT', 11211);
define('MC_PREFIX', 'SpeedJSCSS_');

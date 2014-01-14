<?php
/**
 * SpeedJSCSS - JS和CSS资源合并压缩脚本
 * 
 * <head>
 * <link rel="stylesheet" type="text/css" href="http://localhots/_/?2013,css/stylesheet.css,css/main.css,css/form.css"/>
 * <script type="text/javascript" src="http://localhots/_/?2013,js/jquery/jquery-1.6.1.min.js,js/jquery/ui/jquery-ui-1.8.9.custom.min.js,js/common.js></script>
 * </head>
 * 
 * @author Mingfun Wong <mingfun.wong.chn@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @version 2013-09-10
 */

define('SPEEDJSCSS_ROOT', dirname(__FILE__));
header("Expires: " . date("D, j M Y H:i:s", strtotime("now + 10 years")) ." GMT");
set_etag(md5(serialize($_SERVER['QUERY_STRING'])));

require_once SPEEDJSCSS_ROOT . '/config.php';

if (IS_MINIFY){
    require_once SPEEDJSCSS_ROOT . '/core/jsmin.php';
    require_once SPEEDJSCSS_ROOT . '/core/cssmin.php';
}

$files_name = explode(',', $_SERVER['QUERY_STRING']);

if (IS_CAHCE) {
    require_once SPEEDJSCSS_ROOT . '/core/cache_'.CACHE_DRIVER.'.php';
    $cache = new cache();
    $arr = $cache->get(md5(serialize($files_name)));
}

if (!$arr)
{
    $arr = get_files($files_name, DIR_CDN);
    if (IS_CAHCE) {
        $cache->set(md5(serialize($files_name)), $arr);
    }
}

$files = isset($arr['files']) && !empty($arr['files']) ? $arr['files'] : array();
$type = isset($arr['type']) && !empty($arr['files']) ? $arr['type'] : '';

set_type($type);
ob_start('ob_gzhandler');
echo join('', $files);
ob_end_flush();


/**
 * 获得文件
 * 
 * @access global
 * @param mixed $val
 * @param mixed $dir_cdn
 * @return array
 */
function get_files($val, $dir_cdn){
    $arr = array('type' => '', 'files' => '');
    foreach ($val as $v => $key) {
        $key = str_replace('_', '.', $key);
        strstr($key, 'http://') || strstr($key, 'https://') ? $file = $key : $file = $dir_cdn . $key;
        if (!is_numeric($key))
        {
            if (strstr($key, 'http://') || strstr($key, 'https://') || is_file($file))
            {
                $arr['type'] = get_extend($file);
                $in_str = file_get_contents($file);
                //处理文本
                if(preg_match('/js|css/', $arr['type'])){
                    $arr['files'][] = '/* '.$key.' */';
                    if (IS_MINIFY)
                    {
                        if($arr['type'] == 'js'){
                            $arr['files'][] = JSMin::minify($in_str);
                        }
                        if($arr['type'] == 'css'){
                            $arr['files'][] = cssmin::minify($in_str);
                        }
                    }else{
                        $arr['files'][] = $in_str;
                    }
                }else{
                    if (IS_ERROR) save_log(ERROR_FILE, "Not CSS : {$key}");
                }
            }else{
                if (IS_ERROR) save_log(ERROR_FILE, "Not File: {$key}");
            }
        }
    }
    return $arr;
}

/**
 * 头缓存
 * 
 * @access global
 * @param mixed $etag
 * @return void
 */
function set_etag($etag){
    if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $etag){
        header('Etag:'.$etag,true,304);
        exit;
    }
    else header('Etag:'.$etag);
}

/**
 * 头类型
 * 
 * @access global
 * @param mixed $etag
 * @return void
 */
function set_type($type){
    if (!$type) return;
    $header = array(
        'js' => 'Content-Type: application/x-javascript',
        'css' => 'Content-Type: text/css'
    );
    header($header[$type]);//文件类型
}

/**
 * 得到扩展名
 * 
 * @access global
 * @param mixed $file_name
 * @return String
 */
function get_extend($file_name) { 
    $extend =explode("." , $file_name); 
    $va=count($extend)-1;
    return $extend[$va]; 
} 

/**
 * 保存记录
 * 
 * @access global
 * @param mixed $file
 * @param mixed $log
 * @return void
 */
function save_log($file, $log)
{
    $fp = fopen($file,'ab');
    fwrite($fp, "{$log}\r\n");
    fclose($fp);
}
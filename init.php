<?php

define('MINIFY_MIN_DIR', realpath(dirname(__FILE__) . '/vendor/min'));
define('MINIFY_LIB_PATH', realpath(dirname(__FILE__).'/vendor/min/lib'));

ini_set('zlib.output_compression', '0');

Route::set('minify', 'min(/<group>)', array('group' => '[a-z0-9\-\_]+'))
  ->defaults(array(
    'directory' => 'Minify',
    'controller' => 'index',
    'action' => 'minify',
		'group' => ''
  ));

ini_set('pcre.backtrack_limit', 20000000);
ini_set('pcre.recursion_limit', 20000000);

require MINIFY_MIN_DIR . "/utils.php";


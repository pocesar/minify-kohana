<?php defined('SYSPATH') OR die('No direct access allowed.');

if ( ! Route::cache())
{
	Route::set('minify', 'min(/<group>)', array(
			'group' => '[^/.,;?\n]++'
		))
		->defaults(array(
			'directory'  => '',
			'controller' => 'Minify',
			'action'     => 'index',
			'group'      => '',
		));
}

define('MINIFY_MIN_DIR', realpath(__DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'minify'.DIRECTORY_SEPARATOR.'min').DIRECTORY_SEPARATOR);
define('MINIFY_LIB_PATH', MINIFY_MIN_DIR.'lib');


ini_set('zlib.output_compression', '0');
ini_set('pcre.backtrack_limit', 20000000);
ini_set('pcre.recursion_limit', 20000000);

require_once MINIFY_MIN_DIR.'utils.php';

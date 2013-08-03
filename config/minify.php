<?php defined('SYSPATH') OR die('No direct script access.');

return array(
	'uploaderHoursBehind' => 0,
	'serveOptions' => array(
		'maxAge'           => 604800,
		'bubbleCssImports' => FALSE,
		'minApp' => array(
			'groupsOnly' => FALSE,
			'allowDirs'  => array(),
		),
		'minifierOptions' => array(
			'text/css' => array(),
		),
		'preserveComments' => TRUE,
		'rewriteCssUris'   => TRUE,
		'currentDir'       => FALSE,
	),
	'quiet' => FALSE,
	'symlinks' => array(
		// uncoment this line if you are working on a subdirectory
		// '/' . substr(Kohana::$base_url, 0, -1) => (Kohana::$base_url !== '/' ? DOCROOT : '/'),
	),
	'errorLogger'      => TRUE,
	'rewriteCssUris'   => FALSE,
	'allowDebugFlag'   => FALSE,
	'cachePath'        => Kohana::$cache_dir.DIRECTORY_SEPARATOR.'minify',
	'documentRoot'     => DOCROOT,
	'cacheFileLocking' => FALSE,
	'groupsConfig' => array(
		// 'js'  => array('///js/html5.js','//js/common.js'),
		// 'css' => array('//css/file1.css', '//css/file2.css'),
	),
);

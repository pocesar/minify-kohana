<?php defined('SYSPATH') or die('No direct script access.');

return array(
  'uploaderHoursBehind' => 0,
  'symlinks' => array(),
  'serveOptions' => array(
    'maxAge' => 1800,
    'bubbleCssImports' => false,
    'minApp' => array(
      'groupsOnly' => false
    )
  ),
  'errorLogger' => true,
  'allowDebugFlag' => false,
  'cachePath' => APPPATH.'cache/minify',
  'documentRoot' => '',
  'cacheFileLocking' => true,
  'groupsConfig' => array(
    //'js' => array('///js/html5.js','//js/common.js'),
    // 'css' => array('//css/file1.css', '//css/file2.css'),
   )
);

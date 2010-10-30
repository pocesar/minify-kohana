<?php

ini_set('zlib.output_compression', '0');

Route::set('minify', 'min')
  ->defaults(array(
    'directory' => 'minify',
    'controller' => 'index',
    'action' => 'minify'
  ));
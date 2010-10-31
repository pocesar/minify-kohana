<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_minify_index extends Controller {
	public function action_minify(){
    // load config
    $config = Kohana::config('minify');

    //require  MINIFY_MIN_DIR.'/Minify.php';

    Minify::$uploaderHoursBehind = $config['uploaderHoursBehind'];
    Minify::setCache(
        isset($config['cachePath']) ? $config['cachePath'] : ''
        , $config['cacheFileLocking']
    );

    if ($config['documentRoot']) {
        $_SERVER['DOCUMENT_ROOT'] = $config['documentRoot'];
    } elseif (0 === stripos(PHP_OS, 'win')) {
        Minify::setDocRoot(); // IIS may need help
    }

    $config['serveOptions']['minifierOptions']['text/css']['symlinks'] = $config['symlinks'];
    // auto-add targets to allowDirs
    foreach ($config['symlinks'] as $uri => $target) {
        $config['serveOptions']['minApp']['allowDirs'][] = $target;
    }
    
    if ($config['allowDebugFlag']) {
        if (! empty($_COOKIE['minDebug'])) {
            foreach (preg_split('/\\s+/', $_COOKIE['minDebug']) as $debugUri) {
                if (false !== strpos($_SERVER['REQUEST_URI'], $debugUri)) {
                    $config['serveOptions']['debug'] = true;
                    break;
                }
            }
        }
        // allow GET to override
        if (isset($_GET['debug'])) {
            $config['serveOptions']['debug'] = true;
        }
    }

    if ($config['errorLogger']) {
        //require _once MINIFY_MIN_DIR . '/Minify/Logger.php';
        if (true === $config['errorLogger']) {
            //require _once MINIFY_MIN_DIR . '/FirePHP.php';
            Minify_Logger::setLogger(FirePHP::getInstance(true));
        } else {
            Minify_Logger::setLogger($config['errorLogger']);
        }
    }

    // check for URI versioning
    if (preg_match('/&\\d/', $_SERVER['QUERY_STRING'])) {
        $config['serveOptions']['maxAge'] = 31536000;
    }

    if (isset($_GET['g'])) {
        // well need groups config
        $config['serveOptions']['minApp']['groups'] = $config['groupsConfig'];
    }
    
    if (isset($_GET['f']) || isset($_GET['g'])) {
        // serve!   
        Minify::serve('MinApp', $config['serveOptions']);
        exit;
    }
  }
}
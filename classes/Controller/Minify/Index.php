<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Minify_Index extends Controller {

	function action_minify()
	{
		$config = Kohana::$config->load('minify');

		if ($this->request->param('group') !== NULL)
		{
			$_GET['g'] = $this->request->param('group');
		}

		Minify::$uploaderHoursBehind = $config['uploaderHoursBehind'];
		Minify::setCache(
			isset($config['cachePath']) ? $config['cachePath'] : ''
			, $config['cacheFileLocking']
		);

		if ($config['documentRoot'])
		{
			$_SERVER['DOCUMENT_ROOT'] = $config['documentRoot'];
			Minify::$isDocRootSet = true;
		}

		$config['serveOptions']['minifierOptions']['text/css']['symlinks'] = $config['symlinks'];
		// auto-add targets to allowDirs
		foreach ($config['symlinks'] as $uri => $target)
		{
			$config['serveOptions']['minApp']['allowDirs'][] = $target;
		}

		if ($config['allowDebugFlag'])
		{
			$config['serveOptions']['debug'] = Minify_DebugDetector::shouldDebugRequest($_COOKIE, $_GET, $_SERVER['REQUEST_URI']);
		}

		if ($config['errorLogger'])
		{
			if (true === $config['errorLogger'])
			{
				$config['errorLogger'] = FirePHP::getInstance(true);
			}
			Minify_Logger::setLogger($config['errorLogger']);
		}

		// check for URI versioning
		if (preg_match('/&\\d/', $_SERVER['QUERY_STRING']))
		{
			$config['serveOptions']['maxAge'] = 31536000;
		}

		if (isset($_GET['g']))
		{
			// well need groups config
			$config['serveOptions']['minApp']['groups'] = $config['groupsConfig'];
		}

		if (isset($_GET['f']) || isset($_GET['g']))
		{
			set_time_limit(0);
			// serve!
			$serveController = new Minify_Controller_MinApp();
			$response = Minify::serve($serveController, array('quiet' => true) + $config['serveOptions']);

			$this->response->headers($response['headers']);
			$this->response->body($response['content']);
			$this->response->status($response['statusCode']);
		}
	}
}

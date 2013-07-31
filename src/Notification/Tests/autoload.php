<?php
// Use composer autoloader if exists or own PSR-0 autoloader
$vendorPath = dirname(dirname(dirname(dirname(__DIR__))));
$composerLoader = $vendorPath . '/autoload.php';

if (!is_dir($vendorPath . '/composer') || !is_file($composerLoader)) {
	spl_autoload_register(function($className) {
			$className = ltrim($className, '\\');
			$fileName  = '';
			$namespace = '';
			if ($lastNsPos = strripos($className, '\\')) {
				$namespace = substr($className, 0, $lastNsPos);
				$className = substr($className, $lastNsPos + 1);
				$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}
			$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

			require $fileName;
		});
} else {
	require_once $composerLoader;
}

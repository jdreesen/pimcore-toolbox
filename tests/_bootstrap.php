<?php

use Pimcore\Bootstrap;
use DachcomBundle\Test\Util\Autoloader;

include __DIR__ . '/../../../vendor/autoload.php';

define('PIMCORE_KERNEL_CLASS', '\DachcomBundle\Test\App\TestAppKernel');
define('PIMCORE_TEST', true);

Bootstrap::setProjectRoot();
Bootstrap::bootstrap();

/**
 * @var $loader \Composer\Autoload\ClassLoader
 */
Autoloader::addNamespace('Pimcore\Tests', PIMCORE_PROJECT_ROOT . '/vendor/pimcore/pimcore/tests/_support');
Autoloader::addNamespace('Pimcore\Model\DataObject', __DIR__ . '/_output/var/classes/DataObject');

if (!defined('TESTS_PATH')) {
    define('TESTS_PATH', __DIR__);
}

if (!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = '';
}

if (!isset($_SERVER['HTTP_USER_AGENT'])) {
    $_SERVER['HTTP_USER_AGENT'] = '';
}

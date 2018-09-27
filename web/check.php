<?php

use Drupal\Core\DrupalKernel;
use Drupal\Core\Site\Settings;

use DrupalProject\services\ServiceMonitor\ServiceMonitorManager;
use DrupalProject\services\ServiceMonitor\DatabaseServiceMonitor;
use DrupalProject\services\ServiceMonitor\RedisServiceMonitor;

use Symfony\Component\HttpFoundation\Request;

$autoloader = require_once 'autoload.php';

$kernel = new DrupalKernel('prod', $autoloader);

$request = Request::createFromGlobals();

$kernel::bootEnvironment();

$root = $kernel->getAppRoot();
$site_path = $kernel::findSitePath($request);

Settings::initialize($root, $site_path, $autoloader);

$monitor = new ServiceMonitorManager();

$monitor->setService('database', new DatabaseServiceMonitor());
$monitor->setService('redis', new RedisServiceMonitor());

$statuses = $monitor->getStatuses();

echo json_encode($statuses);

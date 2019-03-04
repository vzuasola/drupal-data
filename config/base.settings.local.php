<?php

/**
 * @file
 * Drupal site-specific configuration file for development
 */

$clients = 'tcp://10.5.0.7:6379';
$options = [
  'parameters' => ['database' => 1],
];

/**
 * Redis host
 */
$settings['webcomposer_cache']['redis'] = [
  'clients' => $clients,
  'options' => $options,
];

$settings['redis.connection']['interface'] = 'Predis';
$settings['redis.connection']['host'] = $clients;
$settings['redis.connection']['options'] = $options;

/**
 * Redis backend
 */
$settings['redis.connection']['host'] = 'tcp://10.5.0.7:6379';
$settings['redis.connection']['options'] = [
  'parameters' => ['database' => 1],
];

// use different DB for Redis Cache
$settings['redis.connection']['options']['parameters']['database'] = 2;

/**
 * Monolog settings
 */
$settings['monolog'] = [
  'path' => DRUPAL_ROOT . '/../logs/webcomposer.log',
  'level' => \Monolog\Logger::DEBUG,
];

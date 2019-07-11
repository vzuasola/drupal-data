Predis cache backend
====================

Using Predis for the Drupal 8 version of this module is still experimental.

Get Predis
----------

Predis can be installed to the vendor directory using composer like so:

composer require nrk/predis


Configuration of module for use with Predis
----------------------------

There is not much different to configure about Predis.
Adding this to settings.php should suffice for basic usage:

$settings['redis.connection']['interface'] = 'Predis';
$settings['redis.connection']['host'] = '1.2.3.4';  // Your Redis instance hostname.
$settings['cache']['default'] = 'cache.backend.redis';

To add more magic with a primary/replica setup you can use a config like this:

$settings['redis.connection']['interface'] = 'Predis'; // Use predis library.
$settings['redis.connection']['host'] = ['tcp://10.0.0.1?alias=master', 'tcp://10.0.0.2', 'tcp://10.0.0.3'];
$settings['redis.connection']['options'] = ['replication' => true]; // Options supported by Predis
$settings['cache']['default'] = 'cache.backend.redis';

You can supply any host and option support by Predis. For Sentinel support, you can do something like this:

$settings['redis.connection']['interface'] = 'Predis'; // Use predis library.
$settings['redis.connection']['host'] = ['tcp://10.0.0.1', 'tcp://10.0.0.2', 'tcp://10.0.0.3'];
$settings['redis.connection']['options'] = [
  'replication' => 'sentinel',
  'service' => 'my-service',
  'parameters' => [
    'database' => 1
  ],
];
$settings['cache']['default'] = 'cache.backend.redis';

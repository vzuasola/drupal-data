# Monolog Setup

Monolog can be adjusted on **settings.php**

```php
/**
 * Monolog settings
 */
$settings['monolog'] = [
  'path' => DRUPAL_ROOT . '/var/log/cms/webcomposer.log',
  'level' => \Monolog\Logger::INFO,
];
```

Current monolog configurations are stored on **base.settings.php** and **base.settings.local.php**

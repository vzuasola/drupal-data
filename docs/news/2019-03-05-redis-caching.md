# Move Drupal Cache to Redis

The functionality is provided by the Redis module. **You do not need to enable Redis module to enable the caching**, all you need to do is to put the corresponding values on **settings.php**

This is because the Redis module is set on autoload, it will be loaded even though it is not
enabled, and it will only kick in when the **settings.php** flag exists.

Add this to your settings.php

```php
if (isset($_SERVER['REDIS_SERVER']) && isset($_SERVER['REDIS_SERVICE'])) {
  $settings['cache']['default'] = 'cache.backend.redis';
  $settings['cache_prefix'] = "drupal.cache.$product";
}
```

> The **$product** variable exists on base, so it will always exist even it is not defined on the file

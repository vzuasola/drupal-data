# Settings Configurations Setup

Our current Drupal setup uses a different structure to manage settings.php
configuration values.

> Please read through this document to fully understand how to manage your
> settings.php

**Important**

For Drupal to identify if you are on a local instance, you must add the following
server parameters on your virtual hosts

```nginx
fastcgi_param DRUPAL_ENV "local";
```

So your vhost might look like this

```nginx
location ~ '\.php$|^/update.php' {
    fastcgi_split_path_info ^(.+?\.php)(|/.*)$;
    include fastcgi_params;
    fastcgi_param HTTP_PROXY "";
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    fastcgi_param QUERY_STRING $query_string;

    fastcgi_param DRUPAL_ENV "local";

    fastcgi_intercept_errors on;
    fastcgi_pass  php-fpm:9000;
}
```

This should allow Drupal to identify the current environment.

## Settings Definition

### All site specific settings.php must require the base settings.php

An example settings.php

```php
<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The main URL prefix for this site instance
 */
$settings['primary_site_prefix'] = 'demo';

/**
 * The front end prefix that CKEditor will append for all products
 */
$settings['ck_editor_inline_image_prefix'] = '/en/demo';
```

Notice that it requires the `base.settings.php`. This files allow control
of all setting values that concerns all site instances.

You only need to put override values in your site's `settings.php`.

### All setting values that concerns all site instances must be on base settings.php

The base settings file is located on `config/base.settings.php`.
An example of this scenario is a file alter URI that is applicable for all products.

```php
/**
 * Public file base URL:
 *
 * An alternative base URL to be used for serving public files. This must
 * include any leading directory path.
 *
 * A different value from the domain used by Drupal to be used for accessing
 * public files. This can be used for a simple CDN integration, or to improve
 * security by serving user-uploaded files from a different domain or subdomain
 * pointing to the same server. Do not include a trailing slash.
 */
if (isset($_SERVER['HTTP_X_FE_BASE_URI'])) {
  $settings['file_public_base_url'] =  $_SERVER['HTTP_X_FE_BASE_URI'];
}
```

### Local settings values can be stored on the local base settings.php

The local base settings file is located on `config/base.settings.local.php`.

You can put development specific values here, example is setting the logging
verbosity on local only.

```php
/** 
 * Show all error messages, with backtrace information. 
 * 
 * In case the error level could not be fetched from the database, as for 
 * example the database connection failed, we rely only on this value. 
 */ 
$config['system.logging']['error_level'] = 'verbose';
```

### Local database values can be stored on database.php

You can define `web/sites/{product}/database.local.php` to put your local
database credentials. Drupal will automatically pick this up when found.

The local database file is ignored so you don't have to worry about it being
pushed to the repository.

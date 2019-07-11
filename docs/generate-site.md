# Generating a new Webcomposer Drupal multi site instance

Best practices for generating a new multi site instance based on the Dafabet profile template

> We are not using a custom installation profile due to the fact that config installer
> based configurations are handled differently than Drupal standard configuration

## Create the multisite folder

Make sure you are on the Drupal root, we will use composer to generate the site for us

```bash
$ composer new:product mysite
```
where `mysite` is the folder name of the new site instance

## Add entries to sites.php

Add an entry to sites.php with your local hostname

```php
$sites['mysite.drupal.dev'] = 'mysite';
$sites['mysite.drupal.local'] = 'mysite';
```

## Install Drupal

* Attempt to install your drupal site by accessing your hostname `mysite.drupal.dev`
* Select the `Configuration Installer` installation profile
* Supply the proper database credentials
* On the config selection page, the config sync path should already be populated, just click next
* Wait for the synchronization to finish
* Configure site account, please put this values for consistency across all products

    * Username: `master`
    * Password: `master`
    * Email: `admin@drupal.com`

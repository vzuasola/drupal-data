# Web Composer template for Drupal projects

This project template should provide a kickstart for managing your site
dependencies with [Composer](https://getcomposer.org/).

## How to Setup

* Clone this repository `git clone git@gitlab.ph.esl-asia.com:CMS/drupal-data.git`
* Run `cd drupal-data`
* Install composer dependencies via `composer install`
* Make sure to configure your Nginx vhost to tag your Drupal instance as local (Refer to this [link](docs/settings-configs-setup.md))

## Important

* [Migrate Drupal cache to Redis](docs/news/2019-03-05-redis-caching.md)
* [New Implementation for Drupal Configuration Forms](docs/news/2018-03-28-new-config-form-implementation.md)

## Documentations

### General Guidelines

* [Monolog](docs/monolog.md)
* [Settings Configuration Setup](docs/settings-configs-setup.md)
* [Syncing Configurations](docs/syncing-configs.md)
* [Creating a New Multsite Instance](docs/generate-site.md)

### Module

* [Generating a Module Skeleton](docs/generate-module.md)
* [Generating a Custom Content Entity](docs/generate-custom-entity.md)
* [Generating a Custom Configuration Form](docs/generate-custom-form.md)

### Plugins

* [Creating a Webcomposer Config Plugin](docs/webcomposer-config-plugin.md)
* [Creating a Webcomposer Form Plugin](docs/webcomposer-form-plugin.md)
* [Creating a Webcomposer Dropdown Menu Widget Plugin](docs/webcomposer-menu-widget-plugin.md)

## Updating Drupal Core

This project will attempt to keep all of your Drupal Core files up-to-date; the 
project [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold) 
is used to ensure that your scaffold files are updated every time drupal/core is 
updated. If you customize any of the "scaffolding" files (commonly .htaccess), 
you may need to merge conflicts if any of your modfied files are updated in a 
new release of Drupal core.

Follow the steps below to update your core files.

1. Run `composer update drupal/core symfony/* --with-dependencies` to update Drupal Core and its dependencies.
1. Run `git diff` to determine if any of the scaffolding files have changed. 
   Review the files for any changes and restore any customizations to 
  `.htaccess` or `robots.txt`.
1. Commit everything all together in a single commit, so `web` will remain in
   sync with the `core` when checking out branches or running `git bisect`.
1. In the event that there are non-trivial conflicts in step 2, you may wish 
   to perform these steps on a branch, and use `git merge` to combine the 
   updated core files with your customized files. This facilitates the use 
   of a [three-way merge tool such as kdiff3](http://www.gitshah.com/2010/12/how-to-setup-kdiff-as-diff-tool-for-git.html). This setup is not necessary if your changes are simple; 
   keeping all of your modifications at the beginning or end of the file is a 
   good strategy to keep merges easy. 

## FAQ

### How can I apply patches to downloaded modules?

If you need to apply patches (depending on the project being modified, a pull 
request is often a better solution), you can do so with the 
[composer-patches](https://github.com/cweagans/composer-patches) plugin.

To add a patch to drupal module foobar insert the patches section in the extra 
section of composer.json:
```json
"extra": {
    "patches": {
        "drupal/foobar": {
            "Patch description": "URL to patch"
        }
    }
}
```

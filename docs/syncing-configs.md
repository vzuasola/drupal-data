# Syncing Configurations

This guide will show you how to sync and manage your configurations

> On the Drupal 8 community, YAML configs are just referred to use `configs` and not `CMI`
> The word CMI refers to Configuration Management Initiative, which is a movement to
> migrate Drupal 7 features. We should refer to configs as just `configs` or `YAML configs`

## What is Configurations

* It is the equivalent of `config_get` and `config_set` of Drupal 7
* Values are stored on YAML files
* Most of Drupal schema metadata are stored as configs
* Drupal has an admin page for checking the sync status `http://drupal.local/admin/config/development/configuration`

## Important Concepts

Config has two parts
* `Active Configs`

They are configs stored on your database, and will reflect on the site

* `Staged Configs`

They are configs stored on the YAML, and are on the filesystem

## What Happens when you Sync

Simple. It takes the `Staged Configs` and `override` the `Active Configs`

## Responsible Syncing

* `Clear Cache before Syncing`

This is to rule out cached processes that might interfere with the syncing.

* `Backup the current Database`

Backup. Backup. Backup.

* `Always check the Syncing page`

The Syncing page will display what changes will be added, modified or deleted before
you sync.

## The Syncing Workflow

> Suppose you need to add configuration changes, you need to follow this workflow

* Make sure to `git pull` first, be sure that you have your team's changes

* Sync the configs, you can either use the Syncing page or using console

```bash
$ drupal --uri=entrypage.drupal.dev ci
```

* Do your config changes

* When you are done, you can use the Syncing page to export the current tar, then import it, or using console

```bash
$ drupal --uri=entrypage.drupal.dev ce
```

* Commit the changes

> Please review the changes before you commit, if you are seeing lots of deletion or suspicious changes,
> ask your team mates, you might have been overriding their changes

## Troubleshooting

Depending on how unsynced the site is, you may experience errors after syncing

* `Syncing error before 100%`

This is common, if you got an error syncing your configs, go back to the Syncing page,
then `Clear Cache`. If `Clear Cache` does not work try doing `update.php`. Then try to sync again.

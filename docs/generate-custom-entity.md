# Generating a custom content entity

It is recommended that we follow `only one custom entity per module`.
This is to ensure that entities can be easily installed/uninstalled by limiting
the scope of the module.

```bash
$ drupal --uri=entrypage.drupal.dev gect
```
or
```bash
$ drupal --uri=entrypage.drupal.dev geco
```

All answers can be default except for 
* Enter the module name: `webcomposer_module`
* Enter the class of your new content entity: `DefaultEntity`
* Is your entity revisionable: `no`

> If you are gonna add let say an Awesome Slider, the entity name will be AwesomeSliderEntity

## Change the menu path

After generation, you should change the menu path of the module

* Add a `webcomposer_module.routing.yml` on the module root, register a main menu entry

```yml
webcomposer_module.admin_settings:
  path: 'admin/config/webcomposer/webcomposer_module'
  defaults:
    _controller: '\Drupal\system\Controller\SystemController::systemAdminMenuBlockPage'
    _title: 'Webcomposer Slider'
  requirements:
    _permission: 'administer site configuration'
```

> You can change the admin/config/webcomposer/ to admin/config/<my_product>/ for product specific modules`

* Modify the `webcomposer_module.links.menu.yml`
    * Create entry for the main menu item
    * Put proper capital cased titles on each menu entry
    * Put proper descriptions
    * Remove the entity collection weight so it does not get mixed up
    * Change the parent of the two collection and settings entry, point it to the main one

```yml
webcomposer_module.list:
  title: 'Webcomposer Default Configuration'
  description: 'List Web composer default entities'
  parent: system.admin_config
  route_name: webcomposer_module.admin_settings

# Default entity menu items definition
entity.default_entity.collection:
  title: 'Default Entity List'
  route_name: entity.default_entity.collection
  description: 'List Default entity entities'
  parent: webcomposer_module.list

webcomposer_module.admin.structure.settings:
  title: Default Entity Settings
  description: 'Configure Default entity entities'
  route_name: default_entity.settings
  parent: webcomposer_module.list
```

* Clear the cache and see if the menus are now reflected correctly

## Adjusting the List builder and the form redirection

After adjusting the routes, you need to edit the listing page, and the form redirection

* Modify `src\DefaultEntityListBuilder.php`, or whatever the list builders filename is
    * You need to remove ID, so output will be similar to

```php
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.default_entity.edit_form', array(
          'default_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }
```

* Next change the form redirection on `src\Form\DefaultEntityForm.php`, change
the the form redirect near the last line to:

```php
$form_state->setRedirectUrl($entity->urlInfo('collection'));
```

## Adding new fields the easy way

* `Sync first your configuration, so that sync fields will be empty`. Your config sync should show no changes afterwards.

* Add field on the entity settings. `Please put proper and gramatically correct description on each field`.

* Manage the form display, on the entity settings. Sort your fields as necessary. Set `Name` field to the topmost display and these fields should be `hidden`
    * `Language`
    * `Authored by`

* Double check your fields

* You need to active translation, go to `/admin/config/regional/content-language` then `check` you entity
on the Custom Language Settings

## Add an exposed views for your Entity

Your entity needs an exposed view to fetch the data

* Create a new `Views`
    * Set your views proper name, ex `Webcomposer Default Entity API`
    * View Settings: Show `Default Entity` (or whatever the entity name is) sorted by `unsorted`
    * Check `Provide a REST export` and put a path `api/default_entity`. Adjust path as follow

* Set views page to `Show All`
* Set filter criteria to `Translation language` set to `is one of` then value of `Interface text language selected for page`

## Put everything on the Install of your module

* Export your CMI

```bash
$ drupal --uri=entrypage.drupal.dev ce
```

* On `git status`, you should see files added to your `site/config/sync` folder
* Add those to the `config/install` of your module

## Put an uninstall hook

* Create a `webcomposer_module.install` and put an uninstall hook. Change the keys to all the files on your
`config/install` folder

```php
/**
 * Implements hook_uninstall
 */
function webcomposer_slider_uninstall() {
  $keys = [
    'core.entity_form_display.webcomposer_slider_entity.webcomposer_slider_entity.default.yml',
    'core.entity_view_display.webcomposer_slider_entity.webcomposer_slider_entity.default.yml',
    'field.field.webcomposer_slider_entity.webcomposer_slider_entity.field_banner_image.yml',
    'field.field.webcomposer_slider_entity.webcomposer_slider_entity.field_banner_link_target.yml',
    'field.field.webcomposer_slider_entity.webcomposer_slider_entity.field_banner_link.yml',
    'field.field.webcomposer_slider_entity.webcomposer_slider_entity.field_blurb.yml',
    'field.field.webcomposer_slider_entity.webcomposer_slider_entity.field_log_in_state.yml',
    'field.field.webcomposer_slider_entity.webcomposer_slider_entity.field_title.yml',
    'field.storage.webcomposer_slider_entity.field_banner_image.yml',
    'field.storage.webcomposer_slider_entity.field_banner_link_target.yml',
    'field.storage.webcomposer_slider_entity.field_banner_link.yml',
    'field.storage.webcomposer_slider_entity.field_blurb.yml',
    'field.storage.webcomposer_slider_entity.field_log_in_state.yml',
    'field.storage.webcomposer_slider_entity.field_title.yml',
    'language.content_settings.webcomposer_slider_entity.webcomposer_slider_entity.yml',
    'views.view.webcomposer_slider.yml',
  ];

  foreach ($keys as $key) {
    \Drupal::configFactory()->getEditable($key)->delete();
  }
}
```

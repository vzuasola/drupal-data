### This guide is deprecated, see [Webcomposer Config Plugin](docs/webcomposer-config-plugin.md)

# Generating a custom configuration form

Best practices for generating a custom configuration form

> Depending on your use case, you might need to create a new module to host your configuration form

```bash
$ drupal --uri=entrypage.drupal.dev gfc
```

All answers can be default except for 
* Enter the module name: `webcomposer_module`
* Enter the form class name: `MyConfigForm`
* Enter the form ID: `myconfig_form`
* Enter the route path: `/admin/config/<my_product>/config`
* A title for the menu link: `My Configuration`
* A description for the menu link: `Configuration my custom settings`

> For Webcomposer module paths, use this format `/admin/config/webcomposer/<module_name>/<form_name>`
> Example for single sign on form `/admin/config/webcomposer/single_signon/authentication`

* Delete the generated `config/install` folder on the module

## Change the menu parent

After generation, your form will be attached on the `System` section, which is
not we want.

We need to create a separate section for our configuration.

* On `webcomposer_module.routing.yml` prepend this block of code, `prepend` meaning it should be the first item

```yml
webcomposer_module.admin_settings:
  path: 'admin/config/webcomposer/webcomposer_module'
  defaults:
    _controller: '\Drupal\system\Controller\SystemController::systemAdminMenuBlockPage'
    _title: 'Webcomposer Slider'
  requirements:
    _permission: 'administer site configuration'
```

* Modify the `webcomposer_module.links.menu.yml`
    * Create a menu link entry, prepend the yaml below on your links.menu.yml
    * Remove the entity collection weight so it does not get mixed up
    * Change the parent of the menu item to the ID of the routing you created earlier, in this case it is `webcomposer_module.admin_settings`

```yml
webcomposer_module.list:
  title: 'Webcomposer Default Configuration'
  description: 'List Web composer default entities'
  parent: system.admin_config
  route_name: webcomposer_module.admin_settings
```

* Clear the cache and check the configuration page, your form should appear now. If not then you need to debug it

## Adding fields and submit handler

* On the generated `MyConfigForm.php`, add your fields as it is

```php
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_module.myconfig');

    $form['my_text'] = [
      '#type' => 'textfield',
      '#title' => t('My Text'),
      '#description' => $this->t('This is my own text field'),
      '#default_value' => $config->get('my_text')
    ];

    $form['my_textarea'] = [
      '#type' => 'textarea',
      '#title' => t('My Textarea'),
      '#description' => $this->t('This is my own textarea field'),
      '#default_value' => $config->get('my_textarea')
    ];

    return parent::buildForm($form, $form_state);
  }
```

> For Webcomposer general modules, change your `getEditableConfigNames` to follow the
> format `webcomposer_config.<my_definition>`

* Change the submit handler, notice the use of loop and array keys

```php
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'my_text',
      'my_textarea',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_module.myconfig')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
```

> **Important notes** If you are to define a field with a file image type, you can prefix your field name
> with `file_image`. Example is `file_image_profile_logo`. An alter in the Rest system will automatically
> resolve file IDs to their actual absolute paths

## Making a field translatable

Please contribute to complete this section

## Adding a installation config and uninstall hook

Why add an install ?
* So that when you enable a module, fields have default value on them

Why add an uninstall hook ?
* So that when you disable a module, leftover data are deleted

### Install configs

* Create a `config/install` folder

* Your `getEditableConfigNames` will be the name of your yml. For the example above, it will be `webcomposer_module.myconfig.yml`

* Populate the yml with a key value pair, use the `keys` you specified on your `submitForm`

```yml
my_text: My Text default value
my_textarea: This is a really long text
```

> Best practice is one yml per form, since one form only contains one editableConfigName

### Uninstall hook

* Create `webcomposer_module.install`

* Add this hook, specify `keys` of `getEditableConfigNames` per form

```php
/**
 * Implements hook_uninstall
 */
function webcomposer_module_uninstall() {
    $keys = [
        'webcomposer_module.myconfig.yml'
    ];

    foreach ($keys as $key) {
      \Drupal::configFactory()->getEditable($key)->delete();
    }
}
```

> Best practice is one key per form, since one form only contains one editableConfigName

# Generating a Webcomposer Config Plugin

A Webcomposer Config plugin is an intuitive way to generate custom configuration form.
It has it's own implementation which does not deviate that much from how Drupal
does it.

### Why do you need config plugins instead of using plain Drupal config form

* You just need to define one class
* No more routing yml
* No more menu yml
* No more defining that schema yml
* Fields can easily be made translatable (just one line)
* And most importantly, **_the form stays the same when translating it to another language_**

> Working concrete example can be found on the sample module **webcomposer_config_schema_sample**
> which lives inside **webcomposer_config_schema** module


### Define a Form Plugin Class

* **Structure**

It contains the mandatory methods, see below code example.

* **Annotation**

The important part of the plugin class is the annotation.
It can contain a **route** option or a **menu** option, if you want this form
to appear on the admin menu.

```php
namespace Drupal\my_module\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_module_sample",
 *   route = {
 *     "title" = "MY Module Form Configuration",
 *     "path" = "/admin/config/webcomposer/config/sample",
 *   },
 *   menu = {
 *     "title" = "MY Module Configuration",
 *     "description" = "Provides sample configuration",
 *     "parent" = "my_module.list",
 *     "weight" = 30
 *   },
 * )
 */
class SampleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_module.sample'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['teaser'] = [
      '#type' => 'details',
      '#title' => $this->t('Teaser'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['teaser']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
    ];

    $form['teaser']['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $this->get('description'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
```

* **Defining the form definition**

This is done on the **form** method. Just define the form as you normally would.
To make it translatable, just add the following **'#translatable' => TRUE** 
property on the field.

```php
$form['teaser']['description'] = [
  '#type' => 'textarea',
  '#title' => $this->t('Description'),
  '#default_value' => $this->get('description'),
  '#translatable' => TRUE,
];
```

> (**IMPORTANT**) To make translation work, the **form field index and the index you pass on the
get and submit method should be the same**.
> Just like on the example, _description_ is the field index, so does the one on the get.

To retrieve saved data, you just need to call the **get** method.

```php
$this->get('my_property');
```

* **Auto saving values**

There are two ways to achieve this. If done right, the module can automatically
guess what you want to save and how you want to store it using Artificial Intelligence
and machine learning (just kidding, it's just using loops and pattern matching).

As long as you match your field indeces, this shouldn't be a problem.

* **Manual saving behavior**

If you don't want the module to automatically guess what to save for you,
then you can define the **submit** method.

```php
/**
 * {@inheritdoc}
 */
public function submit(array &$form, FormStateInterface $form_state) {
  $keys = [
    'title',
    'description',
  ];

  foreach ($keys as $key) {
    $data[$key] = $form_state->getValue($key);
  }

  $this->save($data);
}
```

You must only have a **single call to the save method**. You need to construct
what data you need to persist by defining an associative array (in this case the **$data**)
then passing it to the save.


However, even if you choose to save manually, the module still does some post data processing.
The module tries to remove values from the **form_state** that are not tagged as
translatable when trying to translate the values. To disable this behavior, declare
this property on your form.

```php
namespace Drupal\my_module\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class SampleForm extends FormBase {
  protected $disableAutoTranslateOnSave = TRUE;
}
```


### Provide a installtion configs and hook uninstall

You can put generates yml inside **config/install** to have the values
preloaded on module install.

As for uninstallation, define a uninstall hook as follows, where each entry corresponds to your
editable config names.

```php
/**
 * Implements hook_uninstall
 */
function webcomposer_config_schema_sample_uninstall() {
  $keys = [
    'my_module.sample',
  ];

  foreach ($keys as $key) {
    \Drupal::configFactory()->getEditable($key)->delete();
  }
}
```

## How to Fetch Config from Front End

Suppose you define a form

```php
class SampleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_module.sample'];
  }
}
```

You can get the form data using config fetcher by passing the complete config namespace

```php
$data = $this->configs->getConfig('my_module.sample');
```


## Best Practices

### Module Structure

You should define module configuration form under that specific module only.
Don't define config form for another module in a seperate module, group them consistently.

### Making it appear on Admin Configuration page

A common scenario is to make your form appear on **admin/config** page or Drupal's
administrative dashboard.

To do this you need to the following:

* **Define a new module with routing.yml and links.menu.yml**

**my_module.routing.yml**

```yaml
my_module.admin_settings:
  path: 'admin/config/webcomposer/sample'
  defaults:
    _controller: '\Drupal\system\Controller\SystemController::systemAdminMenuBlockPage'
    _title: 'Webcomposer Sample Configuration'
  requirements:
    _permission: 'administer site configuration'
```

**my_module.links.menu.yml**

```yaml
my_module.list:
  title: 'Webcomposer Sample Configuration'
  description: 'Provides a form for defining custom sample configuration'
  parent: system.admin_config
  route_name: my_module.admin_settings
```

* **Make the plugin point to the menu as parent**

```php
/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_module_sample",
 *   route = {
 *     "title" = "MY Module Form Configuration",
 *     "path" = "/admin/config/webcomposer/config/sample",
 *   },
 *   menu = {
 *     "title" = "MY Module Configuration",
 *     "description" = "Provides sample configuration",
 *     "parent" = "my_module.list",
 *     "weight" = 30
 *   },
 * )
 */
class SampleForm extends FormBase {
}
```

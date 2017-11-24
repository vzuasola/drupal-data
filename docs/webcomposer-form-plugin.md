# Generating a Webcomposer Form Plugin

A Webcomposer Form Plugin allows you to define a configurable form, that can be exposed
as data.

> Make sure that the Webcomposer Form Manager Rest Resource has permissions for Anonymous users

It has the following functionality:
* Defining form
* Defining fields per form
* Defining settings per form
* Sorting of fields per form
* Setting validations per field per form
* Setting error messages per validation per field per form
* Setting parameters per validation per field per form

This values can be translated:
* Form settings
* Form weights
* Field settings
* Validation error messages

> For concrete and working example, you can enable the `webcomposer_form_sample` module

## Creating a Webcomposer Form Plugin

Define a plugin class, all plugin class should be under the `Plugin\Webcomposer\Form` subnamespace

> The full namespace in your module would be `Drupal\my_module\Plugin\Webcomposer\Form`

A plugin class would be like this:

```php
namespace Drupal\my_module\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * MyForm
 *
 * @WebcomposerForm(
 *   id = "myform",
 *   name = "MyCustomForm",
 * )
 */
class LoginForm extends WebcomposerFormBase implements WebcomposerFormInterface {
    /**
     * @{inheritdoc}
     */
    public function getSettings() {
    }

    /**
     * @{inheritdoc}
     */
    public function getFields() {
    }
}
```

On this plugin, you can define your form settings, if any. You will also define
your form fields.

## Defining Form Settings

Form settings are just associative array of form API elements

```php
/**
 * @{inheritdoc}
 */
public function getSettings() {
  return [
    'show' => [
      '#title' => 'Show this form',
      '#type' => 'checkbox',
      '#default_value' => true
    ],
    'alias' => [
      '#title' => 'Form alias',
      '#type' => 'textfield',
      '#description' => 'The alias for this form',
    ],
  ];
}
```

> If you do not have form settings, just return an empty array.

## Defining Form Fields

Fields can be defined using a specific associative array format.

Let's break it down, you can return an array of `field definition`. A field definition
is an associative array (the array `key` serves as the field ID) that has the following parts:
* string `name` - The name of the field
* string `type` - The type of the field
* array `options` - Optional. Just the form api values, this can control how the field on the admin is rendered. `default_value` is accepted.
* array `settings` - Optional. Defines the settings, just like form settings, but on a field level.

```php
/**
 *
 */
public function getFields() {
  return [
    'firstname' => [
      'name' => 'First name',
      'type' => 'textfield',
      'settings' => [
        'label' => [
          '#title' => 'Label',
          '#type' => 'textfield',
          '#description' => 'Label for this field',
          '#default_value' => 'Leandrew',
        ],
      ],
    ],

    'lastname' => [
      'name' => 'Last name',
      'type' => 'textfield',
      'settings' => [
        'label' => [
          '#title' => 'Label',
          '#type' => 'textfield',
          '#description' => 'Label for this field',
          '#default_value' => 'ViCarpio',
        ],
      ],
    ],

    'submit' => [
      'name' => 'Submit',
      'type' => 'submit',
      'settings' => [
        'label' => [
          '#title' => 'Submit Label',
          '#type' => 'textfield',
          '#description' => 'Label for the submit button',
          '#default_value' => 'Submit',
        ],
      ],
    ],
  ],
}
```
## Result

The following class in our example will have this code

```php
namespace Drupal\my_module\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * LoginForm
 *
 * @WebcomposerForm(
 *   id = "login",
 *   name = "LoginForm",
 * )
 */
class LoginForm extends WebcomposerFormBase implements WebcomposerFormInterface {
  /**
   *
   */
  public function getSettings() {
    return [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => true
      ],
      'alias' => [
        '#title' => 'Form alias',
        '#type' => 'textfield',
        '#description' => 'The alias for this form',
      ],
    ];
  }

  /**
   *
   */
  public function getFields() {
    return [
      'firstname' => [
        'name' => 'First name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'Leandrew',
          ],
        ],
      ],

      'lastname' => [
        'name' => 'Last name',
        'type' => 'textfield',
        'settings' => [
          'label' => [
            '#title' => 'Label',
            '#type' => 'textfield',
            '#description' => 'Label for this field',
            '#default_value' => 'ViCarpio',
          ],
        ],
      ],

      'submit' => [
        'name' => 'Submit',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Submit Label',
            '#type' => 'textfield',
            '#description' => 'Label for the submit button',
            '#default_value' => 'Submit',
          ],
        ],
      ],
  }
}
```

## Extending Validations

> Please note that the even though you can define any data for your parameters,
> the front end validation library does not support special characters as parameters.

The default list of validations can be found on `Drupal\webcomposer_form_manager\Validation\ValidationManager`

To alter this list, you just need to create an alter hook for `webcomposer_form_validation`.

```php
/**
 * Implements hook_webcomposer_form_validation_alter().
 */
function my_module_webcomposer_form_validation_alter(&$validations) {
  // do alter
}
```

## Best practices

If you are defining your own module, with forms, it is recommended that you
delete the settings on you uninstall hook.

Suppose you have these form IDs as plugin:
* login
* registration

Define a `hook_uninstall` like this

```php
/**
 * Implements hook_uninstall
 */
function my_module_uninstall() {
    $keys = [
        'webcomposer_form_manager.form.registration',
        'webcomposer_form_manager.form.login',
    ];

    foreach ($keys as $key) {
      \Drupal::configFactory()->getEditable($key)->delete();
    }
}
```

# Live Module Example

You can refer to this module for a
[live working example](../web/modules/custom/webcomposer_form_manager/webcomposer_form_sample)

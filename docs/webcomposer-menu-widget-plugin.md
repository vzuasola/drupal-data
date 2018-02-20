# Generating a Webcomposer Dropdown Menu Widget Plugin

A Webcomposer Dropdown Menu Widget Plugin allows you to define a configurable form, that can be exposed
as data to the front end. Widgets can also be enabled or disabled, and they can be sorted.

> Make sure that the Webcomposer Dropdown Menu Rest Resource is enabled and has permissions for Anonymous users

The plugin provides the following:
* Listing
* Sorting
* Assigning widget to sections

> For concrete and working example, you can check the `webcomposer_dropdown_promotion` module

## Creating a Dropdown Menu Widget Plugin

Define a plugin class, all plugin class should be under the `Plugin\Webcomposer\DropdownMenu` subnamespace

> The full namespace in your module would be `Drupal\my_module\Plugin\DropdownMenu\MyWidget`

Please do note that menu widget plugins are also **Config Forms** wherein you can
define your config fields.

```php
namespace Drupal\my_module\Plugin\Webcomposer\DropdownMenu;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface;

/**
 * My menu widget plugin
 *
 * @DropdownMenuPlugin(
 *   id = "my_widget",
 *   name = "My Widget Plugin",
 * )
 */
class MyWidget extends ConfigFormBase implements DropdownMenuPluginInterface {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_dropdown_menu.dropdown_menu.section.my_widget'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my_widget_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_dropdown_menu.dropdown_menu.section.my_widget');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The tile title'),
      '#default_value' => $config->get('title'),
    ];

    $form['markup'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Markup'),
      '#description' => $this->t('The markup for the paragraph text'),
      '#default_value' => $config->get('markup'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'title',
      'markup',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_dropdown_menu.dropdown_menu.section.my_widget')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}
```

> Notice on the above code example the key specified as `webcomposer_dropdown_menu.dropdown_menu.section.{my_widget}`. This is
> very important and you should follow the same format too. Just change all `my_widget` on the
> class above to your widget ID.

Since this is a configuration form, you can define a schema for the values to be
translatable.

### Configuring your Plugin

After defining the plugin, do a **clear cache** and your plugin should appear on
the Dropdown Menu Manager on this path `/admin/config/webcomposer/dropdown/manage`

There are two regions defined
* **Content**
* **Disabled**

Disabled widgets won't show up on the front end.

### Enable Rest Resource and Permission

Make sure that the rest resource for Webcomposer Dropdown Menu is enabled and
anonymous permission is granted unto it.

### Important Guidelines

* **Site specific widget should be defined on site specific modules**
* **Widgets that can be reused across multiple product should be on a web/modules/custom**

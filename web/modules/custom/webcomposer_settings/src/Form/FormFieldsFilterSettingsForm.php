<?php

namespace Drupal\webcomposer_settings\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;

/**
 * Filter Form configuration plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_settings_form_fields_filter_settings",
 *   route = {
 *     "title" = "Form Fields Filter Settings",
 *     "path" = "/admin/config/webcomposer/config/form_fields_filter_settings",
 *   },
 *   menu = {
 *     "title" = "Form Fields Filter Settings",
 *     "description" = "Provides additional settings",
 *     "parent" = "webcomposer_config.list",
 *     "weight" = 100,
 *   },
 * )
 */
class FormFieldsFilterSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_settings.form_fields_filter_settings'];
  }

  /**
   * {@inheritdoc}
   */
  private function getConfigFactoryList() {
    $configList = [];

    foreach ($this->configFactory()->listAll() as $name) {
      if (strpos($name, 'webcomposer_config.') !== false) {
        $configList[$name] = $this->configFactory()->get($name)->get();
      }
    }

    return $configList;
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['#disabled_form_filter'] = TRUE;

    foreach ($this->getConfigFactoryList() as $key => $configs) {
      if ($key == 'webcomposer_config.form_fields_filter_settings') {
        continue;
      }

      $id = str_replace('webcomposer_config.', '', $key);

      $form['advanced'] = [
        '#type' => 'vertical_tabs',
        '#title' => t('Webcomposer Configuration'),
      ];

      $form[$id] = [
        '#type' => 'details',
        '#title' => ucwords(str_replace('_', ' ', $id)),
        '#collapsible' => TRUE,
        '#group' => 'advanced',
      ];

      $form[$id]['select'] = [
        '#type' => 'item',
        '#markup' => '<a href="#" class="select-all" data-checkbox-selector="' . $id . '">Select All</a> | <a href="#" class="deselect-all" data-checkbox-selector="' . $id . '">Deselect All</a><br /><br />',
      ];

      $excluded_fields = ['_core', 'value', 'format', 'title'];

      foreach ($configs as $field_name => $value) {
        if (in_array($field_name, $excluded_fields) || stripos($field_name, '__active_tab') > 1) {
          continue;
        }

        $form[$id][$field_name] = [
          '#type' => 'checkbox',
          '#title' => $field_name,
          '#default_value' => $this->get($field_name),
          '#attributes' => [
            'class' => [$id . '-form-fields-filter']
          ],
        ];
      }

      $apiUrl = implode('/', [
        \Drupal::request()->getSchemeAndHttpHost(),
        \Drupal::languageManager()->getCurrentLanguage()->getId(),
        "api/general/configuration/$id?_format=json",
      ]);

      $form[$id]['api_url'] = [
        '#type' => 'item',
        '#title' => t('API URL'),
        '#markup' => '<a href="' . $apiUrl . '" target="_blank">' . $apiUrl . '</a>',
        '#weight' => 50,
      ];
    }

    $form['#attached']['library'][] = 'webcomposer_settings/webcomposer_settings.form_fields_filter';

    return $form;
  }

  private function selectAllScript() {
    return '(function(){var checboxes = document.querySelector(this.getAttribute("data-checkbox-selector")); console.log(checboxes);}();';
  }

}

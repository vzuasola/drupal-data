<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * GeoIP Language Popup Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_geoip_language_popup",
 *   route = {
 *     "title" = "GeoIP Language Popup Configuration",
 *     "path" = "/admin/config/webcomposer/config/geoip_language_popup",
 *   },
 *   menu = {
 *     "title" = "GeoIP Language Popup Configuration",
 *     "description" = "Provides Settings GeoIP Language Popup",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class GeoIpLanguagePopupForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.geoip_language_popup'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['geoip_language_popup_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('GeoIP Language Popup Configuration'),
    ];

    $form['geoip_settings'] = [
      '#type' => 'details',
      '#title' => 'GeoIP Settings',
      '#group' => 'geoip_language_popup_settings_tab',
    ];

    $geoips = array_map('trim', explode(PHP_EOL, $this->get('geoip_list')));

    $form['geoip_settings']['geoip_list'] = [
      '#type' => 'textarea',
      '#title' => 'GeoIP (per line)',
      '#default_value' => $this->get('geoip_list'),
      '#description' => '<b>Example:</b><br><i>in<br>ph</i>',
    ];

    foreach ($geoips as $geoip) {
      $geoip = trim($geoip);

      if (!empty($geoip)) {
        $groupKey = "geoip_{$geoip}_settings";
        $form[$groupKey] = [
            '#type' => 'details',
            '#title' => strtoupper($geoip),
            '#group' => 'geoip_language_popup_settings_tab',
        ];

        $key = strtolower($geoip);
        $fieldKey = "{$key}_popup_content";
        $content = $this->get($fieldKey);

        $form[$groupKey][$fieldKey] = [
          '#type' => 'text_format',
          '#title' => $this->t('Popup Content'),
          '#default_value' => $content['value'],
          '#format' => $content['format'],
          '#description' => $this->t('Contents that will be displayed inside the popup.'),
          '#translatable' => true,
        ];
      }
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'geoip_list',
    ];

    $geoips = array_map('trim', explode(PHP_EOL, $this->get('geoip_list')));

    foreach ($geoips as $geoip) {
      $keys[] = strtolower($geoip) . '_popup_content';
    }

    foreach ($keys as $key) {
      switch ($key) {
        case 'geoip_list':
          $data[$key] = strtolower($form_state->getValue($key));
          break;
        default:
          $data[$key] = $form_state->getValue($key);
      }
    }

    $this->save($data);
  }
}

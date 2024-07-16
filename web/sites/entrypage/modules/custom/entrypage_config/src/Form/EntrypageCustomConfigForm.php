<?php

namespace Drupal\entrypage_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "entrypage_config",
 *   route = {
 *     "title" = "Entrypage Custom Configuration",
 *     "path" = "/admin/config/entrypage_config/custom",
 *   },
 *   menu = {
 *     "title" = "Entrypage Custom Configuration",
 *     "description" = "Configure the Entrypage Custom configuration",
 *     "parent" = "entrypage_config.list",
 *   },
 * )
 */
class EntrypageCustomConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['entrypage_config.entrypage_configuration_form'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Entrypage Configuration'),
    ];

    $this->customSettings($form);

    return $form;
  }

  private function customSettings(array &$form) {
    $form['trust_element'] = array(
      '#type' => 'details',
      '#title' => t('Trust Element'),
      '#group' => 'advanced',
    );

    $trust_element = $this->get('trust_element_content');
    $form['trust_element']['trust_element_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Content'),
        '#default_value' => $trust_element['value'],
        '#translatable' => TRUE,
    );

    $form['faqs_configuration'] = array(
      '#type' => 'details',
      '#title' => t('FAQ Configuration'),
      '#group' => 'advanced',
    );

    $form['faqs_configuration']['faq_url'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Faq page URL'),
        '#default_value' => $this->get('faq_url'),
        '#translatable' => TRUE,
    );

    $form['feature_flags_configuration'] = array(
      '#type' => 'details',
      '#title' => t('Feature Flags Configuration'),
      '#group' => 'advanced',
    );
    $form['feature_flags_configuration']['front_blocks'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Front Blocks V2'),
      '#default_value' => $this->get('front_blocks'),
      '#translatable' => TRUE,
    );
  }
}

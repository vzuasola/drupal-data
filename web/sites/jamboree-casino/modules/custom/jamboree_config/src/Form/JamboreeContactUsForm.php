<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_contact",
 *   route = {
 *     "title" = "Contact Us Configuration",
 *     "path" = "/admin/config/jamboree/contact_configuration",
 *   },
 *   menu = {
 *     "title" = "Contact Us Configuration",
 *     "description" = "Provides Contact Us configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeContactUsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.contact_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Contact Us Configuration'),
    ];

    $this->sectionContact($form);

    return $form;
  }

  private function sectionContact(array &$form) {

    $form['contact_us'] = [
      '#type' => 'details',
      '#title' => $this->t('Contact Us'),
      '#group' => 'advanced',
    ];

    $d = $this->get('contact_us_body');

    $form['contact_us']['contact_us_body'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Contact Us'),
      '#default_value' => $d['value'],
       '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  }

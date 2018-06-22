<?php

namespace Drupal\contact_form\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "contact_form_page",
 *   route = {
 *     "title" = "Contact us configuration",
 *     "path" = "/admin/config/contact-us/config",
 *   },
 *   menu = {
 *     "title" = "Contact us configuration",
 *     "description" = "Configure contact us page",
 *     "parent" = "contact_form.list",
 *     "weight" = 30
 *   },
 * )
 */
class ContactUsPageForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['contact_form.page'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
    );

    $form['content'] = array(
      '#type' => 'details',
      '#title' => t('Page Content'),
      '#group' => 'advanced',
    );

    $form['success'] = array(
      '#type' => 'details',
      '#title' => t('Success Message'),
      '#group' => 'advanced',
    );

    $form['content']['page_title'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#required' => TRUE,
        '#translatable' => TRUE,
        '#default_value' => $this->get('page_title'),
        '#description' => 'Contact Us Page Title'
    );

    $body_content = $this->get('body_content');
    $form['content']['body_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Content Blurb'),
        '#translatable' => TRUE,
        '#default_value' => $body_content['value'],
        '#format' => $body_content['format'],
        '#description' => 'Contact Us Blurb'
    );

    $success_message = $this->get('success_message');
    $form['success']['success_message'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Successful Submit Message'),
        '#translatable' => TRUE,
        '#default_value' => $success_message['value'],
        '#format' => $success_message['format'],
        '#description' => 'Contact Us Success Message'
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'page_title',
      'body_content',
      'success_message',
    ];

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}

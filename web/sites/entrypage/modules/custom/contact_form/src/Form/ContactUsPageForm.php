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

    $body_content = $this->get('body_content');
    $form['content']['body_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Body'),
        '#default_value' => $body_content['value'],
        '#format' => $body_content['format']
    );

    $success_message = $this->get('success_message');
    $form['success']['success_message'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Successful Submit Message'),
        '#default_value' => $success_message['value'],
        '#format' => $success_message['format']
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'body_content',
      'success_message',
    ];

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}

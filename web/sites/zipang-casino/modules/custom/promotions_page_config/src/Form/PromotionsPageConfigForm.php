<?php

namespace Drupal\promotions_page_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "promotions_page_config",
 *   route = {
 *     "title" = "Promotions Page Configuration",
 *     "path" = "/admin/config/webcomposer/config/promotions_page_config",
 *   },
 *   menu = {
 *     "title" = "Promotions Page configuration",
 *     "description" = "Configure Promotions Page Blurb, Success Page and Email Template",
 *     "parent" = "promotions_page_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class PromotionsPageConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['promotions_page_config.promotions_page_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->promotionsBlurb($form);
    $this->promotionsSuccess($form);
    $this->promotionsSettings($form);

    return $form;
  }

  /**
   *
   */
  private function promotionsBlurb(array &$form) {
    $form['content'] = [
      '#type' => 'details',
      '#title' => t('Promotions Page Blurb'),
      '#group' => 'advanced',
    ];

    $form['content']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Adds page title to the promotions page.'),
      '#default_value' => $this->get('page_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $body_content = $this->get('body_content');
    $form['content']['body_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content Blurb'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];

    $footer_blurb = $this->get('footer_blurb');
    $form['content']['footer_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Footer Blurb'),
      '#default_value' => $footer_blurb['value'],
      '#format' => $footer_blurb['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function promotionsSuccess(array &$form) {
    $form['success'] = [
      '#type' => 'details',
      '#title' => t('Promotions Success Page'),
      '#group' => 'advanced',
    ];

    $form['success']['success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Adds page title to the promotions page success message.'),
      '#default_value' => $this->get('success_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $success_message = $this->get('success_message');
    $form['success']['success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content Blurb'),
      '#default_value' => $success_message['value'],
      '#format' => $success_message['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function promotionsSettings(array &$form) {
    $form['settings'] = [
      '#type' => 'details',
      '#title' => t('Promotions Page Form Settings'),
      '#group' => 'advanced',
    ];

    $form['settings']['form_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Adds page title to the promotions page form.'),
      '#default_value' => $this->get('form_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['settings']['email_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Email Template'),
      '#default_value' => $this->get('email_template'),
      '#rows' => 15,
      '#description' => 'Tokens:
      <ul>
          <li>@firstname - First name of the player</li>
          <li>@lastname - Last name of the player</li>
          <li>@username - Username of the player</li>
          <li>@email - Email Address the player inputted</li>
          <li>@product - Product the player selected</li>
          <li>@subject - Subject the player selected</li>
          <li>@message - Main message of the player</li>
          <li>@date - This date the form is submitted</li>
          <li>@ip - IP address of the player</li>
          <li>@language - Selected language of the player</li>
      </ul>',
      '#translatable' => TRUE,
    ];

    $form['settings']['form_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Label'),
      '#description' => $this->t('Adds button label to the promotions page form.'),
      '#default_value' => $this->get('form_button'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }
}

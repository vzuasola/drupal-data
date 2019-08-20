<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_footer",
 *   route = {
 *     "title" = "Footer Configuration",
 *     "path" = "/admin/config/jamboree/footer_configuration",
 *   },
 *   menu = {
 *     "title" = "Footer Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeFooterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.footer_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $this->sectionFooterBlurb($form);
    $this->sectionCookieNotification($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionFooterBlurb(array &$form) {
    $form['footer'] = [
      '#type' => 'details',
      '#title' => t('Footer Blurb'),
      '#group' => 'advanced',
    ];

    $d = $this->get('footer_blurb');

    $form['footer']['footer_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Footer Blurb'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }

  private function sectionCookieNotification(array &$form) {
    $form['cookie_notif'] = [
      '#type' => 'details',
      '#title' => t('Cookie Notification'),
      '#group' => 'advanced',
    ];

    $default_website_cookie_body = $this->get('cookie_notif_body');
    $form['cookie_notif']['cookie_notif_body'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Notification Message'),
      '#default_value' => $default_website_cookie_body['value'],
      '#format' => $default_website_cookie_body['format'],
      '#translatable' => TRUE,
    ];

    $default_website_cookie_acceptbutton_text = $this->get('cookie_notif_acceptbutton_text');
    $form['cookie_notif']['cookie_notif_acceptbutton_text'] = [
      '#type' => 'textfield',
      '#title' => t('Accept Button Text'),
      '#default_value' => $default_website_cookie_acceptbutton_text,
      '#translatable' => TRUE,
    ];

  }
}

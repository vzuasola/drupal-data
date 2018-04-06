<?php

namespace Drupal\webcomposer_config\Deprecated\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Footer.
 */
class FooterConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.footer_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_config_footer_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $this->sectionAbout($form);
    $this->sectionQuicklinks($form);
    $this->sectionSocials($form);
    $this->sectionBackToTop($form);
    $this->sectionResponsive($form);

    return parent::buildForm($form, $form_state);
  }

  /**
   *
   */
  private function sectionAbout(array &$form) {
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['about_dafabet_details'] = [
      '#type' => 'details',
      '#title' => t('About Dafabet'),
      '#group' => 'advanced',
    ];

    $form['about_dafabet_details']['about_dafabet_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('about_dafabet_title'),
      '#required' => TRUE,
    ];

    $d = $config->get('about_dafabet_content');

    $form['about_dafabet_details']['about_dafabet_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionQuicklinks(array &$form) {
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['quicklinks_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Quicklinks'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['quicklinks_group']['quicklinks_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Quicklink Title'),
      '#description' => $this->t('Text to be displayed in quicklink title.'),
      '#default_value' => $config->get('quicklinks_title'),
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionSocials(array &$form) {
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['social_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Social Media'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['social_group']['social_media_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Social Media Title'),
      '#description' => $this->t('Text to be displayed above the Social Media Links.'),
      '#default_value' => $config->get('social_media_title'),
    ];
  }

  /**
   *
   */
  private function sectionBackToTop(array &$form) {
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['back_to_top'] = [
      '#type' => 'details',
      '#title' => $this->t('Back To Top'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['back_to_top']['back_to_top_title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Exclude These Pages'),
      '#description' => $this->t('Exclude Back To Top Button From These Pages.'),
      '#default_value' => $config->get('back_to_top_title'),
    ];
  }

  /**
   *
   */
  private function sectionResponsive(array &$form) {
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['responsive_footer'] = [
      '#type' => 'details',
      '#title' => $this->t('Responsive'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['responsive_footer']['sponsor_mobile_desc'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sponsor Mobile Description'),
      '#description' => $this->t('Text to be displayed in mobile devices below the sponsor logos.'),
      '#default_value' => $config->get('sponsor_mobile_desc') ?? 'Official Main Club Sponsors',
      '#required' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      // About Dafabet Section
      'about_dafabet_title',
      'about_dafabet_content',

      // Quicklinks Sections
      'quicklinks_title',

      // Social Section
      'social_media_title',

      // Back to top Section
      'back_to_top_title',

      // Responsive Section
      'sponsor_mobile_desc',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.footer_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}

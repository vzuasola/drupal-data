<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

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
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

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

    $form['partners_details'] = [
      '#type' => 'details',
      '#title' => t('Partners Logo'),
      '#group' => 'advanced',
    ];

    $form['partners_details']['deprecated'] = [
      '#type' => 'details',
      '#title' => $this->t('Deprecated'),
      '#description' => $this->t('Deprecated Partners fields due to New Curacao
        implementation, this is just to support old products.'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];

    $form['partners_details']['deprecated']['partners_logo'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Partners logo'),
      '#default_value' => $config->get('partners_logo'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['quicklinks_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Quicklinks Title'),
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

    $form['social_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Social Media Title'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['social_group']['social_media_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Social Media Title'),
      '#description' => $this->t('Text to be displayed above the Social Media Links.'),
      '#default_value' => $config->get('social_media_title'),
    ];

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

    $form['responsive_footer'] = [
      '#type' => 'details',
      '#title' => $this->t('Responsive Footer'),
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

    $form['responsive_footer']['tablet_partners_logo'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Tablet - Partners logo'),
      '#default_value' => $config->get('tablet_partners_logo'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    return parent::buildForm($form, $form_state);
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
      'about_dafabet_title',
      'about_dafabet_content',
      'partners_logo',
      'quicklinks_title',
      'social_media_title',
      'back_to_top_title',
      'sponsor_mobile_desc',
      'tablet_partners_logo',
    ];

    foreach ($keys as $key) {
      if ($key == 'partners_logo') {
        $fid = $form_state->getValue('partners_logo');
        $this->setImageStatus($fid);
      }

      if ($key == 'tablet_partners_logo') {
        $fid = $form_state->getValue('tablet_partners_logo');
        $this->setImageStatus($fid);
      }

      $this->config('webcomposer_config.footer_configuration')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

  /**
   * Set the URL image.
   */
  private function setImageStatus($fid) {
    if ($fid) {
      $file = File::load($fid[0]);
      $file->setPermanent();
      $file->save();

      $file_usage = \Drupal::service('file.usage');
      $file_usage->add($file, 'webcomposer_config', 'image', $fid[0]);
    }
  }

}

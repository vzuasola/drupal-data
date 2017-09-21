<?php

namespace Drupal\keno_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for Loading Page.
 */
class LoadingPageForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['keno_config.loading_page'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'loading_page_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('keno_config.loading_page');

    $content = $config->get('loading_page_content');
    $form['loading_page_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'loading_page_content',
    ];
    foreach ($keys as $key) {
        $this->config('webcomposer_config.loading_page')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }
}

<?php

namespace Drupal\webcomposer_marketing_script\Form\Providers\AdElement;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_marketing_script\Form\Providers\MarketingScriptProviderBase;

/**
 * AdElement Settings Class.
 */
class AdElementSettingsForm extends MarketingScriptProviderBase {
  /**
   * {@inheritdoc}
   */
  protected function getMarketingScriptConfigName() {
    return 'adelement';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $form['depth'] = [
      '#type' => 'number',
      '#title' => $this->t('Account Creation Confirmation Depth'),
      '#description' => $this->t('Depth value for account creation confirmation page'),
      '#size' => 255,
      '#default_value' => $this->getConfig('depth'),
    ];

    $form['page'] = [
      '#type' => 'textfield',
      '#title' => t('Account Creation Confirmation Page Path'),
      '#description' => $this->t('Page path of account creation confirmation page'),
      '#size' => 255,
      '#default_value' => $this->getConfig('page'),
    ];

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function submitValues() {
    return [
      'depth',
      'page'
    ];
  }
}

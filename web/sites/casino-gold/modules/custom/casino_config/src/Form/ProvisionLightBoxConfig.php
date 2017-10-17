<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for Provisioning LightBox.
 */
class ProvisionLightBoxConfig extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['casino_config.provisioning_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'provisioning_config_settings_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('casino_config.provisioning_config');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['provision_application_details'] = [
      '#type' => 'details',
      '#title' => t('Provision Application Settings'),
      '#group' => 'advanced',
    ];

    $content = $config->get('app_top_blurb');
    $form['provision_application_details']['app_top_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Application Top Blurb'),
      '#description' => $this->t('The Application Top Blurb for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => true,
    ];

    $content = $config->get('app_middle_blurb');
    $form['provision_application_details']['app_middle_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Application Middle Blurb'),
      '#description' => $this->t('The Application Middle Blurb for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
    ];

    $form['provision_reapplication_details'] = [
      '#type' => 'details',
      '#title' => t('Provision Reapplication Settings'),
      '#group' => 'advanced',
    ];

    $content = $config->get('reapp_top_blurb');
    $form['provision_reapplication_details']['reapp_top_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Reapplication Top Blurb'),
      '#description' => $this->t('The Reapplication Top Blurb for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => true,
    ];

    $content = $config->get('reapp_middle_blurb');
    $form['provision_reapplication_details']['reapp_middle_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Reapplication Middle Blurb'),
      '#description' => $this->t('The Reapplication Middle Blurb for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
    ];

    $form['gold_player_details'] = [
      '#type' => 'details',
      '#title' => t('Gold Player Settings'),
      '#group' => 'advanced',
    ];

    $content = $config->get('gold_player_top_blurb');
    $form['gold_player_details']['gold_player_top_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Already Gold Player Top Blurb'),
      '#description' => $this->t('The Already Gold Player Top Blurb for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => true,
    ];

    $content = $config->get('gold_player_middle_blurb');
    $form['gold_player_details']['gold_player_middle_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Already Gold Player Middle Blurb'),
      '#description' => $this->t('The Reapplication Middle Blurb for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
    ];

    $form['bottom_blurb_details'] = [
      '#type' => 'details',
      '#title' => t('Bottom Blurb Settings'),
      '#group' => 'advanced',
    ];

    $content = $config->get('bottom_blurb_content');
    $form['bottom_blurb_details']['bottom_blurb_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Bottom Blurb Content'),
      '#description' => $this->t('The Bottom Blurb Content for the Provisioning LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
    ];

    return parent::buildForm($form, $form_state);
  }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $autoLogoutValuesKeys = [
        'app_top_blurb',
        'app_middle_blurb',
        'reapp_top_blurb',
        'reapp_middle_blurb',
        'gold_player_top_blurb',
        'gold_player_middle_blurb',
        'bottom_blurb_content',
        ];
        foreach ($autoLogoutValuesKeys as $keys) {
            $this->config('casino_config.provisioning_config')->set($keys, $form_state->getValue($keys))->save();
        }
        parent::submitForm($form, $form_state);
    }

}

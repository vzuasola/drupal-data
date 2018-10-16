<?php
namespace Drupal\poker_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Poker client form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "poker_client",
 *   route = {
 *     "title" = "Client Configuration",
 *     "path" = "/admin/config/client/settings",
 *   },
 *   menu = {
 *     "title" = "Client Configuration",
 *     "description" = "Provides configuration for poker client.",
 *     "parent" = "poker_config.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class ClientConfigurationForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['poker_config.client'];
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state) {
        $form['common'] = [
          '#type' => 'details',
          '#title' => $this->t('Common'),
          '#collapsible' => true,
          '#open' => true
        ];

        $form['common']['info_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Game Info Label'),
          '#default_value' => $this->get('info_label'),
          '#translatable' => true,
          '#required' => true
        ];

        $form['common']['play_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Play Button Label'),
          '#default_value' => $this->get('play_label'),
          '#translatable' => true,
          '#required' => true
        ];

        return $form;
    }
}

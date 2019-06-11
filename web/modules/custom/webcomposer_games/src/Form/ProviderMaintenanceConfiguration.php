<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provider Maintenance Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "provider_maintenance_form",
 *   route = {
 *     "title" = "Provider Maintenance Configuration",
 *     "path" = "/admin/config/webcomposer/games/provider-maintenance",
 *   },
 *   menu = {
 *     "title" = "Provider Maintenance Configuration",
 *     "description" = "Provides configuration for Provider Maintenance",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 10
 *   },
 * )
 */
class ProviderMaintenanceConfiguration extends FormBase
{
    /**
     * @inheritdoc
     */
    /**
     * Unsupported Currency Configuration definitions
     */
    /**
     * Unsupported Currency Configuration definitions
     */
    protected function getEditableConfigNames()
    {
        return ['webcomposer_config.provider_maintenance'];
    }

    /**
     * @inheritdoc
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form['provider_maintenance_form'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Settings'),
        ];

        $this->generalConfig($form);
        return $form;
    }

    private function generalConfig(&$form)
    {

        $form['gen_config']['provider_maintenance_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Provider Maintenance Lightbox Title'),
            '#default_value' => $this->get('provider_maintenance_title'),
            '#required' => false,
            '#translatable' => TRUE,
        ];

        $form['gen_config']['provider_maintenance_message'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Provider Maintenance Lightbox Message'),
            '#default_value' => $this->get('provider_maintenance_message')['value'],
            '#required' => false,
            '#translatable' => TRUE,
        ];

        $form['gen_config']['provider_maintenance_button'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Provider Maintenance Lightbox Button Text'),
            '#description' => $this->t('Text inside the UCL button'),
            '#default_value' => $this->get('provider_maintenance_button'),
            '#required' => false,
            '#translatable' => TRUE,
        ];

        $form['gen_config']['provider_maitenance_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Game Provider Mapping for Provider Maintenance'),
            '#description' => $this->t('Game provider mapping. Pattern should be {game_provider_key}|{game provider name}'),
            '#default_value' => $this->get('provider_maitenance_mapping'),
            '#required' => false,
            '#translatable' => TRUE,
        ];
    }
}

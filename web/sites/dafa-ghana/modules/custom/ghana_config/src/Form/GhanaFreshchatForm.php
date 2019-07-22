<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Freshchat Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_freshchat_config_form",
 *   route = {
 *     "title" = "Ghana Freshchat Configuration",
 *     "path" = "/admin/config/ghana/ghana_freshchat_configuration",
 *   },
 *   menu = {
 *     "title" = "Freshchat Configuration",
 *     "description" = "Provides Freshchat configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 5
 *   },
 * )
 */

class GhanaFreshchatForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['ghana_config.freshchat_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => 'Ghana Freshchat Configuration',
        ];

        $this->sectionPageSetting($form);

        return $form;
    }

    private function sectionPageSetting(array &$form) {
        $form['ghana_freshchat_settings'] = [
            '#type' => 'details',
            '#title' => t('General Settings'),
            '#group' => 'advanced',
        ];

        $form['ghana_freshchat_settings']['token'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Freshchat Token'),
            '#default_value' => $this->get('token'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_settings']['enability'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Freshchat'),
            '#default_value' => $this->get('enability'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings'] = [
            '#type' => 'details',
            '#title' => t('FAQ Settings'),
            '#group' => 'advanced',
        ];

        $form['ghana_freshchat_faq_settings']['faq_show'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Hide FAQ'),
            '#default_value' => $this->get('faq_show'),
            '#translatable' => TRUE,
        ];

        $form['ghana_freshchat_faq_settings']['faq_show_on_open'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Show FAQ on chat open'),
            '#default_value' => $this->get('faq_show_on_open'),
            '#translatable' => TRUE,
        ];
    }

}
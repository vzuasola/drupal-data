<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_withdraw_method_form",
 *   route = {
 *     "title" = "Withdraw Method Page Configuration",
 *     "path" = "/admin/config/jamboree/withdraw_method_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Withdraw Method Page Configuration",
 *     "description" = "Provides withdraw method page configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeWithdrawMethodForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['jamboree_config.withdraw_method_page_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Withdraw Method Page Configuration'),
        ];

        $this->sectionPageSetting($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form) {
        $form['page_setting'] = [
            '#type' => 'details',
            '#title' => t('Withdraw Method Page Setting'),
            '#group' => 'advanced',
        ];

        $form['page_setting']['page_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $this->get('page_title'),
            '#translatable' => true,
        ];

        $form['page_setting']['page_summary'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Summary'),
            '#default_value' => $this->get('page_summary'),
            '#translatable' => true,
        ];

        $c = $this->get('page_banner');
        $form['page_setting']['page_banner'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Set Page Banner'),
            '#default_value' => $c['value'],
            '#format' => $c['format'],
            '#translatable' => true,
        ];

        $form['page_setting']['page_button_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Button Label'),
            '#default_value' => $this->get('page_button_label'),
            '#translatable' => true,
        ];

        $form['page_setting']['page_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('URL'),
            '#default_value' => $this->get('page_url'),
            '#translatable' => true,
        ];
    }
}

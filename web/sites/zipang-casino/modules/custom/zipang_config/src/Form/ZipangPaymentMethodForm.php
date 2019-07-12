<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_payment_method_form",
 *   route = {
 *     "title" = "Payment Method Page Configuration",
 *     "path" = "/admin/config/zipang/payment_method_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Payment Method Page Configuration",
 *     "description" = "Provides payment method page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangPaymentMethodForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['zipang_config.payment_method_page_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Payment Method Page Configuration'),
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
            '#title' => t('Payment Method Page Setting'),
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
            '#title' => $this->t('Button URL'),
            '#default_value' => $this->get('page_url'),
            '#translatable' => true,
        ];
    }
}

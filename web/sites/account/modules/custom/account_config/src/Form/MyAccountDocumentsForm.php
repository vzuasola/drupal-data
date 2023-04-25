<?php

namespace Drupal\account_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My AccountProfile Form configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "documents_form",
 *   route = {
 *     "title" = "Documents Form",
 *     "path" = "/admin/config/my-account/documents",
 *   },
 *   menu = {
 *     "title" = "Documents Form Configuration",
 *     "description" = "Documents Form Configuration",
 *     "parent" = "account_config.list",
 *   },
 * )
 */
class MyAccountDocumentsForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['my_account_config.documents_configuration'];
    }

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form['documents'] = [
            '#type' => 'vertical_tabs',
        ];

        $this->featureConfig($form);

        return $form;
    }

    private function featureConfig(&$form)
    {
        $form['feature_configuration'] = [
            '#type' => 'details',
            '#title' => 'Feature Configuration',
            '#open' => FALSE,
            '#group' => 'documents',
        ];

        $form['feature_configuration']['enabled'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable'),
            '#required' => FALSE,
            '#description' => $this->t('Check to enable the documents feature'),
            '#default_value' => $this->get('enabled'),
            '#translatable' => TRUE,
        ];

        $form['feature_configuration']['force_enable'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Force Enable'),
            '#required' => FALSE,
            '#description' => $this->t('Check to force showing of the documents feature even if the Status is not "Pending Upload"'),
            '#default_value' => $this->get('force_enable'),
            '#translatable' => TRUE,
        ];

        $form['feature_configuration']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tab Label'),
            '#required' => FALSE,
            '#description' => $this->t('The label to display on the tab'),
            '#default_value' => $this->get('label') ?? 'Documents',
            '#translatable' => TRUE,
        ];
    }
}

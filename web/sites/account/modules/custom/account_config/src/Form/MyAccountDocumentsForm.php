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
        $this->documentStorageConfig($form);

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
        $form['feature_configuration']['jira_project_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('JIRA Project ID'),
            '#required' => FALSE,
            '#description' => $this->t('Project to create related JIRA tickets. Find it here: https://asianlogic.atlassian.net/rest/api/latest/project/FRDOC'),
            '#default_value' => $this->get('jira_project_id') ?? '12409',
            '#translatable' => FALSE,
        ];
        $form['feature_configuration']['jira_issue_type_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('JIRA Issue Type ID'),
            '#required' => FALSE,
            '#description' => $this->t('What type of issue to create. Find it here: https://asianlogic.atlassian.net/rest/api/latest/project/FRDOC'),
            '#default_value' => $this->get('jira_issue_type_id') ?? '10900',
            '#translatable' => FALSE,
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

    private function documentStorageConfig(&$form)
    {
        $form['document_storage_configuration'] = [
            '#type' => 'details',
            '#title' => 'Document Storage Configuration',
            '#open' => FALSE,
            '#group' => 'documents',
        ];

        $form['document_storage_configuration']['folder_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Google Drive Folder ID'),
            '#required' => TRUE,
            '#description' => $this->t('Folder ID where documents will be stored'),
            '#default_value' => $this->get('folder_id'),
        ];

        $form['document_storage_configuration']['brand'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Brand Name'),
            '#required' => TRUE,
            '#description' => $this->t('Brand Name that will be concatenated to the file name'),
            '#default_value' => $this->get('brand'),
        ];
    }
}

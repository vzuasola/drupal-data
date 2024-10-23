<?php

namespace Drupal\msw_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * MSW Maya Configuration Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_maya_config_form",
 *   route = {
 *     "title" = "Maya Configuration",
 *     "path" = "/admin/config/msw/maya_configuration",
 *   },
 *   menu = {
 *     "title" = "Maya Configuration",
 *     "description" = "Provides Maya configuration",
 *     "parent" = "msw_config.list",
 *     "weight" = 31
 *   },
 * )
 */
class MSWMayaConfigurationForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['msw_config.maya_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state)
    {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => $this->t('MAYA Configurations'),
        ];

        $this->maintenanceSection($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function maintenanceSection(array &$form)
    {
        $form['maya_config'] = [
            '#type' => 'details',
            '#title' => $this->t('Maintenance Configurations'),
            '#group' => 'advanced',
        ];

       $form['maya_config']['enable_maintenance'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable system maintenance - (✓)enable | (✕)disable'),
        '#default_value' => $this->get('enable_maintenance'),
        '#translatable' => TRUE,
      ];

      $form['maya_config']['maintenance_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Maintenance page title'),
          '#required' => true,
          '#default_value' => $this->get('maintenance_title'),
          '#translatable' => true,
      ];

      $content = $this->get('maintenance_content');
      $form['maya_config']['maintenance_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Maintenance page Content'),
          '#default_value' => $content['value'],
          '#translatable' => TRUE,
      ];
    }
}

<?php

namespace Drupal\msw_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * MSW Pop-up Reminder Configuration Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_popup_reminder_config_form",
 *   route = {
 *     "title" = "Pop-up Reminder Configuration",
 *     "path" = "/admin/config/msw/popup_reminder",
 *   },
 *   menu = {
 *     "title" = "Pop-up Reminder Configuration",
 *     "description" = "Pop-up Reminder on pre login configuration",
 *     "parent" = "msw_config.list",
 *     "weight" = 32
 *   },
 * )
 */
class MSWPopupConfigurationForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['msw_config.popup_reminder'];
    }

    public function form(array $form, FormStateInterface $form_state)
    {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => $this->t('Pop-up Reminder Configuration'),
        ];

        $this->popupReminderConfig($form);
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function popupReminderConfig(array &$form) {
      $form['popup_reminder'] = [
          '#type' => 'details',
          '#title' => t('Pop-up Reminder'),
          '#group' => 'advanced',
      ];

      $form['popup_reminder']['popup_reminder_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Pop-up Reminder title'),
          '#required' => true,
          '#default_value' => $this->get('popup_reminder_title'),
          '#translatable' => true,
      ];

      $content = $this->get('popup_reminder_content');
      $form['popup_reminder']['popup_reminder_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Pop-up Reminder Content'),
          '#default_value' => $content['value'],
          '#translatable' => TRUE,
      ];
    }
}

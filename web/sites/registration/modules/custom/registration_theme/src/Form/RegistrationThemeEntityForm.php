<?php

namespace Drupal\registration_theme\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegistrationThemeEntityForm.
 */
class RegistrationThemeEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $registration_theme_entity = $this->entity;

    dpm($registration_theme_entity->getFontColor());

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $registration_theme_entity->label(),
      '#description' => $this->t("Label for the Registration Theme."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $registration_theme_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\registration_theme\Entity\RegistrationThemeEntity::load',
      ],
      '#disabled' => !$registration_theme_entity->isNew(),
    ];

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $form['font_group'] = array(
      '#type' => 'details',
      '#title' => t('Font'),
      '#group' => 'advanced',
    );

    $form['font_group']['font_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Font color'),
    ];

    $form['button_group'] = array(
      '#type' => 'details',
      '#title' => t('Button'),
      '#group' => 'advanced',
    );
    $form['button_group']['btn_bg_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Background color'),
    ];
    $form['button_group']['btn_hover_bg_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Hover background color'),
    ];
    $form['button_group']['btn_font_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Button font color'),
    ];
    $form['button_group']['btn_hover_font_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Hover button font color'),
    ];

    $form['background_group'] = array(
      '#type' => 'details',
      '#title' => t('Background'),
      '#group' => 'advanced',
    );
    $form['background_group']['bg_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background image'),
      // '#default_value' => $config->get('partners_logo'),
      '#upload_location' => 'public://',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    ];
    $form['background_group']['bg_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Background color'),
    ];

    $form['banner_group'] = array(
      '#type' => 'details',
      '#title' => t('Banner'),
      '#group' => 'advanced',
    );
    $form['banner_group']['banner_desktop_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Desktop'),
      '#upload_location' => 'public://',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    ];
    $form['banner_group']['banner_tablet_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Tablet'),
      '#upload_location' => 'public://',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    ];
    $form['banner_group']['banner_mobile_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Mobile'),
      '#upload_location' => 'public://',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    ];
    $form['banner_group']['banner_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('content'),
        '#format' => 'full_html',
    );


    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $registration_theme_entity = $this->entity;
    dpm($registration_theme_entity);
    $status = $registration_theme_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Registration Theme.', [
          '%label' => $registration_theme_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Registration Theme.', [
          '%label' => $registration_theme_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($registration_theme_entity->toUrl('collection'));
  }

}

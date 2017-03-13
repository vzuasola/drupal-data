<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LeftFloatingBanner extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
      return ['casino_config.left_floating_banner'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
      return 'left_floating_banner_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('casino_config.left_floating_banner');

    $form['left_floating_banner_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => $config->get('left_floating_banner_label'),
    );

    $form['left_floating_banner_default_download_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Default Download url'),
      '#default_value' => $config->get('left_floating_banner_default_download_url'),
      '#description' => $this->t('Please enter default download URL.'),
    );
    $form['left_floating_banner_text_direction'] = array(
      '#type' => 'select',
      '#title' => $this->t('label text direction'),
      '#default_value' => $config->get('left_floating_banner_text_direction'),
      '#options' => array(
        'facing_down_downward' => $this->t('Facing Down, Stacked Downward'),
        'facing_up_upward' => $this->t('Facing Up, Stacked Upward'),
        'facing_left_downward' => $this->t('Facing Left, Stacked Downward'),
      ),
    );
    $form['left_floating_banner_menu'] = array(
      '#type' => 'select',
      '#title' => $this->t('Select Menu'),
      '#default_value' => $config->get('left_floating_banner_menu'),
      '#options' => $this->getMenuOptions()
    );

    $form['left_floating_banner_visibility'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Page Visibility'),
      '#default_value' => $config->get('left_floating_banner_visibility'),
      '#description' => $this->t('Specify pages by using their paths separated by comma. (e.g. /node/1, /node/2)'),
    );

    $form['left_floating_banner_visibility_condition'] = array(
      '#type' => 'select',
      '#title' => $this->t(''),
      '#default_value' => $config->get('left_floating_banner_visibility_condition'),
      '#options' => array(
        'show' => $this->t('Show for the listed pages'),
        'hide' => $this->t('Hide for the listed pages'),
      )
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      $loginValuesKeys = array(
        'left_floating_banner_label',
        'left_floating_banner_default_download_url',
        'left_floating_banner_menu',
        'left_floating_banner_text_direction',
        'left_floating_banner_visibility',
        'left_floating_banner_visibility_condition'
      );
      foreach($loginValuesKeys as $keys){
        $this->config('casino_config.left_floating_banner')->set($keys, $form_state->getValue($keys))->save();
      }
      parent::submitForm($form, $form_state);
  }


  public function getMenuOptions(){
    $menus = \Drupal\system\Entity\Menu::loadMultiple();
    $options = array(
      '' => $this->t('-- Select Menu -- '),
    );
    foreach($menus as $key => $menu){
      $options[$key] = $menu->label();
    }
    return $options;
  }
}

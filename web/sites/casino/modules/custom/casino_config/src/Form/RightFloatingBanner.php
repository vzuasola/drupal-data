<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RightFloatingBanner extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
      return ['casino_config.right_floating_banner'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
      return 'right_floating_banner_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('casino_config.right_floating_banner');
    $form['right_floating_banner_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => $config->get('right_floating_banner_label'),
    );

    $form['right_floating_banner_text_direction'] = array(
      '#type' => 'select',
      '#title' => $this->t('Label text direction'),
      '#default_value' => $config->get('right_floating_banner_text_direction'),
      '#options' => array(
        'facing_down_downward' => $this->t('Facing Down, Stacked Downward'),
        'facing_up_upward' => $this->t('Facing Up, Stacked Upward'),
        'facing_left_downward' => $this->t('Facing Left, Stacked Downward'),
      ),
    );

    $form['right_floating_banner_menu'] = array(
      '#type' => 'select',
      '#title' => $this->t('Label Text Direction'),
      '#default_value' => $config->get('right_floating_banner_menu'),
      '#options' => $this->getMenuOptions()
    );



    $form['right_floating_banner_visibility'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Page Visibility'),
      '#default_value' => $config->get('right_floating_banner_visibility'),
      '#description' => $this->t('Specify pages by using their paths separated by comma. (e.g. /node/1, /node/2)'),
    );

    $form['right_floating_banner_visibility_condition'] = array(
      '#type' => 'select',
      '#title' => $this->t(''),
      '#default_value' => $config->get('right_floating_banner_visibility_condition'),
      '#options' => array(
        'show' => $this->t('Show for the listed pages'),
        'hide' => $this->t('Hide for the listed pages'),
      )
    );

    return parent::buildForm($form, $form_state);
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

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $loginValuesKeys = array(
      'right_floating_banner_label',
      'right_floating_banner_text_direction',
      'right_floating_banner_menu',
      'right_floating_banner_visibility',
      'right_floating_banner_visibility_condition',
      'right_floating_banner_visibility_condition'
    );
    foreach($loginValuesKeys as $keys){
      $this->config('casino_config.right_floating_banner')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }

}

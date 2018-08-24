<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_casino_config",
 *   route = {
 *     "title" = "Jamboree Casino Page Configuration",
 *     "path" = "/admin/config/jamboree/page_configuration",
 *   },
 *   menu = {
 *     "title" = "Jamboree Casino Page Configuration",
 *     "description" = "Provides Jamboree Casino page configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeCasinoConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Page Title Configuration'),
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
      '#title' => t('Page Title Configuration'),
      '#group' => 'advanced',
    ];

    $form['page_setting']['home'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home TPage itle'),
      '#default_value' => $this->get('home'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['sitemap'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sitemap Page Title'),
      '#default_value' => $this->get('sitemap'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['404'] = [
      '#type' => 'textfield',
      '#title' => $this->t('404 Page Title'),
      '#default_value' => $this->get('404'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['500'] = [
      '#type' => 'textfield',
      '#title' => $this->t('500 Page Title'),
      '#default_value' => $this->get('404'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['games'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Games Page Title'),
      '#default_value' => $this->get('games'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['registration'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Page Title'),
      '#default_value' => $this->get('registration'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['registration_step2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Step 2 Page Title'),
      '#default_value' => $this->get('registration'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['registration_step3'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Step 3 Page Title'),
      '#default_value' => $this->get('registration'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['contact_us'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Us Page Title'),
      '#default_value' => $this->get('contact_us'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['jackpot'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Jackpot Page Title'),
      '#default_value' => $this->get('jackpot'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['faq'] = [
      '#type' => 'textfield',
      '#title' => $this->t('FAQ Page Title'),
      '#default_value' => $this->get('jackpot'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['big_winner'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Big Winner Page Title'),
      '#default_value' => $this->get('big_winner'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['weekly_winner'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Weekly Winner Page Title'),
      '#default_value' => $this->get('weekly_winner'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['download'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download Page Title'),
      '#default_value' => $this->get('download'),
      '#translatable' => TRUE,
    ];
  }
}

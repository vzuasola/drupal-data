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
      '#title' => $this->t('Home Page Title'),
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
      '#default_value' => $this->get('500'),
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
      '#default_value' => $this->get('registration_step2'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['registration_step3'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Step 3 Page Title'),
      '#default_value' => $this->get('registration_step3'),
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
      '#default_value' => $this->get('faq'),
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

    $form['page_setting']['promotion'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Page Title'),
      '#default_value' => $this->get('promotion'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['release'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Release Page Title'),
      '#default_value' => $this->get('release'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['fair_gaming'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fair Gaming Page Title'),
      '#default_value' => $this->get('fair_gaming'),
      '#translatable' => TRUE,
    ];
    
    $form['page_setting']['withdraw_method_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Withdraw Method Page Title'),
      '#default_value' => $this->get('withdraw_method_title'),
      '#translatable' => true,
    ];
    
    $form['page_setting']['payment_method_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Payment Method Page Title'),
      '#default_value' => $this->get('payment_method_title'),
      '#translatable' => true,
    ];

    $form['inner_breadcrumb'] = [
      '#type' => 'details',
      '#title' => t('InnerPage Breadcrumb'),
      '#group' => 'advanced',
    ];

    $form['inner_breadcrumb']['home_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home'),
      '#default_value' => $this->get('home_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['how_to_start_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How to Start'),
      '#default_value' => $this->get('how_to_start_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['payment_options_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Payment Options'),
      '#default_value' => $this->get('payment_options_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['big_winner_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Big Winner'),
      '#default_value' => $this->get('big_winner_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['weekly_winner_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Weekly Winner'),
      '#default_value' => $this->get('weekly_winner_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['faq_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Faq'),
      '#default_value' => $this->get('faq_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['jackpot_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Jackpot'),
      '#default_value' => $this->get('jackpot_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['contact_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact'),
      '#default_value' => $this->get('contact_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['sitemap_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sitemap'),
      '#default_value' => $this->get('sitemap_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['reg_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration'),
      '#default_value' => $this->get('reg_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['games_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Games'),
      '#default_value' => $this->get('games_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['promotion_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion'),
      '#default_value' => $this->get('promotion_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['release_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Release'),
      '#default_value' => $this->get('release_breadcrumb'),
      '#translatable' => TRUE,
    ];

    $form['inner_breadcrumb']['fair_gaming_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fair Gaming'),
      '#default_value' => $this->get('fair_gaming_breadcrumb'),
      '#translatable' => TRUE,
    ];
    
    $form['inner_breadcrumb']['withdraw_method_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Withdraw Method'),
      '#default_value' => $this->get('withdraw_method_breadcrumb'),
      '#translatable' => true,
    ];
    
    $form['inner_breadcrumb']['payment_method_breadcrumb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Payment Method'),
      '#default_value' => $this->get('payment_method_breadcrumb'),
      '#translatable' => true,
    ];
  }
}

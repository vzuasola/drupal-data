<?php

namespace Drupal\my_account_core\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Bonus History configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "bonus_history",
 *   route = {
 *     "title" = "Bonus History Configuration",
 *     "path" = "/admin/config/my_account/bonus-history",
 *   },
 *   menu = {
 *     "title" = "Bonus History",
 *     "description" = "Bonus history configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class BonusHistoryForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_core.bonus_history'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['my_account_group'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->bonusHistoryConfig($form);
    $this->bonusHistoryPagination($form);

    return $form;
  }

  /**
   * Bonus history form configuration.
   */
  private function bonusHistoryConfig(array &$form) {
    $form['bonus_history_group'] = [
      '#type' => 'details',
      '#title' => 'Bonus History',
      '#group' => 'my_account_group',
    ];

    $form['bonus_history_group']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('page_title') ?: 'Active Bonuses',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['bonus_history_group']['datetime_format'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date and Time Format'),
      '#default_value' => $this->get('datetime_format') ?: 'd/m/Y H:i',
      '#description' => $this->t('A user-defined date format. See the <a href="http://php.net/manual/function.date.php">PHP manual</a> for available options.'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['bonus_history_group']['zero_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Zero Display'),
      '#default_value' => $this->get('zero_display') ?: 'N/A',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['bonus_history_group']['no_result'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No Result Message'),
      '#default_value' => $this->get('no_result') ?: 'No Active bonus under this product',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['bonus_history_group']['service_unavailable'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Service not available'),
      '#default_value' => $this->get('service_unavailable') ?: 'N/A',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['bonus_history_group']['sportsbook_expirydate_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sportsbook expiry date display'),
      '#default_value' => $this->get('sportsbook_expirydate_display') ?: 'N/A',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Bonus history pagination configuration form.
   */
  private function bonusHistoryPagination(array &$form) {
    $form['pagination_group'] = [
      '#type' => 'details',
      '#title' => 'Pagination',
      '#group' => 'my_account_group',
    ];

    $form['pagination_group']['items_to_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Items to display'),
      '#description' => $this->t('Items to display per page.'),
      '#default_value' => $this->get('items_to_display') ?: '5',
      '#required' => TRUE,
    ];

    $form['pagination_group']['next_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Label'),
      '#default_value' => $this->get('next_label') ?: 'Next',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['pagination_group']['prev_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Previous Label'),
      '#default_value' => $this->get('prev_label') ?: 'Prev',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

}

<?php

/**
 * @file
 * Contains Drupal\my_account_core\Form\BonusHistoryForm.
 */
namespace Drupal\my_account_core\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class BonusHistoryForm extends ConfigFormBase
{
  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId()
  {
    return 'bonus_histroy_form_config';
  }

  /**
   *
   * @inheritdoc
   */
  protected function getEditableConfigNames()
  {
    return ['my_account_core.bonus_history'];
  }

  /**
   * {@inheritdoc}
   *
   * @param array              $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('my_account_core.bonus_history');

    $form['my_account_group'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['bonus_history_group'] = [
      '#type' => 'details',
      '#title' => 'Bonus History',
      '#group' => 'my_account_group'
    ];

    $form['bonus_history_group']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $config->get('page_title') ?? 'Active Bonuses',
      '#required' => true,
    ];

    $form['bonus_history_group']['datetime_format'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date and Time Format'),
      '#default_value' => $config->get('datetime_format') ?? 'd/m/Y H:i',
      '#description' => $this->t('A user-defined date format. See the <a href="http://php.net/manual/function.date.php">PHP manual</a> for available options.'),
      '#required' => true,
    ];

    $form['bonus_history_group']['zero_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Zero Display'),
      '#default_value' => $config->get('zero_display') ?? 'N/A',
      '#required' => true,
    ];

    $form['bonus_history_group']['no_result'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No Result Message'),
      '#default_value' => $config->get('no_result') ?? 'No Active bonus under this product',
      '#required' => true,
    ];

    $form['bonus_history_group']['service_unavailable'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Service not available'),
      '#default_value' => $config->get('service_unavailable') ?? 'N/A',
      '#required' => true,
    ];

    $form['bonus_history_group']['sportsbook_expirydate_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sportsbook expiry date display'),
      '#default_value' => $config->get('sportsbook_expirydate_display') ?? 'N/A',
      '#required' => true,
    ];

    $form['pagination_group'] = [
      '#type' => 'details',
      '#title' => 'Pagination',
      '#group' => 'my_account_group'
    ];

    $form['pagination_group']['items_to_display'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Items to display'),
      '#description' => $this->t('Items to display per page.'),
      '#default_value' => $config->get('items_to_display') ?? '5',
      '#required' => true,
    ];

    $form['pagination_group']['next_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Label'),
      '#default_value' => $config->get('next_label') ?? 'Next',
      '#required' => true,
    ];

    $form['pagination_group']['prev_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Previous Label'),
      '#default_value' => $config->get('prev_label') ?? 'Prev',
      '#required' => true,
    ];
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   *
   * @param array              $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) 
  {
    parent::validateForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   *
   * @param array              $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $keys = [
      'page_title',
      'datetime_format',
      'no_result',
      'service_unavailable',
      'zero_display',
      'items_to_display',
      'next_label',
      'prev_label',
      'sportsbook_expirydate_display',
    ];
    foreach ($keys as $key) {
        $this->config('my_account_core.bonus_history')
            ->set($key, $form_state->getValue($key))
            ->save();
    }
    parent::submitForm($form, $form_state);
  }
}

<?php
namespace Drupal\games_category\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * How to Play form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "games_category_config",
 *   route = {
 *     "title" = "Category Provider Configuration Form",
 *     "path" = "/admin/config/games/category-provider-config",
 *   },
 *   menu = {
 *     "title" = "Category Provider Configuration",
 *     "description" = "Provides configuration for Games Category Provider",
 *     "parent" = "games_category.list",
 *     "weight" = -5
 *   },
 * )
 */
class GamesCategoryConfigurationForm extends FormBase {
  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['games_config.games_category_configuration'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['category_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->generalConfig($form);

    return $form;
  }

  private function generalConfig(&$form) {
    $form['category_alignment'] = array(
      '#type' => 'details',
      '#title' => $this->t('Category Provider Alignment'),
      '#collapsible' => TRUE,
      '#group' => 'category_tab'
    );

    $form['category_alignment']['row_one'] = array(
      '#type' => 'select',
      '#title' => $this->t('First Row'),
      '#description' => $this->t('This will be the alignment'),
      '#options' => [
        'row-left' => $this->t('Left'),
        'row-center' => $this->t('Center'),
        'row-right' => $this->t('Right'),
      ],
      '#default_value' => $this->get('row_one'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    );

    $form['category_alignment']['row_two'] = array(
      '#type' => 'select',
      '#title' => $this->t('Second Row'),
      '#description' => $this->t('This will appear in browser page tab title'),
      '#options' => [
        'row-left' => $this->t('Left'),
        'row-center' => $this->t('Center'),
        'row-right' => $this->t('Right'),
      ],
      '#default_value' => $this->get('row_two'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    );
  }
}

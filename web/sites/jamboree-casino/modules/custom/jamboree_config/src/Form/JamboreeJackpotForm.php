<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_config",
 *   route = {
 *     "title" = "Jackpot Configuration",
 *     "path" = "/admin/config/jamboree/jackpot_configuration",
 *   },
 *   menu = {
 *     "title" = "Jackpot Configuration",
 *     "description" = "Provides Jackpot configuration",
 *     "parent" = "jamboree_config.jamboree_jackpot",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeJackpotForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.jackpot_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['jamboree_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionJackpot($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  }

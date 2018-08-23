<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_jackpot",
 *   route = {
 *     "title" = "Jackpot Configuration",
 *     "path" = "/admin/config/jamboree/jackpot_configuration",
 *   },
 *   menu = {
 *     "title" = "Jackpot Configuration",
 *     "description" = "Provides Jackpot configuration",
 *     "parent" = "jamboree_config.jamboree_config",
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
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jackpot Configuration'),
    ];

    $this->sectionJackpot($form);

    return $form;
  }

  private function sectionJackpot(array &$form) {

    $form['casino_hits_benchmark'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Hits Benchmark'),
      '#group' => 'advanced',
    ];

    $form['casino_hits_benchmark']['casino_hits_benchmark_content'] = [
      '#type' => 'textfield',
      '#title' => t('Casino Hits Benchmark'),
      '#default_value' => $this->get('casino_hits_benchmark_content'),
      '#description' => $this->t('NOTE: Casino hits benchmark. For example : 5740000.00 .'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['jackpot_xml_url'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot XML URL'),
      '#group' => 'advanced',
    ];

    $form['jackpot_xml_url']['jackpot_xml_url_value'] = [
      '#type' => 'textfield',
      '#title' => t('XML URL'),
      '#default_value' => $this->get('jackpot_xml_url_value'),
      '#description' => $this->t('NOTE: XML for JA and EN languages.'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['jackpot_ticker_redirect_url'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot ticker redirect url'),
      '#group' => 'advanced',
    ];

    $form['jackpot_ticker_redirect_url']['jackpot_ticker_redirect_url_value'] = [
      '#type' => 'textfield',
      '#title' => t('Jackpot ticker redirect url'),
      '#default_value' => $this->get('jackpot_ticker_redirect_url_value'),
      '#description' => $this->t('NOTE: Jackpot ticker redirect url for JA and EN languages. For example - "/jackpot"'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['jackpot_graph_text'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Graph Text Config'),
      '#group' => 'advanced',
    ];

    $form['jackpot_graph_text']['jackpot_graph_main_title_value'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the main title for casino graph page.'),
      '#default_value' => $this->get('jackpot_graph_main_title_value'),
      '#translatable' => TRUE,
    ];

    $form['jackpot_graph_text']['jackpot_amount_title_value'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the title for recent jackpot amount on graph).'),
      '#default_value' => $this->get('jackpot_amount_title_value'),
      '#translatable' => TRUE,
    ];

    $form['jackpot_graph_text']['jackpot_last_update'] = [
      '#type' => 'textfield',
      '#title' => t('Enter Last Updated).'),
      '#default_value' => $this->get('jackpot_last_update'),
      '#translatable' => TRUE,
    ];

    $form['jackpot_graph_text']['jackpot_latest_hits_title_value'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the title for jackpot hits on graph.'),
      '#default_value' => $this->get('jackpot_latest_hits_title_value'),
      '#translatable' => TRUE,
    ];

    $form['jackpot_lobby_custom_block'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot Lobby Page Custom Block'),
      '#group' => 'advanced',
    ];

    $form['jackpot_lobby_custom_block']['jackpot_custom_block_title'] = [
      '#type' => 'textfield',
      '#title' => t('Enter Title for Jackpot Lobby Custom Block).'),
      '#default_value' => $this->get('jackpot_custom_block_title'),
      '#translatable' => TRUE,
    ];

    $default_jackpot_content = $this->get('jackpot_custom_block_content');
    $form['jackpot_lobby_custom_block']['jackpot_custom_block_content'] = [
      '#type' => 'text_format',
      '#title' => t('Enter Content for Jackpot Lobby Custom Block).'),
      '#default_value' => $default_jackpot_content['value'],
      '#format' => $default_jackpot_content['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  }

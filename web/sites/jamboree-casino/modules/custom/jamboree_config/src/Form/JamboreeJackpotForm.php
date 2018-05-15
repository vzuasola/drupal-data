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
    $form['jamboree_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionJackpot($form);

    return $form;
  }

  private function sectionJackpot(array &$form) {

    $form['casino_hits_benchmark'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Hits Benchmark'),
    ];

    $default_casino_hits_benchmark = $this->get('casino_hits_benchmark_value');
    $form['casino_hits_benchmark']['casino_hits_benchmark_content'] = [
      '#type' => 'textfield',
      '#title' => t('Casino Hits Benchmark'),
      '#default_value' => $default_casino_hits_benchmark['value'],
      '#description' => $this->t('NOTE: Casino hits benchmark. For example : 5740000.00 .'),
      '#format' => $default_casino_hits_benchmark['format'],
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['jackpot_xml_url'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot XML URL'),
    ];
    $default_jackpot_xml_url = $this->get('jackpot_xml_url_value');
    $form['jackpot_xml_url']['jackpot_xml_url_value'] = [
      '#type' => 'textfield',
      '#title' => t('XML URL'),
      '#default_value' => $default_jackpot_xml_url['value'],
      '#description' => $this->t('NOTE: XML for JA and EN languages. For example - http://tickers.playtech.com/jackpots/new_jackpotxml.php?info=2&casino=zipang¤cy=usd '),
      '#format' => $default_jackpot_xml_url['format'],
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['jackpot_ticker_redirect_url'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot ticker redirect url'),
    ];
    $default_jackpot_ticker_redirect_url = $this->get('jackpot_ticker_redirect_url_value');
    $form['jackpot_ticker_redirect_url']['jackpot_ticker_redirect_url_value'] = [
      '#type' => 'textfield',
      '#title' => t('Jackpot ticker redirect url'),
      '#default_value' => $default_jackpot_ticker_redirect_url['value'],
      '#description' => $this->t('NOTE: Jackpot ticker redirect url for JA and EN languages. For example - "/jackpot" (Path of jackpot listing page)  '),
      '#format' => $default_jackpot_ticker_redirect_url['format'],
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['jackpot_graph_main_title'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Graph Main Title'),
    ];
    $default_jackpot_graph_main_title = $this->get('jackpot_graph_main_title_value');
    $form['jackpot_graph_main_title']['jackpot_graph_main_title_value'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the main title for casino graph page.'),
      '#default_value' => $default_jackpot_graph_main_title['value'],
      '#format' => $default_jackpot_graph_main_title['format'],
      '#translatable' => TRUE,
    ];

    $form['jackpot_amount_title'] = [
      '#type' => 'details',
      '#title' => $this->t('Recent Jackpot Amount Title'),
    ];
    $default_jackpot_amount_title = $this->get('jackpot_amount_title_value');
    $form['jackpot_amount_title']['jackpot_amount_title_value'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the title for recent jackpot amount on graph).'),
      '#default_value' => $default_jackpot_amount_title['value'],
      '#format' => $default_jackpot_amount_title['format'],
      '#translatable' => TRUE,
    ];

    $form['jackpot_latest_hits_title'] = [
      '#type' => 'details',
      '#title' => $this->t('Latest Hits Title'),
    ];
    $default_jackpot_latest_hits_title = $this->get('jackpot_latest_hits_title_value');
    $form['jackpot_latest_hits_title']['jackpot_latest_hits_title_value'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the title for jackpot hits on graph.'),
      '#default_value' => $default_jackpot_latest_hits_title['value'],
      '#format' => $default_jackpot_latest_hits_title['format'],
      '#translatable' => TRUE,
    ];

  }

  /**
   * {@inheritdoc}
   */
  }

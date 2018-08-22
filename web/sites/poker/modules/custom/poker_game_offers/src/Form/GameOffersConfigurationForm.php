<?php
namespace Drupal\poker_game_offers\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "poker_game_offers",
 *   route = {
 *     "title" = "Game Offers Configuration",
 *     "path" = "/admin/game-offers/config",
 *   },
 *   menu = {
 *     "title" = "Game Offers Configuration",
 *     "description" = "Provides configuration for game offers page.",
 *     "parent" = "poker_game_offers.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class GameOffersConfigurationForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['poker_config.game_offers'];
    }

    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => true,
      '#required' => true
    ];

        $this->casinoGames($form);
        $this->pokerGames($form);
        $this->common($form);

        return $form;
    }

    private function casinoGames(&$form)
    {
        $form['casino'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Game Offers'),
      '#collapsible' => true,
      '#open' => true,
    ];

        $form['casino']['casino_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Casino Tab Label'),
      '#default_value' => $this->get('casino_label'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['casino']['file_image_casino_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Default Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_casino_icon'),
      '#required' => true,
    ];

        $form['casino']['file_image_casino_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Hover/Active Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_casino_icon_hover'),
      '#required' => true,
    ];
    }

    private function pokerGames(&$form)
    {
        $form['poker'] = [
      '#type' => 'details',
      '#title' => $this->t('Poker Game Offers'),
      '#collapsible' => true,
      '#open' => true,
    ];

        $form['poker']['poker_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Poker Tab Label'),
      '#default_value' => $this->get('poker_label'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['poker']['file_image_poker_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Default Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_poker_icon'),
      '#required' => true,
    ];

        $form['poker']['file_image_poker_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Hover/Active Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_poker_icon_hover'),
      '#required' => true,
    ];
    }

    private function common(&$form)
    {
        $form['common'] = [
      '#type' => 'details',
      '#title' => $this->t('Common'),
      '#collapsible' => true,
      '#open' => true,
    ];

        $form['common']['download_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download Button Label'),
      '#default_value' => $this->get('download_label'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['common']['download_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download Button Link'),
      '#default_value' => $this->get('download_link'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['common']['play_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Button Label'),
      '#default_value' => $this->get('play_label'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['common']['info_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Label'),
      '#default_value' => $this->get('info_label'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['common']['promo_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promo Button Link'),
      '#default_value' => $this->get('promo_link'),
      '#translatable' => true,
      '#required' => true
    ];

        $form['common']['promo_link_target'] = [
      '#type' => 'select',
      '#title' => $this->t('Promo Button Link Target'),
      '#default_value' => $this->get('promo_link_target'),
      '#translatable' => true,
      '#required' => true,
      '#options' => [
        '_blank' => 'New Tab',
        '_self' => 'Same Window',
        'window' => 'New Window'
      ]
    ];
    }
}

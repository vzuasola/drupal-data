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

        $form['game_offers_settings_tab'] = [
          '#type' => 'vertical_tabs',
          '#title' => t('Game Offers Configuration'),
        ];

        $this->common($form);
        $this->casinoGames($form);
        $this->pokerGames($form);

        return $form;
    }

    private function casinoGames(&$form)
    {
        $form['casino'] = [
          '#type' => 'details',
          '#title' => $this->t('Game Offers - Casino'),
          '#collapsible' => true,
          '#open' => true,
          '#group' => 'game_offers_settings_tab',
        ];

        $form['casino']['tab'] = [
          '#type' => 'details',
          '#title' => $this->t('Tab Settings'),
          '#collapsible' => true,
          '#open' => true,
          '#group' => 'casino',
        ];

        $form['casino']['tab']['casino_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Casino Tab Label'),
          '#default_value' => $this->get('casino_label'),
          '#translatable' => true,
          '#required' => true
        ];

        $form['casino']['tab']['file_image_casino_icon'] = [
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

        $form['casino']['tab']['file_image_casino_icon_hover'] = [
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

        $form['casino']['thumb'] = [
          '#type' => 'details',
          '#title' => $this->t('Thumbnail Settings'),
          '#collapsible' => true,
          '#open' => true,
          '#group' => 'casino',
        ];

        $form['casino']['thumb']['play_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Play Button Label'),
          '#default_value' => $this->get('play_label'),
          '#translatable' => true,
          '#required' => true
        ];

        $form['casino']['launch'] = [
          '#type' => 'details',
          '#title' => $this->t('Game Launch Settings'),
          '#collapsible' => true,
          '#open' => true,
          '#group' => 'casino',
        ];

        $form['casino']['launch']['promo_link'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Promo Button Link'),
          '#default_value' => $this->get('promo_link'),
          '#translatable' => true,
          '#required' => true
        ];

        $form['casino']['launch']['promo_link_target'] = [
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

        $html5LightboxGroupTitle = $this->t('HTML5 Alert (Lightbox)');
        $form['casino']['launch']['html5_lightbox'] = array(
            '#type' => 'fieldset',
            '#title' => $html5LightboxGroupTitle,
            '#description' => '<p>This lightbox will appear if player access an html5 game '
                            . 'on a browser that do not support html5.</p>'
        );

        $form['casino']['launch']['html5_lightbox']['html5_lightbox_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
          '#default_value' => $this->get('html5_lightbox_title'),
          '#required' => TRUE,
          '#translatable' => true,
        ];

        $html5LightboxContent = $this->get('html5_lightbox_content');
        $form['casino']['launch']['html5_lightbox']['html5_lightbox_content'] = array(
          '#type' => 'text_format',
          '#title' => $this->t('Content'),
          '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
          '#default_value' => $html5LightboxContent['value'],
          '#format' => $html5LightboxContent['format'],
          '#required' => TRUE,
          '#translatable' => true,
        );
    }

    private function pokerGames(&$form)
    {
        $form['poker'] = [
          '#type' => 'details',
          '#title' => $this->t('Game Offers - Poker'),
          '#collapsible' => true,
          '#open' => true,
          '#group' => 'game_offers_settings_tab',
        ];

        $form['poker']['tab'] = [
          '#type' => 'details',
          '#title' => $this->t('Tab Settings'),
          '#collapsible' => true,
          '#open' => true,
          '#group' => 'poker',
        ];

        $form['poker']['tab']['poker_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Poker Tab Label'),
          '#default_value' => $this->get('poker_label'),
          '#translatable' => true,
          '#required' => true
        ];

        $form['poker']['tab']['file_image_poker_icon'] = [
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

        $form['poker']['tab']['file_image_poker_icon_hover'] = [
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
          '#group' => 'game_offers_settings_tab',
        ];

        $form['common']['info_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Game Info Label'),
          '#default_value' => $this->get('info_label'),
          '#translatable' => true,
          '#required' => true
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
    }
}

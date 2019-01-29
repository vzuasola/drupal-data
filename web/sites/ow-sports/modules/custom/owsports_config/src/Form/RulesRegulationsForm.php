<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "rules_regulations",
 *   route = {
 *     "title" = "Rules and Regulations",
 *     "path" = "/admin/config/owsports/rules-regulations",
 *   },
 *   menu = {
 *     "title" = "Rules and Regulations",
 *     "description" = "Provides Rules and Regulations configuration",
 *     "parent" = "owsports_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class RulesRegulationsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['owsports_config.rules_regulations'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['rules_regulations'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Rules and Regulations Configuration'),
    ];

    $form['rules_regulations'] = [
      '#type' => 'details',
      '#title' => t('Rules and Regulations'),
      '#group' => 'advanced',
    ];

    $form['rules_regulations']['file_image_rules_page_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background Image'),
      '#default_value' => $this->get('file_image_rules_page_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
      '#description' => $this->t('Recommended minimum width is 1920px and'.
        ' height is 800px'),
    ];

    $form['rules_regulations']['rules_page_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Background Color'),
      '#default_value' => $this->get('rules_page_color'),
    ];

    $pageListSortUrl = Url::fromUri('internal:/admin/structure/sort-rules-list',
     []);
    $pageListSortLink = Link::fromTextAndUrl(t('this link'), $pageListSortUrl);

    $form['rules_regulations']['rules_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('rules_page_title'),
      '#translatable' => TRUE,
      '#description' => $this->t('For sorting Rules and Regulations Page List'.
       ' go to '. $pageListSortLink->toString() . '.'),
    ];

    return $form;
  }
}

<?php

namespace Drupal\mobile_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "promotion_form",
 *   route = {
 *     "title" = "Promotion Configuration",
 *     "path" = "/admin/config/promotion/promotion_configuration",
 *   },
 *   menu = {
 *     "title" = "Promotion Configuration",
 *     "description" = "Provides promotion configuration",
 *     "parent" = "mobile_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class PromotionForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['mobile_config.promotion_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Promotion Configuration'),
        ];

        $this->sectionPageSetting($form);
        $this->sectionMayaSetting($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form) {

        // Title
        $form['page_title'] = [
            '#type' => 'details',
            '#title' => t('Mobile Promotion'),
            '#group' => 'advanced',
        ];

        $form['page_title']['promotion_page_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Promotion Page Title.'),
            '#description' => $this->t('Promotion Page Title.'),
            '#default_value' => $this->get('promotion_page_title'),
            '#required' => TRUE,
            '#translatable' => TRUE,
        ];

    }


    /**
     * {@inheritdoc}
     */
    private function sectionMayaSetting(array &$form) {

        // Title
        $form['maya_config'] = [
            '#type' => 'details',
            '#title' => t('Maya Promotion'),
            '#group' => 'advanced',
        ];

        $form['maya_config']['maya_promotion_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Promotion Page Title.'),
            '#description' => $this->t('Promotion Page Title.'),
            '#default_value' => $this->get('maya_promotion_title'),
            '#required' => TRUE,
            '#translatable' => TRUE,
        ];
    }

}

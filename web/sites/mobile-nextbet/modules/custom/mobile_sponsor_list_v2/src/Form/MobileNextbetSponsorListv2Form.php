<?php

namespace Drupal\mobile_sponsor_list_v2\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_sponsor_list_v2",
 *   route = {
 *     "title" = "Mobile Nextbet Description",
 *     "path" = "/admin/structure/mobile_sponsor_list_v2/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Nextbet Description",
 *     "description" = "Provides Description for Nextbet",
 *     "parent" = "mobile_sponsor_list_v2.list",
 *   },
 * )
 */
class MobileNextbetSponsorListv2Form extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_sponsor_list_v2.mobile_sponsor_list_v2_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $this->sectionNextbetConfigs($form);

    return $form;
  }

  private function sectionNextbetConfigs(array &$form) {
    $form['mobile_sponsor_list_v2_configuration']['about_nextbet'] = [
      '#type' => 'text_format',
      '#title' => $this->t('About Nextbet'),
      '#default_value' => $this->get('about_nextbet')['value'],
      '#required' => false,
      '#translatable' => TRUE,
    ];
  }
}

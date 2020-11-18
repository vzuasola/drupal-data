<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_restriction",
 *   route = {
 *     "title" = "Restriction Configuration",
 *     "path" = "/admin/config/jamboree/restriction_config",
 *   },
 *   menu = {
 *     "title" = "Restriction Configuration",
 *     "description" = "Provides Restriction configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeRestrictionConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.restriction_config'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Restriction Configuration'),
    ];

    $this->sectionAccessRestriction($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */

  private function sectionAccessRestriction(array &$form) {
    $form['access_restriction'] = [
      '#type' => 'details',
      '#title' => t('Access Resctriction'),
      '#group' => 'advanced',
    ];

    $this->get('enable_restriction');
    $form['access_restriction']['enable_restriction'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('<b>Enable Access Restriction</b>'),
      '#default_value' => $this->get('enable_restriction'),
      '#translatable' => FALSE,
    ];

    $form['access_restriction']['enable_noindex'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('<b>Enable No Indexing Header on limited restriction domains</b>'),
      '#default_value' => $this->get('enable_noindex'),
      '#translatable' => FALSE,
    ];

    $form['access_restriction']['official_domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Official Domain'),
      '#default_value' => $this->get('official_domain') ?? "www.casinojamboree.com",
      '#description' => $this->t('Official domain used, restricted domains will be redirected here.'),
      '#translatable' => FALSE,
      '#required' => TRUE,
    ];

    $domain_limited_restriction = $this->get('domain_limited_restriction');
    $form['access_restriction']['domain_limited_restriction'] = [
      '#type' => 'textarea',
      '#title' => t('Domains with Limited Restriction'),
      '#description' => $this->t('All domains listed here will have restriction to access. 
                                    <br> Only non-marketed domains must be listed, still need ip address to allow access. 
                                    Official website will not be able to restrict here.'),
      '#default_value' => $domain_limited_restriction,
      '#translatable' => FALSE,
      '#required' => TRUE,
    ];

    $ip_whitelist = $this->get('ip_whitelist');
    $form['access_restriction']['ip_whitelist'] = [
      '#type' => 'textarea',
      '#title' => t('Allowed IP whitelist for limited restrcition domains'),
      '#description' => $this->t('All ip addresses whitelisted here will be allowed to access the non-marketed domain.
                                <br>Others will only redirected to the official product website.'),
      '#default_value' => $ip_whitelist,
      '#translatable' => FALSE,
      '#required' => TRUE,
    ];
  }
}
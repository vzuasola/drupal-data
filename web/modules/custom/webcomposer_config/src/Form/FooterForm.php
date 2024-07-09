<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Footer configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_footer",
 *   route = {
 *     "title" = "Footer Configuration",
 *     "path" = "/admin/config/webcomposer/config/footer",
 *   },
 *   menu = {
 *     "title" = "Footer Configuration",
 *     "description" = "Provides configuration for footer components",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class FooterForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.footer_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $this->sectionAbout($form);
    $this->sectionQuicklinks($form);
    $this->sectionSocials($form);
    $this->sectionBackToTop($form);
    $this->sectionResponsive($form);
    $this->sectionCookieNotification($form);
    $this->sectionAmbassador($form);
    $this->sectionCopyright($form);
    $this->footerVersionCheck($form);

    return $form;
  }

  /**
   *
   */
  private function sectionAbout(array &$form) {
    $form['about_dafabet_details'] = [
      '#type' => 'details',
      '#title' => t('About Dafabet'),
      '#group' => 'advanced',
    ];

    $form['about_dafabet_details']['about_dafabet_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('about_dafabet_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $d = $this->get('about_dafabet_content');

    $form['about_dafabet_details']['about_dafabet_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionQuicklinks(array &$form) {
    $form['quicklinks_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Quicklinks'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['quicklinks_group']['quicklinks_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Quicklink Title'),
      '#description' => $this->t('Text to be displayed in quicklink title.'),
      '#default_value' => $this->get('quicklinks_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionSocials(array &$form) {
    $form['social_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Social Media'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['social_group']['social_media_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Social Media Title'),
      '#description' => $this->t('Text to be displayed above the Social Media Links.'),
      '#default_value' => $this->get('social_media_title'),
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionBackToTop(array &$form) {
    $form['back_to_top'] = [
      '#type' => 'details',
      '#title' => $this->t('Back To Top'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['back_to_top']['back_to_top_title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Exclude These Pages'),
      '#description' => $this->t('Exclude Back To Top Button From These Pages.'),
      '#default_value' => $this->get('back_to_top_title'),
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionResponsive(array &$form) {
    $form['responsive_footer'] = [
      '#type' => 'details',
      '#title' => $this->t('Responsive'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['responsive_footer']['sponsor_mobile_desc'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sponsor Mobile Description'),
      '#description' => $this->t('Text to be displayed in mobile devices below the sponsor logos.'),
      '#default_value' => $this->get('sponsor_mobile_desc') ?? 'Official Main Club Sponsors',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Cookie Notification Config
   */
  private function sectionCookieNotification(array &$form) {
    $form['cookie_notification_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Cookie Notification'),
      '#collapsible' => true,
      '#group' => 'advanced',
    ];

    $form['cookie_notification_group']['country_codes'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country Code'),
      '#description' => $this->t('Enter multiple country code separated by comma.'),
      '#default_value' => $this->get('country_codes'),
    ];

    $defaultValue = $this->get('cookie_notification');
    $form['cookie_notification_group']['cookie_notification'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Notification Message'),
      '#default_value' => $defaultValue['value'],
      '#format' => $defaultValue['format'],
      '#translatable' => true,
    ];
  }

  /**
   * Brand Ambassadors Config
   */
  private function sectionAmbassador(array &$form) {
    $form['brand_ambassador_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Brand Ambassador'),
      '#collapsible' => true,
      '#group' => 'advanced',
    ];

    $form['brand_ambassador_group']['ambassador_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Enter Title of Brand Ambassador Section'),
      '#default_value' => $this->get('ambassador_title'),
      '#translatable' => true,
    ];

    $enabledV2 = $this->get('enable_new_style') ? true : false;
    $form['brand_ambassador_group']['file_image_ambassador_image'] = [
      '#name' => 'file_image_ambassador_image',
      '#type' => 'managed_file',
      '#title' => $this->t('Ambassador Image'),
      '#default_value' => $this->get('file_image_ambassador_image'),
      '#upload_location' => 'public://ambassadors/',
      '#translatable' => true,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg svg'],
        'file_validate_unique' => [],
      ],
      '#required' => $enabledV2,
    ];

    $form['brand_ambassador_group']['ambassador_redirection_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Redirection Link'),
      '#description' => $this->t('Enter Redirection Link for Brand Ambassador Section'),
      '#default_value' => $this->get('ambassador_redirection_link'),
      '#translatable' => true,
    ];

    $form['brand_ambassador_group']['ambassador_link_target'] = [
      '#type' => 'select',
      '#options' => [
        '_self' => 'Same Tab',
        '_blank' => 'New Tab',
        'window' => 'New Window'
      ],
      '#translatable' => true,
      '#title' => $this->t('Redirection Link Target'),
      '#description' => $this->t('Select a Redirection link target'),
      '#default_value' => $this->get('ambassador_link_target'),
      '#rows' => 1,
    ];
  }

  private function sectionCopyright(array &$form) {
    $form['copyright_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Copyright'),
      '#collapsible' => true,
      '#group' => 'advanced',
    ];

    $form['copyright_group']['use_cms_copyright_label'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use CMS Copyright Label'),
      '#default_value' => $this->get('use_cms_copyright_label'),
      '#translatable' => true,
    ];

    $form['copyright_group']['copyright'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright Label'),
      '#default_value' => $this->get('copyright'),
      '#translatable' => true,
    ];

    $form['copyright_group']['all_rights_reserved'] = [
      '#type' => 'textfield',
      '#title' => $this->t('All Rights Reserved Label'),
      '#default_value' => $this->get('all_rights_reserved'),
      '#translatable' => true,
    ];
  }
  /**
   * footer version config
   */
  private function footerVersionCheck(array &$form) {
    $form['footer_version_check'] = [
      '#type' => 'details',
      '#title' => $this->t('Footer Version Config'),
      '#collapsible' => true,
      '#group' => 'advanced',
    ];
    $form['footer_version_check']['enable_new_style'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Footer Revamp'),
      '#default_value' => $this->get('enable_new_style'),
      '#translatable' => true,
    ];
  }
}

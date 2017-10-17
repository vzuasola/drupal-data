<?php

namespace Drupal\webcomposer_editor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginCssInterface;

/**
 * Defines the "webcomposer_editor" plugin.
 *
 * @CKEditorPlugin(
 *   id = "webcomposer_editor",
 *   label = @Translation("Web Composer CKEditor Plugins"),
 * )
 */
class WebcomposerEditor extends CKEditorPluginBase implements CKEditorPluginCssInterface {
  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'webcomposer_editor') . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getCssFiles(Editor $editor) {
    return array(
      drupal_get_path('module', 'webcomposer_editor') . '/css/plugin.css'
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $modulePath = drupal_get_path('module', 'webcomposer_editor');
    return [
      'FontSizes' => [
          'label' => t('Font Size'),
          'image_alternative' => [
              '#type' => 'inline_template',
              '#template' => '<a href="#" role="button" aria-label=""><span class="ckeditor-button-dropdown">{{ text }}<span class="ckeditor-button-arrow"></span></span></a>',
              '#context' => [
                  'text' => t('Font Size'),
              ],
          ],
      ],
      'FontColors' => [
          'label' => t('Font Color'),
          'image_alternative' => [
              '#type' => 'inline_template',
              '#template' => '<a href="#" role="button" aria-label=""><span class="ckeditor-button-dropdown">{{ text }}<span class="ckeditor-button-arrow"></span></span></a>',
              '#context' => [
                  'text' => t('Font Color'),
              ],
          ],
      ],
      'Link' => array(
        'label' => t('Webcomposer Editor Link'),
        'image' => $modulePath . '/icons/link.png',
      ),
      'Unlink' => array(
        'label' => t('Webcomposer Editor Unlink'),
        'image' => $modulePath . '/icons/unlink.png',
      ),
  ];
  }
}

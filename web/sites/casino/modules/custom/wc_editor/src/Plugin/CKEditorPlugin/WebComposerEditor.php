<?php

namespace Drupal\wc_editor\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginCssInterface;

/**
 * Defines the "wc_editor" plugin.
 *
 * @CKEditorPlugin(
 *   id = "wc_editor",
 *   label = @Translation("Web Composer Editor"),
 * )
 */
class WebComposerEditor extends CKEditorPluginBase implements CKEditorPluginCssInterface {
  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'wc_editor') . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getCssFiles(Editor $editor) {
    return array(
      drupal_get_path('module', 'wc_editor') . '/css/plugin.css'
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $modulePath = drupal_get_path('module', 'wc_editor');
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
      'SimpleLink' => array(
        'label' => t('Link ckeditor button'),
        'image' => $modulePath . '/icons/simplelink.png',
      ),
  ];
  }
}

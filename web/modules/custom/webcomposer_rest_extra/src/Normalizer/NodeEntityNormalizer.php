<?php

namespace Drupal\webcomposer_rest_extra\Normalizer;

use Drupal\serialization\Normalizer\ContentEntityNormalizer;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\file\Entity\File;
use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;

/** 
 * Converts typed data objects to arrays.
 */
class NodeEntityNormalizer extends ContentEntityNormalizer
{
  /**
   * The interface or class that this Normalizer supports. 
   * 
   * @var string 
   */
  protected $supportedInterfaceOrClass = 'Drupal\node\NodeInterface';

  /** 
   * {@inheritdoc} 
   */
  public function normalize($entity, $format = NULL, array $context = [])
  {
    $entityData = $entity->toArray();
    $attributes = parent::normalize($entity, $format, $context);

    foreach ($entityData as $key => $value) {
      
       if (isset($value[0]['format'])) {
        if (!empty($value[0]['value'])) {
          $attributes[$key][0]['value'] = $this->filterHtml($attributes[$key][0]['value']);
        }
      }

      if (isset($value[0]['target_id'])) {
        $targetId = $value[0]['target_id'];
        $setting = $entity->get($key)->getSettings();

        switch ($setting['target_type']) {
          case 'paragraph':
            foreach ($value as $id => $item) {
              $attributes[$key][$id] = $this->loadParagraphById($item['target_id']);
            }
            break;

          case 'taxonomy_term':
            foreach ($value as $id => $item) {
              $attributes[$key][$id] = $this->loadTermById($item['target_id']);
            }
            break;

          case 'node':
            foreach ($value as $id => $item) {
              $attributes[$key][$id] = $this->loadNodeById($item['target_id']);
            }
            break;
        }
      }
    }

    return $attributes;
  }

  /**
   * Load Paragraph by ID
   */
  private function loadParagraphById($id) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
    $paragraph = \Drupal::entityManager()->getStorage('paragraph')->load($id);
    $paragraphTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($paragraph, $lang);
    $pargraphTranslatedArray = $paragraphTranslated->toArray();

    foreach ($pargraphTranslatedArray as $field => $item) {
      $setting = $paragraphTranslated->get($field)->getSettings();

      if (isset($setting['target_type'])) {
        if ($setting['target_type'] == 'file') {
          $field_array = array_merge($pargraphTranslatedArray[$field][0], $this->loadFileById($item[0]['target_id']));
          $pargraphTranslatedArray[$field] = $field_array;
        }
      }
      foreach ($item as $value) {
         if (isset($value['format'])) {
            $field_array = $this->filterHtml($value['value']);
            $pargraphTranslatedArray[$field] = $field_array;    
          }
      }

    }
    return $pargraphTranslatedArray;
  }

  /**
   * Load terms by taxonomy ID
   */
  private function loadTermById($tid) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();

    $term = \Drupal\taxonomy\Entity\Term::load($tid);
    $termTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);
    $translatedArray = $termTranslated->toArray();

    foreach ($translatedArray as $field => $item) {
      $setting = $termTranslated->get($field)->getSettings();

      if (isset($setting['target_type'])) {
        if ($setting['target_type'] == 'file') {
          $field_array = array_merge($translatedArray[$field][0], $this->loadFileById($item[0]['target_id']));
          $translatedArray[$field] = $field_array;
        }
      }
    }

    return $translatedArray;
  }

  /**
   * Load node data by Node ID
   */
  private function loadNodeById($id) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();

    $node = \Drupal::entityManager()->getStorage('node')->load($id);

    if($node->isPublished()) {
         $nodeTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($node, $lang);
         $nodeTranslatedArray = $nodeTranslated->toArray();

          foreach ($nodeTranslatedArray as $field => $item) {
           $setting = $nodeTranslated->get($field)->getSettings();

        if (isset($setting['target_type'])) {
          if ($setting['target_type'] == 'file') {
            $field_array = array_merge($nodeTranslatedArray[$field][0], $this->loadFileById($item[0]['target_id']));
            $nodeTranslatedArray[$field] = $field_array;
          }
        }
      }
    }
    return $nodeTranslatedArray;
  }

  /**
   * Load file url data by target ID
   */
  private function loadFileById($fid) {
    $result = [];
    $fileArray = []; 

    if (isset($fid)) {
      $file = File::load($fid);

      if ($file) {
        $fileArray = $file->toArray();
        $fileArray['url'] = file_create_url($file->getFileUri());
      }
    }

    $result[] = $fileArray;

    return $result;
  }

  /**
   * Filtered Html for Image Source.
   */
  public function filterHtml($markup)
  {
    $document = new Html();
    $htmlDoc = $document->load($markup);
    $dom_object = simplexml_import_dom($htmlDoc);
    $images = $dom_object->xpath('//img');
    $base_path = Settings::get('ck_editor_inline_image_prefix', $default = NULL);

    foreach ($images as $image) {
      $replace = preg_replace('/\/sites\/[a-z]+\/files/', $base_path, $image['src']);
      $image['src'] = $replace;          
    }

    $html_markup = Html::serialize($htmlDoc);
    $processed_html = trim($html_markup);

    return $processed_html;

  }
}

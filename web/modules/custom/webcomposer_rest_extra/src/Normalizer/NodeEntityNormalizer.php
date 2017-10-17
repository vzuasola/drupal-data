<?php

namespace Drupal\webcomposer_rest_extra\Normalizer;

use Drupal\serialization\Normalizer\ContentEntityNormalizer;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\file\Entity\File;
use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;

/**
 * Converts typed data objects to arrays.
 */
class NodeEntityNormalizer extends ContentEntityNormalizer
{
  use FilterHtmlTrait;
  /**
   * The interface or class that this Normalizer supports.
   *
   * @var string
   */
  protected $supportedInterfaceOrClass = 'Drupal\node\NodeInterface';

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = []) {
    $entityData = $entity->toArray();
    $attributes = parent::normalize($entity, $format, $context);
    foreach ($entityData as $key => $value) {
      // replace the images src for text formats
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
              $term = $this->loadTermById($item['target_id']);
              if ($term === false) {
                unset($attributes[$key][$id]);
              } else {
                $attributes[$key][$id] = $term;
              }
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

      foreach ($item as $key => $value) {
        if (isset($value['format'])) {
          $field_array = $this->filterHtml($value['value']);
          $pargraphTranslatedArray[$field][$key]['value'] = $field_array;
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

    if (!$term) {
      return false;
    }

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
}

<?php

namespace Drupal\webcomposer_rest_extra\Normalizer;

use Drupal\serialization\Normalizer\ContentEntityNormalizer;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\file\Entity\File;

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
    public function normalize($entity, $format = NULL, array $context = array())
    {
        
        $entity_data = $entity->toArray();
        
        $attributes = parent::normalize($entity, $format, $context);

        foreach ($entity_data as $key => $value) {
            if (isset($value[0]['target_id'])) {
                $targetId = $value[0]['target_id'];
                $setting  = $entity->get($key)->getSettings();

                switch ($setting['target_type']) {
                	case 'paragraph':
                		foreach ($value as $id => $item) {
                        	$attributes[$key][$id] = $this->loadParagraphByID($item['target_id']);
                    	}
                	break;

                	case 'taxonomy_term':
                		foreach ($value as $id => $item) {
                        	$attributes[$key][$id] = $this->loadTerm($item['target_id']);
                   		}	
                	break;

                	case 'node':
                		foreach ($value as $id => $item) {
                        	$attributes[$key][$id] = $this->NodeLoadById($item['target_id']);
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
    private function loadParagraphByID($id)
    {
        $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
        $paragraph = \Drupal::entityManager()->getStorage('paragraph')->load($id);
        $para_translated = \Drupal::service('entity.repository')->getTranslationFromContext($paragraph, $lang);
        $para_translated_array = $para_translated->toArray();

        foreach ($para_translated_array as $field => $item) {
            $setting  = $para_translated->get($field)->getSettings();
            if (isset($setting['target_type'])) {
                if ($setting['target_type'] == 'file') {
                    $field_array = array_merge($para_translated_array[$field][0], $this->loadFileById($item[0]['target_id']));
                    $para_translated_array[$field] = $field_array;
                }
            }
        }
        return $para_translated_array;
    }
    
    /**
     * Load terms by taxonomy ID
     */
    private function loadTerm($tid)
    {
        $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
        
        $term = \Drupal\taxonomy\Entity\Term::load($tid);
        $term_translated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);
        $term_translated_array = $term_translated->toArray();

        foreach ($term_translated_array as $field => $item) {
            $setting  = $term_translated->get($field)->getSettings();
            if (isset($setting['target_type'])) {
                if ($setting['target_type'] == 'file') {
                    $field_array = array_merge($term_translated_array[$field][0], $this->loadFileById($item[0]['target_id']));
                    $term_translated_array[$field] = $field_array;
                }
            }
        }

        return $term_translated_array;
    }
    
    /**
     * Load node data by Node ID
     */
    private function NodeLoadById($id)
    {
        
        $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
        
        $node = \Drupal::entityManager()->getStorage('node')->load($id);
        $node_translated = \Drupal::service('entity.repository')->getTranslationFromContext($node, $lang);
        $node_translated_array = $node_translated->toArray();

        foreach ($node_translated_array as $field => $item) {
            $setting  = $node_translated->get($field)->getSettings();

            if (isset($setting['target_type'])) {
                if ($setting['target_type'] == 'file') {
                    $field_array = array_merge($node_translated_array[$field][0], $this->loadFileById($item[0]['target_id']));
                    $node_translated_array[$field] = $field_array;
                }
            }

        }

        return $node_translated_array;
        
    }

    /**
     * Load file url data by target ID
     */
    private function loadFileById($fid) 
    {

        $fileArray = []; 

        if (isset($fid)) {
            $file = File::load($fid);
            $fileArray = $file->toArray();
            $fileArray['image_url'] = file_create_url($file->getFileUri());
        }

        return $fileArray;
    }
}

<?php

namespace Drupal\webcomposer_rest_extra\Normalizer;

use Drupal\serialization\Normalizer\ContentEntityNormalizer;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\paragraphs\Entity\Paragraph;

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
                
                if ($setting['target_type'] == 'paragraph') {
                    foreach ($value as $id => $item) {
                        $attributes[$key][$id] = $this->loadParagraphByID($targetId);
                    }
                }
                
                if ($setting['target_type'] == 'taxonomy_term') {
                    foreach ($value as $id => $item) {
                        $attributes[$key][$id] = $this->loadTerm($targetId);
                    }
                }
                
                if ($setting['target_type'] == 'node') {
                    foreach ($value as $id => $item) {
                        $attributes[$key][$id] = $this->NodeLoadById($targetId);
                    }
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
        
        $lang            = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
        $paragraph       = \Drupal::entityManager()->getStorage('paragraph')->load($id);
        $para_translated = \Drupal::service('entity.repository')->getTranslationFromContext($paragraph, $lang);
        return $para_translated->toArray();
    }
    
    /**
     * Load terms by taxonomy ID
     */
    private function loadTerm($tid)
    {
        
        $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
        
        $term            = \Drupal\taxonomy\Entity\Term::load($tid);
        $term_translated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);
        return $term_translated->toArray();
        
    }
    
    /**
     * Load node data by Node ID
     */
    private function NodeLoadById($id)
    {
        
        $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
        
        $node            = \Drupal::entityManager()->getStorage('node')->load($id);
        $node_translated = \Drupal::service('entity.repository')->getTranslationFromContext($node, $lang);
        return $node_translated->toArray();
        
    }
    
}
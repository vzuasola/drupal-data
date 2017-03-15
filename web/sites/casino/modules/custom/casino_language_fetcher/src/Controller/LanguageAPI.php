<?php
namespace Drupal\casino_language_fetcher\Controller;


use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;


class LanguageAPI {

public function getEnabledLanguages() {

   $lang_obj = \Drupal::languageManager()->getLanguages();

   foreach($lang_obj as $lang) {
    $lang_info[$lang->getName()] = [
    'name' => $lang->getName(),
    'id'   => $lang->getId(),
    'weight' => $lang->getWeight()
    ];

   }
   kint($lang_info);die;
   return array(
    '#markup' => "test"
    );
}
}

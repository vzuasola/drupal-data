<?php

namespace Drupal\webform_rest\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * Creates a resource for submitting a webform.
 *
 * @RestResource(
 *   id = "webform_rest_list",
 *   label = @Translation("List of Webform list"),
 *   uri_paths = {
 *     "canonical" = "/webform_rest/list",
 *   }
 * )
 */
class WebformList extends ResourceBase {

  /**
   * Responds webform entities id.
   *
   * @param array $content_entity_types
   *   Webform field data and webform ID.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   */
  public function get() {

    $content_entity_types = [];
    $entity_type_definations = \Drupal::entityTypeManager()->getDefinitions();
    /* @var $definition EntityTypeInterface */
    foreach ($entity_type_definations as $definition) {
      if($definition->id() == 'webform') {
        $types = \Drupal::entityTypeManager()->getStorage('webform')->loadMultiple();
        foreach ($types as $type) {
          $content_entity_types[] = $type->id();
       }
     }
    }
       return new ResourceResponse($content_entity_types);
  }

}

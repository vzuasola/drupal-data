<?php

namespace Drupal\webcomposer_affilates\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Unicode;
use Drupal\Component\Utility\Html;

class AffilateListing extends ControllerBase {

  /**
   * Returns the Taxonomy Form.
   */
  public function getTaxonomyForm() {

    $taxonomyTerm = $this->entityManager()->getStorage('taxonomy_term')->create(array(
      'vid' => 'affiliates_parameters',
    ));

    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return array(
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    );
  }
}


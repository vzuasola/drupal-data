<?php

namespace Drupal\webcomposer_affilates\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for Affilate listing.
 */
class AffilateListing extends ControllerBase {
  /**
   * Returns the Taxonomy Form.
   *
   * @return array
   *   The taxonomy form.
   */
  public function getTaxonomyForm() {
    $taxonomyTerm = $this->entityManager()->getStorage('taxonomy_term')->create([
      'vid' => 'affiliates_parameters',
    ]);

    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);

    return [
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    ];
  }
}

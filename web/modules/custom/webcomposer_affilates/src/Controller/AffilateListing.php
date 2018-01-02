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
  public function getList() {
    $terms = $this->entityManager()->getStorage('taxonomy_term')->create([
      'vid' => 'affiliates_parameters',
    ]);

    $form = $this->entityFormBuilder()->getForm($terms);

    return [
      '#type' => 'markup',
      '#markup' => render($form),
    ];
  }

    /**
   * Returns the Taxonomy Form.
   *
   * @return array
   *   The taxonomy form.
   */
  public function getGroupList() {
    $terms = $this->entityManager()->getStorage('taxonomy_term')->create([
      'vid' => 'affiliates_group',
    ]);

    $form = $this->entityFormBuilder()->getForm($terms);

    return [
      '#type' => 'markup',
      '#markup' => render($form),
    ];
  }
}

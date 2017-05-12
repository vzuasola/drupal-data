<?php

namespace Drupal\webcomposer_dm\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Html;

/**
 * Provides route responses for the Example module.
 */
class DomainManagement extends ControllerBase {

  /**
   * Returns Domain Groups Add Taxonomy form page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function getManageGroupsPage(Request $request) {
    $taxonomyTerm = $this->entityManager()->getStorage('taxonomy_term')->create(array(
      'vid' => DOMAIN_GROUP_VOCAB,
    ));
    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return array(
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    );
  }

  /**
   * Returns Domains Add Taxonomy form page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function getManageDomainsPage() {
    $taxonomyTerm = $this->entityManager()->getStorage('taxonomy_term')->create(array(
      'vid' => DOMAIN_VOCAB,
    ));
    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return array(
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    );
  }

  /**
   * Returns Master Placeholder Add Taxonomy form page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function getManagePlaceholdersPage() {
    $taxonomyTerm = \Drupal::entityManager()->getStorage('taxonomy_term')->create(array(
      'vid' => MASTER_PLACEHOLDER,
    ));
    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return array(
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    );
  }

}

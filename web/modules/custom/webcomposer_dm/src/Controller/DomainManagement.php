<?php

namespace Drupal\webcomposer_dm\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

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
    $taxonomyTerm = $this->entityManager()->getStorage('taxonomy_term')->create([
      'vid' => WEBCOMPOSER_DM_DOMAIN_GROUP_VOCAB,
    ]);
    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return [
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    ];
  }

  /**
   * Returns Domains Add Taxonomy form page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function getManageDomainsPage() {
    $taxonomyTerm = $this->entityManager()->getStorage('taxonomy_term')->create([
      'vid' => WEBCOMPOSER_DM_DOMAIN_VOCAB,
    ]);
    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return [
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    ];
  }

  /**
   * Returns Master Placeholder Add Taxonomy form page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function getManagePlaceholdersPage() {
    $taxonomyTerm = \Drupal::entityManager()->getStorage('taxonomy_term')->create([
      'vid' => WEBCOMPOSER_DM_MASTER_PLACEHOLDER,
    ]);
    $taxonomyAddForm = $this->entityFormBuilder()->getForm($taxonomyTerm);
    return [
      '#type' => 'markup',
      '#markup' => render($taxonomyAddForm),
    ];
  }

}

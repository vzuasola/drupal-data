<?php

namespace Drupal\webcomposer_rest_extra;

/**
 * Provide a trait for pager details
 */
trait PagerTrait {

 /**
  * Get pager details
  */
  public function pagerDetails($pager) {
    $pagerDetails = \Drupal::request()->query->get('pager');
    if ($pagerDetails) {
      // Get pager details if "pager" query string is available
      $pagerClass = get_class($pager);
      $total_pages = 0;
      if (!in_array($pagerClass, ['Drupal\views\Plugin\views\pager\None', 'Drupal\views\Plugin\views\pager\Some'])) {
        $total_pages = $pager->getPagerTotal();
      }

      return [
          'total_items' => (int) $pager->getTotalItems(),
          'total_pages' => $total_pages,
          'items_per_page' => $pager->getItemsPerPage(),
      ];
    }

    return false;
  }
}

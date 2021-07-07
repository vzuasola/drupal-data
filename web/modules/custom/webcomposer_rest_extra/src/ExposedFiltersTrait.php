<?php

namespace Drupal\webcomposer_rest_extra;

use Drupal\Core\Language\LanguageInterface;

/**
 * Provide a trait for pager details
 */
trait ExposedFiltersTrait {

  /**
   * Get exposed filters on the view
   */
  public function getExposedFilters($originalView) {
    $filterSet = [];
    $lang = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();

    $view = clone $originalView;

    foreach ($view->storage->get('display') as $filterId => $filterValue) {
      $view->setDisplay($filterId);
      $filters = $view->display_handler->getOption('filters');

      foreach ($filters as $key => $value) {
        if (isset($value['exposed']) && $value['exposed']) {
          $value['view_id'] = $view->id();
          $value['display_id'] = $filterId;
          $value['identifier'] = $value['expose']['identifier'];

          $filterSet[] = $value;
        }
      }
    }

    return $filterSet;
  }
}

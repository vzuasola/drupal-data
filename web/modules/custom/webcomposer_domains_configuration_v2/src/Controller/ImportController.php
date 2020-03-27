<?php

namespace Drupal\webcomposer_domains_configuration_v2\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ImportController.
 */
class ImportController extends ControllerBase {

  /**
   * Import.
   *
   * @return string
   *   Return Hello string.
   */
  public function import() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: import')
    ];
  }

}

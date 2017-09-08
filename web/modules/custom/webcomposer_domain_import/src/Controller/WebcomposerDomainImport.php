<?php

namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class WebcomposerDomainImport.
 *
 * @package Drupal\webcomposer_domain_import\Controller
 */
class WebcomposerDomainImport extends ControllerBase {

  /**
   * Domain Import.
   *
   * @return string
   *   Return Hello string.
   */
  public function DomainImport() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: Import Successfull')
    ];
  }

}

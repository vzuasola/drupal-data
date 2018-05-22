<?php

namespace Drupal\webcomposer_floating_banners\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\views\Views;

/**
 * Controller routines for imce routes.
 */
class WebcomposerFloatingBannersController extends ControllerBase {

  /**
   * Default manage page
   */
  public function manage() {
    $view = Views::getView('floating_banner');
    if (isset($view) && $view->access('manage')) {
        $view->setDisplay('manage');
        $view->execute();
        $markup = \Drupal::service('renderer')->renderRoot($view->render());
    } else {
        return $this->redirect('entity.left_floating_banner_entity.collection');
    }

    return [
      '#type' => 'markup',
      '#markup' => $markup,
    ];
  }
}

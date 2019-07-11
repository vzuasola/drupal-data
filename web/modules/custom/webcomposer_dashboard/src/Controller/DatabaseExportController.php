<?php

namespace Drupal\webcomposer_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 *
 */
class DatabaseExportController extends ControllerBase {
  /**
   *
   */
  public function download() {
    if (empty($_SESSION['webcomposer_dashboard.database_export_download.path'])) {
      throw new NotFoundHttpException();
    }

    $file = $_SESSION['webcomposer_dashboard.database_export_download.path'];
    $filename = $_SESSION['webcomposer_dashboard.database_export_download.filename'];

    unset($_SESSION['webcomposer_dashboard.database_export_download.path']);
    unset($_SESSION['webcomposer_dashboard.database_export_download.filename']);

    header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename='$filename'");
    header('Content-Length: ' . filesize($file));

    readfile($file);

    exit;
  }
}

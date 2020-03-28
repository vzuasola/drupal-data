<?php

namespace Drupal\webcomposer_domains_configuration_v2\Parser;

use Drupal\file\Entity\File;
use Interop\Container\ContainerInterface;

class ImportParser
{
  public function __construct()
  {
  }

  public static function create(ContainerInterface $container)
  {
  }

  public function readExcel($form_state)
  {
    $message = 'Reading File...';
    if (is_object($form_state)) {
      $fid = $form_state->getValue('fid');
      if (!$fid) {
        $file_field = $form_state->getValue('import_file');
        $fid = $file_field[0];
      }
    } else {
      $fid = $form_state;
    }

    $uri = File::load($fid)->getFileUri();
    $realPath = \Drupal::service('file_system')->realpath($uri);

    var_dump($realPath);
    die();
  }

}

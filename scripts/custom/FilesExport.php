<?php

namespace DrupalProject\custom;

class FilesExport {
  public function export($path, $filename) {
    set_time_limit(30000);

    $tempname = tempnam(sys_get_temp_dir(), $filename);

    $zip = new eZipArchive();
    $res = $zip->open($tempname, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

    if ($res === true) {
      $zip->addDir($path, '');
      $zip->close();

      header('Content-Type: application/zip');
      header("Content-Disposition: attachment; filename='$filename'");
      header('Content-Length: ' . filesize($tempname));

      echo file_get_contents($tempname);

      exit;
    }
  }
}

class eZipArchive extends \ZipArchive {
  public function addDir($location, $name) {
    $this->addEmptyDir($name);
    $this->doAddDir($location, $name);
  }

  private function doAddDir($location, $name) {
    $name .= '/';
    $location .= '/';
    $dir = opendir($location);

    while ($file = readdir($dir)) {
      if ($file == '.' || $file == '..') {
        continue;
      }

      if (filetype($location . $file) === 'dir') {
        $this->addDir($location . $file, $name . $file);
      } else {
        $this->addFile($location . $file, $name . $file);
      }
    }
  }
}

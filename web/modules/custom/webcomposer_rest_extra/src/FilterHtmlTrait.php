<?php

namespace Drupal\webcomposer_rest_extra;

use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\file\Entity\File;

/**
* Provide a trait to filter html
*/
trait FilterHtmlTrait {

 /**
  * Filtered Html for Image Source.
  */
  public function filterHtml($markup) {
    $document = new Html();

    $htmlDoc = $document->load($markup);
    $domObject = simplexml_import_dom($htmlDoc);

    // replace the images src for text formats
    $images = $domObject->xpath('//img');
    $basePath = $this->getInlineBasePath();

    if ($basePath) {
      // if base path is available, make them relative of front end
      foreach ($images as $image) {
          $replace = preg_replace('/\/sites\/[a-z\-]+\/files/', $basePath, $image['src']);
          $image['src'] = $replace;
      }
    } else {
      // make them absolute, so that it will work on front end
      foreach ($images as $image) {
          $drupal_uri = \Drupal::request()->getSchemeAndHttpHost();
          $image['src'] = $drupal_uri . $image['src'];
      }

    }

    $htmlMarkup = Html::serialize($htmlDoc);
    $processedHtml = trim($htmlMarkup);

    return $processedHtml;
  }

  /**
   *
   */
  private function getInlineBasePath() {
    $path = $_SERVER['HTTP_X_FE_BASE_URI'];

    \Drupal::moduleHandler()->alter('inline_image_url_change', $path);

    return $path;
  }

  /**
   * Load file by the file id.
   *
   * @param  String $fid
   *  file id to get the file object.
   * @return String
   *  file relative path.
   */
  public function getFileRelativePath($fid) {
    $file_url;

    if (isset($fid)) {
      $file = File::load($fid);

      if ($file) {
        $file_url = preg_replace('/public:\/\//', '', $file->getFileUri());
      }
    }

    return $file_url;
  }
}

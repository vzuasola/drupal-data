<?php

namespace Drupal\webcomposer_rest_extra;

use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\file\Entity\File;
use Drupal\Component\Utility\UrlHelper;

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
    $base_path = $this->getInlineBasePath();

    if ($base_path) {
      // if base path is available, make them relative of front end
      foreach ($images as $image) {
        $src = preg_replace('/\/sites\/[a-z\-]+\/files/', '', $image['src']);
        $replace = $base_path . $src;

        if (UrlHelper::isExternal($src)) {
          $image['src'] = $src;
        } else {
          $image['src'] = $this->doParseImage($replace, $base_path, $src);
        }
      }
    } else {
      // make them absolute, so that it will work on front end
      foreach ($images as $image) {
        $drupal_uri = \Drupal::request()->getSchemeAndHttpHost();
        $replace = $drupal_uri . $image['src'];

        if (UrlHelper::isExternal($image['src'])) {
          $image['src'] = $image['src'];
        } else {
          $image['src'] = $replace;
        }
      }
    }

    $htmlMarkup = Html::serialize($htmlDoc);
    $processedHtml = trim($htmlMarkup);

    return $processedHtml;
  }

  /**
   * Generate the resolved URL of a file object.
   *
   * @param File $file
   *   The file entity object.
   *
   * @return string
   *   The resolved absolute path.
   */
  protected function generateUrlFromFile(File $file) {
    $path = NULL;
    $base_path = $this->getInlineBasePath();

    if ($base_path) {
      $pre = $this->getFileRelativeFilename($file->getFileUri());
      $path = $base_path . '/' . $pre;

      $this->doParseImage($path, $base_path, $pre);
    } else {
      $path = file_create_url($file->getFileUri());
    }

    return $path;
  }

  /**
   *
   */
  private function doParseImage($uri, $base_path, $src)
  {
    $path = ltrim($src, '/');
    $uri = "[uri:($path)]";

    \Drupal::moduleHandler()->alter('inline_image_url_change', $uri, $base_path, $src);

    return $uri;
  }

  /**
   * Load file by the file id.
   *
   * @param integer $fid
   *   The file id to get the file object.
   *
   * @return string
   *   The file relative path.
   */
  protected function getFileRelativePath($fid) {
    $file = File::load($fid);

    if ($file) {
      $path = $file->getFileUri();
      return $this->getFileRelativeFilename($path);
    }
  }

  /**
   * Gets the inline base path.
   * Supports alter via hook_inline_image_url_change_alter().
   *
   * @return string
   */
  protected function getInlineBasePath() {
    return isset($_SERVER['HTTP_X_FE_BASE_URI']) ? $_SERVER['HTTP_X_FE_BASE_URI'] : NULL;
  }

  /**
   * Gets the filename of from the file URI
   *
   * @param string $filename
   *   The file entity URI file path
   *
   * @return string
   */
  protected function getFileRelativeFilename($filename) {
    return preg_replace('/public:\/\//', '', $filename);
  }
}

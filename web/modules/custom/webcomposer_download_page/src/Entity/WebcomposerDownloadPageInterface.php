<?php

namespace Drupal\webcomposer_download_page\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Webcomposer download page entities.
 *
 * @ingroup webcomposer_download_page
 */
interface WebcomposerDownloadPageInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Webcomposer download page name.
   *
   * @return string
   *   Name of the Webcomposer download page.
   */
  public function getName();

  /**
   * Sets the Webcomposer download page name.
   *
   * @param string $name
   *   The Webcomposer download page name.
   *
   * @return \Drupal\webcomposer_download_page\Entity\WebcomposerDownloadPageInterface
   *   The called Webcomposer download page entity.
   */
  public function setName($name);

  /**
   * Gets the Webcomposer download page creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Webcomposer download page.
   */
  public function getCreatedTime();

  /**
   * Sets the Webcomposer download page creation timestamp.
   *
   * @param int $timestamp
   *   The Webcomposer download page creation timestamp.
   *
   * @return \Drupal\webcomposer_download_page\Entity\WebcomposerDownloadPageInterface
   *   The called Webcomposer download page entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Webcomposer download page published status indicator.
   *
   * Unpublished Webcomposer download page are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Webcomposer download page is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Webcomposer download page.
   *
   * @param bool $published
   *   TRUE to set this Webcomposer download page to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_download_page\Entity\WebcomposerDownloadPageInterface
   *   The called Webcomposer download page entity.
   */
  public function setPublished($published);

}

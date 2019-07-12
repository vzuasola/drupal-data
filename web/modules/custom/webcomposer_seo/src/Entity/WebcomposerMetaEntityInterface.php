<?php

namespace Drupal\webcomposer_seo\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Webcomposer meta entity entities.
 *
 * @ingroup webcomposer_seo
 */
interface WebcomposerMetaEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Webcomposer meta entity name.
   *
   * @return string
   *   Name of the Webcomposer meta entity.
   */
  public function getName();

  /**
   * Sets the Webcomposer meta entity name.
   *
   * @param string $name
   *   The Webcomposer meta entity name.
   *
   * @return \Drupal\webcomposer_seo\Entity\WebcomposerMetaEntityInterface
   *   The called Webcomposer meta entity entity.
   */
  public function setName($name);

  /**
   * Gets the Webcomposer meta entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Webcomposer meta entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Webcomposer meta entity creation timestamp.
   *
   * @param int $timestamp
   *   The Webcomposer meta entity creation timestamp.
   *
   * @return \Drupal\webcomposer_seo\Entity\WebcomposerMetaEntityInterface
   *   The called Webcomposer meta entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Webcomposer meta entity published status indicator.
   *
   * Unpublished Webcomposer meta entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Webcomposer meta entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Webcomposer meta entity.
   *
   * @param bool $published
   *   TRUE to set this Webcomposer meta entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_seo\Entity\WebcomposerMetaEntityInterface
   *   The called Webcomposer meta entity entity.
   */
  public function setPublished($published);

}

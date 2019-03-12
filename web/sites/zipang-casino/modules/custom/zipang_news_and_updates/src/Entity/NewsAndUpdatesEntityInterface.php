<?php

namespace Drupal\zipang_news_and_updates\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining News and updates entity entities.
 *
 * @ingroup zipang_news_and_updates
 */
interface NewsAndUpdatesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the News and updates entity name.
   *
   * @return string
   *   Name of the News and updates entity.
   */
  public function getName();

  /**
   * Sets the News and updates entity name.
   *
   * @param string $name
   *   The News and updates entity name.
   *
   * @return \Drupal\zipang_news_and_updates\Entity\NewsAndUpdatesEntityInterface
   *   The called News and updates entity entity.
   */
  public function setName($name);

  /**
   * Gets the News and updates entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the News and updates entity.
   */
  public function getCreatedTime();

  /**
   * Sets the News and updates entity creation timestamp.
   *
   * @param int $timestamp
   *   The News and updates entity creation timestamp.
   *
   * @return \Drupal\zipang_news_and_updates\Entity\NewsAndUpdatesEntityInterface
   *   The called News and updates entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the News and updates entity published status indicator.
   *
   * Unpublished News and updates entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the News and updates entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a News and updates entity.
   *
   * @param bool $published
   *   TRUE to set this News and updates entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_news_and_updates\Entity\NewsAndUpdatesEntityInterface
   *   The called News and updates entity entity.
   */
  public function setPublished($published);

}

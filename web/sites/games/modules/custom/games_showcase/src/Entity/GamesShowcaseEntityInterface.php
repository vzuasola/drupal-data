<?php

namespace Drupal\games_showcase\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Games Showcase entity entities.
 *
 * @ingroup games_showcase
 */
interface GamesShowcaseEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Games Showcase entity name.
   *
   * @return string
   *   Name of the Games Showcase entity.
   */
  public function getName();

  /**
   * Sets the Games Showcase entity name.
   *
   * @param string $name
   *   The Games Showcase entity name.
   *
   * @return \Drupal\games_showcase\Entity\GamesShowcaseEntityInterface
   *   The called Games Showcase entity entity.
   */
  public function setName($name);

  /**
   * Gets the Games Showcase entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Games Showcase entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Games Showcase entity creation timestamp.
   *
   * @param int $timestamp
   *   The Games Showcase entity creation timestamp.
   *
   * @return \Drupal\games_showcase\Entity\GamesShowcaseEntityInterface
   *   The called Games Showcase entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Games Showcase entity published status indicator.
   *
   * Unpublished Games Showcase entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Games Showcase entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Games Showcase entity.
   *
   * @param bool $published
   *   TRUE to set this Games Showcase entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\games_showcase\Entity\GamesShowcaseEntityInterface
   *   The called Games Showcase entity entity.
   */
  public function setPublished($published);

}

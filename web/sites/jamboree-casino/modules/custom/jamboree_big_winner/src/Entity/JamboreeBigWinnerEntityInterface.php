<?php

namespace Drupal\jamboree_big_winner\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree big winner entity entities.
 *
 * @ingroup jamboree_big_winner
 */
interface JamboreeBigWinnerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree big winner entity name.
   *
   * @return string
   *   Name of the Jamboree big winner entity.
   */
  public function getName();

  /**
   * Sets the Jamboree big winner entity name.
   *
   * @param string $name
   *   The Jamboree big winner entity name.
   *
   * @return \Drupal\jamboree_big_winner\Entity\JamboreeBigWinnerEntityInterface
   *   The called Jamboree big winner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree big winner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree big winner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree big winner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree big winner entity creation timestamp.
   *
   * @return \Drupal\jamboree_big_winner\Entity\JamboreeBigWinnerEntityInterface
   *   The called Jamboree big winner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree big winner entity published status indicator.
   *
   * Unpublished Jamboree big winner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree big winner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree big winner entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree big winner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_big_winner\Entity\JamboreeBigWinnerEntityInterface
   *   The called Jamboree big winner entity entity.
   */
  public function setPublished($published);

}

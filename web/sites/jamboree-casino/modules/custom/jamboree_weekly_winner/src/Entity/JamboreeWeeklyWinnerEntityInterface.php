<?php

namespace Drupal\jamboree_weekly_winner\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree weekly winner entity entities.
 *
 * @ingroup jamboree_weekly_winner
 */
interface JamboreeWeeklyWinnerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree weekly winner entity name.
   *
   * @return string
   *   Name of the Jamboree weekly winner entity.
   */
  public function getName();

  /**
   * Sets the Jamboree weekly winner entity name.
   *
   * @param string $name
   *   The Jamboree weekly winner entity name.
   *
   * @return \Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntityInterface
   *   The called Jamboree weekly winner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree weekly winner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree weekly winner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree weekly winner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree weekly winner entity creation timestamp.
   *
   * @return \Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntityInterface
   *   The called Jamboree weekly winner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree weekly winner entity published status indicator.
   *
   * Unpublished Jamboree weekly winner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree weekly winner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree weekly winner entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree weekly winner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntityInterface
   *   The called Jamboree weekly winner entity entity.
   */
  public function setPublished($published);

}

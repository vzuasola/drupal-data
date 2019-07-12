<?php

namespace Drupal\jamboree_jackpot\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree jackpot entity entities.
 *
 * @ingroup jamboree_jackpot
 */
interface JamboreeJackpotEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree jackpot entity name.
   *
   * @return string
   *   Name of the Jamboree jackpot entity.
   */
  public function getName();

  /**
   * Sets the Jamboree jackpot entity name.
   *
   * @param string $name
   *   The Jamboree jackpot entity name.
   *
   * @return \Drupal\jamboree_jackpot\Entity\JamboreeJackpotEntityInterface
   *   The called Jamboree jackpot entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree jackpot entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree jackpot entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree jackpot entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree jackpot entity creation timestamp.
   *
   * @return \Drupal\jamboree_jackpot\Entity\JamboreeJackpotEntityInterface
   *   The called Jamboree jackpot entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree jackpot entity published status indicator.
   *
   * Unpublished Jamboree jackpot entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree jackpot entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree jackpot entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree jackpot entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_jackpot\Entity\JamboreeJackpotEntityInterface
   *   The called Jamboree jackpot entity entity.
   */
  public function setPublished($published);

}

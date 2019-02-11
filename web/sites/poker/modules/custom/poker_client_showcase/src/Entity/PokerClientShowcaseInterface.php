<?php

namespace Drupal\poker_client_showcase\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Poker client showcase entities.
 *
 * @ingroup poker_client_showcase
 */
interface PokerClientShowcaseInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Poker client showcase name.
   *
   * @return string
   *   Name of the Poker client showcase.
   */
  public function getName();

  /**
   * Sets the Poker client showcase name.
   *
   * @param string $name
   *   The Poker client showcase name.
   *
   * @return \Drupal\poker_client_showcase\Entity\PokerClientShowcaseInterface
   *   The called Poker client showcase entity.
   */
  public function setName($name);

  /**
   * Gets the Poker client showcase creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Poker client showcase.
   */
  public function getCreatedTime();

  /**
   * Sets the Poker client showcase creation timestamp.
   *
   * @param int $timestamp
   *   The Poker client showcase creation timestamp.
   *
   * @return \Drupal\poker_client_showcase\Entity\PokerClientShowcaseInterface
   *   The called Poker client showcase entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Poker client showcase published status indicator.
   *
   * Unpublished Poker client showcase are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Poker client showcase is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Poker client showcase.
   *
   * @param bool $published
   *   TRUE to set this Poker client showcase to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\poker_client_showcase\Entity\PokerClientShowcaseInterface
   *   The called Poker client showcase entity.
   */
  public function setPublished($published);

}

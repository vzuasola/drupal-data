<?php

namespace Drupal\poker_client_promotions\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Poker client promotions entities.
 *
 * @ingroup poker_client_promotions
 */
interface PokerClientPromotionsInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Poker client promotions name.
   *
   * @return string
   *   Name of the Poker client promotions.
   */
  public function getName();

  /**
   * Sets the Poker client promotions name.
   *
   * @param string $name
   *   The Poker client promotions name.
   *
   * @return \Drupal\poker_client_promotions\Entity\PokerClientPromotionsInterface
   *   The called Poker client promotions entity.
   */
  public function setName($name);

  /**
   * Gets the Poker client promotions creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Poker client promotions.
   */
  public function getCreatedTime();

  /**
   * Sets the Poker client promotions creation timestamp.
   *
   * @param int $timestamp
   *   The Poker client promotions creation timestamp.
   *
   * @return \Drupal\poker_client_promotions\Entity\PokerClientPromotionsInterface
   *   The called Poker client promotions entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Poker client promotions published status indicator.
   *
   * Unpublished Poker client promotions are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Poker client promotions is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Poker client promotions.
   *
   * @param bool $published
   *   TRUE to set this Poker client promotions to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\poker_client_promotions\Entity\PokerClientPromotionsInterface
   *   The called Poker client promotions entity.
   */
  public function setPublished($published);

}

<?php

namespace Drupal\poker_vip_page\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Poker vip entity entities.
 *
 * @ingroup poker_vip_page
 */
interface PokerVipEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Poker vip entity name.
   *
   * @return string
   *   Name of the Poker vip entity.
   */
  public function getName();

  /**
   * Sets the Poker vip entity name.
   *
   * @param string $name
   *   The Poker vip entity name.
   *
   * @return \Drupal\poker_vip_page\Entity\PokerVipEntityInterface
   *   The called Poker vip entity entity.
   */
  public function setName($name);

  /**
   * Gets the Poker vip entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Poker vip entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Poker vip entity creation timestamp.
   *
   * @param int $timestamp
   *   The Poker vip entity creation timestamp.
   *
   * @return \Drupal\poker_vip_page\Entity\PokerVipEntityInterface
   *   The called Poker vip entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Poker vip entity published status indicator.
   *
   * Unpublished Poker vip entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Poker vip entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Poker vip entity.
   *
   * @param bool $published
   *   TRUE to set this Poker vip entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\poker_vip_page\Entity\PokerVipEntityInterface
   *   The called Poker vip entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Poker vip entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Poker vip entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\poker_vip_page\Entity\PokerVipEntityInterface
   *   The called Poker vip entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Poker vip entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Poker vip entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\poker_vip_page\Entity\PokerVipEntityInterface
   *   The called Poker vip entity entity.
   */
  public function setRevisionUserId($uid);

}

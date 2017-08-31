<?php

namespace Drupal\entrypage_partners\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Entrypage partner entities.
 *
 * @ingroup entrypage_partners
 */
interface EntrypagePartnerInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Entrypage partner name.
   *
   * @return string
   *   Name of the Entrypage partner.
   */
  public function getName();

  /**
   * Sets the Entrypage partner name.
   *
   * @param string $name
   *   The Entrypage partner name.
   *
   * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
   *   The called Entrypage partner entity.
   */
  public function setName($name);

  /**
   * Gets the Entrypage partner creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Entrypage partner.
   */
  public function getCreatedTime();

  /**
   * Sets the Entrypage partner creation timestamp.
   *
   * @param int $timestamp
   *   The Entrypage partner creation timestamp.
   *
   * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
   *   The called Entrypage partner entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Entrypage partner published status indicator.
   *
   * Unpublished Entrypage partner are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Entrypage partner is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Entrypage partner.
   *
   * @param bool $published
   *   TRUE to set this Entrypage partner to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
   *   The called Entrypage partner entity.
   */
  public function setPublished($published);

  /**
   * Gets the Entrypage partner revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Entrypage partner revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
   *   The called Entrypage partner entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Entrypage partner revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Entrypage partner revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
   *   The called Entrypage partner entity.
   */
  public function setRevisionUserId($uid);

}

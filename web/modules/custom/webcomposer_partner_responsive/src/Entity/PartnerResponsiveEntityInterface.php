<?php

namespace Drupal\webcomposer_partner_responsive\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Partner entities.
 *
 * @ingroup webcomposer_partner_responsive
 */
interface PartnerResponsiveEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Partner name.
   *
   * @return string
   *   Name of the Partner.
   */
  public function getName();

  /**
   * Sets the Partner name.
   *
   * @param string $name
   *   The Partner name.
   *
   * @return \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface
   *   The called Partner entity.
   */
  public function setName($name);

  /**
   * Gets the Partner creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Partner.
   */
  public function getCreatedTime();

  /**
   * Sets the Partner creation timestamp.
   *
   * @param int $timestamp
   *   The Partner creation timestamp.
   *
   * @return \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface
   *   The called Partner entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Partner published status indicator.
   *
   * Unpublished Partner are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Partner is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Partner.
   *
   * @param bool $published
   *   TRUE to set this Partner to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface
   *   The called Partner entity.
   */
  public function setPublished($published);

}

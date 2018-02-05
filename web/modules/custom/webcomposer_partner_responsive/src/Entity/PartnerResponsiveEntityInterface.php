<?php

namespace Drupal\webcomposer_partner_responsive\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Partner - Responsive entities.
 *
 * @ingroup webcomposer_partner_responsive
 */
interface PartnerResponsiveEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Partner - Responsive name.
   *
   * @return string
   *   Name of the Partner - Responsive.
   */
  public function getName();

  /**
   * Sets the Partner - Responsive name.
   *
   * @param string $name
   *   The Partner - Responsive name.
   *
   * @return \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface
   *   The called Partner - Responsive entity.
   */
  public function setName($name);

  /**
   * Gets the Partner - Responsive creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Partner - Responsive.
   */
  public function getCreatedTime();

  /**
   * Sets the Partner - Responsive creation timestamp.
   *
   * @param int $timestamp
   *   The Partner - Responsive creation timestamp.
   *
   * @return \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface
   *   The called Partner - Responsive entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Partner - Responsive published status indicator.
   *
   * Unpublished Partner - Responsive are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Partner - Responsive is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Partner - Responsive.
   *
   * @param bool $published
   *   TRUE to set this Partner - Responsive to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface
   *   The called Partner - Responsive entity.
   */
  public function setPublished($published);

}

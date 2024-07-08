<?php

namespace Drupal\msw_legal_agreement\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Registration Legal Agreement entities.
 *
 * @ingroup msw_legal_agreement
 */
interface MswLegalAgreementInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Registration Legal Agreement name.
   *
   * @return string
   *   Name of the Registration Legal Agreement.
   */
  public function getName();

  /**
   * Sets the Registration Legal Agreement name.
   *
   * @param string $name
   *   The Registration Legal Agreement name.
   *
   * @return \Drupal\msw_legal_agreement\Entity\MswLegalAgreementInterface
   *   The called Registration Legal Agreement entity.
   */
  public function setName($name);

  /**
   * Gets the Registration Legal Agreement creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Registration Legal Agreement.
   */
  public function getCreatedTime();

  /**
   * Sets the Registration Legal Agreement creation timestamp.
   *
   * @param int $timestamp
   *   The Registration Legal Agreement creation timestamp.
   *
   * @return \Drupal\msw_legal_agreement\Entity\MswLegalAgreementInterface
   *   The called Registration Legal Agreement entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Registration Legal Agreement published status indicator.
   *
   * Unpublished Registration Legal Agreement are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Registration Legal Agreement is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Registration Legal Agreement.
   *
   * @param bool $published
   *   TRUE to set this Registration Legal Agreement to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\msw_legal_agreement\Entity\MswLegalAgreementInterface
   *   The called Registration Legal Agreement entity.
   */
  public function setPublished($published);

}

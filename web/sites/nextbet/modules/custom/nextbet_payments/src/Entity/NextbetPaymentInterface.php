<?php

namespace Drupal\nextbet_payments\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Nextbet payment entities.
 *
 * @ingroup nextbet_payments
 */
interface NextbetPaymentInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

    // Add get/set methods for your configuration properties here.

    /**
     * Gets the Nextbet payment name.
     *
     * @return string
     *   Name of the Nextbet payment.
     */
    public function getName();

    /**
     * Sets the Nextbet payment name.
     *
     * @param string $name
     *   The Nextbet payment name.
     *
     * @return \Drupal\nextbet_payments\Entity\NextbetPaymentInterface
     *   The called Nextbet payment entity.
     */
    public function setName($name);

    /**
     * Gets the Nextbet payment creation timestamp.
     *
     * @return int
     *   Creation timestamp of the Nextbet payment.
     */
    public function getCreatedTime();

    /**
     * Sets the Nextbet payment creation timestamp.
     *
     * @param int $timestamp
     *   The Nextbet payment creation timestamp.
     *
     * @return \Drupal\nextbet_payments\Entity\NextbetPaymentInterface
     *   The called Nextbet payment entity.
     */
    public function setCreatedTime($timestamp);

    /**
     * Returns the Nextbet payment published status indicator.
     *
     * Unpublished Nextbet payment are only visible to restricted users.
     *
     * @return bool
     *   TRUE if the Nextbet payment is published.
     */
    public function isPublished();

    /**
     * Sets the published status of a Nextbet payment.
     *
     * @param bool $published
     *   TRUE to set this Nextbet payment to published, FALSE to set it to unpublished.
     *
     * @return \Drupal\nextbet_payments\Entity\NextbetPaymentInterface
     *   The called Nextbet payment entity.
     */
    public function setPublished($published);
}

<?php

namespace Drupal\zedbet_payments\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zedbet payment entities.
 *
 * @ingroup zedbet_payments
 */
interface ZedbetPaymentInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

    // Add get/set methods for your configuration properties here.

    /**
     * Gets the Zedbet payment name.
     *
     * @return string
     *   Name of the Zedbet payment.
     */
    public function getName();

    /**
     * Sets the Zedbet payment name.
     *
     * @param string $name
     *   The Zedbet payment name.
     *
     * @return \Drupal\zedbet_payments\Entity\ZedbetPaymentInterface
     *   The called Zedbet payment entity.
     */
    public function setName($name);

    /**
     * Gets the Zedbet payment creation timestamp.
     *
     * @return int
     *   Creation timestamp of the Zedbet payment.
     */
    public function getCreatedTime();

    /**
     * Sets the Zedbet payment creation timestamp.
     *
     * @param int $timestamp
     *   The Zedbet payment creation timestamp.
     *
     * @return \Drupal\zedbet_payments\Entity\ZedbetPaymentInterface
     *   The called Zedbet payment entity.
     */
    public function setCreatedTime($timestamp);

    /**
     * Returns the Zedbet payment published status indicator.
     *
     * Unpublished Zedbet payment are only visible to restricted users.
     *
     * @return bool
     *   TRUE if the Zedbet payment is published.
     */
    public function isPublished();

    /**
     * Sets the published status of a Zedbet payment.
     *
     * @param bool $published
     *   TRUE to set this Zedbet payment to published, FALSE to set it to unpublished.
     *
     * @return \Drupal\zedbet_payments\Entity\ZedbetPaymentInterface
     *   The called Zedbet payment entity.
     */
    public function setPublished($published);
}

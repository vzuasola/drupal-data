<?php

namespace Drupal\webcomposer_cache\Storage;

interface SignatureStorageInterface {
  /**
   * Gets the current signature
   *
   * @return string
   */
  public function getSignature();

  /**
   * Gets the current signature
   *
   * @param string $signature Enforces a string as the new signature
   */
  public function setSignature($signature);

  /**
   * Renews the current signature
   *
   * @return string The new signature
   */
  public function renewSignature();

  /**
   * Deletes the current signature
   */
  public function deleteSignature();
}

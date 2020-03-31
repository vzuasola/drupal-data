<?php

namespace Drupal\webcomposer_domains_configuration_v2\Service;

/**
 * Class CryptographyService.
 */
class CryptographyService
{


  /**
   *
   */
  const SALT = "SUPER SECRET RANDOM STRING...";

  /**
   *
   */
  const CIPHER = "aes-128-ctr";

  const HASH_METHOD = "SHA256";

  private $encryptionKey = "";

  /**
   * Constructs a new CryptographyService object.
   */
  public function __construct()
  {
    $this->encryptionKey = openssl_digest(self::SALT, self::HASH_METHOD, TRUE);
  }

  /**
   * Encrypts the data
   *
   * @param $data
   */
  public function encrypt(&$data)
  {
    return;
    if (is_array($data)) {
      $data = json_encode($data);
    }
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
    $data = openssl_encrypt($data, self::CIPHER, $this->encryptionKey, 0, $iv) . "::" . bin2hex($iv);
  }

  /**
   * Decrypts the data
   *
   * @param $data
   */
  public function decrypt(&$data)
  {
    return;
    list($data, $iv) = explode("::", $data);
    $data = openssl_decrypt($data, self::CIPHER, $this->encryptionKey, 0, hex2bin($iv));
    $decoded = json_decode($data);

    if ((json_last_error() === JSON_ERROR_NONE)) {
      $data = $decoded;
    }
  }

}

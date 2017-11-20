<?php

namespace Drupal\webcomposer_marketing_script\Form\Providers\AdElement;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * AdElement parser class.
 */
class AdElementParser extends ConfigFormBase {

  const SALT = 'v4l4rm0rghul1$!g0tv4l4rd0h43r1$!';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'MarketingScript_providers_adelement_parser';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['decrypt'] = [
      '#type' => 'textarea',
      '#title' => t('Encrypted Usernames'),
      '#description' => $this->t('List down all encrypted usernames and click DECRYPT button to decrypt usernames.'),
    ];

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $encrypted = explode(PHP_EOL, trim($form_state->getValue('decrypt')));
    if (!empty($encrypted) && count($encrypted) > 1) {
        $data = "Encrypted Username,Decrypted Username\n";
        foreach ($encrypted as $username) {
            $eusername = $this->encode(trim($username), self::SALT);
            $data .= trim($username).",".$this->decode(trim($eusername), self::SALT)."\n";
        }

        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="Player-List(' . date("Y-m-d") . ').csv"');
        echo $data;
        exit();
    }
  }

  private  function safe_b64encode($string) {
      $data = base64_encode($string);
      $data = str_replace(array('+','/','='),array('-','_',''),$data);
      return $data;
  }

  private function safe_b64decode($string) {
      $data = str_replace(array('-','_'),array('+','/'),$string);
      $mod4 = strlen($data) % 4;
      if ($mod4) {
          $data .= substr('====', $mod4);
      }
      return base64_decode($data);
  }

  private  function encode($value, $salt) { 
      if(!$value){return false;}
      $text = $value;
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, $iv);
      return trim($this->safe_b64encode($crypttext)); 
  }

  private function decode($value, $salt) {
      if(!$value){return false;}
      $crypttext = $this->safe_b64decode($value); 
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, $crypttext, MCRYPT_MODE_ECB, $iv);
      return trim($decrypttext);
  }
}

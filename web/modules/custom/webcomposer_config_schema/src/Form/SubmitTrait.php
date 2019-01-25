<?php

namespace Drupal\webcomposer_config_schema\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Datetime\DrupalDateTime;

trait SubmitTrait {
  /**
   *
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $data = [];

    $this->constructSaveData($data, $form, $form_state);
    $this->processUploads($data);

    $this->save($data);
  }

  /**
   *
   */
  private function constructSaveData(&$data, array $form, FormStateInterface $form_state) {
    $excluded_types = ['vertical_tabs'];

    foreach ($form as $key => $value) {
      if (strpos($key, '#') === 0) {
        continue;
      }

      if (is_array($value)) {
        if (isset($value['#type']) &&
          array_key_exists('#default_value', $value) &&
          !in_array($value['#type'], $excluded_types)) {
            $values = $form_state->getValue($key);

            // Checking if value is instance of DrupalDateTime.
            if ($values instanceof DrupalDateTime) {
              $values = $values->getTimestamp();
            }

            $data[$key] = $values;
        }

        $this->constructSaveData($data, $value, $form_state);
      }
    }

    unset($data['form_token']);

    return $data;
  }

  /**
   *
   */
  private function processUploads($data) {
    foreach ($data as $key => $value) {
      if (0 === strpos($key, 'file_image') && isset($value[0])) {
        $file = File::load($value[0]);

        if ($file) {
          $file->setPermanent();
          $file->save();
        }
      }
    }
  }
}

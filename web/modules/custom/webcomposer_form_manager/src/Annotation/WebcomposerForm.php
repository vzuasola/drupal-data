<?php

namespace Drupal\webcomposer_form_manager\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Form manager item annotation object.
 *
 * @see \Drupal\webcomposer_form_manager\Plugin\WebcomposerFormManager
 * @see plugin_api
 *
 * @Annotation
 */
class WebcomposerForm extends Plugin {
  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the form.
   *
   * @var string
   */
  public $name;
}

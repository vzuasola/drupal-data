<?php

namespace Drupal\draggableviews\Plugin\views\join;

use Drupal\views\Plugin\views\join\JoinPluginBase;
use Drupal\Core\Language\LanguageInterface;

/**
 *
 * @ingroup views_join_handlers
 *
 * @ViewsJoin("draggableviews_with_args")
 */
class WithArgs extends JoinPluginBase {
  /**
   * {@inheritdoc}
   */
  public function buildJoin($select_query, $table, $view_query) {
    $language = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
    $view_args = [];
    // check if there are view args - only include if not skipped.
    foreach ($view_query->view->argument as $arg) {
      if (!$arg->options['default_argument_skip_url']) {
        $view_args[] = $arg->argument;
      }
    }
    // get the expose filters
    $exposedInput = $view_query->view->getExposedInput();
    // unset format for rest views
    unset($exposedInput['_format']);
    // remove empty arguments
    $exposedInput = array_diff($exposedInput, ['']);
    if (!empty($exposedInput)) {
        $view_args += $exposedInput;
        $view_args['language'] = $language;
    }

    if (!empty($view_args)) {
        $view_args = json_encode($view_args);
    } else {
        $view_args = $language;
    }

    if (!isset($this->extra)) {
      $this->extra = [];
    }

    if (is_array($this->extra)) {
      $found = FALSE;
      foreach ($this->extra as $info) {
        if (empty(array_diff(array_keys($info), array('field', 'value'))) && $info['field'] == 'args' && $info['value'] == $view_args) {
          $found = TRUE;
          break;
        }
      }

      if (!$found) {
        $this->extra[] = ['field' => 'args', 'value' => $view_args];
      }
    }

    parent::buildJoin($select_query, $table, $view_query);
  }
}
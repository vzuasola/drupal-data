<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\Component\Plugin\PluginBase;

use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormFieldEntity;

/**
 * Base class for Form manager plugins.
 */
abstract class WebComposerFormBase extends PluginBase implements WebcomposerFormInterface {
    /**
     *
     */
    protected function form($id, $name, $settings = []) {
        return new WebcomposerFormEntity($id, $name, $settings);
    }

    /**
     *
     */
    protected function field($id, $name, $type, $options = [], $settings = []) {
        return new WebcomposerFormFieldEntity($id, $name, $type, $options, $settings);
    }

}

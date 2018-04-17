<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Robots configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_robots",
 *   route = {
 *     "title" = "Robots Configuration",
 *     "path" = "/admin/config/webcomposer/config/robots",
 *   },
 *   menu = {
 *     "title" = "Robots Configuration",
 *     "description" = "Provides configuration for robots text",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class RobotsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.robots_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['robots_configuration'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Robots Configuration'),
      '#rows' => 15,
      '#description' => $this->t("Appends the Robots value for your site.
        <br>
        Should only be applicable for main domains like <strong>www.dafabet.com/robots.txt</strong>"),
      '#default_value' => $this->get('robots_configuration'),
    ];

    return $form;
  }
}

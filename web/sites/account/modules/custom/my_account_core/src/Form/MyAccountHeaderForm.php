<?php

namespace Drupal\my_account_core\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\Core\Routing\RequestContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class MyAccountHeaderForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {

    return ['my_account_core.header'];
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['header'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Welcome Text',
      '#group' => 'header',
    ];

    $form['field_configuration']['welcome_text'] = [
      '#type' => 'textfield',
      '#title' => t('Welcome text'),
      '#required' => TRUE,
      '#description' => $this->t('Text for welcome text appear at the header top navigation.'),
      '#default_value' => $this->get('welcome_text'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['product_menu_new_tag'] = [
      '#type' => 'textfield',
      '#title' => t('New Tag'),
      '#required' => TRUE,
      '#description' => $this->t('Text for new tag'),
      '#default_value' => $this->get('product_menu_new_tag'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['help_tooltip'] = [
      '#type' => 'textfield',
      '#title' => t('Help Tooltip'),
      '#required' => TRUE,
      '#description' => $this->t('Tooltip for help'),
      '#default_value' => $this->get('help_tooltip'),
      '#translatable' => TRUE,
    ];
    $form['field_configuration']['error_mid_down'] = [
      '#type' => 'textarea',
      '#title' => t('Error Message MID Down'),
      '#size' => 500,
      '#required' => TRUE,
      '#description' => $this->t('General Error Message across all forms of my account if MID is down.'),
      '#default_value' => $this->get('error_mid_down'),
      '#translatable' => TRUE,
    ];

    return $form;
  }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('config.factory'),
            $container->get('path.alias_manager'),
            $container->get('path.validator'),
            $container->get('router.request_context')
        );
    }
}

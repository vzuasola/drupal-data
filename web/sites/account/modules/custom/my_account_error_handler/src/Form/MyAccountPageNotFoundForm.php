<?php

namespace Drupal\my_account_error_handler\Form;

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
class MyAccountPageNotFoundForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_error_handler.404'];
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['page_not_found'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'page_not_found',
      '#open' => TRUE,
    ];

    $form['field_configuration']['top_blurb'] = [
      '#type' => 'textarea',
      '#title' => t('Top Blurb'),
      '#required' => TRUE,
      '#description' => $this->t('Top Blurb'),
      '#default_value' => $this->get('top_blurb'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['bottom_blurb'] = [
      '#type' => 'textarea',
      '#title' => t('Bottom Blurb'),
      '#required' => TRUE,
      '#description' => $this->t('Bottom Blurb'),
      '#default_value' => $this->get('bottom_blurb'),
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

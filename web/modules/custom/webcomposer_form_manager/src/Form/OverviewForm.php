<?php

namespace Drupal\webcomposer_form_manager\Form;

use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;

/**
 * Class List.
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class OverviewForm extends FormBase {
  /**
   * Class constructor.
   */
  public function __construct($typedConfigManager, $languageManager, $formManager, $moduleHandler) {
    parent::__construct($typedConfigManager, $languageManager, $moduleHandler);

    $this->formManager = $formManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.typed'),
      $container->get('language_manager'),
      $container->get('webcomposer_form_manager.form_manager'),
      $container->get('module_handler')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_form_manager.list',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_form_manager.overview_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $formList = $this->formManager->getFormList();
    $rows = [];

    foreach ($formList as $key => $value) {
      $url = new Url('webcomposer_form_manager.form.view', ['form' => $key]);

      $rows[] = [
        'title' => $value['name'],
        'actions' => $this->l('Manage', $url),
      ];
    }

    $header = [
      'name' => 'Name',
      'actions' => 'Actions',
    ];

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => 'No form to show',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
  }
}

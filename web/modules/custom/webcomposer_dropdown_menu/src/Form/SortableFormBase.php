<?php

namespace Drupal\webcomposer_dropdown_menu\Form;

use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;

/**
 * Sortable Form Base
 *
 * @package Drupal\webcomposer_dropdown_menu\Form
 */
class SortableFormBase extends FormBase {
  const DEFAULT_REGION = 'disable';

  /**
   * Class constructor.
   */
  public function __construct($typed_config_manager, $language_manager, $drop_down_manager) {
    parent::__construct($typed_config_manager, $language_manager);
    $this->dropDownManager = $drop_down_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.typed'),
      $container->get('language_manager'),
      $container->get('webcomposer_dropdown_menu.dropdown_menu_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_dropdown_menu.dropdown_menu',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultConfigName() {
    return 'webcomposer_dropdown_menu.dropdown_menu';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_dropdown_menu.dropdown_menu_sort_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $header = [
      'name' => $this->t('Name'),
      'region' => $this->t('Group'),
      'weight' => $this->t('Weight'),
      'actions' => $this->t('Actions'),
    ];

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#empty' => $this->t('No entries to show'),
      '#attributes' => [
        'id' => 'blocks',
      ],
    ];

    $form['#attached']['library'][] = 'block/drupal.block';

    // reorganize the sort data according to the fetched saved data
    // although this can be moved to the managers, put it here for now

    $name = $this->getDefaultConfigName();
    $sort_data = $this->getConfigValues($name, 'sort');

    $groupList = $this->dropDownManager->getSectionsByRegions($sort_data);
    $regions = array_combine(array_keys($groupList), array_keys($groupList));

    // kint_require();
    // d($groupList);

    foreach ($groupList as $key => $tiles) {
      $form['table']['#tabledrag'][] = [
        'action' => 'match',
        'relationship' => 'sibling',
        'group' => 'block-region-select',
        'subgroup' => 'block-region-' . $key,
      ];

      $form['table']['#tabledrag'][] = [
        'action' => 'order',
        'relationship' => 'sibling',
        'group' => 'block-weight',
        'subgroup' => 'block-weight-' . $key,
      ];

      $form['table']['region-' . $key] = [
        '#attributes' => [
          'class' => ['region-title', 'region-title-' . $key],
          'no_striping' => TRUE,
        ],
      ];

      $form['table']['region-' . $key]['title'] = [
        '#theme_wrappers' => [
          'container' => [
            '#attributes' => ['class' => 'region-title__action'],
          ]
        ],
        '#prefix' => ucfirst($key),
        '#type' => 'link',
        '#wrapper_attributes' => [
          'colspan' => 5,
        ],
      ];

      $form['table']['region-' . $key . '-message'] = [
        '#attributes' => [
          'class' => [
            'region-message',
            'region-' . $key . '-message',
            empty($tiles) ? 'region-empty' : 'region-populated',
          ],
        ],
      ];

      $form['table']['region-' . $key . '-message']['message'] = [
        '#markup' => '<em>' . $this->t('No entries in this region') . '</em>',
        '#wrapper_attributes' => [
          'colspan' => 5,
        ],
      ];

      foreach ($tiles as $tile => $definition) {
        $form['table'][$tile] = [
          '#attributes' => [
            'class' => ['draggable'],
          ],
        ];

        $form['table'][$tile]['title'] = [
          '#markup' => ucfirst($definition['name']),
        ];

        $form['table'][$tile]['region'] = [
          '#type' => 'select',
          '#title' => $this->t('Region'),
          '#title_display' => 'invisible',
          '#options' => $regions,
          '#default_value' => $definition['region'],
          '#default_value' => 'content',
          '#attributes' => [
            'class' => ['block-region-select', 'block-region-' . $key],
          ],
        ];

        $form['table'][$tile]['weight'] = [
          '#type' => 'weight',
          '#title' => 'Weight',
          '#title_display' => 'invisible',
          '#default_value' => $definition['weight'],
          '#attributes' => [
            'class' => ['block-weight', 'block-weight-' . $key],
          ],
        ];

        $url = new Url('webcomposer_domain.domain.view', [
          'domain' => 'alex',
        ]);

        $form['table'][$tile]['actions'] = [
          'data' => [
            '#type' => 'operations',
            '#links' => [
              'edit' => [
                'url' => $url,
                'title' => 'Edit'
              ],
            ],
          ],
        ];
      }
    }

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
    kint_require();
    parent::submitForm($form, $form_state);

    $name = $this->getDefaultConfigName();

    $sort = [];
    $data = $form_state->getValue('table');

    foreach ($data as $key => $value) {
      $sort[$key] = $value;
    }

    $this->saveRawConfigValue($name, 'sort', $sort);
  }
}

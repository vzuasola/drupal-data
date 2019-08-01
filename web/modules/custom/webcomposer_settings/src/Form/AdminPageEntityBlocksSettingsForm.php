<?php

namespace Drupal\webcomposer_settings\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Menu\MenuTreeParameters;

/**
 * Filter Entity configuration plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_settings_entity_settings",
 *   route = {
 *     "title" = "Entity Blocks Settings",
 *     "path" = "/admin/config/webcomposer/config/admin_page_entity_blocks_settings",
 *   },
 *   menu = {
 *     "title" = "Entity Blocks Settings",
 *     "description" = "Provides additional settings",
 *     "parent" = "webcomposer_config.list",
 *     "weight" = 100,
 *   },
 * )
 */
class AdminPageEntityBlocksSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_settings.admin_page_entity_blocks_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['#disabled_form_filter'] = true;

    $parameters = new MenuTreeParameters();
    $parameters->setRoot('system.admin_config')->excludeRoot()->onlyEnabledLinks();
    $tree = \Drupal::service('menu.link_tree')->load(NULL, $parameters);

    $items = [];
    foreach ($tree as $desc => $menu) {
      if (strpos($desc, 'webcomposer') === 0) {
        $parent = str_replace('.', '__', $desc);

        $form[$parent] = [
          '#type' => 'checkbox',
          '#title' => 'Hide <span class="ui-state-highlight">' . $menu->link->getTitle() . '</span> Panel',
          '#default_value' => $this->get($parent),
          '#attributes' => [
            'class' => ['entity-blocks-filter'],
          ],
          '#prefix' => '<hr />',
        ];

        if (!empty($menu->subtree)) {
          foreach ($menu->subtree as $submenu) {
            $key = str_replace('.', '__', $submenu->link->getPluginId());
            $key = str_replace(':', '___', $key);

            $form[$key] = [
              '#type' => 'checkbox',
              '#title' => 'Hide ' . $submenu->link->getTitle(),
              '#default_value' => $this->get($key),
              '#attributes' => [
                'class' => ['entity-blocks-filter-child'],
              ],
              '#prefix' => '<div class="form-item-options-expose-label ' . $parent . '">',
              '#suffix' => '</div>',
            ];
          }
        }
      }
    }

    $form['#attached']['library'][] = 'webcomposer_settings/webcomposer_settings.entity_blocks_filter';

    return $form;
  }
}

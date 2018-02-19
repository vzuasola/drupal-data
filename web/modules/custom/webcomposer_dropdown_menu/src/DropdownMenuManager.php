<?php

namespace Drupal\webcomposer_dropdown_menu;

use Drupal\Component\Utility\SortArray;

/**
 *
 */
class DropdownMenuManager {
  /**
   * Initial list of regions
   */
  const REGIONS = [
    'content' => 'Content',
    'disable' => 'Disabled',
  ];

  /**
   * The default region
   */
  const DEFAULT_REGION = 'disable';

  /**
   * Class constructor.
   */
  public function __construct($plugin_manager, $config_factory) {
    $this->pluginManager = $plugin_manager;
    $this->configFactory = $config_factory;
  }

  /**
   *
   */
  public function getRegions() {
    return self::REGIONS;
  }

  /**
   *
   */
  public function getSectionsByRegions($data = []) {
    $result = [];
    $sections = [];

    $definitions = $this->pluginManager->getDefinitions();

    $i = 0;

    foreach ($definitions as $section => $definition) {
      $weight = ++ $i;
      $region = self::DEFAULT_REGION;

      if (isset($data[$section]['region'])) {
        $region = $data[$section]['region'];
      }

      if (isset($data[$section]['weight'])) {
        $weight = $data[$section]['weight'];
      }

      $definition['weight'] = $weight;
      $definition['region'] = $region;

      $sections[$section] = $definition;
    }

    uasort($sections, function ($a, $b) use ($result) {
      return SortArray::sortByKeyInt($a, $b, 'weight');
    });

    $regions = $this->getRegions();

    // put all region on the resulting array
    foreach ($regions as $key => $value) {
      $result[$key] = [];
    }

    // put the section unto the respective regions
    foreach ($sections as $key => $definition) {
      $region = $definition['region'];

      if (!isset($regions[$region])) {
        $region = self::DEFAULT_REGION;
      }

      $result[$region][$key] = $definition;
    }

    return $result;
  }
}

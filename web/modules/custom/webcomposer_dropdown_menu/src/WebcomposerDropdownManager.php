<?php

namespace Drupal\webcomposer_dropdown_menu;

use Drupal\Component\Utility\SortArray;

/**
 *
 */
class WebcomposerDropdownManager {
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
  public function __construct($plugin_manager, $schema_base) {
    $this->pluginManager = $plugin_manager;

    $this->schemaBase = $schema_base;
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
  public function getEnabledSections() {
    $sections = $this->getSections();

    $disabled = self::DEFAULT_REGION;

    $sections = array_filter($sections, function ($value) use ($disabled) {
      return $value['region'] !== $disabled;
    });

    return $sections;
  }

  /**
   *
   */
  public function getSections() {
    $i = 0;
    $sections = [];

    $this->schemaBase->setEditableConfigNames([
      'webcomposer_dropdown_menu.dropdown_menu',
    ]);

    $data = $this->schemaBase->getConfigValues('webcomposer_dropdown_menu.dropdown_menu', 'sort');

    $definitions = $this->pluginManager->getDefinitions();

    foreach ($definitions as $section => $definition) {
      $weight = ++ $i;
      $region = self::DEFAULT_REGION;

      if (isset($data[$section]['region'])) {
        $region = $data[$section]['region'];
      }

      if (isset($data[$section]['weight'])) {
        $weight = $data[$section]['weight'];
      }

      // attempt to fetch settings
      try {
        $this->schemaBase->setEditableConfigNames([
          "webcomposer_dropdown_menu.dropdown_menu.section.$section",
        ]);

        $settings = $this->schemaBase
          ->getConfigValuesAll("webcomposer_dropdown_menu.dropdown_menu.section.$section");

      } catch (\Exception $e) {
        $settings = [];
      }

      $definition['settings'] = $settings;
      $definition['weight'] = $weight;
      $definition['region'] = $region;

      $sections[$section] = $definition;
    }

    uasort($sections, function ($a, $b) {
      return SortArray::sortByKeyInt($a, $b, 'weight');
    });

    return $sections;
  }

  /**
   *
   */
  public function getSectionsByRegions() {
    $result = [];
    $sections = [];

    $this->schemaBase->setEditableConfigNames([
      'webcomposer_dropdown_menu.dropdown_menu',
    ]);

    $data = $this->schemaBase->getConfigValues('webcomposer_dropdown_menu.dropdown_menu', 'sort');

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

      // attempt to fetch settings
      try {
        $this->schemaBase->setEditableConfigNames([
          "webcomposer_dropdown_menu.dropdown_menu.section.$section",
        ]);

        $settings = $this->schemaBase
          ->getConfigValuesAll("webcomposer_dropdown_menu.dropdown_menu.section.$section");

      } catch (\Exception $e) {
        $settings = [];
      }

      $definition['settings'] = $settings;
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

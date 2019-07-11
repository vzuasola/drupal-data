<?php

namespace Drupal\webcomposer_dashboard\Controller;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Menu\MenuLinkTreeInterface;
use Drupal\Core\Menu\MenuTreeParameters;
use Drupal\Core\Theme\ThemeAccessCheck;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\system\SystemManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for System routes.
 */
class SystemController extends ControllerBase {

  /**
   * System Manager Service.
   *
   * @var \Drupal\system\SystemManager
   */
  protected $systemManager;

  /**
   * The theme access checker service.
   *
   * @var \Drupal\Core\Theme\ThemeAccessCheck
   */
  protected $themeAccess;

  /**
   * The form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * The theme handler service.
   *
   * @var \Drupal\Core\Extension\ThemeHandlerInterface
   */
  protected $themeHandler;

  /**
   * The menu link tree service.
   *
   * @var \Drupal\Core\Menu\MenuLinkTreeInterface
   */
  protected $menuLinkTree;

  /**
   * Constructs a new SystemController.
   *
   * @param \Drupal\system\SystemManager $systemManager
   *   System manager service.
   * @param \Drupal\Core\Theme\ThemeAccessCheck $theme_access
   *   The theme access checker service.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   * @param \Drupal\Core\Extension\ThemeHandlerInterface $theme_handler
   *   The theme handler.
   * @param \Drupal\Core\Menu\MenuLinkTreeInterface $menu_link_tree
   *   The menu link tree service.
   */
  public function __construct(
    SystemManager $systemManager,
    ThemeAccessCheck $theme_access,
    FormBuilderInterface $form_builder,
    ThemeHandlerInterface $theme_handler,
    MenuLinkTreeInterface $menu_link_tree
  ) {
    $this->systemManager = $systemManager;
    $this->themeAccess = $theme_access;
    $this->formBuilder = $form_builder;
    $this->themeHandler = $theme_handler;
    $this->menuLinkTree = $menu_link_tree;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('system.manager'),
      $container->get('access_check.theme'),
      $container->get('form_builder'),
      $container->get('theme_handler'),
      $container->get('menu.link_tree')
    );
  }

  /**
   * Provide the administration overview page.
   *
   * @return array
   *   A renderable array of the administration overview page.
   */
  public function overview() {
    // Load all menu links below it.
    $parameters = new MenuTreeParameters();
    $parameters->setRoot('system.admin_config')->excludeRoot()->setTopLevelOnly()->onlyEnabledLinks();

    $tree = $this->menuLinkTree->load(NULL, $parameters);

    $manipulators = [
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
    ];

    $tree = $this->menuLinkTree->transform($tree, $manipulators);
    $tree_access_cacheability = new CacheableMetadata();

    $blocks = [];

    foreach ($tree as $key => $element) {
      $tree_access_cacheability = $tree_access_cacheability->merge(CacheableMetadata::createFromObject($element->access));

      if (strpos($element->link->getRouteName(), 'webcomposer') !== 0) {
        continue;
      }

      // Only render accessible links.
      if (!$element->access->isAllowed()) {
        continue;
      }

      $link = $element->link;
      $block['title'] = $link->getTitle();
      $block['description'] = $link->getDescription();
      $block['content'] = [
        '#theme' => 'admin_block_content',
        '#content' => $this->systemManager->getAdminBlock($link),
      ];

      if (!empty($block['content']['#content'])) {
        $blocks[$key] = $block;
      }
    }

    $build = [];

    $message = "Only Webcomposer Specific Configurations are listed here";
    $message = $this->getInfoMessage();

    $build['message'] = [
      '#theme' => 'status_messages',
      '#message_list' => [
        'warning' => [$message],
      ],
    ];

    if ($blocks) {
      ksort($blocks);
      $build['admin'] = [
        '#theme' => 'admin_page',
        '#blocks' => $blocks,
      ];
      $tree_access_cacheability->applyTo($build);
      return $build;
    }
    else {
      $build['admin'] = [
        '#markup' => $this->t('You do not have any administrative items.'),
      ];
      $tree_access_cacheability->applyTo($build);
      return $build;
    }
  }

  /**
   *
   */
  private function getInfoMessage() {
    $link = Link::createFromRoute(t('here'), 'system.admin_config')->toString();

    return t("Only Webcomposer Specific Configurations are listed here. You can view all configurations <strong>$link</strong>");
  }
}

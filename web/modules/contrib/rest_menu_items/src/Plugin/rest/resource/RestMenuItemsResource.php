<?php
/**
 * @file
 * Create the menu item REST resource.
 */

namespace Drupal\rest_menu_items\Plugin\rest\resource;

use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Menu\MenuTreeParameters;
use Drupal\Core\Path\AliasManagerInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Cache\CacheableMetadata;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Psr\Log\LoggerInterface;

/**
 * Provides a resource to get bundles by entity.
 *
 * @RestResource(
 *   id = "rest_menu_item",
 *   label = @Translation("Menu items per menu"),
 *   uri_paths = {
 *     "canonical" = "/api/menu_items/{menu_name}"
 *   }
 * )
 */
class RestMenuItemsResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * A instance of entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * A instance of the alias manager.
   *
   * @var \Drupal\Core\Path\AliasManagerInterface
   */
  protected $aliasManager;

  /**
   * A list of menu items.
   *
   * @var array
   */
  protected $menuItems = array();

  /**
   * The maximum depth we want to return the tree.
   *
   * @var int
   */
  protected $maxDepth = 0;

  /**
   * The minimum depth we want to return the tree from.
   *
   * @var int
   */
  protected $minDepth = 1;

  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    EntityManagerInterface $entity_manager,
    AccountProxyInterface $current_user,
    AliasManagerInterface $alias_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);

    $this->entityManager = $entity_manager;
    $this->currentUser = $current_user;
    $this->aliasManager = $alias_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('rest'),
      $container->get('entity.manager'),
      $container->get('current_user'),
      $container->get('path.alias_manager')
    );
  }

  /**
   * Responds to GET requests.
   *
   * Returns a list of menu items for specified menu name.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing a list of bundle names.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   A HTTP Exception.
   */
  public function get($menu_name = NULL) {
    if ($menu_name) {
      // Setup permissions.
      // $permission = 'View published content';
      // if (!$this->currentUser->hasPermission($permission)) {
      //   throw new AccessDeniedHttpException();
      // }

      // Setup variables.
      $this->setup();

      $menu_tree = \Drupal::menuTree();

      // Set the parameters.
      $parameters = new MenuTreeParameters();
      // Comment out this line as this is causing issues for parent-child relationship
      // in terms of enabled/disabled feature
      //$parameters->onlyEnabledLinks();

      if (!empty($this->maxDepth)) {
        $parameters->setMaxDepth($this->maxDepth);
      }

      $parameters->setMinDepth($this->minDepth);

      // Load the tree based on this set of parameters.
      $tree = $menu_tree->load($menu_name, $parameters);

      // Only load menu which has an existing tree
      if (!empty($tree)) {
        // Transform the tree using the manipulators you want.
        $manipulators = array(
          // Only show links that are accessible for the current user.
          array('callable' => 'menu.default_tree_manipulators:checkAccess'),
          // Use the default sorting of menu links.
          array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
        );

        $tree = $menu_tree->transform($tree, $manipulators);

        // Finally, build a renderable array from the transformed tree.
        $menu = $menu_tree->build($tree);

        $this->getMenuItems($menu['#items'], $this->menuItems);

        if (!empty($this->menuItems)) {
          $build = array(
            '#cache' => array(
              'max-age' => 0,
            ),
          );

          $cacheMetadata = CacheableMetadata::createFromRenderArray($build);
          $resource = new ResourceResponse(array_values($this->menuItems));

          return $resource->addCacheableDependency($build);
        }
      }

      throw new NotFoundHttpException(t('Menu items for menu name @menu were not found', array('@menu' => $menu_name)));
    }

    throw new HttpException(t("Menu name was not provided"));
  }

  /**
   * Generate the menu tree we can use in JSON.
   *
   * @param array $tree
   *   The menu tree.
   * @param array $items
   *   The already created items.
   */
  private function getMenuItems(array $tree, array &$items = array()) {
    foreach ($tree as $item_value) {
      /* @var $org_link \Drupal\Core\Menu\MenuLinkDefault */
      $org_link = $item_value['original_link'];
      $item_name = $org_link->getDerivativeId();
      if (empty($item_name)) {
        $item_name = $org_link->getBaseId();
      }

      /* @var $url \Drupal\Core\Url */
      $url = $item_value['url'];

      $external = FALSE;
      if ($url->isExternal()) {
        $uri = $url->getUri();
        $external = TRUE;
      }
      else {
        try {
          $uri = $url->getInternalPath();
        }
        catch (\UnexpectedValueException $e) {
          // if the path is relative in Drupal, but does not exist, we use the
          // actual menu path as our uri
          $uri = $url->getUri();
          $uri = str_replace('base:', '', $uri);
        }
      }

      $alias = $this->aliasManager->getAliasByPath("/$uri");

      // pull the additional attributes
      $attr = array();
      $options = $item_value['url']->getOptions();

      if (isset($options['attributes'])) {
        foreach($options['attributes'] as $key => $value) {
          $attr[$key] = $value;
        }
      }

      // initialize query string 
      $queryString = '';
      // only append the query string if the uri is relative
      if (!$url->isExternal() && isset($options['query'])) {
        // build query param
        $query = http_build_query($options['query']);
        // decode query param 
        $query = urldecode($query);
        if (!empty($query)) {
          $queryString = "?$query";
        }
      }

      // initialize fragment
      $fragment = '';
      // append the fragment if it exists
      if (isset($options['fragment'])) {
        $fragment = '#' . $options['fragment'];
      }

      // if the URI is blank but a query parameter is introduced
      if ($uri === "" && empty($options['fragment'])) {
        try {
          $route_name = $url->getRoutename();

          if ($route_name === '<none>') {
            $uri = '#';
            $alias = '#';
          }
        } catch (\Exception $e) {
          // do nothing
        }
      }

      $final_alias = ltrim($alias, '/');
      $alias = $final_alias == '' ? '/' : $final_alias;

      $items[$item_name] = array(
        'key' => $item_name,
        'title' => $org_link->getTitle(),
        'uri' => "$uri$queryString$fragment",
        'alias' => "$alias$queryString$fragment",
        'external' => $external,
        'attributes' => $attr,
      );

      if (!empty($item_value['below'])) {
        $items[$item_name]['below'] = array();
        $this->getMenuItems($item_value['below'], $items[$item_name]['below']);
      }
    }
  }

  /**
   * This function is used to generate some variables we need to use.
   *
   * These variables are available in the url.
   */
  private function setup() {
    // Get the current request.
    $request = \Drupal::request();

    // Get and set the max depth if available.
    $max = $request->get('max_depth');
    if (!empty($max)) {
      $this->maxDepth = $max;
    }

    // Get and set the min depth if available.
    $min = $request->get('min_depth');
    if (!empty($min)) {
      $this->minDepth = $min;
    }
  }

}

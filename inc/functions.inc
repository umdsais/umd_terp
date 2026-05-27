<?php

/**
 * @file
 * Functions for umd_terp theme.
 */

use Drupal\node\Entity\Node;
use Drupal\Core\Cache\CacheableMetadata;

/**
 * Helper to render a menu tree by menu ID into a render array.
 */
function _umd_terp_render_menu($menu_id) {
  $menu_tree = \Drupal::service('menu.link_tree');
  $parameters = $menu_tree->getCurrentRouteMenuTreeParameters($menu_id);
  $parameters->setMaxDepth(1);
  $tree = $menu_tree->load($menu_id, $parameters);
  $manipulators = [
    ['callable' => 'menu.default_tree_manipulators:checkAccess'],
    ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
  ];
  $tree = $menu_tree->transform($tree, $manipulators);
  return $menu_tree->build($tree);
}

/**
 * Make all theme settings available to insert in pages/nodes/etc.
 *
 * Added to pages by default in hook_preproccess_node above.
 * Can extend in sub-theme to nodes/etc if needed.
 *
 * Use in theme by var name, as {{twitter_link}} /etc.
 */
function _umd_terp_extend_theme_variables(&$variables) {
  $variables['site_name'] = \Drupal::config('system.site')->get('name');
  $variables['theme_name'] = \Drupal::theme()->getActiveTheme()->getName();
  $variables['site_slogan'] = \Drupal::config('system.site')->get('slogan');
  $variables['logo_width'] = '';
  $variables['logo_height'] = '';
  $variables['theme_path'] = \Drupal::service('file_url_generator')->generateString(\Drupal::service('file_url_generator')->generateAbsoluteString(\Drupal::service('extension.list.theme')->getPath($variables['theme_name'])));
  $logo_path = theme_get_setting('logo.url');
  if (!empty($logo_path)) {
    $variables['logo_path'] = \Drupal::service('file_url_generator')->generateString(\Drupal::service('file_url_generator')->generateAbsoluteString($logo_path));

    $logo_realpath = \Drupal::service('file_system')->realpath($logo_path);
    if (!empty($logo_realpath) && is_file($logo_realpath)) {
      $logo_size = @getimagesize($logo_realpath);
      if (!empty($logo_size[0]) && !empty($logo_size[1])) {
        $variables['logo_width'] = $logo_size[0];
        $variables['logo_height'] = $logo_size[1];
      }
    }
  }

  $theme_settings = \Drupal::config($variables['theme_name'] . '.settings');
  CacheableMetadata::createFromRenderArray($variables)
    ->addCacheableDependency($theme_settings)
    ->applyTo($variables);
  $variables += $theme_settings->getOriginal();
  // Add full assets_path.
  if (!empty($variables['umd_terp_assets_path'])) {
    $variables['assets_path'] = $variables['theme_path'] . $variables['umd_terp_assets_path'];
  }

  // Render mega footer menus when the mega footer type is active.
  if (!empty($variables['umd_terp_footer_type']) && $variables['umd_terp_footer_type'] === 'mega') {
    $variables['mega_footer_menu_one'] = _umd_terp_render_menu('footer-mega-menu-column-one');
    $variables['mega_footer_menu_two'] = _umd_terp_render_menu('footer-mega-menu-column-two');
    $variables['mega_footer_menu_three'] = _umd_terp_render_menu('footer-mega-menu-column-three');
  }

  // Render utility menu links for the header if the menu exists and has items.
  $utility_menu = \Drupal::entityTypeManager()->getStorage('menu')->load('utility-menu');
  if ($utility_menu) {
    $variables['utility_menu_links'] = _umd_terp_render_menu('utility-menu');
  }
}

/**
 * Custom function to help with previews/revisions.
 */
function _umd_terp_get_node_by_route() {
  $route_name = \Drupal::routeMatch()->getRouteName();
  $node = FALSE;
  switch ($route_name) {
    case 'entity.node.canonical':
      $node = \Drupal::routeMatch()->getParameter('node');
      break;

    case 'entity.node.preview':
      $node = \Drupal::routeMatch()->getParameter('node_preview');
      break;

    case 'entity.node.revision':
      $revision_id = \Drupal::routeMatch()->getRawParameter('node_revision');
      $node = \Drupal::entityTypeManager()->getStorage('node')->loadRevision($revision_id);
      break;

    case 'entity.node.latest_version':
      $node = \Drupal::routeMatch()->getParameter('node');
      break;
  }
  if (is_numeric($node)) {
    $node = Node::load($node);
  }
  return !empty($node) ? $node : FALSE;
}

<?php

/*
  Plugin Name: Featured Page Widget
  Plugin URI: http://plugins.grandslambert.com/plugins/featured-page-widget.html
  Description: Feature pages on your sidebar including an excerpt and either a text or image link to the page.
  Version: 1.4
  Author: grandslambert
  Author URI: http://grandslambert.com/


 * *************************************************************************

  Copyright (C) 2009-2011 GrandSlambert

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

 * *************************************************************************

 */

/* Class Declaration */

class FeaturedPageWidget extends WP_Widget {
     /* Plugin Variables */

     var $version = '1.4';
     var $make_link = false;
     var $options = array();

     /* Options page name */
     var $optionsName = 'featured-page-widget-options';
     var $menuName = 'featured-pages-settings';
     var $pluginName = 'Featured Pages';

     /**
      * Method constructor
      */
     function FeaturedPageWidget() {
          $this->pluginName = __('Featured Page Widget', 'featured-page-widget');

          /* Load the language support */
          $langDir = dirname(plugin_basename(__FILE__)) . '/lang';
          load_plugin_textdomain('featured-page-widget', false, $langDir, $langDir);

          /* translators: This is the description shown on the Widgets page. */
          $widget_ops = array('description' => __('Feature a page on your sidebar. By GrandSlambert.', 'featured-page-widget'));
          $control_ops = array('width' => 400, 'height' => 350);
          /* translators: This is the title of the widget on the Widgets page. */
          $this->WP_Widget('featured_page_widget', __($this->pluginName, 'featured-page-widget'), $widget_ops, $control_ops);

          /* Plugin paths */
          $this->pluginPath = WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__));
          $this->pluginURL = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__));

          /* Load the plugin settings */
          $this->load_settings();

          /* WordPress Actions */
          add_action('admin_menu', array(&$this, 'admin_menu'));
          add_action('admin_init', array(&$this, 'admin_init'));
          add_action('wp_loaded', array(&$this, 'wp_loaded'));
          add_action('wp_print_styles', array(&$this, 'wp_print_styles'));
          add_action('update_option_' . $this->optionsName, array(&$this, 'update_option'), 10);

          /* WordPress Filters */
          add_filter('plugin_action_links', array(&$this, 'plugin_action_links'), 10, 2);

          /* Add Image Sizes */
          add_image_size('featured-page-image-small', $this->options['small-image'][0], $this->options['small-image'][1], $this->options['hard-crop']);
          add_image_size('featured-page-image-full', $this->options['full-image'][0], $this->options['full-image'][1], $this->options['hard-crop']);
     }

     /**
      * Load the plugin settings.
      */
     function load_settings() {
          $options = get_option($this->optionsName);

          $defaults = array(
               'length' => 55,
               'link_title' => '',
               'link_text' => __('Read More', 'featured-page-widget'),
               'target' => 'None',
               'link_align' => 'center',
               'image_align' => 'right',
               'allowed-tags' => 'p',
               'post_types' => array('page'),
               'allowed-tags-formatted' => '',
               'hide_widget' => false,
               /* Added in version 1.4 */
               'thumbnail_size' => 'thumbnail',
               'small-image' => array(100, 75),
               'full-image' => array(200, 125),
               'hard-crop' => isset($options['hard-crop']) ? $options['hard-crop'] : true,
          );
          $this->options = wp_parse_args($options, $defaults);

          /* Build the list of allowed tags in excerpts */
          $tags = explode(',', $this->options['allowed-tags']);
          foreach ( $tags as $tag ) {
               $this->options['allowed-tags-formatted'].= '<' . $tag . '>';
          }
     }

     /**
      * Register front end styles.
      */
     function wp_loaded() {
          wp_register_style('featured-widget-css', $this->pluginURL . '/includes/featured-page-widget.css');
     }

     /**
      * Add items to the header of the web site.
      */
     function wp_print_styles() {
          wp_enqueue_style('featured-widget-css');
     }

     /**
      * Register the options for Wordpress MU Support
      */
     function admin_init() {
          register_setting($this->optionsName, $this->optionsName);
          wp_register_style('featured-page-widget-admin-css', $this->pluginURL . '/includes/featured-page-widget-admin.css');
          wp_register_script('featured-page-widget-js', $this->pluginURL . '/js/featured-page-widget.js');
     }

     /**
      * Print the administration styles.
      */
     function admin_print_styles() {
          wp_enqueue_style('featured-page-widget-admin-css');
     }

     /**
      * Print the scripts needed for the admin.
      */
     function admin_print_scripts() {
          wp_enqueue_script('featured-page-widget-js');
     }

     /**
      * Add the admin page for the settings panel.
      *
      * @global string $wp_version
      */
     function admin_menu() {
          $page = add_options_page($this->pluginName . __('Settings', 'featured-page-widget'), $this->pluginName, 'manage_options', $this->menuName, array(&$this, 'options_panel'));

          add_action('admin_print_styles-' . $page, array(&$this, 'admin_print_styles'));
          add_action('admin_print_scripts-' . $page, array(&$this, 'admin_print_scripts'));
     }

     /**
      * Add a configuration link to the plugins list.
      *
      * @staticvar object $this_plugin
      * @param array $links
      * @param array $file
      * @return array
      */
     function plugin_action_links($links, $file) {
          static $this_plugin;

          if ( !$this_plugin ) {
               $this_plugin = plugin_basename(__FILE__);
          }

          if ( $file == $this_plugin ) {
               /* translators: This is the link displayed on the Plugins page to the settings page for the plugin. */
               $settings_link = '<a href="' . admin_url('options-general.php?page=' . $this->menuName) . '">' . __('Settings', 'featured-page-widget') . '</a>';
               array_unshift($links, $settings_link);
          }

          return $links;
     }

     /**
      * Settings management panel.
      */
     function options_panel() {
          global $_wp_additional_image_sizes;
          include($this->pluginPath . '/includes/settings.php');
     }

     /**
      * Check on update option to see if we need to reset the options.
      * @param <array> $input
      * @return <boolean>
      */
     function update_option($input) {
          if ( $_REQUEST['confirm-reset-options'] ) {
               delete_option($this->optionsName);
               wp_redirect(admin_url('options-general.php?page=' . $this->menuName . '&tab=' . $_POST['active_tab'] . '&reset=true'));
               exit();
          } else {
               wp_redirect(admin_url('options-general.php?page=' . $this->menuName . '&tab=' . $_POST['active_tab'] . '&updated=true'));
               exit();
          }
     }

     /**
      * Method to create the widget.
      *
      * @param array $args
      * @param array $instance
      * @return false
      */
     function widget($args, $instance) {
          global $post, $_wp_additional_image_sizes;
;

          $instance = $this->defaults($instance);

          if ( (isset($instance['error']) && $instance['error']) or !isset($instance['page']) ) {
               return;
          }

          extract($args, EXTR_SKIP);

          $pages = (array) $instance['page'];

          if ( count($pages) > 1 ) {
               do {
                    $thePage = $pages[rand(0, count($pages) - 1)];
               } while ($thePage == $post->ID);
          } elseif ( $instance['hidewidget'] and $pages[0] == $post->ID ) {
               return;
          } else {
               $thePage = $pages[0];
          }

          /* WPML function. Get the right id for the right language */
          if ( function_exists('icl_object_id') ) {
               $thePage = icl_object_id($thePage);
          }

          $page = get_page($thePage);

          if ( !$instance['title'] ) {
               $instance['title'] = $page->post_title;
          }

          $instance['title'] = apply_filters('widget_title', $instance['title']);

          if ( !$content = get_post_meta($page->ID, 'featured-text', true) ) {
               $content = $this->trim_excerpt($page->post_content, $instance['length']);
          }

          if ( $postimage = get_post_meta($page->ID, 'featured-image', true) ) {
               switch ($instance['thumbnail_size']) {
                    default:
                         $width = $_wp_additional_image_sizes[$instance['thumbnail_size']]['width'];
                         $height = $_wp_additional_image_sizes[$instance['thumbnail_size']]['height'];
               }
               $content = $this->make_link($page->ID, '<img src="' . $postimage . '" width="' . $width . '" height="' . $height . '" border="0" class="align' . $instance['imagealign'] . ' fpw-image-' . $instance['imagealign'] . '" /></a>', $instance['target']) . $content;
          } elseif ( function_exists('has_post_thumbnail') and has_post_thumbnail($page->ID) and $instance['useimageas'] == 'image' ) {
               $content = $this->make_link($page->ID, get_the_post_thumbnail($page->ID, $instance['thumbnail_size'], array('class' => 'align' . $instance['imagealign'] . ' fpw-image-' . $instance['imagealign'])), $instance['target']) . $content;
          }

          if ( function_exists('has_post_thumbnail') and has_post_thumbnail($page->ID) and $instance['useimageas'] == 'link' ) {
               $link = '<img src="' . wp_get_attachment_thumb_url(get_post_thumbnail_id($page->ID)) . '" width="' . $instance['imagewidth'] . '" border="0" />';
          } elseif ( $linkImage = get_post_meta($page->ID, 'featured-link', true) ) {
               $link = '<img src="' . $linkImage . '" border="0" />';
          } else {
               $link = $this->options['link_text'];
          }

          $content.= '<p align="' . $instance['linkalign'] . '">' . $this->make_link($page->ID, $link, $instance['target']) . '</p>';

          print $before_widget;
          if ( $instance['title'] ) {
               print $before_title;

               if ( $instance['linktitle'] ) {
                    print $this->make_link($page->ID, $instance['title'], $instance['target']);
               } else {
                    print $instance['title'];
               }

               print $after_title;
          }
          print $content;
          print $after_widget;
     }

     /**
      * Build the link to the post or page.
      *
      * @param integer $id
      * @param string $text
      * @param string $target
      * @return string
      */
     function make_link($id, $text, $target = false) {
          $output = '<a href="' . get_permalink($id) . '" ';
          if ( $target )
               $output.= 'target="' . $target . '"';
          $output.= '>' . $text . '</a>';

          return $output;
     }

     function trim_excerpt($text, $length = NULL) {
          global $post;

          if ( !$length ) {
               $length = $this->options['length'];
          }

          $text = apply_filters('the_content', $text);
          $text = str_replace(']]>', ']]&gt;', $text);
          $text = strip_tags($text, $this->options['allowed-tags-formatted']);
          $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
          $words = explode(' ', $text, $length + 1);
          if ( count($words) > $length ) {
               array_pop($words);
               array_push($words, '[...]');
               $text = implode(' ', $words);
          }

          $tags = explode(',', $this->options['allowed-tags']);
          foreach ( $tags as $tag ) {
               $text.= '</' . $tag . '>';
          }

          return $text;
     }

     /**
      * Widget Update method
      * @param array $new_instance
      * @param array $old_instance
      * @return array
      */
     function update($new_instance, $old_instance) {
          return $new_instance;
     }

     /**
      * Widget Defaults
      */
     function defaults($instance) {
          $defaults = array(
               'title' => '',
               'linktitle' => $this->options['link_title'],
               'hidewidget' => $this->options['hide_widget'],
               'length' => $this->options['length'],
               'target' => $this->options['target'],
               'linkalign' => $this->options['link_align'],
               'imagealign' => $this->options['image_align'],
               'thumbnail_size' => $this->options['thumbnail_size'],
               'useimageas' => 'none'
          );

          return wp_parse_args($instance, $defaults);
     }

     /**
      * Widget form.
      *
      * @param array $instance
      */
     function form($instance) {
          global $_wp_additional_image_sizes;
          $instance = $this->defaults($instance);
          include( $this->pluginPath . '/includes/widget-form.php');
     }

     /**
      * Get list of pages as select options
      */
     function get_pages($selected = NULL, $name = 'page') {

          if ( !is_array($selected) ) {
               $selected = array($selected);
          }

          $pages = get_posts(array('post_type' => $this->options['post_types'], 'posts_per_page' => -1, 'showposts' => -1, 'orderby' => 'title', 'order' => 'asc'));

          $output = '';

          foreach ( $pages as $page ) {
               $output.= '<option value="' . $page->ID . '"';
               if ( in_array($page->ID, $selected) ) {
                    $output.= ' selected';
               }
               $output.= '>' . $page->post_title . ' (' . ucfirst($page->post_type) . ')' . "</option>\n";
          }

          return $output;
     }

     /**
      * Display the list of contributors.
      * @return boolean
      */
     function contributor_list() {
          $this->showFields = array('NAME', 'LOCATION', 'COUNTRY');
          print '<ul>';

          $xml_parser = xml_parser_create();
          xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
          xml_set_element_handler($xml_parser, array($this, "start_element"), array($this, "end_element"));
          xml_set_character_data_handler($xml_parser, array($this, "character_data"));

          if ( !(@$fp = fopen('http://wordpress.grandslambert.com/xml/featured-page-widget/contributors.xml', "r")) ) {
               print 'There was an error getting the list. Try again later.';
               return;
          }

          while ($data = fread($fp, 4096)) {
               if ( !xml_parse($xml_parser, $data, feof($fp)) ) {
                    die(sprintf("XML error: %s at line %d",
                                    xml_error_string(xml_get_error_code($xml_parser)),
                                    xml_get_current_line_number($xml_parser)));
               }
          }

          xml_parser_free($xml_parser);
          print '</ul>';
     }

     /**
      * XML Start Element Procedure.
      */
     function start_element($parser, $name, $attrs) {
          if ( $name == 'NAME' ) {
               print '<li class="rp-contributor">';
          } elseif ( $name == 'ITEM' ) {
               print '<br><span class="rp_contributor_notes">Contributed: ';
          }

          if ( $name == 'URL' ) {
               $this->make_link = true;
          }
     }

     /**
      * XML End Element Procedure.
      */
     function end_element($parser, $name) {
          if ( $name == 'ITEM' ) {
               print '</li>';
          } elseif ( $name == 'ITEM' ) {
               print '</span>';
          } elseif ( in_array($name, $this->showFields) ) {
               print ', ';
          }

          $this->make_link = false;
     }

     /**
      * XML Character Data Procedure.
      */
     function character_data($parser, $data) {
          if ( $this->make_link ) {
               print '<a href="http://' . $data . '" target="_blank">' . $data . '</a>';
               $this->make_link = false;
          } else {
               print $data;
          }
     }

}

add_action('widgets_init', create_function('', 'return register_widget("FeaturedPageWidget");'));

register_activation_hook(__FILE__, 'featured_page_activate');

function featured_page_activate() {

     /* Compile old options into new options Array */
     $new_options = array();
     $options = array('length', 'hide_widget', 'link_text', 'link_title', 'target', 'link_align', 'image_align', 'image_width');

     foreach ( $options as $option ) {
          if ( $old_option = get_option('featured_page_widget_' . $option) ) {
               $new_options[$option] = $old_option;
               delete_option('featured_page_widget_' . $option);
          }
     }
     if ( !add_option('featured-page-widget-options', $new_options) ) {
          update_option('featured-page-widget-options', $new_options);
     }
}
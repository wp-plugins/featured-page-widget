<?php
/*
Plugin Name: Featured Page Widget
Plugin URI: http://featuredpagewidget.grandslambert.com/
Description: Feature pages on your sidebar including an excerpt and either a text or image link to the page.
Author: GrandSlambert
Version: 1.3
Author: GrandSlambert
Author URI: http://wordpress.grandslambert.com/


**************************************************************************

Copyright (C) 2009-2010 GrandSlambert

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

**************************************************************************

*/

/* Class Declaration */
class FeaturedPageWidget extends WP_Widget {
    var $version	= '1.3';

    /* Options page name */
    var $optionsName	= 'featured-page-widget-options';
    var $menuName	= 'featured-pages-settings';
    var $pluginName     = 'Featured Pages';
    var $options        = array();

    /**
     * Method constructor
     */
    function FeaturedPageWidget() {
        $langDir = dirname( plugin_basename(__FILE__) ) . '/lang';
        load_plugin_textdomain( 'featured-page-widget', false, $langDir, $langDir );

        /* translators: This is the description shown on the Widgets page. */
        $widget_ops = array('description' => __('Feature a page on your sidebar. By GrandSlambert.', 'featured-page-widget') );
        /* translators: This is the title of the widget on the Widgets page. */
        $this->WP_Widget('featured_page_widget', __($this->pluginName, 'featured-page-widget'), $widget_ops);

        $this->pluginPath = WP_CONTENT_DIR . '/plugins/' . plugin_basename(dirname(__FILE__));
        $this->pluginURL = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
        /* translators: This is the title of the plugin as used throughout the plugin. */
        $this->pluginName = __('Featured Page Widget');
        $this->loadSettings();

        /* Wordpress hooks and filters */
        add_action('wp_head', array($this, 'add_header') );
        add_action('admin_menu', array(&$this, 'addAdminPages'));
        add_filter('plugin_action_links', array(&$this, 'addConfigureLink'), 10, 2);
        add_action('admin_init', array(&$this, 'registerOptions'));
    }

    /**
     * Load the plugin settings.
     */
    function loadSettings() {
        $this->options = get_option($this->optionsName);

        /* Get defaults for those items not defauled to false. */
        if (!$this->options['length']) {
            $this->options['length'] = 55;
        }

        if (!$this->options['link_text']) {
            $this->options['link_text'] = 'Read More &raquo;';
        }

        if (!$this->options['target']) {
            $this->options['target'] = 'None';
        }

        if (!$this->options['link_align']) {
            $this->options['link_align'] = 'center';
        }

        if (!$this->options['image_align']) {
            $this->options['image_align'] = 'right';
        }

        if (!$this->options['image_width']) {
            $this->options['image_width'] = 100;
        }

        if (!$this->options['allowed-tags']) {
            $this->options['allowed-tags'] = 'p';
        }

        if (!$this->options['post-types']) {
            $this->options['post-types'] = array('page');
        }

        $tags = explode(',', $this->options['allowed-tags']);

        foreach ($tags as $tag) {
            $this->options['allowed-tags-formatted'].= '<'. $tag . '>';
        }
    }

    /**
     * Add settings vars to the whitelist for forms.
     *
     * @param array $whitelist
     * @return array
     */
    function whitelistOptions($whitelist) {
        if (is_array($whitelist)) {
            $option_array = array('FeaturedPageWidget' => $this->optionsName);
            $whitelist = array_merge($whitelist, $option_array);
        }

        return $whitelist;
    }

    /**
     * Add items to the header of the web site.
     */
    function add_header() {
        print "<link rel='stylesheet' href='" . $this->pluginURL . "/featured-page-widget.css' type='text/css' media='all' />";
    }

    /**
     * Add the admin page for the settings panel.
     *
     * @global string $wp_version
     */
    function addAdminPages() {
        global $wp_version;

        add_options_page($this->pluginName, $this->pluginName, 8, $this->menuName, array(&$this, 'optionsPanel'));

        // Use the bundled jquery library if we are running WP 2.5 or above
        if (version_compare($wp_version, '2.5', '>=')) {
            wp_enqueue_script('jquery', false, false, '1.2.3');
        }
    }

    /**
     * Add a configuration link to the plugins list.
     *
     * @staticvar object $this_plugin
     * @param array $links
     * @param array $file
     * @return array
     */
    function addConfigureLink($links, $file) {
        static $this_plugin;

        if (!$this_plugin) {
            $this_plugin = plugin_basename(__FILE__);
        }

        if ($file == $this_plugin) {
            /* translators: This is the link displayed on the Plugins page to the settings page for the plugin. */
            $settings_link = '<a href="' . get_option('siteurl') . '/wp-admin/options-general.php?page=' . $this->menuName . '">' . __('Settings', 'featured-page-widget') . '</a>';
            array_unshift($links, $settings_link);
        }

        return $links;
    }

    /**
     * Settings management panel.
     */
    function optionsPanel() {
        include($this->pluginPath . '/options-panel.php');
    }

    /**
     * Method to create the widget.
     *
     * @param array $args
     * @param array $instance
     * @return false
     */
    function widget($args, $instance) {
        global $post;

        if ( isset($instance['error']) && $instance['error'] ) {
            return;
        }

        extract($args, EXTR_SKIP);

        if (!$pages = $instance['page']) {
            return NULL;
        }

        if ( !is_array($pages) ) {
            $pages = array($pages);
        }

        $hide = $instance['hidewidget'];

        if (count($pages) > 1) {
            do {
                $thePage = $pages[rand(0,count($pages)-1)];
            } while ($thePage == $post->ID);
        } elseif ($hide and $pages[0] == $post->ID) {
            return;
        } else {
            $thePage = $pages[0];
        }

        $page = get_page($thePage);

        if (!$title = $instance['title']) {
            $title = $page->post_title;
        }

        if (!$linkTitle = $instance['linktitle']) {
            $linkTitle = $this->options['link_title'];
        }

        if (!$length = $instance['length']) {
            $length = $this->options['length'];
        }

        if (!$linkTarget = $instance['target']) {
            $linkTarget = $this->defaultLinkTarget;
        }

        if (!$linkAlign = $instance['linkalign']) {
            $linkAlign = $this->options['link_align'];
        }

        if (!$imageAlign = $instance['imagealign']) {
            $imageAlign = $this->options['image_align'];
        }

        if (!$imageWidth = $instance['imagewidth']) {
            $imageWidth = $this->options['image_width'];
        }

        $title = apply_filters('widget_title', $title );

        if (!$content = get_post_meta($page->ID, 'featured-text', true) ) {
            $content = $this->trim_excerpt($page->post_content, $length);
        }

        if (function_exists(has_post_thumbnail) and has_post_thumbnail($page->ID) and $instance['useimageas'] == 'image') {
            $content = $this->makelink($page->ID, get_the_post_thumbnail($page->ID, array($imageWidth, $imageWidth), array('class'=>'align'. $imageAlign . ' fpw-image-' . $imageAlign)), $linkTarget) . $content;
        } elseif ($postimage = get_post_meta($page->ID, 'featured-image', true) ) {
            $content = $this->makelink($page->ID, '<img src="' . $postimage . '" width="' . $imageWidth . '" border="0" class="align' . $imageAlign .' fpw-image-' . $imageAlign . '" /></a>', $linkTarget) . $content;
        }

        if (function_exists(has_post_thumbnail) and has_post_thumbnail($page->ID) and $instance['useimageas'] == 'link') {
            $link = '<img src="' . wp_get_attachment_thumb_url(get_post_thumbnail_id($page->ID)) . '" width="' . $imageWidth . '" border="0" />';
        } elseif ($linkImage = get_post_meta($page->ID, 'featured-link', true) ) {
            $link = '<img src="' . $linkImage . '" width="' . $imageWidth . '" border="0" />';
        } else {
            $link = $this->options['link_text'];
        }

        $content.= '<p align="' . $linkAlign . '">' . $this->makelink($page->ID, $link, $linkTarget) . '</p>';

        print $before_widget;
        if ( $title ) {
            print $before_title;

            if ($linkTitle)
                print $this->makelink($page->ID, $title, $linkTarget);
            else
                print $title;

            print $after_title;
        }
        print $content;
        print $after_widget;
    }

    function makelink($id, $text, $target = false) {
        $output = '<a href="' . get_page_link($id) . '" ';
        if ($target) $output.= 'target="' . $target . '"';
        $output.= '>' . $text . '</a>';

        return $output;
    }

    function trim_excerpt($text, $length = NULL) {
        global $post;

        if (!$length)
            $length = $this->options['length'];

        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = strip_tags($text, $this->options['allowed-tags-formatted']);
        $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
        $words = explode(' ', $text, $length + 1);
        if (count($words)> $excerpt_length) {
            array_pop($words);
            array_push($words, '[...]');
            $text = implode(' ', $words);
        }

        $tags = explode(',', $this->options['allowed-tags']);
        foreach ($tags as $tag) {
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
     * Widget form.
     *
     * @param array $instance
     */
    function form($instance) {
        $title 	= esc_attr($instance['title']);
        $page 	= $instance['page'];

        if (!$instance) {
            $linktitle = $this->options['link_title'];
            $hidewidget = $this->options['hide_widget'];
            $length = $this->options['length'];
            $linktarget = $this->options['target'];
            $linkalign = $this->options['link_align'];
            $imagealign = $this->options['image_align'];
            $imagewidth = $this->options['image_width'];
            $useImageAs = 'none';
        } else {
            $linktitle = esc_attr($instance['linktitle']);
            $hidewidget = esc_attr($instance['hidewidget']);
            $length = esc_attr($instance['length']);
            $linktarget = esc_attr($instance['target']);
            $linkalign = esc_attr($instance['linkalign']);
            $imagealign = $instance['imagealign'];
            $imagewidth = $instance['imagewidth'];
            $useImageAs = $instance['useimageas'];
        }

        include( $this->pluginPath . '/widget-form.php');
    }

    /**
     * Get list of pages as select options
     */
    function get_pages($selected = NULL, $name = 'page') {

        if ( !is_array($selected) ) {
            $selected = array($selected);
        }

        $pages = get_posts(array('post_type'=>$this->options['post-types'], 'posts_per_page'=>-1, 'showposts'=>-1, 'orderby'=>'title', 'order'=>'asc'));

        $output = '';

        foreach ($pages as $page) {
            $output.= '<option value="' . $page->ID . '"';
            if ( in_array($page->ID, $selected) ) {
                $output.= ' selected';
            }
            $output.= '>' . $page->post_title . ' (' . ucfirst($page->post_type) . ')' . "</option>\n";
        }

        return $output;
    }

    /**
     * Display the current version number
     * @return string
     */
    function showVersion() {
        return $this->version;
    }

    /**
     /**
     * Register the options for Wordpress MU Support
     */
    function registerOptions() {
        register_setting( $this->optionsName, $this->optionsName);
    }

    /**
     * Display the list of contributors.
     * @return boolean
     */
    function contributorList() {
        $this->showFields = array('NAME', 'LOCATION' , 'COUNTRY');
        print '<ul>';

        $xml_parser = xml_parser_create();
        xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
        xml_set_element_handler($xml_parser, array($this,"startElement"), array($this, "endElement") );
        xml_set_character_data_handler($xml_parser, array($this, "characterData") );

        if (!(@$fp = fopen('http://wordpress.grandslambert.com/xml/featured-page-widget/contributors.xml', "r"))) {
            print 'There was an error getting the list. Try again later.';
            return;
        }

        while ($data = fread($fp, 4096)) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
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
    function startElement($parser, $name, $attrs) {
        if ($name == 'NAME') {
            print '<li class="rp-contributor">';
        } elseif ($name == 'ITEM') {
            print '<br><span class="rp_contributor_notes">Contributed: ';
        }

        if ($name == 'URL') {
            $this->makeLink = true;
        }
    }

    /**
     * XML End Element Procedure.
     */
    function endElement($parser, $name) {
        if ($name == 'ITEM') {
            print '</li>';
        }
        elseif ($name == 'ITEM') {
            print '</span>';
        }
        elseif ( in_array($name, $this->showFields)) {
            print ', ';
        }
    }

    /**
     * XML Character Data Procedure.
     */
    function characterData($parser, $data) {
        if ($this->makeLink) {
            print '<a href="http://' . $data . '" target="_blank">' . $data . '</a>';
            $this->makeLink = false;
        } else {
            print $data;
        }
    }
}

add_action('widgets_init', create_function('', 'return register_widget("FeaturedPageWidget");'));

register_activation_hook(__FILE__, 'featured_page_activate' );

function featured_page_activate() {

    /* Compile old options into new options Array */
    $new_options = array();
    $options = array('length','hide_widget','link_text','link_title','target','link_align','image_align','image_width');

    foreach ($options as $option) {
        if ($old_option = get_option('featured_page_widget_' . $option)) {
            $new_options[$option] = $old_option;
            delete_option('featured_page_widget_' . $option);
        }
    }
    if (!add_option('featured-page-widget-options', $new_options) ) {
        update_option('featured-page-widget-options', $new_options);
    }
}
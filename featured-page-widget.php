<?php
/*
Plugin Name: Featured Page Widget
Plugin URI: http://wordpress.grandslambert.com/plugins/featured-page-widget.html
Description: Feature pages on your sidebar including an excerpt and either a text or image link to the page.
Author: GrandSlambert
Version: 0.6
Author: GrandSlambert
Author URI: http://www.grandslambert.com/
*/

/* Class Declaration */
class FeaturedPageWidget extends WP_Widget
{
	var $version	= '0.6';
	
	// Options page name
	var $optionsName	= 'featured-page-widget_options';
	var $menuName		= 'featured-page-widget-settings';
	
	// Settings
	var $defaultLength		= 55;
	var $defaultLinkTitle	= false;
	var $defaultLinkText		= 'Read More &raquo;';
	var $defaultTarget		= 'None';
	var $defaultLinkAlign	= 'center';
	var $defaultImageAlign	= 'right';
	var $defaultImageWidth	= '100';
	
	/**
	 * Constructor
	 */
	function FeaturedPageWidget()
	{
		$widget_ops = array('description' => __('Feature a page on your sidebar. By GrandSlambert.') );
		$this->WP_Widget('featured_page_widget', __('Featured Page Widget'), $widget_ops);
		
		$this->pluginPath = WP_CONTENT_DIR . '/plugins/' . plugin_basename(dirname(__FILE__));
		
		// Get stored settings
		if (!$this->defaultLength = get_option('featured_page_widget_length') )
			$this->defaultLength = 55;

		if (!$this->defaultLinkTitle = get_option('featured_page_widget_link_title') )
			$this->defaultLinkTitle = false;

		if (!$this->defaultLinkText = get_option('featured_page_widget_link_text') )
			$this->defaultLinkText = 'Read More &raquo;';

		if (!$this->defaultTarget = get_option('featured_page_widget_target') )
			$this->defaultTarget = 'None';

		if (!$this->defaultLinkAlign = get_option('featured_page_widget_link_align') )
			if (!$this->defaultLinkAlign = get_option('featured_page_widget_align') )
				$this->defaultLinkAlign = 'center';

		if (!$this->defaultImageAlign = get_option('featured_page_widget_image_align') )
			$this->defaultImageAlign = 'right';

		if (!$this->defaultImageWidth = get_option('featured_page_widget_image_width') )
			$this->defaultImageWidth = '100';
	
		// Add aministration page.
		add_action('admin_menu', array(&$this, 'addAdminPages'));
		add_filter('plugin_action_links', array(&$this, 'addConfigureLink'), 10, 2);
	}
	
	/**
	 * Add all options to the whitelist for the NONCE
	 * Required for Wordpress MU support
	 */
	function whitelistOptions($whitelist)
	{
		if (is_array($whitelist))
		{
			$option_array = array('FeaturedPageWidget' => array(
				'featured_page_widget_length',
				'featured_page_widget_link_title',
				'featured_page_widget_link_text',
				'featured_page_widget_target',
				'featured_page_widget_link_align',
				'featured_page_widget_image_align',
				'featured_page_widget_image_width',
				
			));
			$whitelist = array_merge($whitelist, $option_array);
		}

		return $whitelist;
	}

	/**
	 * Adds Disclaimer options tab to admin menu
	 */
	function addAdminPages()
	{
		global $wp_version;
		
		add_options_page('Featured Page Widget', 'Featured Page Widget', 8, $this->menuName, array(&$this, 'optionsPanel'));

		// Use the bundled jquery library if we are running WP 2.5 or above
		if (version_compare($wp_version, '2.5', '>=')) {
			wp_enqueue_script('jquery', false, false, '1.2.3');
		}
	}

	/**
	 * Adds a settings link next to Login Configurator on the plugins page
	 */
	function addConfigureLink($links, $file)
	{
		static $this_plugin;

		if (!$this_plugin) 
		{
			$this_plugin = plugin_basename(__FILE__);
		}

		if ($file == $this_plugin) 
		{
			$settings_link = '<a href="options-general.php?page=' . $this->menuName . '">' . __('Settings') . '</a>';
			array_unshift($links, $settings_link);
		}

		return $links;
	}

	/**
	 * Outputs the overview sub panel
	 */
	function optionsPanel()
	{
		include($this->pluginPath . '/options-panel.php');
	}

	/**
	 * Widget code
	 */
	function widget($args, $instance) 
	{

		if ( isset($instance['error']) && $instance['error'] )
			return;

		extract($args, EXTR_SKIP);
		
		if (!$page = $instance['page'])
			return NULL;
		
		$page = get_page($page);

		if (!$title = $instance['title'])
			$title = $page->post_title;
			
		if (!$linkTitle = $instance['linktitle'])
			$linkTitle = $this->defaultLinkTitle;
		
		if (!$length = $instance['length'])
			$length = $this->defaultLength;
		
		if (!$linkTarget = $instance['target'])
			$linkTarget = $this->defaultLinkTarget;

		if (!$linkAlign = $instance['linkalign'])
			$linkAlign = $this->defaultLinkAlign;

		if (!$imageAlign = $instance['imagealign'])
			$imageAlign = $this->defaultImageAlign;

		if (!$imageWidth = $instance['imagewidth'])
			$imageWidth = $this->defaultImageWidth;
		
		$title = apply_filters('widget_title', $title );
		
		if (!$content = get_post_meta($page->ID, 'featured-text', true) )
			$content = $this->trim_excerpt($page->post_content, $length);
		
		if ($postimage = get_post_meta($page->ID, 'featured-image', true) )	
			$content = $this->makelink($page->ID, '<img src="' . $postimage . '" width="' . $imageWidth . '" border="0" class="align' . $imageAlign .'" /></a>', $linkTarget) . $content;
			
		if ($linkImage = get_post_meta($page->ID, 'featured-link', true) )
			$link = '<img src="' . $linkImage . '" border="0" />';
		else
			$link = $this->defaultLinkText;
			
		$content.= '<p align="' . $linkAlign . '">' . $this->makelink($page->ID, $link, $linkTarget) . '</p>';

		print $before_widget;
		if ( $title )
		{
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

	function makelink($id, $text, $target = false)
	{
		$output = '<a href="' . get_page_link($id) . '" ';
		if ($target) $output.= 'target="' . $target . '"';
		$output.= '>' . $text . '</a>';
		
		return $output;
	}

	function trim_excerpt($text, $length = NULL)
	{ 
		global $post;
		
		if (!$length)
			$length = $this->defaultLength;
			
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text, '<p>');
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$words = explode(' ', $text, $length + 1);
		if (count($words)> $excerpt_length) 
		{
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}

		return $text;
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) 
	{
		$title 	= esc_attr($instance['title']);
		$page 	= esc_attr($instance['page']);
		
		if (!$linktitle = esc_attr($instance['linktitle']) )
			$linktitle = $this->defaultLinkTitle;
		
		if (!$length = esc_attr($instance['length']) )
			$length = $this->defaultLength;

		if (!$linktarget = esc_attr($instance['target']) )
			$linktarget = $this->defaultTarget;

		if (!$linkalign = esc_attr($instance['linkalign']) )
			$linkalign = $this->defaultLinkAlign;

		if (!$imagealign = $instance['imagealign'])
			$imagealign = $this->defaultImageAlign;

		if (!$imagewidth = $instance['imagewidth'])
			$imagewidth = $this->defaultImageWidth;

		include( $this->pluginPath . '/widget-form.php');
	}
	
	/**
	 * Get list of pages as select options
	 */
	function get_pages($selected = NULL)
	{
		$pages = get_pages();
		
		print_r($pages);
		$output = '';
		
		foreach ($pages as $page)
		{
			$output.= '<option value="' . $page->ID . '"';
			if ($page->ID == $selected) $output.= ' selected';
			$output.= '>' . $page->post_title . "</option>\n";
		}
		
		return $output;
	}

	/**
	 * Show the version number
	 */
	function showVersion()
	{
		return $this->version;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("FeaturedPageWidget");'));
<p>
    <label for="<?php print $this->get_field_id('title'); ?>">
        <?php _e('Widget Title:<br /><small>Leave blank to use page title</small>', 'featured-page-widget'); ?>
    </label>
    <input class="widefat" id="<?php print $this->get_field_id('title'); ?>" name="<?php print $this->get_field_name('title'); ?>" type="text" value="<?php print $title; ?>" />
</p>
<p>
    <label for="<?php print $this->get_field_id('page'); ?>">
        <?php _e('Featured Page<br /><small>(CTRL-Click to select multiple)</small>:', 'featured-page-widget'); ?>
    </label>
    <select name="<?php print $this->get_field_name('page'); ?>[]" size="1" style="height:100px;" multiple="multiple" id="<?php print $this->get_field_id('page'); ?>">
        <?php print $this->get_pages($page); ?>
    </select>
</p>
<p>
    <label for="<?php print $this->get_field_id('hidewidget'); ?>">
        <?php _e('Hide on selected page:', 'featured-page-widget'); ?>
    </label>
    <input name="<?php print $this->get_field_name('hidewidget'); ?>" id="<?php print $this->get_field_id('hidewidget'); ?>" type="checkbox" value="1" <?php checked($hidewidget,1); ?> />
    <br /><small><?php _e('If only one page is selected, otherwise show any other randomly selected page.', 'featured-page-widget'); ?></small>
</p>
<p>
    <label for="<?php print $this->get_field_id('length'); ?>">
        <?php _e('Excerpt Length:<br /><small>If no excerpt specified</small>', 'featured-page-widget'); ?>
    </label>
    <input class="widefat" id="<?php print $this->get_field_id('length'); ?>" name="<?php print $this->get_field_name('length'); ?>" type="text" value="<?php print $length; ?>" />
</p>
<h3><?php _e('Page Link', 'featured-page-widget'); ?></h3>
<p>
    <label for="<?php print $this->get_field_id('linktitle'); ?>">
        <?php _e('Link Title to Page:', 'featured-page-widget'); ?>
    </label>
    <input name="<?php print $this->get_field_name('linktitle'); ?>" id="<?php print $this->get_field_id('linktitle'); ?>" type="checkbox" value="1" <?php checked($linktitle); ?> />
</p>
<p>
    <label for="<?php print $this->get_field_id('target'); ?>">
        <?php _e('Link Target:', 'featured-page-widget'); ?>
    </label>
    <select name="<?php print $this->get_field_name('target'); ?>" id="<?php print $this->get_field_id('target'); ?>">
        <option value="0"><?php _e('No Link Target', 'featured-page-widget'); ?></option>
        <option value="_blank" <?php selected($linktarget, '_blank'); ?>><?php _e('New Window', 'featured-page-widget'); ?></option>
        <option value="_top" <?php selected($linktarget, '_top'); ?>><?php _e('Top Window', 'featured-page-widget'); ?></option>
    </select>
</p>
<p>
    <label for="<?php print $this->get_field_id('linkalign'); ?>">
        <?php _e('Link Alignment:', 'featured-page-widget'); ?>
    </label>
    <select name="<?php print $this->get_field_name('linkalign'); ?>" id="<?php print $this->get_field_id('linkalign'); ?>">
        <option value="none" <?php selected($linkalign, 'none'); ?> ><?php _e('No Link Alignment', 'featured-page-widget'); ?></option>
        <option value="left" <?php selected($linkalign, 'left'); ?> ><?php _e('Align Left', 'featured-page-widget'); ?></option>
        <option value="center" <?php selected($linkalign, 'center'); ?> ><?php _e('Align Centered', 'featured-page-widget'); ?></option>
        <option value="right" <?php selected($linkalign, 'right'); ?> ><?php _e('Align Right', 'featured-page-widget'); ?></option>
    </select>
</p>
<h3><?php _e('Page Image (if present)', 'featured-page-widget'); ?></h3>
<p>
    <label for="<?php print $this->get_field_id('imagealign'); ?>">
        <?php _e('Image Alignment:', 'featured-page-widget'); ?>
    </label>
    <select name="<?php print $this->get_field_name('imagealign'); ?>" id="<?php print $this->get_field_id('imagealign'); ?>">
        <option value="none" <?php selected($imagealign, 'none'); ?> ><?php _e('No Image Alignment', 'featured-page-widget'); ?></option>
        <option value="left" <?php selected($imagealign, 'left'); ?> ><?php _e('Align Left', 'featured-page-widget'); ?></option>
        <option value="center" <?php selected($imagealign, 'center'); ?> ><?php _e('Align Center', 'featured-page-widget'); ?></option>
        <option value="right" <?php selected($imagealign, 'right'); ?> ><?php _e('Align Right', 'featured-page-widget'); ?></option>
    </select>
</p>
<p>
    <label for="<?php print $this->get_field_id('imagewidth'); ?>">
        <?php _e('Image Width (pixels):', 'featured-page-widget'); ?>
    </label>
    <input class="widefat" id="<?php print $this->get_field_id('imagewidth'); ?>" name="<?php print $this->get_field_name('imagewidth'); ?>" type="text" value="<?php print $imagewidth; ?>" />
</p>

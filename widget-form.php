
<p>
	<label for="<?php print $this->get_field_id('title'); ?>">
	<?php _e('Widget Title:<br /><small>Leave blank to use page title</small>'); ?>
	</label>
	<input class="widefat" id="<?php print $this->get_field_id('title'); ?>" name="<?php print $this->get_field_name('title'); ?>" type="text" value="<?php print $title; ?>" />
</p>
<p>
	<label for="<?php print $this->get_field_id('page'); ?>">
	<?php _e('Featured Page:'); ?>
	</label>
	<select name="<?php print $this->get_field_name('page'); ?>" id="<?php print $this->get_field_id('page'); ?>">
		<?php print $this->get_pages($page); ?>
	</select>
</p>
<p>
	<label for="<?php print $this->get_field_id('length'); ?>">
	<?php _e('Excerpt Length:<br /><small>If no excerpt specified</small>'); ?>
	</label>
	<input class="widefat" id="<?php print $this->get_field_id('length'); ?>" name="<?php print $this->get_field_name('length'); ?>" type="text" value="<?php print $length; ?>" />
</p>
<h3><?php _e('Page Link'); ?></h3>
<p>
	<label for="<?php print $this->get_field_id('linktitle'); ?>">
	<?php _e('Link Title to Page:'); ?>
	</label>
	<input name="<?php print $this->get_field_name('linktitle'); ?>" id="<?php print $this->get_field_id('linktitle'); ?>" type="checkbox" value="1" <?php if ($linktitle) print "checked"; ?> />
</p>
<p>
	<label for="<?php print $this->get_field_id('target'); ?>">
	<?php _e('Link Target:'); ?>
	</label>
	<select name="<?php print $this->get_field_name('target'); ?>" id="<?php print $this->get_field_id('target'); ?>">
		<option value="0">None</option>
		<option value="_blank" <?php if ($linktarget == '_blank') print 'selected'; ?>>New Window</option>
		<option value="_top" <?php if ($linktarget == '_top') print 'selected'; ?>>Top Window</option>
	</select>
</p>
<p>
	<label for="<?php print $this->get_field_id('linkalign'); ?>">
	<?php _e('Link Alignment:'); ?>
	</label>
	<select name="<?php print $this->get_field_name('linkalign'); ?>" id="<?php print $this->get_field_id('linkalign'); ?>">
		<option value="left" <?php if ($linkalign == 'left') print 'selected'; ?> >Left</option>
		<option value="center" <?php if ($linkalign == 'center') print 'selected'; ?> >Center</option>
		<option value="right" <?php if ($linkalign == 'right') print 'selected'; ?> >Right</option>
	</select>
</p>
<h3><?php _e('Page Image (if present)'); ?></h3>
<p>
	<label for="<?php print $this->get_field_id('imagealign'); ?>">
	<?php _e('Image Alignment:'); ?>
	</label>
	<select name="<?php print $this->get_field_name('imagealign'); ?>" id="<?php print $this->get_field_id('imagealign'); ?>">
		<option value="left" <?php if ($imagealign == 'left') print 'selected'; ?> >Left</option>
		<option value="center" <?php if ($imagealign == 'center') print 'selected'; ?> >Center</option>
		<option value="right" <?php if ($imagealign == 'right') print 'selected'; ?> >Right</option>
	</select>
</p>
<p>
	<label for="<?php print $this->get_field_id('imagewidth'); ?>">
	<?php _e('Image Width (pixels):'); ?>
	</label>
	<input class="widefat" id="<?php print $this->get_field_id('imagewidth'); ?>" name="<?php print $this->get_field_name('imagewidth'); ?>" type="text" value="<?php print $imagewidth; ?>" />
</p>

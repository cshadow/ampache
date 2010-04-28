<?php
/* vim:set tabstop=8 softtabstop=8 shiftwidth=8 noexpandtab: */
/*
 Copyright (c) Ampache.org
 All rights reserved.

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License v2
 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

*/
/**
 * Playlist Box
 * This box is used for actions on the main screen and on a specific playlist page
 * It changes depending on where it is
 */
?>
<?php 
/* HINT: Playlist Type, Playlist Name */
show_box_top('<div id="playlist_row_' . $playlist->id . '">' . 
	sprintf(_('%s %s (Playlist)'), $playlist->f_type, $playlist->name) .
	'</div>');
?>
<div id="information_actions">
<ul>
	<li>
		<a href="<?php echo Config::get('web_path'); ?>/playlist.php?action=normalize_tracks&amp;playlist_id=<?php echo $playlist->id; ?>"><?php echo get_user_icon('statistics',_('Normalize Tracks')); ?></a>
		<?php echo _('Normalize Tracks'); ?>
	</li>
        <?php if (Access::check_function('batch_download')) { ?>
	<li>
		<a href="<?php echo Config::get('web_path'); ?>/batch.php?action=playlist&amp;id=<?php echo $playlist->id; ?>"><?php echo get_user_icon('batch_download', _('Batch Download')); ?></a>
		<?php echo _('Batch Download'); ?>
	</li>
        <?php } ?>
	<li>
		<?php echo Ajax::button('?action=basket&type=playlist&id=' . $playlist->id,'add',_('Add All'),'play_playlist'); ?>
		<?php echo _('Add All'); ?>
	</li>
	<li>
		<?php echo Ajax::button('?action=basket&type=playlist_random&id=' . $playlist->id,'random',_('Add Random'),'play_playlist_random'); ?>
		<?php echo _('Add Random'); ?>
	</li>
	<?php if ($playlist->has_access()) { ?>
	<li>
		<?php echo Ajax::button('?action=show_edit_object&type=playlist_full&id=' . $playlist->id,'edit',_('Edit'),'edit_playlist_' . $playlist->id); ?>
		<?php echo _('Edit'); ?>
	</li>
	<li>
		<a href="<?php echo Config::get('web_path'); ?>/playlist.php?action=delete_playlist&playlist_id=<?php echo $playlist->id; ?>">
			<?php echo get_user_icon('delete'); ?>
		</a>
		<?php echo _('Delete'); ?>
	</li>
	<?php } ?>
</ul>
</div>
<?php show_box_bottom(); ?>
<?php
	Browse::set_type('playlist_song');
	Browse::add_supplemental_object('playlist',$playlist->id);
	Browse::set_static_content(1);
	Browse::show_objects($object_ids);
?>

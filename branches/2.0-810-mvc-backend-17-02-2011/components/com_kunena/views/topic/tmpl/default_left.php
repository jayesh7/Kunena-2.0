<?php
/**
 * @version $Id$
 * Kunena Component
 * @package Kunena
 *
 * @Copyright (C) 2008 - 2011 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>
<div class="kmsg-header kmsg-header-left">
	<h2>
		<span class="kmsgtitle<?php echo $this->escape($this->msgsuffix) ?> kmsg-title-left">
			<?php echo $this->escape($this->message->subject) ?>
		</span>
		<span class="kmsgdate kmsgdate-left" title="<?php echo CKunenaTimeformat::showDate($this->message->time, 'config_post_dateformat_hover') ?>">
			<?php echo CKunenaTimeformat::showDate($this->message->time, 'config_post_dateformat') ?>
		</span>
		<span class="kmsg-id-left">
			<a name="<?php echo intval($this->message->id) ?>"></a>
			<?php echo $this->numLink ?>
		</span>
	</h2>
</div>
<table <?php echo $this->class ?>>
	<tbody>
		<tr>
			<td rowspan="2" class="kprofile-left">
				<?php $this->displayMessageProfile('vertical') ?>
			</td>
			<td class="kmessage-left">
				<?php $this->displayMessageContents() ?>
			</td>
		</tr>
		<tr>
			<td class="kbuttonbar-left">
				<?php $this->displayMessageActions() ?>
			</td>
		</tr>
	</tbody>
</table>

<!-- Begin: Message Module Position -->
<?php $this->getModulePosition('kunena_msg_' . $this->mmm) ?>
<!-- Finish: Message Module Position -->
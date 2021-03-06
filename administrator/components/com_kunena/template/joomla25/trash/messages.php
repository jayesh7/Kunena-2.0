<?php
/**
 * Kunena Component
 * @package Kunena.Administrator.Template
 * @subpackage Trash
 *
 * @copyright (C) 2008 - 2012 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$document = JFactory::getDocument();
$document->addStyleSheet ( JUri::base(true).'/components/com_kunena/media/css/admin.css' );
if (JFactory::getLanguage()->isRTL()) $document->addStyleSheet ( JUri::base(true).'/components/com_kunena/media/css/admin.rtl.css' );
?>
<div id="kadmin">
	<div class="kadmin-left"><?php include KPATH_ADMIN.'/template/joomla25/common/menu.php'; ?></div>
	<div class="kadmin-right">
	<div class="kadmin-functitle icon-trash">
		<?php echo JText::_('COM_KUNENA_TRASH_VIEW').' '.JText::_( 'COM_KUNENA_TRASH_MESSAGES') ?>
	</div>
		<form action="<?php echo KunenaRoute::_('administrator/index.php?option=com_kunena&view=trash') ?>" method="post" id="adminForm" name="adminForm">

			<fieldset id="filter-bar">
				<div class="filter-search fltlft">
					<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('COM_KUNENA_FILTER'); ?>:</label>
					<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('list.search')); ?>" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />

					<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
					<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
				</div>
				<div class="filter-select fltrt">
					<select name="filter_order_Dir" class="inputbox" onchange="this.form.submit()">
						<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC');?></option>
						<?php echo JHtml::_('select.options', $this->sortDirectionOrdering, 'value', 'text', $this->escape ($this->state->get('list.direction')));?>
					</select>
				</div>
				</fieldset>
			<div class="clr"> </div>

			<table class="adminlist table table-striped">
			<thead>
				<tr>
					<th width="5" align="left"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count ( $this->trash_items ); ?>);" /></th>
					<th align="left" ><?php
					echo JHtml::_( 'grid.sort', 'COM_KUNENA_TRASH_TITLE', 'm.subject', $this->state->get('list.direction'), $this->state->get('list.ordering'));
					?></th>
					<th align="left">
						<?php echo JHtml::_( 'grid.sort', 'COM_KUNENA_MENU_TOPIC', 'tt.id', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
					</th>
					<th align="left" >
					<?php echo JHtml::_( 'grid.sort', 'COM_KUNENA_TRASH_CATEGORY', 'm.category', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
					</th>
					<th align="left" ><?php
					echo JHtml::_( 'grid.sort', 'COM_KUNENA_TRASH_IP', 'm.ip', $this->state->get('list.direction'), $this->state->get('list.ordering'));
					?></th>
					<th align="left" ><?php
					echo JHtml::_( 'grid.sort', 'COM_KUNENA_TRASH_AUTHOR', 'm.name', $this->state->get('list.direction'), $this->state->get('list.ordering'));
					?></th>
					<th align="left" ><?php
					echo JHtml::_( 'grid.sort', 'COM_KUNENA_TRASH_DATE', 'm.time', $this->state->get('list.direction'), $this->state->get('list.ordering'));
					?></th>
					<th width="5" align="left"><?php
					echo JHtml::_( 'grid.sort', 'COM_KUNENA_TRASH_ID', 'm.id', $this->state->get('list.direction'), $this->state->get('list.ordering'));
					?></th>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<label for="filter_title" class="element-invisible"><?php echo JText::_('COM_KUNENA_FIELD_LABEL_SEARCH_IN');?>:</label>
						<input class="input-block-level input-filter" type="text" name="filter_title" id="filter_title" placeholder="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" value="<?php echo $this->filterTitle; ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" />
					</td>
					<td>
						<label for="filter_topic" class="element-invisible"><?php echo JText::_('COM_KUNENA_FIELD_LABEL_SEARCH_IN');?>:</label>
						<input class="input-block-level input-filter" type="text" name="filter_topic" id="filter_topic" placeholder="<?php echo 'Filter'; ?>" value="<?php echo $this->filterTopic; ?>" title="<?php echo 'Filter'; ?>" />
					</td>
					<td>
						<label for="filter_category" class="element-invisible"><?php echo JText::_('COM_KUNENA_FIELD_LABEL_SEARCH_IN');?>:</label>
						<input class="input-block-level input-filter" type="text" name="filter_category" id="filter_category" placeholder="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" value="<?php echo $this->filterCategory; ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" />
					</td>
					<td class="nowrap">
						<label for="filter_ip" class="element-invisible"><?php echo JText::_('COM_KUNENA_FIELD_LABEL_SEARCH_IN');?>:</label>
						<input class="input-block-level input-filter" type="text" name="filter_ip" id="filter_ip" placeholder="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" value="<?php echo $this->filterIp; ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" />
					</td>
					<td class="nowrap center">
						<label for="filter_author" class="element-invisible"><?php echo JText::_('COM_KUNENA_FIELD_LABEL_SEARCH_IN');?>:</label>
						<input class="input-block-level input-filter" type="text" name="filter_author" id="filter_author" placeholder="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" value="<?php echo $this->filterAuthor; ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" />
					</td>
					<td class="nowrap center">
						<label for="filter_date" class="element-invisible"><?php echo JText::_('COM_KUNENA_FIELD_LABEL_SEARCH_IN');?>:</label>
						<input class="input-block-level input-filter" type="text" name="filter_date" id="filter_date" placeholder="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" value="<?php echo $this->filterDate; ?>" title="<?php echo JText::_('JSEARCH_FILTER_LABEL') ?>" />
					</td>
					<td class="nowrap center">
					</td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="9">
						<div class="pagination">
							<div class="limit"><?php echo JText::_('COM_KUNENA_A_DISPLAY'). $this->navigation->getLimitBox (); ?></div>
							<?php echo $this->navigation->getPagesLinks (); ?>
							<div class="limit"><?php echo $this->navigation->getResultsCounter (); ?></div>
						</div>
					</td>
				</tr>
			</tfoot>
				<?php
					$k = 0;
					$i = 0;
					foreach ( $this->trash_items as $id => $row ) {
						$k = 1 - $k;
						?>
				<tr class="row<?php
						echo $k;
						?>">
					<td align="center"><?php echo JHtml::_('grid.id', $i++, intval($row->id)) ?></td>
					<td ><?php
						echo $this->escape($row->subject);
						?></td>
					<td><?php echo $this->escape($row->getTopic()->subject); ?></td>
					<td ><?php
						$cat = KunenaForumCategoryHelper::get($row->catid);
						echo $this->escape($cat->name);
						?></td>
					<td ><?php
							echo $this->escape($row->ip);
						?></td>
					<td ><?php
						echo $this->escape($row->getAuthor()->getName());
						?></td>
					<td ><?php
						echo strftime('%Y-%m-%d %H:%M:%S',$row->time);
						?></td>
					<td ><?php
						echo intval($row->id) ?></td>
				</tr>
				<?php
					}
					?>
			</table>
			<input type="hidden" name="type" value="<?php echo $this->escape ($this->state->get('layout')) ?>" />
			<input type="hidden" name="layout" value="<?php echo $this->escape ($this->state->get('layout')) ?>" />
			<input type="hidden" name="filter_order" value="<?php echo intval ( $this->state->get('list.ordering') ) ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $this->escape ($this->state->get('list.direction')) ?>" />
			<input type="hidden" name="limitstart" value="<?php echo intval ( $this->navigation->limitstart ) ?>" />
			<input type="hidden" name="view" value="trash" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<?php echo JHtml::_( 'form.token' ); ?>
		</form>
	</div>
	<div class="kadmin-footer">
		<?php echo KunenaVersion::getLongVersionHTML (); ?>
	</div>
</div>

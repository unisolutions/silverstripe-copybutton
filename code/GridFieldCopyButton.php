<?php
/**
 * This component provides a button for copying record.
 * First of all it dublicates record and then opens opens edit form {@link GridFieldDetailForm}.
 *
 * @package framework
 * @subpackage gridfield
 * @author Elvinas Liutkevičius <elvinas@unisolutions.eu>
 * @license BSD http://silverstripe.org/BSD-license
 */
class GridFieldCopyButton implements GridField_ColumnProvider {

	public function augmentColumns($gridField, &$columns) {
		if(!in_array('Actions', $columns))
			$columns[] = 'Actions';
	}

	public function getColumnAttributes($gridField, $record, $columnName) {
		return array('class' => 'col-buttons');
	}

	public function getColumnMetadata($gridField, $columnName) {
		if($columnName == 'Actions') {
			return array('title' => '');
		}
	}

	public function getColumnsHandled($gridField) {
		return array('Actions');
	}

	public function getActions($gridField) {
		return array();
	}

	public function getColumnContent($gridField, $record, $columnName) {
		$data = new ArrayData(array(
			'Link' => Controller::join_links($gridField->Link('item'), $record->ID, 'copy')
		));
		return $data->renderWith('GridFieldCopyButton');
	}

	public function handleAction(GridField $gridField, $actionName, $arguments, $data) {

	}

}

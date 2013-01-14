<?php
/**
 * Adds copy operation to the GridFieldDetailForm {@link GridFieldDetailForm}
 *
 * @package framework
 * @subpackage gridfield
 * @author Elvinas Liutkevičius <elvinas@unisolutions.eu>
 * @license BSD http://silverstripe.org/BSD-license
 */
class GridFieldDetailFormCustom extends GridFieldDetailForm {
}

class GridFieldDetailFormCustom_ItemRequest extends GridFieldDetailForm_ItemRequest {

	function copy($request) {
		// TODO: we need to redirrect to the edit action, because refreshing window with copy action leaved will create new a record at the database.
		$this->record = $this->record->duplicate();
		return parent::edit($request);
	}

}
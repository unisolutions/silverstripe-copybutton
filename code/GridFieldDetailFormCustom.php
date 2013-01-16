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
		$this->record = $this->record->duplicate();
		return Controller::curr()->redirect($this->Link('edit'));
	}

}
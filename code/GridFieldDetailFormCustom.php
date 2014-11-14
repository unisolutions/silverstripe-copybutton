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

	private static $allowed_actions = array(
		'copy',
	);

	function copy($request) {
		$current_record = $this->record;
		$clone = $this->record->duplicate();
		if (!$clone || $clone->ID < 1) {
			user_error("Error Duplicating!",
				E_USER_ERROR);
		}

		return Controller::curr()->redirect($this->Link('edit'));
	}

}

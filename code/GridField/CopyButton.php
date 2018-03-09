<?php

namespace Unisolutions\GridField;

use SilverStripe\Forms\GridField\GridField_ColumnProvider;
use SilverStripe\Forms\GridField\GridField_ActionProvider;
use SilverStripe\Forms\GridField\GridField_FormAction;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\ValidationException;

/**
 * This component provides a button for copying record.
 * First of all it dublicates record and then opens opens edit form {@link GridFieldDetailForm}.
 *
 * @package framework
 * @subpackage gridfield
 * @author Elvinas Liutkevičius <elvinas@unisolutions.eu>
 * @license BSD http://silverstripe.org/BSD-license
 */
class CopyButton implements GridField_ColumnProvider, GridField_ActionProvider
{

    public function augmentColumns($gridField, &$columns)
    {
        if (!in_array('Actions', $columns)) {
            $columns[] = 'Actions';
        }
    }

    public function getColumnAttributes($gridField, $record, $columnName)
    {
        return array('class' => 'col-buttons');
    }

    public function getColumnMetadata($gridField, $columnName)
    {
        if ($columnName == 'Actions') {
            return array('title' => '');
        }
    }

    public function getColumnsHandled($gridField)
    {
        return array('Actions');
    }

    public function getActions($gridField)
    {
        return array('copyrecord');
    }

    public function getColumnContent($gridField, $record, $columnName)
    {
        if (!$record->canCreate()) {
            return;
        }
        $field = GridField_FormAction::create($gridField,  'CopyRecord'.$record->ID, false, "copyrecord",
                array('RecordID' => $record->ID))
            ->addExtraClass('gridfield-button-copy')
            ->setAttribute('title', _t('GridAction.Copy', "Copy"))
            ->setDescription(_t('GridAction.COPY_DESCRIPTION', 'Copy'));

        return $field->Field();
    }

    public function handleAction(GridField $gridField, $actionName, $arguments, $data)
    {
        if ($actionName == 'copyrecord') {
            /** @var \SilverStripe\ORM\DataObject $item */
            $item = $gridField->getList()->byID($arguments['RecordID']);
            if (!$item) {
                return;
            }

            if (!$item->canCreate()) {
                throw new ValidationException(
                    _t('GridFieldAction_Copy.CreatePermissionsFailure', "No create permissions"), 0);
            }

            $clone = $item->duplicate();
            if (!$clone || $clone->ID < 1) {
                user_error("Error Duplicating!", E_USER_ERROR);
            }
        }
    }
}

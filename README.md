silverstripe-copybutton
=======================

Adds copy button to the GridField

## Maintainer Contact

Elvinas Liutkevičius

<elvinas (at) unisolutions (dot) eu>

## Requirements

SilverStripe 3

## Documentation

Simply install the module using the standard method.

To add the button to the GridField you need to extend ModelAdmin and
override getEditForm() method like this:

	function getEditForm($id = null, $fields = null) {
		$form = parent::getEditForm();

		$form
			->Fields()
			->fieldByName($this->sanitiseClassName($this->modelClass))
			->getConfig()
			->addComponent(new GridFieldCopyButton(), 'GridFieldEditButton') // or just ->addComponent(new GridFieldCopyButton())
		;

		return $form;
	}


This action will make exact copy of the record (with all relations and etc.).
Sometimes you will need to do some actions just after copy operation (i.e.
you'll need to remove some relations). It is easily achieved by extending
DataObject and writing all the actions in the onAfterDuplicate() method.

	class SomeObjectExtension extends DataExtension {

		public function onAfterDuplicate() {
			DB::query("delete from Member_SomeObject where SomeObjectID = ".$this->owner->ID);
		}

	}

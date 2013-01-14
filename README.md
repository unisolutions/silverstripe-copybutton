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
			->removeComponentsByType('GridFieldEditButton')
			->removeComponentsByType('GridFieldDeleteAction')
			->removeComponentsByType('GridFieldDetailForm')
			->addComponent(new GridFieldDetailFormCustom())
			->addComponent(new GridFieldCopyButton())
			->addComponent(new GridFieldEditButton())
			->addComponent(new GridFieldDeleteAction())
		;

		return $form;
	}
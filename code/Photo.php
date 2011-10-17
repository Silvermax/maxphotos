<?php
class Photo extends DataObject
{
	static $db = array (
		'Name' => 'Text'
	);
	
	static $has_one = array (
		'PhotoImage' => 'Image',
        'PhotosPage' => 'PhotosPage'
	);
	
	public function getCMSFields_forPopup()
	{
		$fields = new FieldSet(
			new TextField('Name')
		);
		$this->extend('updateCMSFields_forPopup', $fields);
   		return $fields;
	}
	
}
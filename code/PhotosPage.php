<?php

class PhotosPage extends Page {
		
	public static $db = array(
		'Starred' => 'Boolean'
	);
	
	public static $has_many = array(
        'Photos' => 'Photo'
	);
	
	static $default_parent = 'PhotosPageHolder';
	
	public function getCMSFields()   {
        $fields = parent::getCMSFields();
		
		$fields->addFieldToTab("Root.Content.Photos", new CheckboxField("Starred", "Starred"));    
        
        $manager = new ImageDataObjectManager(
			$this, 
			'Photos',
			'Photo', 
			'PhotoImage', 
			array(
				'Name' => 'Názov',
			), // Headings 
			'getCMSFields_forPopup'
		);
		$manager->setUploadFolder('Photos/'.$this->ID);
        $fields->addFieldToTab("Root.Content.Photos", $manager);     
        
        return $fields;
   } 
	
	function previewImages($limit = 1) {
			if (Translatable::is_enabled()) {
				return $this->getTranslation(Translatable::default_locale())->Photos(NULL,NULL,NULL,$limit);
			} else {
				return $this->Photos(NULL,NULL,NULL,$limit);
			}
	}
	
}

class PhotosPage_Controller extends Page_Controller {
    	
    public function init() {
        parent::init();
		if (class_exists("Floatbox"))  Floatbox::initialize();
        Requirements::themedCSS("PhotosPage");
    }
	
}

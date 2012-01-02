<?php

class PhotosPage extends Page {
		
	public static $db = array(
		'photosFromDefaultLang' => 'Boolean',
		'previewPhotosCount' => "Int(1)"
	);
	
	public static $has_many = array(
        'Photos' => 'Photo'
	);
	
	static $default_parent = 'PhotosPage';
	
	static $allowed_children = array('PhotosPage');
	
	public function getCMSFields()   {
        $fields = parent::getCMSFields();
		
		if (DataObject::get_one("PhotosPage","ParentID = '$this->ID'")) {
			$fields->addFieldToTab("Root.Content.Photos", new TextField("previewPhotosCount", "This pages has children PhotosPages. Limit number of preview Photos of children PhotoPages by setting this value. Notice: some themes are using fixed Photos count and changing this value will not change anything! Ask your developer..."));    
		}
		
		if (Translatable::is_enabled() && $this->Locale != Translatable::default_locale()) {
			$fields->addFieldToTab("Root.Content.Photos", new CheckboxField("photosFromDefaultLang", "Get Photos from default language (".Translatable::default_locale().")?"));    
		}

		if ($this->usePhotosFromDefaultLang()) {
			$count = 0;
			$tPage = $this->getTranslation(Translatable::default_locale()); 
			if ($tPage) {
				if ($tPage->Photos()) {
					$count = $tPage->Photos()->count();
				}
				$fields->addFieldToTab("Root.Content.Photos", new LiteralField("TranslatableNoticeForPhotos","This page shares photos from " . Translatable::default_locale() . " language. Photos count: " . $count));
			} else {
				$fields->addFieldToTab("Root.Content.Photos", new LiteralField("TranslatableNoticeForPhotos","This page needs translated page in default language (" . Translatable::default_locale() . "), but this page doesn't exists. Create one or uncheck checkbox which enables using default language's photos."));
			}
		} else {
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
		}
        
        return $fields;
   } 

	function usePhotosFromDefaultLang() {
		return (Translatable::is_enabled() && $this->Locale != Translatable::default_locale() && $this->photosFromDefaultLang) ? true : false;
	}

	function allPhotos() {
			if ($this->usePhotosFromDefaultLang()) {
				return $this->getTranslation(Translatable::default_locale())->Photos();
			} else {
				return $this->Photos();
			}
	}
	
	function previewPhotos($limit = false) {
			$limit = ($limit) ? $limit : $this->Parent()->previewPhotosCount;
			if ($this->usePhotosFromDefaultLang()) {
				return $this->getTranslation(Translatable::default_locale())->Photos(NULL,NULL,NULL,$limit);
			} else {
				return $this->Photos(NULL,NULL,NULL,$limit);
			}
	}
	
	function previewImages($limit = 1) {
		return $this->previewPhotos($limit);
	}
	
}

class PhotosPage_Controller extends Page_Controller {
    	
    public function init() {
        parent::init();
		if (class_exists("Floatbox"))  Floatbox::initialize();
    }
	
}

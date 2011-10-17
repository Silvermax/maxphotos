<?php

class PhotosPageHolder extends Page {
	
	static $allowed_children = array(
		'PhotosPage'
	);
	
}

class PhotosPageHolder_Controller extends Page_Controller {
	public function init() {
        parent::init();
		if (class_exists("Floatbox"))  Floatbox::initialize();
        Requirements::themedCSS("PhotosPage");
    }
}

// EOF

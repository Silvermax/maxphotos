<?php
/**
 *
 * 
 */

class PhotoImageDecorator extends DataObjectDecorator {
	
	public static $PhotoImageWidth = 170;
	
	public static $PhotoImageHeight = 111;
	
	function generatePhotoThumb($gd) {
		return $gd->croppedResize(self::$PhotoImageWidth,self::$PhotoImageHeight);
	}
	
	function PhotoThumb() {
		return $this->owner->getFormattedImage('PhotoThumb');
	}	
	
}


<?php

class MaxPhoto extends DataObject
{
    public static $db = array(
        "Title" => "Varchar",
        "SortOrder" => "Int"
    );
    
    public static $default_sort = "SortOrder";

    public static $has_one = array(
            'Page' => 'Page',
            'Image' => 'Image'
    );
    
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        
        // Toto zobrazíme len pri BulkUpload, kde zadaný nadpis skopírujeme do Title obrázka
        if ($this->ID) {
            $fields->removeFieldFromTab("Root.Main", "Title");
            if ($Image = $this->Image()) {
                $fields->addFieldToTab('Root.Main', TextField::create("TitleTemp", "Nadpis", $Image->Title));
            }
        }
        $fields->removeFieldFromTab("Root.Main", "SortOrder");
        $fields->removeFieldFromTab("Root.Main", "PageID");

        return $fields;
    }
    
    public function onBeforeWrite()
    {
        $LastEdited = $this->LastEdited;
        
         
        parent::onBeforeWrite();
        if (!empty($this->TitleTemp)) {
            $this->Title = $this->TitleTemp;
        }
    }
    
    /*
     *  Skopírujeme nadpis 
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        $Image = $this->Image();
        if ($Image) {
            $Image->Title = $this->Title;
            $Image->write();
        }
    }
}

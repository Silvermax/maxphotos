<?php

class MaxPhotosPageExtension extends Extension
{
        
    public static $has_many = array(
        "MaxPhotos" => "MaxPhoto"
    );
        
    public function updateCMSFields(FieldList $fields)
    {
        if (class_exists("Translatable") && $this->owner->Locale != Translatable::default_locale() && !$this->owner->MaxPhotos()->exists()) {
            $tPage = $this->owner->getTranslation(Translatable::default_locale());
            if ($tPage) {
                if ($tmp = $tPage->MaxPhotos()) {
                    $count = $tmp->count();
                    $fields->addFieldToTab("Root.Images", new LiteralField("TranslatableNoticeForPhotos", "This page shares photos from " . Translatable::default_locale() . " language. Photos count: " . $count .". If you want different photos, add it here ;)"));
                }
            }
        }
        
        $config = GridFieldConfig_RelationEditor::create();
        $config->addComponent(new GridFieldSortableRows('SortOrder'));
        $config->addComponent(new GridFieldBulkImageUpload());
        $config->addComponent(new GridFieldGalleryTheme('Image'));
        $GridField = new GridField('MaxPhotos', 'MaxPhotos', $this->owner->MaxPhotos(), $config);
        
        $fields->addFieldToTab('Root.Images', $GridField);
    }
    
    public function tMaxPhotos()
    {
        if (class_exists("Translatable") && $this->owner->Locale != Translatable::default_locale() && !$this->owner->MaxPhotos()->exists()) {
            $tPage = $this->owner->getTranslation(Translatable::default_locale());
            if ($tPage) {
                return $tPage->MaxPhotos();
            }
        }
        return $this->owner->MaxPhotos();
    }
}

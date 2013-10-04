<?php
class Podcast extends Page {
   static $db = array(
     'EpisodeTitle' => 'Text',
     'Subject' => 'Text',
     'Summary' => 'Text',
     'Duration' => 'Text',
     'Date' => 'Date',
     'Artist' => 'Text',
     'ExternalLink' => 'Text'
  );
   static $has_one = array(
     'Audio' => 'File'
   );
    static $allowed_children = "none";
    static $can_be_root = false;
    static $default_sort = "Date DESC"; 
    static $defaults = array(
      'ShowInMenus' => false
    );

   function getCMSFields() {
      $fields = parent::getCMSFields();
         
      $fields->addFieldToTab('Root.Main', new TextField('EpisodeTitle'), 'Content');
      $fields->addFieldToTab('Root.Main', new TextField('Subject'), 'Content');
      $fields->addFieldToTab('Root.Main', new TextAreaField('Summary'), 'Content');
      $fields->addFieldToTab('Root.Main', new TextField('Duration'), 'Content');
      $fields->addFieldToTab('Root.Main', $dateField = new DateField('Date','Record Date (for example: 20/12/2010)'), 'Content');
      $dateField->setConfig('showcalendar', true);
      $fields->addFieldToTab('Root.Main', new TextField('Artist'), 'Content');
      $fields->addFieldToTab('Root.Main', $uploadField = new UploadField('Audio'), 'Content');
      $uploadField->setFolderName('podcastfiles');
      $uploadField->getValidator()->setAllowedExtensions(array('mp3', 'm4a'));
      $fields->addFieldToTab('Root.Main', new TextField("ExternalLink", "or enter the link to an externally hosted MP3/M4a file (eg dropbox)", "Content") );
       //remove Content field
      $fields->removeByName('Content');
      $fields->removeByName('Metadata');
         
      return $fields;
    }
}
class Podcast_Controller extends Page_Controller {

}
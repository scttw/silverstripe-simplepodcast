<?php
class PodcastHolder extends Page {
	
	public static $db = array(
		'PodcastTitle' => 'Varchar',
		'Copyright' => 'Varchar',
		'Description' => 'Text',
		'PodcastOwner' => 'Varchar',
		'Email' => 'Varchar',
		'Category' => 'Varchar'
	);
	
	public static $has_one = array(
		'PodcastIcon' => 'Image'
	);	
  static $allowed_children = array("Podcast");
  static $default_child = "Podcast";
  
  function getCMSFields() {
    $fields = parent::getCMSFields();
     
    $fields->addFieldToTab('Root.Main', new TextField('PodcastTitle'), 'Content');
    $fields->addFieldToTab('Root.Main', new TextField('Copyright'), 'Content');
    $fields->addFieldToTab('Root.Main', new TextAreaField('Description'), 'Content');
    $fields->addFieldToTab('Root.Main', new TextField('PodcastOwner'), 'Content');
    $fields->addFieldToTab('Root.Main', new EmailField('Email'), 'Content');
    $fields->addFieldToTab('Root.Main', new TextField('Category'), 'Content');
    $fields->addFieldToTab('Root.Main', new UploadField('PodcastIcon'), 'Content');
     //remove Content field
    $fields->removeByName('Content');
    $fields->removeByName('Metadata');
     
    return $fields;
  }

	
}
class PodcastHolder_Controller extends Page_Controller {
	public function init() {
        RSSFeed::linkToFeed($this->Link("rss"), "Podcast feed");
        parent::init();
    }

  function rss() {
    return $this->renderWith("PodcastFeed");
  }
  function FeedLink() {
    return $this->AbsoluteLink()."rss";
  }
  function iTunesLink() {
    return str_replace("http://", "itp://", $this->AbsoluteLink()."rss");
  }
  public function PodcastList(){
    //$children = $this->Children();
    $children = DataObject::get('Podcast', "ParentID = $this->ID"); 
    if( !$children )
      return null; 
      $children->sort('Date', 'DESC');
      $children->limit(15);
    return $children;
  }
}


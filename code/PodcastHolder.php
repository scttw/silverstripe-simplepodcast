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
		if(!isset($_GET['start']) || !is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0;
		$SQL_start = (int)$_GET['start']; 
		$children = DataObject::get(
			$callerClass = 'Podcast',
			$filter = "ParentID = $this->ID",
			$sort = 'Date DESC',
			$join = '',
			$limit = "$SQL_start, 12" 
		); 
		if( !$children )
			return null; 

		return $children;
	}
}


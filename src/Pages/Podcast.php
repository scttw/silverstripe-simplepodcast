<?php
namespace scttw\Podcast\Models;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class Podcast extends \Page
{

    private static $table_name = 'Podcast';

	private static $db = array(
		'EpisodeTitle' => 'Text',
		'Subject' => 'Text',
		'Summary' => 'Text',
		'Duration' => 'Text',
		'Date' => 'Datetime',
		'Artist' => 'Text',
		'ExternalLink' => 'Text'
	);

    /**
     * @var array
     */
    private static $indexes = [
        'Date' => true,
    ];

	private static $has_one = array(
		'Audio' => File::class
	);

    private static $casting = array(
        'Date'   => 'Date',
    );

    private static $default_sort = '"Date" IS NULL DESC, "Date" DESC';

    private static $show_in_sitetree = false;
    private static $allowed_children = [];
    private static $can_be_root = false;
	private static $defaults = array(
		'ShowInMenus' => false
	);

    public function populateDefaults()
    {
        $this->Date = date('Y-m-d');
        parent::populateDefaults();
    }

//    public function validate()
//    {
//        $result = parent::validate();
//
//        if (!$this->Date) {
//            $result->addError('Please add a podcast date');
//        }
//
//        return $result;
//    }

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', TextField::create('EpisodeTitle'), 'Content');
		$fields->addFieldToTab('Root.Main', TextField::create('Subject'), 'Content');
		$fields->addFieldToTab('Root.Main', TextareaField::create('Summary'), 'Content');
		$fields->addFieldToTab('Root.Main', TextField::create('Duration'), 'Content');
		$fields->addFieldToTab('Root.Main', $dateField = DateField::create('Date','Record Date (for example: 20/12/2010)'), 'Content');
//		$dateField->setConfig('showcalendar', true);
		$fields->addFieldToTab('Root.Main', TextField::create('Artist'), 'Content');
		$fields->addFieldToTab('Root.Main', $uploadField = UploadField::create('Audio'), 'Content');
		$uploadField->setFolderName('podcastfiles');
		$uploadField->getValidator()->setAllowedExtensions(array('mp3', 'm4a'));
		$fields->addFieldToTab('Root.Main', TextField::create("ExternalLink", "or enter the link to an externally hosted MP3/M4a file (eg dropbox)", "Content") );
	//remove Content field
		$fields->removeByName('Content');
		$fields->removeByName('Metadata');

		return $fields;
	}
}

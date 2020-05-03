<?php

namespace scttw\Podcast\Models;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Lumberjack\Model\Lumberjack;

class PodcastHolder extends \Page
{
    private static $table_name = 'PodcastHolder';
    private static $db = array(
        'PodcastTitle' => 'Varchar',
        'Copyright'    => 'Varchar',
        'Description'  => 'Text',
        'PodcastOwner' => 'Varchar',
        'Email'        => 'Varchar',
        'Category'     => 'Varchar'
    );

    private static $has_one = array(
        'PodcastIcon' => Image::class
    );

    private static $allowed_children = [Podcast::class];
    private static $default_child = Podcast::class;

    private static $extensions = [
        Lumberjack::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('PodcastTitle'), 'Content');
        $fields->addFieldToTab('Root.Main', TextField::create('Copyright'), 'Content');
        $fields->addFieldToTab('Root.Main', TextareaField::create('Description'), 'Content');
        $fields->addFieldToTab('Root.Main', TextField::create('PodcastOwner'), 'Content');
        $fields->addFieldToTab('Root.Main', EmailField::create('Email'), 'Content');
        $fields->addFieldToTab('Root.Main', TextField::create('Category'), 'Content');
        $fields->addFieldToTab('Root.Main', UploadField::create('PodcastIcon'), 'Content');
        //remove Content field
        $fields->removeByName('Content');
        $fields->removeByName('Metadata');

        return $fields;
    }

    public function PodcastList()
    {
        $children = Podcast::get()->filter('ParentID', $this->ID)->sort('Date DESC');

        return $children;
    }
}

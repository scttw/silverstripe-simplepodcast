<?php

namespace scttw\Podcast\Models;

use SilverStripe\Forms\EmailField;

class PodcastUploadPage extends \Page {
    private static $table_name = "PodcastUploadPage";

    private static $db = [
        'NotificationEmail' => 'Varchar(100)',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->insertAfter('MenuTitle', EmailField::create('NotificationEmail'));

        return $fields;
    }

}


<?php


namespace scttw\Podcast\Models;


use scttw\Podcast\Models\Podcast;
use SilverStripe\Control\RSS\RSSFeed;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\PaginatedList;

class PodcastHolderController extends \PageController
{
    private static $allowed_actions = array(
        'rss'
    );

    public function init()
    {
        RSSFeed::linkToFeed($this->Link("rss"), "Podcast feed");
        parent::init();
    }

    function rss()
    {
        return $this->renderWith("PodcastFeed");
    }

    function FeedLink()
    {
        return $this->AbsoluteLink() . "rss";
    }

    function iTunesLink()
    {
        return str_replace("http://", "itms://", $this->AbsoluteLink() . "rss");
    }


}


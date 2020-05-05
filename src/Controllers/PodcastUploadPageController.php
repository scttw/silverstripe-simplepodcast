<?php


namespace scttw\Podcast\Models;


use scttw\Podcast\Models\Podcast;
use scttw\Podcast\Models\PodcastHolder;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\FormMessage;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;


class PodcastUploadPageController extends \PageController
{
    private static $allowed_actions = array(
        'PodcastUploadForm'
    );


    public function init()
    {
        parent::init();
    }


    public function PodcastUploadForm()
    {
        $uploadfield = UploadField::create('Audio');
        $uploadfield->setIsMultiUpload(false);
        $uploadfield->setAllowedExtensions(array('mp3'));
        $uploadfield->setFolderName('podcastfiles/new');

        // die(print_r('here'));

        $fields = FieldList::create(
            TextField::create('EpisodeTitle'),
            TextField::create('Subject', 'Sermon Series'),
            TextareaField::create('Summary', 'Podcast Description'),
            TextField::create('Duration', 'Duration (in minutes and seconds, eg 34:33)'),
            $datefield = DateField::create('Date', 'Record Date (for example: 2010-06-22)'),
            TextField::create('Artist', 'Sermon preacher (eg Leigh Roberts)'),
            $uploadfield
        );



        $actions = FieldList::create(
            FormAction::create('doPodcastUpload', 'Submit')
        );
        $validator = RequiredFields::create('Audio', 'EpisodeTitle', 'Duration', 'Date', 'Artist');
        $form = Form::create($this, 'PodcastUploadForm', $fields, $actions, $validator);
        return $form;
    }

    public function doPodcastUpload($data, $form)
    {


        $page = Podcast::create();
        $form->saveInto($page);
        $page->Title = date('d M, Y', strtotime($data['Date']));
        $page->EpisodeTitle = $data['EpisodeTitle'];
        $page->Subject = $data['Subject'];
        $page->Summary = $data['Summary'];
        $page->Duration = $data['Duration'];
        $page->Date = date('Y-m-d', strtotime($data['Date']));
        $page->ParentID = PodcastHolder::get()->first()->ID;
        $page->Artist = $data['Artist'];
        //$page->Audio = $data['Audio'];
        $page->ShowInMenus = false;
        $page->ShowInSearch = true;
        $page->writeToStage('Stage');
        // $page->publish('Stage', 'Live');
        $page->flushCache();


        // send email
        $body = '';
        $body .= 'A new podcast has been uploaded:  ' . Director::absoluteURL($page->CMSEditLink());
        $email = new Email(Email::admin_email, $this->NotificationEmail, 'Podcast Upload', $body);
        $email->sendPlain();

        return $data = array(
            'Title'             => 'Thanks',
            'Content'           => 'Your Podcast has been submitted.',
            'PodcastUploadForm' => ''
        );
    }

}

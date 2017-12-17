<?php

namespace Controllers;

use \Components\Record\RecordGenerateFacade;
use \Components\Base\View;

/**
 * Class MainController
 * @package Controllers
 */
class MainController
{
    public $view;
    /**
     * @var \Components\Record\RecordGenerateFacade
     */
    private $record;

    private function __construct() {
        $this->view = new View();
    }

    static function run()
    {
        $instance = new MainController();
        $instance->init();
        $instance->indexAction();
    }

    private function init()
    {
        $record = new RecordGenerateFacade();
        $record->recordsGenerate();
        $record->insertRecordToDb();
        $this->record = $record;
    }

    private function indexAction(){
        $dataForView = [];
        $records = $this->record->getDataForView();
        $dataForView['records'] = $records;
        $this->view->generate('list_new.php', 'template_view.php', $dataForView);
    }
} 
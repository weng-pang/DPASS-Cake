<?php
/**
 * Created by PhpStorm.
 * User: Weng Long Pang
 * Date: 31/01/2019
 * Time: 15:00
 */


namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\Time;
/**
 * RestUpload Command.
 *
 * This command allows records to be uploaded to DPASS RESTFul Service
 * It is particularly designed for records are yet to be uploaded to the said service
 */
class RestUploadCommand extends Command {


    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Records');
    }

    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser->setDescription('This command uploads Records into RESTful service');
        $parser
            ->addOption('all',[
                'short' => 'a',
                'help' => 'Upload all records',
                'boolean' => true
            ])
            ->addArgument('date', [
                'help' => 'The Date to start uploading. Format: YYYY-MM-DD',
                'required' => true
            ])
            ;
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        try {
            $date = new Time($args->getArgument('date'));
        } catch (\Exception $e){ // Date Validation
            $io->error('Please enter a valid date');
            die();
        }
        $uploadAll = $args->getOption('all');

        // Find all relevant records
        $recordSet = $this->Records
            ->find('all')
            ->where(['time >='=> $date])
        ;
        if (!$uploadAll){
            $recordSet->where(['rest_serial is null']);
        }
        // Upload the records to REST
        $io->out('Uploading '. $recordSet->count().' record(s)');
        $records = iterator_to_array($recordSet);
        $this->Records->addRestRecords($records);
        $io->out('Upload Completed');
    }
}
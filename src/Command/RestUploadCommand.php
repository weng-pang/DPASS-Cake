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

/**
 * RestUploadCommand shell command.
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
            ->addArgument('date', [
                'help' => 'The Date to start uploading'
            ]);
        $parser
            ->addArgument('all',[
                'help' => 'Upload all records'
            ]);

        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $io->out('Hello world.');
    }


}
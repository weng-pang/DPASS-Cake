<?php
namespace App\Command;

use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Symfony\Component\Process\Process;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\Time;
/**
 * ResetDatabase shell command.
 * This code is taken from Camelot IE Demonstration System, developed by Faculty of IT, Monash University
 */
class DatabaseResetCommand extends Command
{

    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser->setDescription('This command re-establishes the database from a backup sql file');
        return $parser;
    }


    public function execute(Arguments $args, ConsoleIo $io)
    {
        $connection = ConnectionManager::get('default'); // TODO DRY
        $db = $connection->config()['database'];
        $config = $connection->config();
        $fileList = array();
        // Find all relevant files from the directory
        // https://stackoverflow.com/questions/2922954/getting-the-names-of-all-files-in-a-directory-with-php
        foreach(glob(BACKUP_SCHEMA_DIR . $config['file_prefix'] . DOT . '*' . DOT . $config['file_type']) as $file){
            $fileList[] = $file;
        }
        debug(array_keys($fileList));
        if (sizeof($fileList) == 0) {
            $io->out('No backup files found. Aborting');
            die; // Exit the command if no files found
        }
        // Proceed to file selection
        do {
            $waitingForEntry = false;
            $io->out('Please select one of the backup file');
            $response = $io->askChoice('Type in the number and press enter',array_keys($fileList));
            // Input Validation

        } while ($waitingForEntry);
        $io->out("Dropping existing database");
        // Switching off referential integrity
        $connection->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();
//        $connection->prepare("DROP DATABASE {$db}")->execute();
//
//        $this->out("Recreating new database");
//        $connection->prepare("CREATE DATABASE {$db}")->execute();
//        $connection->prepare("USE {$db}")->execute();

        $io->out("Apply schema and data into the database");
//        $script = (new File(SCHEMA_DIR . $config['file_prefix'] .$config['file_type']))->read(); //TODO Add multiple file support
//        $connection->prepare($script)->execute();

        // Switching on referential integrity
        $connection->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();

        $io->success("Done!");
    }

    public function outputHelp()
    {
        $this->out($this->OptionParser->help());
    }
}

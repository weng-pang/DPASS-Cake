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
        $config = $connection->config();
        $fileList = array();
        $nameList = array();
        // Find all relevant files from the directory
        // https://stackoverflow.com/questions/2922954/getting-the-names-of-all-files-in-a-directory-with-php
        foreach(glob( BACKUP_SCHEMA_DIR . $config['file_prefix'] . DOT . '*' . DOT . $config['file_type']) as $file){
            $fileList[] = $file;
            $allNames = explode( DS , $file);
            $nameList[] = $allNames[sizeof($allNames) - 1];
        }

        if (sizeof($fileList) == 0) {
            $io->out('No backup files found. Aborting');
            die; // Exit the command if no files found
        }
        // Proceed to file selection
        do {
            $waitingForEntry = true;
            $io->out('Please select one of the backup file');
            print_r(($nameList));
            $response = $io->askChoice('Type in the number and press enter OR press n to leave:',array_keys($fileList));
            // Input Validation
            if(strtolower($response) == 'n'){
                die;
            } elseif (!array_key_exists($response,$fileList)){
                $io->error('The Key entered is invalid, please try again');
            } else {
                $waitingForEntry = false;
            }
        } while ($waitingForEntry);
        $io->out("Dropping existing database");
        // Switching off referential integrity
        $connection->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();
        $io->out("Apply schema and data into the database");
        $script = (new File($fileList[$response]))->read();
        $connection->prepare($script)->execute();
        // Switching on referential integrity
        $connection->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
        $io->success("Done!");
    }
}

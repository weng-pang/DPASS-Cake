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
        $parser->setDescription([
            'This command re-establishes the database from a backup sql file',
            'WARNING: Please backup the database before proceeding'
        ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $connection = ConnectionManager::get('default');
        $config = $connection->config();
        $fileList = array();
        $nameList = array();
        // Find all relevant files from the directory
        // https://stackoverflow.com/questions/2922954/getting-the-names-of-all-files-in-a-directory-with-php
        foreach(glob( BACKUP_SCHEMA_DIR . $config['file_prefix'] . '*' . DOT . $config['file_type']) as $file){
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
            $io->out('WARNING: Please backup the database before proceeding, leave now if you have not done so.');
            $io->out('Please select one of the backup file');
            print_r(($nameList));
            $response = $io->askChoice('Type in the number OR type n to leave:',array_keys($fileList));
            // Input Validation
            if(strtolower($response) == 'n'){
                die;
            } elseif (!array_key_exists($response,$fileList)){
                $io->error('The Key entered is invalid, please try again');
            } else {
                $waitingForEntry = false;
            }
        } while ($waitingForEntry);
        try{
            // Switching off referential integrity https://tableplus.io/blog/2018/08/mysql-how-to-drop-all-tables.html
            $io->out("Accessing the database: Switch off Foreign Key Checks");
            $connection->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();
            $io->out("Drop, then Apply schema and data into the database");
            $script = (new File($fileList[$response]))->read();
            $connection->prepare($script)->execute();
            // Switching on referential integrity
            $io->out("Final touches on the database: Switch on Foreign Key Checks");
            $connection->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
            $io->success("Done!");
        } catch (\Exception $exception){
            $io->error('Database Operation is unsuccessful. Please refer to the Message below');
            $io->error($exception->getMessage());
        }
    }
}

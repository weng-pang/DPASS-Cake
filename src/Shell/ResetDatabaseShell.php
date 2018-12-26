<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\File;

/**
 * ResetDatabase shell command.
 * This code is taken from Camelot IE Demonstration System, developed by Faculty of IT, Monash University
 */
class ResetDatabaseShell extends Shell
{

    /**
     *
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $connection = ConnectionManager::get('default'); // TODO DRY
        $db = $connection->config()['database'];
        $config = $connection->config();

//        $this->out("Dropping existing database");
//        $connection->prepare("DROP DATABASE {$db}")->execute();
//
//        $this->out("Recreating new database");
//        $connection->prepare("CREATE DATABASE {$db}")->execute();
//        $connection->prepare("USE {$db}")->execute();

        $this->out("Apply schema and data into the database");
        $script = (new File(SCHEMA_DIR . $config['file_prefix'] .$config['file_type']))->read(); //TODO Add multiple file support
        $connection->prepare($script)->execute();

        $this->out("Done!");
    }

    public function outputHelp()
    {
        $this->out($this->OptionParser->help());
    }
}

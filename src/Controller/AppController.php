<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\Core\Exception\Exception;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $settings;
    protected $marks;
    protected $languages;
    protected $keyError = "The API key is missing"; // This is the default message for key error;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    /**
     * Getting the Setting tables ready
     *
     * @param \Cake\Event\Event $event An Event instance
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        $this->settings = $this->loadModel('Settings');
        $this->marks = $this->loadModel('Marks');
        $this->languages = $this->loadModel('Languages');
        // Use the default language
        $default = (int)$this->settings->getSettings()->language_id;
        $code = $this->languages->get($default)['code'];
        I18n::setLocale($code); // using the default code
        return parent::beforeFilter($event);
    }

    /**
     *  Change Language method
     *
     * The language and locale may be amended here
     * Default locale is configured in bootstrap.php
     *
     * @param string $language
     */
    public function changeLanguage($language){
        $code = $this->languages->get($language)['code'];
        I18n::setLocale($code);
        $this->set('language',$language);
    }

    /**
     *  Find Mark Method
     *  The mark from the database is obtained by providing the keyword.
     *
     * @param string $keyword
     * @return int
     */
    public function getMark($keyword){

        return (int)$this->marks->find('all')->where(['keyword' => $keyword])->first()['mark'];
    }

    /**
     * Check method
     *
     * Check if a key is valid in the system
     * A key is valid only when all conditions are met:
     *  - it is presented in the system
     *  - it is not expired
     *  - it is not revoked
     *
     * @param string|null $key Api Key.
     * @return boolean
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When the key is not found.
     * @throws KeyInvalidException When the key is invalid.
     */
    public function checkKey($key = null)
    {

        try {
            $this->loadModel('ApiKeys');
            $apiKey = $this->ApiKeys->find('all')
                ->where(['ApiKeys.key'=>$key])
                ->firstOrFail(); // Throws RecordNotFoundException if no key is found
            // Check expiry date
            if (Time::now() > $apiKey->expire)
            {
                throw new KeyInvalidException(['reason' => 'Expired']);
            }
            // Check revoke status
            if ($apiKey->revoked){
                throw new KeyInvalidException(['reason' => 'Revoked']);
            }
            $this->keyError = "Key is valid for use";
            return true;
        } catch(Exception $e){
            $this->keyError = $e->getMessage();
            $this->response = $this->response->withStatus(406);
            return false;
        }
    }
}

class KeyInvalidException extends Exception
{
    protected $_messageTemplate = 'The API Key is %s';
}

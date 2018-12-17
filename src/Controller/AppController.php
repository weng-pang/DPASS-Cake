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
        $default = (int)$this->settings->find('all')->where(['keyword' => 'default_language'])->first()['content'];
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
    protected function changeLanguage($language){
        $code = $this->languages->get($language)['code'];
        I18n::setLocale($code);
        $this->set('language',$language);
    }

    /**
     *  Find Setting Method
     *  The setting from the database is obtained by providing the keyword.
     *
     * @param string $keyword
     * @return string
     */
    protected function getSetting($keyword){

        return $this->settings->find('all')->where(['keyword' => $keyword])->first()['content'];
    }

    /**
     *  Find Mark Method
     *  The mark from the database is obtained by providing the keyword.
     *
     * @param string $keyword
     * @return int
     */
    protected function getMark($keyword){

        return (int)$this->marks->find('all')->where(['keyword' => $keyword])->first()['mark'];
    }
}

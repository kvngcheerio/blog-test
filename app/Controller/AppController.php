<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'plugin' => 'users'
            ),
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                      'username' => 'my_user_model_username_field', //Default is 'username' in the userModel
                      'password' => 'my_user_model_password_field'  //Default is 'password' in the userModel
                    )
                )
            )
        )
    );
	
	public function beforeFilter() {
		// Auth will block all entries with admin prefix unless the user is authenticated
		if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
			if($this->Auth->loggedIn()){
				$this->Auth->allow();
				$this->layout = 'admin';
			}else{
				$this->Auth->deny();
				$this->layout = 'default';
			}
		}else{
			$this->Auth->allow();
			$this->layout = 'default';
		}
	}
	
	public function isAuthorized($user = null) {
		// Everyone is authorized to see that front pages. However, some admin pages require you to be an admin to have access
		if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
			if($this->Auth->loggedIn()){
				if($this->Auth->user('role') == 'admin'){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		return true;
    }

}
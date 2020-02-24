<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required'
            )
        ),
        'username' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required',
                'allowEmpty' => false
            ),
            'between' => array( 
                'rule' => array('between', 5, 15), 
                'required' => true, 
                'message' => 'Usernames must be between 5 to 15 characters'
            ),
             'unique' => array(
                'rule'    => array('isUniqueUsername'),
                'message' => 'This username is already in use'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'Username can only be letters, numbers and underscores'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author','reader')),
                'message' => 'Please select a valid role',
                'allowEmpty' => false
            )
        )
    );

    function isUniqueUsername($check) {
 
        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );
 
    if(!empty($username)){
            if($this->data[$this->alias]['id'] == $username['User']['id']){
                return true; 
            }else{
                return false; 
            }
        }else{
            return true; 
        }
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
 
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
     
    // public function beforeSave($options = array()) {

	// 	// hash the user's password befor we save it
	// 	if (isset($this->data[$this->alias]['password'])) {
	// 		$passwordHasher = new BlowfishPasswordHasher();
	// 		$this->data[$this->alias]['password'] = $passwordHasher->hash(
	// 				$this->data[$this->alias]['password']
	// 		);
	// 	}
	// 	// fallback to our parent
	// 	return parent::beforeSave($options);
    // }
    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}
<?php

App::uses('AppModel', 'Model');

class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A post name is required'
            )
        ),
        'body' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A post body is required'
            )
        ),
        'category_id' => array(
            'valid' => array(
                'rule' => array('inList', array('News', 'Entertainment','Sports')),
                'message' => 'Please select a valid category',
                'allowEmpty' => false
            )
            ),
        'created_by' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'You must be logged in'
            )
        ),
    );
}
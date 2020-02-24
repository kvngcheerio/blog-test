App::uses('AppModel', 'Model');

class Category extends AppModel {
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A category name is required'
            )
        )
     
    );
}
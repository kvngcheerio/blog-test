class RoleController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('roles', $this->Role->find('all'));
    }
}
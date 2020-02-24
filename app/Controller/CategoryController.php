class CategoryController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('categories', $this->Category->find('all'));
    }
}
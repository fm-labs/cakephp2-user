
## Use the UserFormAuthentication ##

Fields are automatically set to
'username' => 'email'
'password' => 'password'

In your AppController:

class AppController extends Controller{

	public $components = array('Session', 'Auth' => array('authenticate' => 'User.UserForm'));

	public function beforeFilter() {
		//$this->Auth->loginAction = '/custom_route_to_login'
	}
}

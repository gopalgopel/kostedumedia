<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Html extends CI_Controller {

	public $data;
	private $role;

	function __construct() {
		parent::__construct();
		$this->data = array();
		$this->load->helper('acl');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->library('tank_auth');
		// $this->load->database();
		$this->load->model('Kosts','',TRUE);

		$this->logged_in();
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->data['user_id'] = '5ae039b33e0b2a360b304585'; // p ddg
	}
	
	function logged_in() {
		if (!$this->tank_auth->is_logged_in()) {
			// $this->map_clean();
		}
	}

	public function index() {
		$this->load->view('html/side-menu');
	}

	public function map() {
		$this->role_user();
		$this->load->view('html/map_clean',$this->data);
	}
	public function tabelkost() {
		$this->role_user();
		$this->data['kosts'] = $this->Kosts->getDaftarKosan($this->data['user_id']);
		$this->load->view('html/tabelkost',$this->data);
	}
	public function about() {
		$this->role_user();
		$this->load->view('html/about',$this->data);
	}
	
	/**role and permission**/
	private function role_user(){
		$user_id = $this->tank_auth->get_user_id();
		$this->data['username'] = $this->session->userdata('username');
		
		if ($user_id) {
			// $user = $this->user_role_dao->fetch_record($user_id);
			// $this->role = $this->role_dao->by_id(array('role_id'=>$user->role_id));

			// // added by SKM17 for checking backend access {
			// $permission = all_permission_string($user_id); 
			// if (is_has_access('backend', $permission)) { 
			// 	$user->backend_access = true;
			// } else { 
			// 	$user->backend_access = false;
			// }
			// $user->user_group = get_data_restriction($this->session->userdata(SESSION_USERGROUP));
			// // } end ADDED */
			
			// $this->data['user'] = $user;
			// $this->data['permission'] = $permission;
			$this->data['permission'] = 'admin';
		} else
			$this->data['permission'] = '';
	}
}

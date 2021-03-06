<?php
class pengguna_ctrl extends CI_Controller{

	public $data;
	public $filter;
	public $limit = 16;
	public static $CURRENT_CONTEXT = '/admin/pengguna_ctrl';
	public static $TITLE = "PENGGUNA";

	public function __construct(){
		parent::__construct();
		$this->data = array();
		$this->load->helper('string');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('stringify');
		$this->load->helper('geodesics');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="note error">', '</span>');
		$this->load->library('pagination'); // GA KEPAKE
		$this->load->library('tank_auth');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('dao/pengguna_dao');

		$this->logged_in();
		$this->role_user();

		$this->data['user_id'] = $this->session->userdata('user_id');
	}

	public function index($offset=0 ,$limit=16){
		$this->preload();
		$this->load_view('admin/list_pengguna', $this->data);
	}

	public function preload(){
		$this->data['current_context'] = self::$CURRENT_CONTEXT;
		$this->data['title'] = self::$TITLE;

		$this->data['penggunas'] = $this->pengguna_dao->getDaftarPengguna();
		$this->data['obj'] = null;
	}

	public function load_view($page, $data = null){
		$this->load->view('template/template_header',$data);
		$this->load->view('template/template_menu',$this->data);
		$this->load->view($page, $data);
		$this->load->view('template/template_footer');
	}

	public function edit($id_pengguna = null){
		$this->preload();

		if ($id_pengguna == null) {
			$this->load_view('admin/list_pengguna');
		} else {
			$this->data['obj'] = $this->pengguna_dao->getDataPengguna($id_pengguna);
			$this->session->set_userdata('user_url', self::$CURRENT_CONTEXT . '/edit/' . $id_pengguna);

			$this->load_view('admin/list_pengguna', $this->data);
		}
	}

	private function fetch_input(){
		$data = null;
		$data = array(
			'username' => $this->input->post('username'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'hp' => $this->input->post('hp'),
			'alamat' => $this->input->post('alamat')
		);

		return $data;
	}

	private function is_pass_changed($id_pengguna, $password) {
		if ($password != '') {
			$this->tank_auth->change_password($id_pengguna, $password);
			return true;
		} else
			return false;
	}

	public function add_pengguna() {
		$obj = $this->fetch_input();
		$gen_id_pengguna = $this->pengguna_dao->saveNewPengguna($obj);

		if ($gen_id_pengguna > 0) {
			$this->is_pass_changed($gen_id_pengguna, $this->input->post('password'));
			$this->session->set_flashdata("success", "Pengguna baru berhasil disimpan.");
		}
		else
			$this->session->set_flashdata("failed", "Pengguna baru gagal disimpan.");

		redirect(self::$CURRENT_CONTEXT);
	}

	public function edit_pengguna() {
		$obj = $this->fetch_input();
		$id_pengguna = $this->input->post('id_pengguna');

		if ($this->pengguna_dao->editPengguna($id_pengguna, $obj)) {
			$notif = "Data Pengguna berhasil diubah. ";
			if ($this->is_pass_changed($id_pengguna, $this->input->post('password')))
				$notif .= "Password berhasil diubah. ";
			$this->session->set_flashdata("success", $notif);
		} else
			$this->session->set_flashdata("failed", "Data Pengguna gagal diubah.");

		redirect($this->session->userdata('user_url'));
	}

	public function delete($id_pengguna = null){
		if ($this->pengguna_dao->deletePengguna($id_pengguna)) {
			$this->session->set_flashdata("success", "Pengguna berhasil dihapus.");
		}
		else
			$this->session->set_flashdata("failed", "Pengguna gagal dihapus.");

		redirect(self::$CURRENT_CONTEXT);
	}
	
	function role_user() {
		$user_id = $this->tank_auth->get_user_id();
		// $user = $this->user_role_dao->fetch_record($user_id);
		$this->data['permission'] = 'admin';

		// if (trim($user->role_name) == 'viewer') {
		// 	redirect('html/map_clean');
		// }
	}
	
	function logged_in() {
		if (!$this->tank_auth->is_logged_in()) {
			redirect('home/login');
		}
	}
}
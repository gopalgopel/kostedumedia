<?php
class komplain_ctrl extends CI_Controller{

	public $data;
	public $filter;
	public $limit = 16;
	public static $CURRENT_CONTEXT = '/admin/komplain_ctrl';
	public static $TITLE = "KOMPLAIN";

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
		$this->load->library('dao/komplain_dao');

		$this->logged_in();
		$this->role_user();

		$this->data['user_id'] = $this->session->userdata('user_id');
	}

	public function index($offset=0 ,$limit=16){
		$this->preload();
		$this->load_view('admin/list_komplain', $this->data);
	}

	public function preload(){
		$this->data['current_context'] = self::$CURRENT_CONTEXT;
		$this->data['title'] = self::$TITLE;

		$this->data['komplains'] = $this->komplain_dao->getDaftarKomplain();
		$this->data['obj'] = null;
	}

	public function load_view($page, $data = null){
		$this->load->view('template/template_header',$data);
		$this->load->view('template/template_menu',$this->data);
		$this->load->view($page, $data);
		$this->load->view('template/template_footer');
	}

	public function edit($id_komplain = null){
		$this->preload();

		if ($id_komplain == null) {
			$this->load_view('admin/list_komplain');
		} else {
			$this->data['obj'] = $this->komplain_dao->getDataKomplain($id_komplain);
			$this->session->set_userdata('user_url', self::$CURRENT_CONTEXT . '/edit/' . $id_komplain);

			$this->load_view('admin/list_komplain', $this->data);
		}
	}

	private function fetch_input(){
		$data = null;
		$data = array(
			'lokasi' => $this->input->post('lokasi'),
			'orang_kamar' => $this->input->post('orang_kamar'),
			'masalah' => $this->input->post('masalah'),
			'start_komplain' => $this->input->post('start_komplain'),
			'end_komplain' => ($this->input->post('status_beres') == 'T') ? $this->input->post('end_komplain') : null,
			'status_beres' => $this->input->post('status_beres'),
			'solusi' => $this->input->post('solusi')
		);

		return $data;
	}

	public function add_komplain() {
		$obj = $this->fetch_input();
		
		if ($this->komplain_dao->saveNewKomplain($obj))
			$this->session->set_flashdata("success", "Komplain baru berhasil disimpan.");
		else
			$this->session->set_flashdata("failed", "Komplain baru gagal disimpan.");

		redirect(self::$CURRENT_CONTEXT);
	}

	public function edit_komplain() {
		$obj = $this->fetch_input();
		$id_komplain = $this->input->post('id_komplain');

		if ($this->komplain_dao->editKomplain($id_komplain, $obj))
			$this->session->set_flashdata("success", "Data Komplain berhasil diubah.");
		else
			$this->session->set_flashdata("failed", "Data Komplain gagal diubah.");

		redirect($this->session->userdata('user_url'));
	}

	public function delete($id_komplain = null){
		if ($this->komplain_dao->deleteKomplain($id_komplain)) { // delete dr tabel penghuni
			$this->session->set_flashdata("success", "Komplain berhasil dihapus.");
		}
		else
			$this->session->set_flashdata("failed", "Komplain gagal dihapus.");

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
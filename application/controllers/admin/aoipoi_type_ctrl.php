<?php

class aoipoi_type_ctrl extends CI_Controller {

    public $data;
    public $filter;
    public $limit = 16;
    public static $CURRENT_CONTEXT = '/admin/aoipoi_type_ctrl';
    public static $TITLE = "AoiPoi Type";

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->helper('acl');
        $this->load->library('dao/aoipoi_type_dao');
        $this->load->library('dao/user_role_dao');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->form_validation->set_error_delimiters('<span class="note error">', '</span>');
        $this->load->library('pagination');
        $this->load->library('tank_auth');
        $this->load->library('upload');
        $this->load->library('image_lib');

        $this->logged_in();
        $this->data['permission'] = all_permission_string($this->session->userdata('user_id'));
        $this->data['idAccessMsg'] = $this->session->userdata(SESSION_USERMSGID);
        
    }

    private function validate() {
        $this->form_validation->set_rules('aptype_id', 'aptype_id', '');
        $this->form_validation->set_rules('aptype_name', 'aptype_name', 'required');

        return $this->form_validation->run();
    }

    /**
      prepare data for view
     */
    public function preload() {
        $this->data['current_context'] = self::$CURRENT_CONTEXT;
        $this->data['title'] = self::$TITLE;
    }

    public function load_view($page, $data = null) {
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu', $this->data);
        $this->load->view($page);
        $this->load->view('template/template_footer');
    }

    public function index($offset = 0) {
        $this->preload();
        $this->get_list($this->limit, $offset);
        $this->load_view('admin/aoipoi_type/list_aoipoi_type', $this->data);
    }

    /**
      getting filter parameter when user
      doing searching.
     */
    public function filter_param() {
        $filter = array();
        $par = $this->input->post('sample');
        if ($par != NULL || $par != '') {
            $filter['sample'] = $par;
        }
        // other input receive
        return $filter;
    }

    public function get_list($limit = 16, $offset = 0) {
        $obj = $this->filter_param();

        #generate pagination
        $config['base_url'] = site_url(self::$CURRENT_CONTEXT . 'index');
        $config['total_rows'] = $this->aoipoi_type_dao->count_all();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();

        if (empty($obj)) {
            // non conditional data fetching
            $this->fetch_data($limit, $offset);
        } else {
            // apply filter
        }
    }

    public function fetch_record($keys) {
        $this->data['aoipoi_type'] = $this->aoipoi_type_dao->by_id($keys);
    }

    private function fetch_data($limit, $offset) {
        $this->data['aoipoi_type'] = $this->aoipoi_type_dao->fetch($limit, $offset, 'aptype_name');
    }

   private function fetch_input() {
        $data = array('aptype_name' => $this->input->post('aptype_name'));
        if ($this->input->post('aptype_id')) {
            $data['aptype_id'] = $this->input->post('aptype_id');
        }
        return $data;
    }

    public function save() {
        $obj = $this->fetch_input();
        $infoSession = ''; // added by SKM17

        if ($this->validate() != false) {
        
        /*
//            $obj_id = array('aertype_id' => $obj['aertype_id']);
            $config_upload['upload_path'] = './assets/img/icon-aeroplane/';
            $config_upload['allowed_types'] = 'gif|jpg|png';
            $config_upload['max_width'] = 100;
            $config_upload['max_height'] = 100;
            $config_upload['max_size'] = 1000;
            $this->upload->initialize($config_upload);
            if ($this->upload->do_upload('aertype_icon')) {
                $info = $this->upload->data();
                $obj['aertype_icon'] = $info['file_name'];
                $infoSession .= "Ikon Tipe Pesawat berhasil diunggah. ";
            }
            */
            
            $saved; // added by SKM17
            if (isset($obj['aptype_id']) && $this->aoipoi_type_dao->by_id(array('aptype_id' => $obj['aptype_id'])) != null) {
                $obj_id = array('aptype_id' => $obj['aptype_id']);
                $saved = $this->aoipoi_type_dao->update($obj, $obj_id);
                $saving_aptype_id = $obj['aptype_id'];
                $infoSession .= "Data Tipe AoiPoi berhasil diubah. ";
            } else {
                $saved = $this->aoipoi_type_dao->insert($obj);
                $saving_aptype_id = $this->aoipoi_type_dao->insert_id();
                $infoSession .= "Data Tipe AoiPoi berhasil ditambah. ";
            }
            
            if (!$saved)
                $infoSession .= "Data Tipe AoiPoi gagal ditambah/disimpan. ";
                
            $this->session->set_flashdata("info", $infoSession);
            $this->data['saving'] = true;
            redirect(self::$CURRENT_CONTEXT);
        } else {
            /* invalid input will be redirected to edit view with error message included */
            $this->preload();
            $this->data['edit'] = false;
            #prepare link for back to view list
            $this->data['link_back'] = anchor(self::$CURRENT_CONTEXT . 'index/', 'Back', array('class' => 'back'));
            $this->load_view('admin/aoipoi_type/list_aoipoi_type', $this->data);
        }
    }

    /**
      repopulation for reference data done here.
      add different reference data to different array.
      and pass it to views using $this->data[] parameter.
     */
    public function repopulate() {
        
    }

    /**

      @description
      viewing editing form. repopulation for every data needed in form done here.
     */
    public function edit($aptype_id = null) {
        $this->preload();
        if ($aptype_id == null) {
            $this->load_view('admin/aoipoi_type/list_aoipoi_type');
        } else {
            $param = $this->get_list($this->limit);
            $obj_id = array('aptype_id' => $aptype_id);

            $to_edit = $this->aoipoi_type_dao->by_id($obj_id);
            $this->data['obj'] = $to_edit;
            $this->load_view('admin/aoipoi_type/list_aoipoi_type', $this->data);
        }
    }

    /**

      @description
      viewing record. repopulation for every data needed for view.
     */
    public function view($aptype_id = null) {
        $obj_id = array('aptype_id' => $aptype_id);

        $this->preload();
        $this->fetch_record($obj_id);
        #prepare link for back to view list
        $this->data['link_back'] = anchor(self::$CURRENT_CONTEXT . 'index/', 'Back', array('class' => 'back'));
        $this->load_view('admin/aoipoi_type/view_aoipoi_type', $this->data);
    }

    public function delete($aptype_id = null) {
        $obj_id = array('aptype_id' => $aptype_id);

        $status_del = $this->aoipoi_type_dao->delete($obj_id);
        if ($status_del == false) {
            $this->session->set_flashdata("info", "Hapus tipe pesawat gagal!");
        } else {
            $this->session->set_flashdata("info", "Hapus tipe pesawat berhasil!");
        }
        redirect(self::$CURRENT_CONTEXT);
    }

    /*     * role and permission* */

    function role_user() {
        $user_id = $this->tank_auth->get_user_id();
        $user = $this->user_role_dao->fetch_record($user_id);

        if (trim($user->role_name) == 'viewer') {
            redirect('html/map_clean');
        }
    }

    function logged_in() {
        if (!$this->tank_auth->is_logged_in()) {
            redirect('home/login');
        }
    }

}
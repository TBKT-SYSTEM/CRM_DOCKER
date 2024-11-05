<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $another_css;
    public $another_js;
    public $another_chart_js;
    private $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('parser');
        $this->load->library('session');

		$this->data["base_url"] = base_url();

		$result['base_url'] = base_url();
		$result['site_url'] = site_url();

        $this->data = $result;
		$this->top_navbar_data = $result;
		$this->left_sidebar_data = $result;
		$this->footer_data = $result;
	}

	protected function render_view($path)
    {
        $this->data['another_chart_js'] = $this->another_chart_js;
        $this->data['another_css'] = $this->another_css;
        $this->data['another_js'] = $this->another_js;
		$this->data['topbar'] = $this->parser->parse('page/top_navbar', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('page/left_sidebar', $this->left_sidebar_data, TRUE);
		$this->data['footer'] = $this->parser->parse('page/footer', $this->footer_data, TRUE);
        $this->data['page_content'] = $this->parser->parse($path, $this->data, TRUE);
        $this->parser->parse('page/pagecontent', $this->data);
    }

	public function index() {
        $this->another_chart_js = "<script src='" . base_url() . "assets/js/dashboard.js'></script>";
		$this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		$this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		$this->ManageBackend->chkLogout();
        $this->render_view('view_dashboard');

    }

	public function login(){
		$arrData = array(
            'sessUsr' => $this->input->post('su_username'),
            'sessUsrId' => $this->input->post('su_id'),
            'sessFname' => $this->input->post('su_firstname'),
            'sessLname' => $this->input->post('su_lastname'),
            'sessEmail' => $this->input->post('su_email'),
            'sessDeptId' => $this->input->post('sd_id'),
            'sessDeptName' => $this->input->post('sd_dept_name'),
            'sessPgId' => $this->input->post('spg_id'),
            'sessPgName' => $this->input->post('spg_name'),
            'loggedIn' => "OK"
        );
        $this->session->set_userdata($arrData);
		$this->ManageBackend->log_login($arrData['sessUsrId']);
		echo json_encode(true);
	}

	public function logout(){
		$userId = $this->session->userdata('sessUsrId');
		$this->ManageBackend->log_logout($userId);
		$this->session->sess_destroy();
		redirect('Welcome');
	}

	public function send_toEmail(){
		$username = $this->input->post('su_username');
		$email = $this->input->post('su_email');
		$fname = $this->input->post('su_firstname');
		$lname = $this->input->post('su_lastname');
		$psw = base64_decode($this->input->post('su_password'));
		$data = array(
			"username" => $username,
			"email" => $email,
			"fullname" => $fname.' '.$lname,
			"psw" => $psw
		);
		$sending = $this->ManageBackend->sent_pswToMail($data);
		if($sending != true){
			echo $sending;
		}else{
			echo true;
		}
	}
}


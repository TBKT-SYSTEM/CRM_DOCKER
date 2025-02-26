<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountSetting extends CI_Controller
{

	private $another_css;
	public $another_js;
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

		$this->ManageBackend->chkLogout();
	}

	protected function render_view($path)
	{
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->data['topbar'] = $this->parser->parse('page/top_navbar', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('page/left_sidebar', $this->left_sidebar_data, TRUE);
		$this->data['footer'] = $this->parser->parse('page/footer', $this->footer_data, TRUE);
		$this->data['page_content'] = $this->parser->parse($path, $this->data, TRUE);
		$this->parser->parse('page/pagecontent', $this->data);
	}
	public function index()
	{
		// $this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		// $this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		$this->render_view('view_AccountSetting');
	}

	public function saveSignature()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);

		$su_id = $data['su_id'];
		$image = $data['image'];
		$update_date = $data['su_updated_date'];
		$update_by = $data['su_updated_by'];

		$imageData = str_replace('data:image/png;base64,', '', $image);
		$imageData = base64_decode($imageData);

		$fileName = $update_by . '_signature.png';
		$filePath = 'assets/images/uploaded/signature/' . $update_by;

		if (!is_dir($filePath)) {
			mkdir($filePath, 0777, true);
		}

		if (file_put_contents($filePath . '/' . $fileName, $imageData)) {
			$newData = array(
				'su_id' => (int)$su_id,
				'su_sign_file' => $fileName,
				'su_sign_path' => $filePath . '/' . $fileName,
				'su_updated_date' => $update_date,
				'su_updated_by' => $update_by,
			);
			echo json_encode($newData);
		} else {
			echo json_encode(["error" => "Failed to upload file."]);
		}
	}
}

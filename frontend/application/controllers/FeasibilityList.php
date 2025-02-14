<?php defined('BASEPATH') or exit('No direct script access allowed');

class FeasibilityList extends CI_Controller
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
        $this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
        $this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
        $this->render_view('view_historyFeasibility');
    }
    public function uploadImage()
    {
        if (!empty($_FILES["picture"]["name"])) {
            $tempFileLogo = $_FILES['picture']['tmp_name'];
            $FileLogo = $_FILES['picture']['name'];
            $userCode = $this->session->userdata('sessUsr');

            $res = $this->ManageBackend->createFileImage($FileLogo, $tempFileLogo, $userCode);
            echo json_encode(array('error' => '', 'data' => $res));
        } else {
            echo false;
        }
    }
}
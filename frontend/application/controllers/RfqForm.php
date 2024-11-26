<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
require_once APPPATH . 'libraries/fpdf186/fpdf.php';
class RfqForm extends CI_Controller
{
	private $another_css;
	public $another_js;
	private $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
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
		$this->render_view('view_issuerfq');
	}

	public function ManageRfq()
	{
		$this->another_js .= "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		$this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		$this->render_view('view_mngRfq');
	}

	public function addRFQ()
	{
		$this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		$this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		$this->render_view('view_makeRfq');
	}

	public function editRfq()
	{
		$this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		$this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		// $this->another_js .= "<script type='module' src='" . base_url() . "assets/js/feasibility/feasibilityPDF.js'></script>";
		$this->render_view('view_editRfq');
	}

	public function createPDF()
	{
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
		$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew-Bold.php');

		$pdf->SetY(5);
		$image_path = 'assets/images/logos/tbkk logo form.png';
		$pdf->Image($image_path, 5, $pdf->GetY(), 20);
		$pdf->SetFont('THSarabunNew', 'B', 30);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'IN-HOUSE RFQ');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);
		// Doc. No.
		$doc_no = 'Doc. No. :';
		$ir_doc_no = $this->input->get('ir_doc_no');
		$width_docno = $pdf->GetStringWidth($doc_no);
		$pdf->Cell($width_docno, 5, $doc_no);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(33, 5, $ir_doc_no, 'B', 0, 'C');

		// Issue Date.
		$pdf->SetX($pdf->GetX() + 5);
		$issue_date = 'Issue Date :';
		$ir_created_date = $this->input->get('ir_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $ir_created_date, 'B', 0, 'C');

		// Ref Nbc.
		$pdf->Ln(8);
		$pdf->SetX(85);
		$ref_no = 'Ref. No. :';
		$ir_ref_nbc = $this->input->get('ir_ref_nbc');
		$width_ref_no = $pdf->GetStringWidth($ref_no);
		$pdf->Cell($width_ref_no, 5, $ref_no);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(33, 5, $ir_ref_nbc, 'B', 0, 'C');

		// Closing Date.
		$pdf->SetX($pdf->GetX() + 3);
		$closing_date = 'Closing Date :';
		$ir_duedate = $this->input->get('ir_duedate');
		$width_ir_duedate = $pdf->GetStringWidth($closing_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_ir_duedate, 5, $closing_date);
		$pdf->Cell(33, 5, $ir_duedate, 'B', 0, 'C');

		// Attn 
		$pdf->Ln(13);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Attn. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 0, $attn);

		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 15);
		$pdf->Cell(9, 5, '', 0, 0, 'C', true);
		$pu_dept = 'PU Dept.';
		$width_pu_dept = $pdf->GetStringWidth($pu_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $pu_dept);

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$pe_dept = 'PE Dept.';
		$width_pe_dept = $pdf->GetStringWidth($pe_dept) + 2;
		$pdf->Cell($width_pe_dept, 5, $pe_dept);

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$ce_dept = 'CE Dept.';
		$width_ce_dept = $pdf->GetStringWidth($ce_dept) + 2;
		$pdf->Cell($width_ce_dept, 5, $ce_dept);

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'GDC Dept.';
		$width_gdc_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_gdc_dept, 5, $gdc_dept);

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$scm_dept = 'SCM Dept.';
		$width_scm_dept = $pdf->GetStringWidth($scm_dept) + 2;
		$pdf->Cell($width_scm_dept, 5, $scm_dept);

		// Customer 
		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$cus = 'Customer :';
		$width_cus = $pdf->GetStringWidth($cus) + 2;
		$pdf->Cell($width_cus, 0, $cus);

		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 15);
		$ir_customer = $this->input->get('ir_customer');
		$pdf->Cell(90, 5, $ir_customer, 'B', 0, 'L');

		// Import From
		$ir_customer = $this->input->get('ir_import_tran');
		$boxOversea = '';
		$boxDomestic = '';
		if ($ir_customer == 1) {
			$boxOversea = '0, 0, 0';
			$boxDomestic = '255, 255, 255';
		} else if ($ir_customer == 2) {
			$boxOversea = '255, 255, 255';
			$boxDomestic = '0, 0, 0';
		}
		$pdf->SetX($pdf->GetX() + 13.8);
		$pdf->SetFillColor((int)$boxOversea);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Overseas';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		$pdf->SetX($pdf->GetX() + 13.5);
		$pdf->SetFillColor((int)$boxDomestic);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Domestic';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		// Subject
		$mrt_id = $this->input->get('mrt_id');
		$box_newp =	'';
		$box_ecr =	'';
		$box_eop =	'';
		$box_other = '';
		if ($mrt_id == 1) {
			$box_newp = '0, 0, 0';
			$box_ecr = '255, 255, 255';
			$box_eop = '255, 255, 255';
			$box_other = '255, 255, 255';
		} else if ($mrt_id == 2) {
			$box_newp = '255, 255, 255';
			$box_ecr = '0, 0, 0';
			$box_eop = '255, 255, 255';
			$box_other = '255, 255, 255';
		} else if ($mrt_id == 3) {
			$box_newp = '255, 255, 255';
			$box_ecr = '255, 255, 255';
			$box_eop = '0, 0, 0';
			$box_other = '255, 255, 255';
		} else {
			$box_newp = '255, 255, 255';
			$box_ecr = '255, 255, 255';
			$box_eop = '255, 255, 255';
			$box_other = '0, 0, 0';
		}

		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Subject :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		$pdf->SetFillColor((int)$box_newp);
		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 15);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$newp = 'New Project';
		$width_newp = $pdf->GetStringWidth($newp) + 2;
		$pdf->Cell($width_newp, 5, $newp);

		$pdf->SetX($pdf->GetX() + 7.5);
		$pdf->SetFillColor((int)$box_ecr);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$ecr = 'ECR / PCR';
		$width_ecr = $pdf->GetStringWidth($ecr) + 2;
		$pdf->Cell($width_ecr, 5, $ecr);

		$pdf->SetX($pdf->GetX() + 10);
		$pdf->SetFillColor((int)$box_eop);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$eop = 'EOP / Service Parts';
		$width_eop = $pdf->GetStringWidth($eop) + 2;
		$pdf->Cell($width_eop, 5, $eop);

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor((int)$box_other);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Other :';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);
		$pdf->Cell(33, 5, '', 'B', 0, 'L');

		// Enclosures
		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Enclosures :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 15);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$drawing = 'Drawing';
		$width_drawing = $pdf->GetStringWidth($drawing) + 2;
		$pdf->Cell($width_drawing, 5, $drawing);

		$pdf->SetX($pdf->GetX() + 13);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$eOther = 'Other :';
		$width_eOther = $pdf->GetStringWidth($eOther) + 2;
		$pdf->Cell($width_eOther, 5, $eOther);
		$pdf->Cell(60, 5, '', 'B', 0, 'L');

		// Project Life 
		$pdf->Ln(10);
		$ir_pro_life = $this->input->get('ir_pro_life');
		$pdf->SetX($pdf->GetX() - 5);
		$proj = 'Project Life :';
		$width_proj = $pdf->GetStringWidth($proj);
		$pdf->Cell($width_proj, 5, $proj);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(33, 5, $ir_pro_life, 'B', 0, 'C');
		$pdf->Cell(5, 5, 'Years', '', 0, 'L');

		$ir_sop_tim = $this->input->get('ir_sop_tim');
		$pdf->SetX($pdf->GetX() + 38);
		$pti = 'Program Timing info. :';
		$width_pti = $pdf->GetStringWidth($pti);
		$pdf->Cell($width_pti, 5, $pti);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(40, 5, $ir_sop_tim, 'B', 0, 'C');

		// Table Part No.
		$pdf->Ln(10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 4, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 4, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 4, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 4, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 4, 'Remark', 1, 1, 'C', true);

		$ir_id = $this->input->get('ir_id');
		$consern = $this->db->select('irpn.irpn_part_no, irpn.irpn_part_name, irpn.irpn_model, irpn.irpn_remark')
			->from('info_rfq_part_no irpn')
			->join('info_rfq ir', 'ir.ir_id = irpn.ir_id', 'left')
			->where('irpn.ir_id', $ir_id)
			->where('irpn.irpn_status', 1)
			->order_by('irpn.irpn_id', 'ASC')->get()->result();

		for ($i = 0; $i < 20; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 11);
			$pdf->Cell(15, 4, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->irpn_part_no) ? $consern[$i]->irpn_part_no : '';
			$part_name = isset($consern[$i]->irpn_part_name) ? $consern[$i]->irpn_part_name : '';
			$model = isset($consern[$i]->irpn_model) ? $consern[$i]->irpn_model : '';
			$remark = isset($consern[$i]->irpn_remark) ? $consern[$i]->irpn_remark : '';

			$pdf->Cell(35, 4, $part_no, 1, 0, 'C');
			$pdf->Cell(55, 4, $part_name, 1, 0, 'C');
			$pdf->Cell(40, 4, $model, 1, 0, 'C');
			$pdf->Cell(50, 4, $remark, 1, 1, 'C'); // 35 Characters
		}

		// Table Volume
		$pdf->Ln(2);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 11);

		$ir_pro_life = $this->input->get('ir_pro_life');
		$val = 'Volume Information :';
		$width_val = $pdf->GetStringWidth($val);
		$pdf->Cell($width_val, 5, $val);

		$pdf->Ln(5);
		$years = [];
		$volumes = [];
		$countYears = $ir_sop_tim;
		for ($i = 0; $i <= $ir_pro_life; $i++) {
			if ($i == 0) {
				$years[$i] = $countYears;
				$volumes[$i] = rand(10000, 99999);
			} else {
				$years[$i] = $countYears += 1;
				$volumes[$i] = rand(10000, 99999);
			}
		}

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Year', 1, 0, 'R', true);
		for ($i = 0; $i < 11; $i++) {
			$year = isset($years[$i]) ? $years[$i] : '';
			$pdf->Cell(16.35, 5, $year, 1, 0, 'C');
		}

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Volume', 1, 0, 'R', true);
		for ($i = 0; $i < 11; $i++) {
			$volume = isset($volumes[$i]) ? $volumes[$i] : '';
			$pdf->Cell(16.35, 5, $volume, 1, 0, 'C');
		}

		// Info
		$pdf->Ln(7);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$info = 'Please be required to study the cost according above detail and be arranged necessary info upon below conditions.';
		$width_val = $pdf->GetStringWidth($info);
		$pdf->Cell($width_val, 5, $info);

		// Purchase Cost
		$pdf->Ln(10);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Purchase Cost :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 0, $attn);

		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 30);
		$pdf->Cell(9, 5, '', 0, 0, 'C', true);
		$pu_dept = 'Raw material';
		$pdf->Cell(10, 5, $pu_dept);

		$pdf->SetX($pdf->GetX() + 20);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$pe_dept = 'Mold/Die';
		$pdf->Cell(10, 5, $pe_dept);

		$pdf->SetX($pdf->GetX() + 20);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$ce_dept = 'Manufacturing';
		$pdf->Cell(10, 5, $ce_dept);

		$pdf->SetX($pdf->GetX() + 20);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Transportation';
		$pdf->Cell(10, 5, $gdc_dept);

		// Process Cost
		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Process Cost :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 0, $attn);

		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 30);
		$pdf->Cell(9, 5, '', 0, 0, 'C', true);
		$pu_dept = 'Casting';
		$pdf->Cell(10, 5, $pu_dept);

		$pdf->SetX($pdf->GetX() + 20);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$pe_dept = 'Machining';
		$pdf->Cell(10, 5, $pe_dept);

		$pdf->SetX($pdf->GetX() + 20);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$ce_dept = 'Assembly';
		$pdf->Cell(10, 5, $ce_dept);

		$pdf->SetX($pdf->GetX() + 20);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Packaging and Delivery';
		$width_gdc_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell(10, 5, $gdc_dept);

		// Table Note
		$pdf->Ln(10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(73, 4, 'Note :', 1, 0, 'L', true);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(113, 4, 'Comment/Additional info By S&M :', 1, 0, 'L', true);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(73, 4, '1. Each cost should provide with breakdown. ', 'LR', 0, 'L',);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->Cell(113, 4, 'This RFQ issued for study cost to customer', 'LR', 0, 'L',);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(73, 4, '2. Tooling development schedule (timelines) ', 'LR', 0, 'L',);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->Cell(113, 4, 'PU : 1. Please submit RM cost to S&M', 'LR', 0, 'L',);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(73, 4, 'is required.', 'LR', 0, 'L',);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->Cell(113, 4, 'PE : 1. Please submit process cost to us', 'LR', 0, 'L',);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(73, 4, '', 'LR', 0, 'L',);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->Cell(113, 4, '      2. Please submit Mold spec and Tooling Fee separately ', 'LR', 0, 'L',);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(73, 4, '', 'LR', 0, 'L',);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->Cell(113, 4, 'PC&L : Please submit the packaging and transportation cost to S&M [Export pkg].', 'LR', 0, 'L',);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(73, 4, '', 'LBR', 0, 'L',);
		$pdf->Cell(9, 4, '', 0, 0, 'C',);
		$pdf->Cell(113, 4, '', 'LBR', 0, 'L');

		// Table Sign
		$pdf->Ln(10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Prepared By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Checked By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Approved By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Authorized By', 1, 0, 'C', true);

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$image_sign = 'assets/images/uploaded/signature/51SST60_signature.png';
		$image_sign2 = 'assets/images/uploaded/signature/51SST60_signature2.png';
		$image_sign3 = 'assets/images/uploaded/signature/51SST60_signature3.png';
		$pdf->Cell(48.75, 20, $pdf->Image($image_sign, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($image_sign3, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($image_sign2, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, '', 'LR', 0, 'C');

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 4, 'Pimnapat Bualuang', 'LR', 0, 'C');
		$pdf->Cell(48.75, 4, 'Kyoko Saijo', 'LR', 0, 'C');
		$pdf->Cell(48.75, 4, 'Sirote Sukhiranwat', 'LR', 0, 'C');
		$pdf->Cell(48.75, 4, 'Horokoshi Yuji', 'LR', 0, 'C');
		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, 'Engineer', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Supervisor', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Department Manager', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'General Manager', 'LBR', 0, 'C');



		$pdf->Output();
	}
}

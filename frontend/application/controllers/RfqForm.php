<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
require_once APPPATH . 'libraries/fpdf186/fpdf.php';
class RfqForm extends CI_Controller
{
	private $another_css;
	public $another_js;
	public $another_chart_js;
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
		$this->data['another_chart_js'] = $this->another_chart_js;
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
		$this->another_chart_js = "";
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
		$image_path = 'assets/images/logos/logo-tbkk.png';
		$pdf->Image($image_path, 2, $pdf->GetY() - 8, 27);
		$pdf->SetFont('THSarabunNew', 'B', 30);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'IN-HOUSE RFQ');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);
		// Doc. No.
		$doc_no = 'Doc. No. :';
		$ir_doc_no = $this->input->get('idc_running_no');
		$width_docno = $pdf->GetStringWidth($doc_no);
		$pdf->Cell($width_docno, 5, $doc_no);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(33, 5, $ir_doc_no, 'B', 0, 'C');

		// Issue Date.
		$pdf->SetX($pdf->GetX() + 5);
		$issue_date = 'Issue Date :';
		$ir_created_date = $this->input->get('idc_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $ir_created_date, 'B', 0, 'C');

		// Ref Nbc.
		$pdf->Ln(8);
		$pdf->SetX(85);
		$ref_no = 'Ref. No. :';
		$ir_ref_nbc = $this->input->get('idc_refer_doc');
		if ($ir_ref_nbc == '0' || $ir_ref_nbc == '') {
			$ref_val = '-';
		} else {
			$ref_val = $this->db->select('idc_running_no')
				->from('info_document_control')
				->where('idc_id', (int)$ir_ref_nbc)
				->get()
				->row();
			$ref_val = $ref_val->idc_running_no;
		}


		$width_ref_no = $pdf->GetStringWidth($ref_no);
		$pdf->Cell($width_ref_no, 5, $ref_no);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(33, 5, $ref_val, 'B', 0, 'C');

		// Closing Date.
		$pdf->SetX($pdf->GetX() + 3);
		$closing_date = 'Closing Date :';
		$ir_duedate = $this->input->get('idc_closing_date');
		$width_ir_duedate = $pdf->GetStringWidth($closing_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_ir_duedate, 5, $closing_date);
		$pdf->Cell(33, 5, $ir_duedate, 'B', 0, 'C');

		// Attn 
		$pdf->Ln(13);
		$count_attn = 0;
		$get_attn = $this->input->get('idat_item');
		$attn_all = $this->db->select('mda_id, mda_name')->from('mst_document_attn')->order_by('mda_id', 'asc')->get()->result();

		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Attn. :';
		$width_attn = $pdf->GetStringWidth($attn) + 6.5;
		$pdf->Cell($width_attn, 0, $attn);

		for ($i = 0; $i < count($attn_all); $i++) {
			$box_bg = '255, 255, 255';

			for ($j = 0; $j < count($get_attn); $j++) {
				if ($get_attn[$j] == $attn_all[$i]->mda_id) {
					$box_bg = '0, 0, 0';
					break;
				}
			}

			if ($count_attn == 0) {
				$pdf->SetFillColor((int) $box_bg);
				$pdf->SetY($pdf->GetY() - 3);
				$pdf->SetX($pdf->GetX() + 15);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$pu_dept = $attn_all[$i]->mda_name . ' Dept.';
				$width_pu_dept = $pdf->GetStringWidth($pu_dept) + 2;
				$pdf->Cell($width_pu_dept, 5, $pu_dept);
			} else {
				$pdf->SetFillColor((int)$box_bg);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$pe_dept = $attn_all[$i]->mda_name . ' Dept.';
				$width_pe_dept = $pdf->GetStringWidth($pe_dept) + 2;
				$pdf->Cell($width_pe_dept, 5, $pe_dept);
			}

			$pdf->SetX($pdf->GetX() + 12);
			$count_attn++;
		}


		// Customer 
		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$cus = 'Customer :';
		$width_cus = $pdf->GetStringWidth($cus) + 2;
		$pdf->Cell($width_cus, 0, $cus);

		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 15);
		$ir_customer = $this->input->get('idc_customer_name');
		$pdf->Cell(93, 5, $ir_customer, 'B', 0, 'L');

		// Import From
		(int)$ir_customer_type = $this->input->get('idc_customer_type');
		$boxOversea = '';
		$boxDomestic = '';
		if ($ir_customer_type == 1) {
			$boxOversea = '0, 0, 0';
			$boxDomestic = '255, 255, 255';
		} else if ($ir_customer_type == 2) {
			$boxOversea = '255, 255, 255';
			$boxDomestic = '0, 0, 0';
		}
		$pdf->SetX($pdf->GetX() + 12.9);
		$pdf->SetFillColor((int)$boxOversea);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Overseas';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		$pdf->SetX($pdf->GetX() + 11.7);
		$pdf->SetFillColor((int)$boxDomestic);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Domestic';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		// Subject
		$pdf->Ln(12);
		$count_mds = 0;
		$get_mds = $this->input->get('mds_id');
		$mds_all = $this->db->select('mds_id, mds_name')->from('mst_document_subject')->order_by('mds_id', 'asc')->get()->result();
		$subject_note = '-';

		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Subject :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		for ($i = 0; $i < count($mds_all); $i++) {
			$box_bg = '255, 255, 255';

			if ($get_mds == $mds_all[$i]->mds_id) {
				$box_bg = '0, 0, 0';
			}

			if ($count_mds == 0) {
				$pdf->SetFillColor((int)$box_bg);
				$pdf->SetY($pdf->GetY() - 3);
				$pdf->SetX($pdf->GetX() + 15);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$newp = $mds_all[$i]->mds_name;
				$width_newp = $pdf->GetStringWidth($newp) + 2;
				$pdf->Cell($width_newp, 5, $newp);
			} else {
				$pdf->SetX($pdf->GetX() + 2);
				$pdf->SetFillColor((int)$box_bg);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$ecr = $mds_all[$i]->mds_name;
				$width_ecr = $pdf->GetStringWidth($ecr) + 2;
				$pdf->Cell($width_ecr, 5, $ecr);
			}

			if ($mds_all[$i]->mds_name == 'Other') {
				if ($get_mds == $mds_all[$i]->mds_id) {
					$subject_note = $this->input->get('idc_subject_note');
					$subject_note = iconv('UTF-8', 'TIS-620//IGNORE', $subject_note);
					$pdf->Cell(30, 5, $subject_note, 'B', 0, 'C');
				} else {
					$pdf->Cell(30, 5, $subject_note, 'B', 0, 'C');
				}
			}

			$pdf->SetX($pdf->GetX() + 5);
			$count_mds++;
		}

		// Enclosures
		$pdf->Ln(12);
		$count_mde = 0;
		$get_mde = $this->input->get('mde_id');
		$mde_all = $this->db->select('mde_id, mde_name')->from('mst_document_enclosures')->order_by('mde_id', 'asc')->get()->result();
		$enclosures_note = '-';

		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Enclosures :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		for ($i = 0; $i < count($mde_all); $i++) {
			$box_bg = '255, 255, 255';

			if ($get_mde == $mde_all[$i]->mde_id) {
				$box_bg = '0, 0, 0';
			}

			if ($count_mde == 0) {
				$pdf->SetFillColor((int)$box_bg);
				$pdf->SetY($pdf->GetY() - 3);
				$pdf->SetX($pdf->GetX() + 15);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$newp = $mde_all[$i]->mde_name;
				$width_newp = $pdf->GetStringWidth($newp) + 2;
				$pdf->Cell($width_newp, 5, $newp);
			} else {
				$pdf->SetX($pdf->GetX() + 7.6);
				$pdf->SetFillColor((int)$box_bg);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$ecr = $mde_all[$i]->mde_name;
				$width_ecr = $pdf->GetStringWidth($ecr) + 2;
				$pdf->Cell($width_ecr, 5, $ecr);
			}

			if ($mde_all[$i]->mde_name == 'Other') {
				if ($get_mde == $mde_all[$i]->mde_id) {
					$enclosures_note = $this->input->get('idc_enclosures_note');
					$pdf->Cell(60, 5, $enclosures_note, 'B', 0, 'C');
				} else {
					$pdf->Cell(60, 5, $enclosures_note, 'B', 0, 'C');
				}
			}

			$pdf->SetX($pdf->GetX() + 5);
			$count_mde++;
		}

		// Project Life 
		$pdf->Ln(8);
		$ir_pro_life = $this->input->get('idc_project_life');
		$pdf->SetX($pdf->GetX() - 5);
		$proj = 'Project Life :';
		$width_proj = $pdf->GetStringWidth($proj);
		$pdf->Cell($width_proj, 5, $proj);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(33, 5, $ir_pro_life, 'B', 0, 'C');
		$pdf->Cell(5, 5, 'Years', '', 0, 'L');

		$ir_sop_tim = $this->input->get('idc_project_start');
		$pdf->SetX($pdf->GetX() + 38);
		$pti = 'Program Timing info. :';
		$width_pti = $pdf->GetStringWidth($pti);
		$pdf->Cell($width_pti, 5, $pti);
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell(40, 5, $ir_sop_tim, 'B', 0, 'C');

		// Table Part No.
		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 14);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5.5, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 5.5, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 5.5, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 5.5, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 5.5, 'Remark', 1, 1, 'C', true);

		$idc_id = $this->input->get('idc_id');
		$consern = $this->db->select('idi_item_no, idi_item_name, idi_model, idi_remark')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		for ($i = 0; $i < 10; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 13);
			$pdf->Cell(15, 5.5, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->idi_item_no) ? $consern[$i]->idi_item_no : '';
			$part_name = isset($consern[$i]->idi_item_name) ? $consern[$i]->idi_item_name : '';
			$model = isset($consern[$i]->idi_model) ? $consern[$i]->idi_model : '';
			$remark = isset($consern[$i]->idi_remark) ? $consern[$i]->idi_remark : '';

			$part_no = iconv('UTF-8', 'TIS-620//IGNORE', $part_no);
			$part_name = iconv('UTF-8', 'TIS-620//IGNORE', $part_name);
			$model = iconv('UTF-8', 'TIS-620//IGNORE', $model);
			$remark = iconv('UTF-8', 'TIS-620//IGNORE', $remark);

			$pdf->SetFont('THSarabunNew', 'B', (strlen($part_no) > 20) ? 9.5 : 13);
			$pdf->Cell(35, 5.5, $part_no, 1, 0, 'C');

			$pdf->SetFont('THSarabunNew', 'B', (strlen($part_name) > 30) ? 9.5 : 13);
			$pdf->Cell(55, 5.5, $part_name, 1, 0, 'C');

			$pdf->SetFont('THSarabunNew', 'B', (strlen($model) > 20) ? 9.5 : 13);
			$pdf->Cell(40, 5.5, $model, 1, 0, 'C');
			
			$pdf->SetFont('THSarabunNew', 'B', (strlen($remark) > 30) ? 9.5 : 13);
			$pdf->Cell(50, 5.5, iconv('UTF-8', 'TIS-620//IGNORE', $remark), 1, 1, 'C'); // 35 Characters
		}

		// Table Volume
		$pdf->Ln(2);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$val = 'Volume Information :';
		$width_val = $pdf->GetStringWidth($val);
		$pdf->Cell($width_val, 5, $val, 0, 1);

		$pdf->Ln(1);
		$itemInfo = $this->db->select('idi_id, idi_item_no')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		$idc_project_life = $this->input->get('idc_project_life');
		$idc_project_start = $this->input->get('idc_project_start');

		$years = [];
		for ($i = 0; $i <= $idc_project_life; $i++) {
			$years[] = strval($idc_project_start + $i);
		}
		$headerHeight = 5.5;

		$pdf->SetFont('THSarabunNew', 'B', 14);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(15, $headerHeight * 2, 'No', 1, 0, 'C', true); // rowspan 2
		$pdf->Cell(35, $headerHeight * 2, 'PART NUMBER', 1, 0, 'C', true); // rowspan 2
		$pdf->Cell(145, $headerHeight, 'YEAR / VOLUME', 1, 1, 'C', true); // colspan

		$pdf->SetX($pdf->GetX() + 50 - 4);
		for ($i = 0; $i < 10; $i++) {
			$pdf->SetFont('THSarabunNew', 'B', 12);
			$label = isset($years[$i]) ? $years[$i] : '';
			$pdf->SetFillColor(218, 233, 248);
			$pdf->Cell(14.5, $headerHeight, $label, 1, 0, 'C', true);
		}
		$pdf->Ln();

		for ($i = 0; $i < 10; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 12);
			$pdf->Cell(15, 5.5, $i + 1, 1, 0, "C");

			$part_no = isset($itemInfo[$i]->idi_item_no) ? $itemInfo[$i]->idi_item_no : '';
			$idi_id = isset($itemInfo[$i]->idi_id) ? $itemInfo[$i]->idi_id : 0;
			$pdf->Cell(35, 5.5, $part_no, 1, 0, 'C');

			$idv_qty = $this->db->select('idv_qty')
				->from('info_document_volume')
				->where('idi_id', $idi_id)
				->where('idv_status', 1)
				->order_by('idv_id', 'ASC')
				->get()
				->result();
			for ($q = 0; $q < 10; $q++) {
				$label = isset($idv_qty[$q]) ? $idv_qty[$q]->idv_qty : ''; // ต้องใช้ ->idv_qty
				$pdf->Cell(14.5, 5.5, $label, 1, 0, 'C');
			}
			$pdf->Ln();
		}
		// Info
		$pdf->Ln(3);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$info = 'Please be required to study the cost according above detail and be arranged necessary info upon below conditions.';
		$width_val = $pdf->GetStringWidth($info);
		$pdf->Cell($width_val, 5, $info);

		// Table Note
		$pdf->Ln(7);
		$idc_note1 = $this->input->get('idc_note1');
		$idc_note1 .= "\n ";
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$startY = $pdf->GetY();
		$pdf->Cell(73, 4, 'Note :', 1, 1, 'L', true);
		$pdf->SetFillColor(255, 255, 255);

		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->MultiCell(73, 4, iconv('UTF-8', 'TIS-620//IGNORE', $idc_note1), 'LBR', 'L');
		$endY = $pdf->GetY();

		$idc_note2 = $this->input->get('idc_note2');
		$idc_note2 .= "\n ";
		$pdf->SetY($startY);
		$pdf->SetX(88);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(113, 4, 'Comment/Additional info By S&M :', 1, 1, 'L', true);
		$pdf->SetFillColor(255, 255, 255);

		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX(88);
		$pdf->MultiCell(113, 4, iconv('UTF-8', 'TIS-620//IGNORE', $idc_note2), 'LBR', 'L');
		// $maxLength2 = 56;
		// $lines2 = str_split($idc_note2, $maxLength2);
		// foreach ($lines2 as $line) {
		// 	$pdf->Cell(113, 4, $line, 'LR', 1, 'L');
		// }

		// Table Sign
		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Prepared By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Checked By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Approved By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Authorized By', 1, 0, 'C', true);

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);

		$idc_id = $this->input->get('idc_id');
		$sign1 = $this->db->select("su.su_sign_path, CONCAT(su.su_firstname, ' ', su.su_lastname) AS fullname")
			->from('sys_users su')
			->join('info_document_control idc', 'idc.idc_created_by = su.su_username', 'left')
			->where('idc.idc_id', $idc_id)
			->get()
			->result();

		$sign1[0]->su_sign_path = ($sign1[0]->su_sign_path == 'null' || !$sign1[0]->su_sign_path) ? 'assets/images/uploaded/signature/EmptySign.png' : $sign1[0]->su_sign_path;
		$sign1[0]->fullname = $sign1[0]->fullname ?? '';

		$sign_group = $this->db->select("CASE WHEN ida.ida_status = 9 THEN su.su_sign_path ELSE 'null' END AS su_sign_path, COALESCE(CONCAT(su.su_firstname, ' ', su.su_lastname), 'null') AS fullname")
			->from('info_document_control idc')
			->join('info_document_approval ida', 'ida.idc_id = idc.idc_id', 'left')
			->join('sys_users su', 'su.su_id = ida.su_id', 'left')
			->where('idc.idc_id', $idc_id)
			->where_in('ida.ida_status', [1, 9])
			->get()
			->result();
		$default_sign = (object) [
			"su_sign_path" => 'assets/images/uploaded/signature/EmptySign.png',
			"fullname" => "Error signature"
		];

		foreach ($sign_group as $sign) {
			if (empty($sign->su_sign_path) || !file_exists($sign->su_sign_path)) {
				$sign->su_sign_path = 'assets/images/uploaded/signature/EmptySign.png';
			}

			$sign->fullname = !empty($sign->fullname) ? $sign->fullname : "Error signature";
		}

		while (count($sign_group) < 3) {
			$sign_group[] = clone $default_sign;
		}

		if (empty($sign_group)) {
			$sign_group = [clone $default_sign, clone $default_sign, clone $default_sign];
		}

		$pdf->Cell(48.75, 20, $pdf->Image($sign1[0]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[0]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[1]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[2]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 4, $sign1[0]->fullname, 'LR', 0, 'C');
		$pdf->Cell(48.75, 4, $sign_group[0]->fullname, 'LR', 0, 'C');
		$pdf->Cell(48.75, 4, $sign_group[1]->fullname, 'LR', 0, 'C');
		$pdf->Cell(48.75, 4, $sign_group[2]->fullname, 'LR', 0, 'C');
		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, 'Engineer', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Supervisor', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Department Manager', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'General Manager', 'LBR', 0, 'C');

		$pdf->Output('I', $ir_doc_no . '.pdf');
	}
}

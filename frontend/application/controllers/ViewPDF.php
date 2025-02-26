<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
require_once APPPATH . 'libraries/fpdf186/fpdf.php';
class ViewPDF extends CI_Controller
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

		// $this->ManageBackend->chkLogout();
	}

	public function RfqPDF()
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
		$pdf->Ln(10);
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
		$pdf->Ln(10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 4, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 4, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 4, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 4, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 4, 'Remark', 1, 1, 'C', true);

		$idc_id = $this->input->get('idc_id');
		$consern = $this->db->select('idi_item_no, idi_item_name, idi_model, idi_remark')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		for ($i = 0; $i < 20; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 11);
			$pdf->Cell(15, 4, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->idi_item_no) ? $consern[$i]->idi_item_no : '';
			$part_name = isset($consern[$i]->idi_item_name) ? $consern[$i]->idi_item_name : '';
			$model = isset($consern[$i]->idi_model) ? $consern[$i]->idi_model : '';
			$remark = isset($consern[$i]->idi_remark) ? $consern[$i]->idi_remark : '';

			$pdf->Cell(35, 4, $part_no, 1, 0, 'C');
			$pdf->Cell(55, 4, $part_name, 1, 0, 'C');
			$pdf->Cell(40, 4, $model, 1, 0, 'C');
			$pdf->Cell(50, 4, $remark, 1, 1, 'C'); // 35 Characters
		}

		// Table Volume
		$pdf->Ln(2);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$val = 'Volume Information :';
		$width_val = $pdf->GetStringWidth($val);
		$pdf->Cell($width_val, 5, $val);

		$pdf->Ln(5);
		$countYears = $this->db->select('idv_year, idv_qty')
			->from('info_document_volume')
			->where('idc_id', $idc_id)
			->where('idv_status', 1)
			->order_by('idv_id', 'ASC')->get()->result();

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Year', 1, 0, 'R', true);
		for ($i = 0; $i < 11; $i++) {
			$year = isset($countYears[$i]->idv_year) ? $countYears[$i]->idv_year : '';
			$pdf->Cell(16.35, 5, $year, 1, 0, 'C');
		}

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Volume', 1, 0, 'R', true);
		for ($i = 0; $i < 11; $i++) {
			$volume = isset($countYears[$i]->idv_qty) ? $countYears[$i]->idv_qty : '';
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

		$count_mdpu = 0;
		$get_mdpu = $this->input->get('idpu_item');
		$mdpu_all = $this->db->select('mdpu_id, mdpu_name')->from('mst_document_purchase')->order_by('mdpu_id', 'asc')->get()->result();

		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Purchase Cost :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 0, $attn);

		for ($i = 0; $i < count($mdpu_all); $i++) {
			$box_bg = '255, 255, 255';

			for ($j = 0; $j < count($get_mdpu); $j++) {
				if ($get_mdpu[$j] == $mdpu_all[$i]->mdpu_id) {
					$box_bg = '0, 0, 0';
					break;
				}
			}

			if ($count_mdpu == 0) {
				$pdf->SetFillColor((int) $box_bg);
				$pdf->SetY($pdf->GetY() - 3);
				$pdf->SetX($pdf->GetX() + 30);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$pu_dept = $mdpu_all[$i]->mdpu_name;
				$pdf->Cell(30, 5, $pu_dept);
			} else {
				$pdf->SetFillColor((int)$box_bg);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$pe_dept = $mdpu_all[$i]->mdpu_name;
				$pdf->Cell(30, 5, $pe_dept);
			}

			$count_mdpu++;
		}

		// Purchase Cost
		$pdf->Ln(10);
		$count_mdpc = 0;
		$get_mdpc = $this->input->get('idpc_item');
		$mdpc_all = $this->db->select('mdpc_id, mdpc_name')->from('mst_document_process')->order_by('mdpc_id', 'asc')->get()->result();

		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Process Cost :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 0, $attn);

		for ($i = 0; $i < count($mdpc_all); $i++) {
			$box_bg = '255, 255, 255';

			for ($j = 0; $j < count($get_mdpc); $j++) {
				if ($get_mdpc[$j] == $mdpc_all[$i]->mdpc_id) {
					$box_bg = '0, 0, 0';
					break;
				}
			}

			if ($count_mdpc == 0) {
				$pdf->SetFillColor((int) $box_bg);
				$pdf->SetY($pdf->GetY() - 3);
				$pdf->SetX($pdf->GetX() + 30);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$pu_dept = $mdpc_all[$i]->mdpc_name;
				$pdf->Cell(30, 5, $pu_dept);
			} else {
				$pdf->SetFillColor((int)$box_bg);
				$pdf->Cell(9, 5, '', 1, 0, 'C', true);
				$pe_dept = $mdpc_all[$i]->mdpc_name;
				$pdf->Cell(30, 5, $pe_dept);
			}

			$count_mdpc++;
		}

		// Table Note
		$pdf->Ln(10);
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
		$pdf->MultiCell(73, 4, $idc_note1, 'LBR', 'L');
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
		$pdf->MultiCell(113, 4, $idc_note2, 'LBR', 'L');
		// $maxLength2 = 56;
		// $lines2 = str_split($idc_note2, $maxLength2);
		// foreach ($lines2 as $line) {
		// 	$pdf->Cell(113, 4, $line, 'LR', 1, 'L');
		// }

		// Table Sign
		$pdf->Ln(5);
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

		$sign_group = $this->db->select("
				CASE WHEN ida.ida_status = 9 THEN su.su_sign_path ELSE 'null' END AS su_sign_path,
				COALESCE(CONCAT(su.su_firstname, ' ', su.su_lastname), 'null') AS fullname")
			->from('info_document_control idc')
			->join('info_document_approval ida', 'ida.idc_id = idc.idc_id', 'left')
			->join('sys_users su', 'su.su_id = ida.su_id', 'left')
			->where('idc.idc_id', $idc_id)
			->where_in('ida.ida_status', [1, 9])
			->get()
			->result();

		if (count($sign_group) == 3) {
			for ($i = 0; $i < count($sign_group); $i++) {
				$sign_group[$i]->su_sign_path = ($sign_group[$i]->su_sign_path == 'null' || !$sign_group[$i]->su_sign_path) ? 'assets/images/uploaded/signature/EmptySign.png' : $sign_group[$i]->su_sign_path;
				$sign_group[$i]->fullname = $sign_group[$i]->fullname ?? '';
			}
		} else {
			for ($i = 0; $i < count($sign_group); $i++) {
				$sign_group[$i]->su_sign_path = 'assets/images/uploaded/signature/EmptySign.png';
				$sign_group[$i]->fullname = 'Error signature';
			}
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



		$pdf->Output();
	}

	public function createNbcPDF()
	{
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
		$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew-Bold.php');

		$pdf->SetY(5);
		$image_path = 'assets/images/logos/tbkk logo form.png';
		$pdf->Image($image_path, 5, $pdf->GetY(), 20);
		$pdf->SetFont('THSarabunNew', 'B', 25);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'Confirmation Sheet for New Business');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);

		$pdf->SetX($pdf->GetX() + 60);
		$issue_date = 'Doc. No. :';
		$run_no = $this->input->get('run_no');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(35.5, 5, $run_no, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() + 135);
		$issue_date = 'Issue Date :';
		$idc_created_date = $this->input->get('idc_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $idc_created_date, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'To :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(40, 5, 'R&D Department', 'B', 0, 'L');

		$pdf->SetX($pdf->GetX() + 12);
		$attn = 'From :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(60, 5, 'Sale and Marketing Department', 'B', 0, 'L');

		$pdf->SetX($pdf->GetX() + 15);
		$attn = 'Ref. No. :';
		$idc_running_no = $this->input->get('idc_running_no');
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(36.5, 5, $idc_running_no, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn_name = $this->db->select("CONCAT('Mr. ', su.su_firstname) AS su_firstname")
			->from('sys_workflow_detail swd')
			->join('sys_workflow_group swg', 'swg.swg_id = swd.swg_id', 'left')
			->join('sys_department sd', 'sd.sd_id = swg.sd_id', 'left')
			->join('sys_users su', 'su.su_id = swd.su_id', 'left')
			->where('sd.sd_dept_aname LIKE', '%R&D%')
			->where('swd.swd_level_no = (SELECT MAX(swd_level_no) FROM sys_workflow_detail swd_sub WHERE swd_sub.swg_id = swg.swg_id)', null, false)
			->get()
			->result();

		$attn = 'Attn :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(37.5, 5, $attn_name[0]->su_firstname, 'B', 0, 'L');

		// Enclosures
		$pdf->Ln(10);
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
				$ecr = $mde_all[$i]->mde_name . ' :';
				$width_ecr = $pdf->GetStringWidth($ecr) + 2;
				$pdf->Cell($width_ecr, 5, $ecr);
			}

			if ($mde_all[$i]->mde_name == 'Other') {
				if ($get_mde == $mde_all[$i]->mde_id) {
					$enclosures_note = $this->input->get('idc_enclosures_note');
					$pdf->Cell(55, 5, $enclosures_note, 'B', 0, 'L');
				} else {
					$pdf->Cell(55, 5, $enclosures_note, 'B', 0, 'C');
				}
			}

			$pdf->SetX($pdf->GetX() + 5);
			$count_mde++;
		}

		$pdf->Ln(10);
		$ir_pro_life = $this->input->get('ir_pro_life');
		$ir_sop_tim = $this->input->get('ir_sop_tim');
		$pdf->SetX($pdf->GetX() - 5);
		$note = 'Please kindly investigate part with customer requirement condition in details as below.';
		$width_note = $pdf->GetStringWidth($note) + 2;
		$pdf->Cell($width_note, 0, $note);

		// Table Part No.
		$pdf->Ln(4);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 4, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 4, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 4, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 4, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 4, 'Remark', 1, 1, 'C', true);

		$idc_id = $this->input->get('idc_id');
		$consern = $this->db->select('idi_item_no, idi_item_name, idi_model, idi_remark')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		for ($i = 0; $i < 20; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 11);
			$pdf->Cell(15, 4, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->idi_item_no) ? $consern[$i]->idi_item_no : '';
			$part_name = isset($consern[$i]->idi_item_name) ? $consern[$i]->idi_item_name : '';
			$model = isset($consern[$i]->idi_model) ? $consern[$i]->idi_model : '';
			$remark = isset($consern[$i]->idi_remark) ? $consern[$i]->idi_remark : '';

			$pdf->Cell(35, 4, $part_no, 1, 0, 'C');
			$pdf->Cell(55, 4, $part_name, 1, 0, 'C');
			$pdf->Cell(40, 4, $model, 1, 0, 'C');
			$pdf->Cell(50, 4, $remark, 1, 1, 'C'); // 35 Characters
		}

		// Table Volume
		$pdf->Ln(1);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$val = 'Volume Information :';
		$width_val = $pdf->GetStringWidth($val);
		$pdf->Cell($width_val, 5, $val);

		$pdf->Ln(5);
		$countYears = $this->db->select('idv_year, idv_qty')
			->from('info_document_volume')
			->where('idc_id', $idc_id)
			->where('idv_status', 1)
			->order_by('idv_id', 'ASC')->get()->result();

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Year', 1, 0, 'R', true);
		for ($i = 0; $i < 11; $i++) {
			$year = isset($countYears[$i]->idv_year) ? $countYears[$i]->idv_year : '';
			$pdf->Cell(16.35, 5, $year, 1, 0, 'C');
		}

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Volume', 1, 0, 'R', true);
		for ($i = 0; $i < 11; $i++) {
			$volume = isset($countYears[$i]->idv_qty) ? $countYears[$i]->idv_qty : '';
			$pdf->Cell(16.35, 5, $volume, 1, 0, 'C');
		}

		// Table Note
		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(195, 5, 'Note :', 1, 0, 'L', true);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(195, 4, '1. Kindly review provided specifications or/and compare with old RFQ, recommend to in-house RFQ stage.', 'LR', 0, 'L',);
		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(195, 4, '2. Please mention point that need to change specification.', 'LR', 0, 'L',);

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(16, 4, '3. Reply on : ', 'L', 0, 'L',);
		$idc_reply_date = $this->input->get('idc_reply_date');
		$pdf->Cell(40, 4, $idc_reply_date, 'B', 0, 'C');
		$pdf->Cell(139, 2, '', 'R', 0, 'L');

		$pdf->Ln();
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(195, 4, '', 'LBR', 0, 'L',);

		// Table Sign
		$pdf->Ln(7);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Prepared By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Checked By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Approved By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Authorized By', 1, 0, 'C', true);

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);

		$sign1 = $this->db->select("su.su_sign_path, CONCAT(su.su_firstname, ' ', su.su_lastname) AS fullname")
			->from('sys_users su')
			->join('info_document_control idc', 'idc.idc_created_by = su.su_username', 'left')
			->where('idc.idc_running_no', $run_no)
			->get()
			->result();

		$sign1[0]->su_sign_path = ($sign1[0]->su_sign_path == 'null' || !$sign1[0]->su_sign_path) ? 'assets/images/uploaded/signature/EmptySign.png' : $sign1[0]->su_sign_path;
		$sign1[0]->fullname = $sign1[0]->fullname ?? '';

		$sign_group = $this->db->select("CASE WHEN ida.ida_status = 9 THEN su.su_sign_path ELSE 'null' END AS su_sign_path,
										COALESCE(CONCAT(su.su_firstname, ' ', su.su_lastname), 'null') AS fullname")
			->from('info_document_control idc')
			->join('info_document_approval ida', 'ida.idc_id = idc.idc_id', 'left')
			->join('sys_users su', 'su.su_id = ida.su_id', 'left')
			->where('idc.idc_id', $this->input->get('idc_refer_doc'))
			->where_in('ida.ida_status', [1, 9])
			->get()
			->result();

		if (count($sign_group) == 3) {
			for ($i = 0; $i < count($sign_group); $i++) {
				$sign_group[$i]->su_sign_path = ($sign_group[$i]->su_sign_path == 'null' || !$sign_group[$i]->su_sign_path) ? 'assets/images/uploaded/signature/EmptySign.png' : $sign_group[$i]->su_sign_path;
				$sign_group[$i]->fullname = $sign_group[$i]->fullname ?? '';
			}
		} else {
			for ($i = 0; $i < count($sign_group); $i++) {
				$sign_group[$i]->su_sign_path = 'assets/images/uploaded/signature/EmptySign.png';
				$sign_group[$i]->fullname = 'Error signature';
			}
		}

		$pdf->Cell(48.75, 15, $pdf->Image($sign1[0]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48, 16), 'LR', 0, 'C');
		$pdf->Cell(48.75, 15, $pdf->Image($sign_group[0]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48, 16), 'LR', 0, 'C');
		$pdf->Cell(48.75, 15, $pdf->Image($sign_group[1]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48, 16), 'LR', 0, 'C');
		$pdf->Cell(48.75, 15, $pdf->Image($sign_group[2]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48, 16), 'LR', 0, 'C');

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, $sign1[0]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[0]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[1]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[2]->fullname, 'LBR', 0, 'C');

		$pdf->Ln(7);
		$bg_ok = '';
		$bg_ng = '';
		$idc_result_confirm = $this->input->get('idc_result_confirm');
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$replysheet = 'Reply Sheet :';
		$pdf->Cell(20, 6, $replysheet, 0, 0);
		$replydept = 'R&D Dept. confirm project\'s possibility result :';
		$pdf->Cell(5, 6, $replydept, 0, 0);

		if ($idc_result_confirm == 0) {
			$bg_ok = '255, 255, 255';
			$bg_ng = '255, 255, 255';
		} else if ($idc_result_confirm == 1) {
			$bg_ok = '255, 255, 255';
			$bg_ng = '0, 0, 0';
		} else if ($idc_result_confirm == 9) {
			$bg_ok = '0, 0, 0';
			$bg_ng = '255, 255, 255';
		}

		$pdf->SetY($pdf->GetY() + 0.5);
		$pdf->SetX($pdf->GetX() - 17);
		$pdf->SetFillColor((int)$bg_ok);
		$pdf->SetX($pdf->GetX() - 115);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$drawing = 'OK';
		$pdf->Cell(15, 5, $drawing);

		$pdf->SetFillColor((int)$bg_ng);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$eOther = 'NG';
		$pdf->Cell(1, 5, $eOther);

		// Table Note/Comment
		$pdf->Ln(7);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(195, 5, 'Note / Comment :', 1, 0, 'L', true);
		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$idc_note2 = $this->input->get('idc_note2');
		$pdf->Cell(195, 20, $idc_note2, 'LBR', 1, 'L',);

		$pdf->Ln(3);
		$arrow = 'assets/images/logos/arrow-right-removebg-preview.png';
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->Cell(48.75, 5, 'Route :');
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 5, 'Prepared By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 5, 'Approved By', 1, 0, 'C', true);
		$pdf->Cell(48.75, 5, 'Authorized By', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(6.5, 5, "SM.", 0, 0, 'L');
		$pdf->Cell(5, 5, $pdf->Image($arrow, $pdf->GetX(), $pdf->GetY() + 1.5, 5, 2.5), '', 0, 'L');
		$pdf->Cell(8, 5, "R&D.", 0, 0, 'L');
		$pdf->Cell(6, 5, $pdf->Image($arrow, $pdf->GetX(), $pdf->GetY() + 1.5, 5, 2.5), '', 0, 'L');
		$pdf->Cell(23.25, 5, "SM.", 0, 0, 'L');
		$pdf->Cell(48.75, 5, '', 'L', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'LR', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'R', 1, 'L',);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, "(RFQ & QUO. )", 0, 0, 'L');
		$pdf->Cell(48.75, 5, '', 'L', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'LR', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'R', 1, 'L',);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(6.5, 5, "SM.", 0, 0, 'L');
		$pdf->Cell(5, 5, $pdf->Image($arrow, $pdf->GetX(), $pdf->GetY() + 1.5, 5, 2.5), '', 0, 'L');
		$pdf->Cell(11, 5, "PU/PE.", 0, 0, 'L');
		$pdf->Cell(4.5, 5, $pdf->Image($arrow, $pdf->GetX(), $pdf->GetY() + 1.5, 5, 2.5), '', 0, 'L');
		$pdf->Cell(6.5, 5, "SM.", 0, 0, 'L');
		$pdf->Cell(4.5, 5, $pdf->Image($arrow, $pdf->GetX(), $pdf->GetY() + 1.5, 5, 2.5), '', 0, 'L');
		$pdf->Cell(10.75, 5, "Cust.", 0, 0, 'L');
		$pdf->Cell(48.75, 5, '', 'L', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'LR', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'R', 1, 'L',);

		$sign_rnd = $this->db->select("
				CASE WHEN ida.ida_status = 9 THEN su.su_sign_path ELSE 'null' END AS su_sign_path,
				COALESCE(CONCAT(su.su_firstname, ' ', su.su_lastname), 'null') AS fullname")
			->from('info_document_control idc')
			->join('info_document_approval ida', 'ida.idc_id = idc.idc_id', 'left')
			->join('sys_users su', 'su.su_id = ida.su_id', 'left')
			->where('idc.idc_id', $idc_id)
			->where_in('ida.ida_status', [1, 9, 6])
			->get()
			->result();

		if (count($sign_rnd) == 2) {
			for ($i = 0; $i < count($sign_rnd); $i++) {
				$sign_rnd[$i]->su_sign_path = ($sign_rnd[$i]->su_sign_path == 'null' || !$sign_rnd[$i]->su_sign_path) ? 'assets/images/uploaded/signature/EmptySign.png' : $sign_rnd[$i]->su_sign_path;
				$sign_rnd[$i]->fullname = $sign_rnd[$i]->fullname ?? '';
			}
		} else {
			for ($i = 0; $i < count($sign_rnd); $i++) {
				$sign_rnd[$i]->su_sign_path = 'assets/images/uploaded/signature/EmptySign.png';
				$sign_rnd[$i]->fullname = 'Error signature';
			}
		}

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, "CE/GDC", 0, 0, 'C');
		$pdf->Cell(48.75, 5, $sign1[0]->fullname, 'LB', 0, 'C',);
		$pdf->Cell(48.75, 5, $sign_rnd[0]->fullname, 'LBR', 0, 'C',);
		$pdf->Cell(48.75, 5, $sign_rnd[1]->fullname, 'BR', 1, 'C',);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Sety($pdf->GetY() - 20);
		$pdf->Cell(45, 5, "", 0, 0, 'C');

		$pdf->Cell(48.75, 5, $pdf->Image($sign1[0]->su_sign_path, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 0, 'L');
		$pdf->Cell(48.75, 5, $pdf->Image($sign_rnd[0]->su_sign_path, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 0, 'L');
		$pdf->Cell(48.75, 5, $pdf->Image($sign_rnd[1]->su_sign_path, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 1, 'L');

		$pdf->Output();
	}

	public function createFeasibilityPDF()
	{
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
		$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew-Bold.php');

		$pdf->SetY(5);
		$image_path = 'assets/images/logos/tbkk logo form.png';
		$pdf->Image($image_path, 5, $pdf->GetY(), 20);
		$pdf->SetFont('THSarabunNew', 'B', 28);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'TEAM FEASIBILITY & RISK ANALYSIS');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);

		$pdf->SetX($pdf->GetX() + 60);
		$issue_date = 'Doc. No. :';
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(35.5, 5, $this->input->get('idc_running_no'), 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() + 135);
		$issue_date = 'Issue Date :';
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $this->input->get('idc_created_date'), 'B', 0, 'C');

		$ir_created_date = $this->input->get('ir_created_date');

		$refer_doc = $this->input->get('run_no') ?: '-';
		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Ref No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(10, 5, '', '', 0, 'C');
		$pdf->Cell(100, 5, $refer_doc, 'B', 0, 'L');
		$pdf->Cell(7, 5, '', '', 0, 'C');

		$pdf->SetX($pdf->GetX() + 15);
		$attn = 'Pag No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(36.5, 5, '1 / 2', 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Customer :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(7, 5, '', '', 0, 'C');
		$pdf->Cell(100, 5, $this->input->get('idc_customer_name'), 'B', 0, 'L');

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
		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor((int)$boxOversea);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Overseas';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		$pdf->SetX($pdf->GetX() + 14);
		$pdf->SetFillColor((int)$boxDomestic);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Domestic';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Requirement :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		$count_mds = 0;
		$get_mds = $this->input->get('mds_id');
		$mds_all = $this->db->select('mds_id, mds_name')->from('mst_document_subject')->order_by('mds_id', 'asc')->get()->result();
		$subject_note = '-';

		for ($i = 0; $i < count($mds_all); $i++) {
			$box_bg = '255, 255, 255';

			if ($get_mds == $mds_all[$i]->mds_id) {
				$box_bg = '0, 0, 0';
			}

			if ($count_mds == 0) {
				$pdf->SetFillColor((int)$box_bg);
				$pdf->SetY($pdf->GetY() - 3);
				$pdf->SetX($pdf->GetX() + 19);
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
					$pdf->Cell(44, 5, $subject_note, 'B', 0, 'C');
				} else {
					$pdf->Cell(44, 5, $subject_note, 'B', 0, 'C');
				}
			}

			$pdf->SetX($pdf->GetX() + 5);
			$count_mds++;
		}

		// Table Part No.
		$pdf->Ln(8);
		// $pdf->SetLineWidth(1.3);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 4, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 4, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 4, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 4, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 4, 'Remark', 1, 1, 'C', true);

		$idc_id = $this->input->get('idc_id');
		$consern = $this->db->select('idi_item_no, idi_item_name, idi_model, idi_remark')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		for ($i = 0; $i < 20; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 11);
			$pdf->Cell(15, 4, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->idi_item_no) ? $consern[$i]->idi_item_no : '';
			$part_name = isset($consern[$i]->idi_item_name) ? $consern[$i]->idi_item_name : '';
			$model = isset($consern[$i]->idi_model) ? $consern[$i]->idi_model : '';
			$remark = isset($consern[$i]->idi_remark) ? $consern[$i]->idi_remark : '';

			$pdf->Cell(35, 4, $part_no, 1, 0, 'C');
			$pdf->Cell(55, 4, $part_name, 1, 0, 'C');
			$pdf->Cell(40, 4, $model, 1, 0, 'C');
			$pdf->Cell(50, 4, $remark, 1, 1, 'C'); // 35 Characters
		}

		$pdf->Ln(4);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->Cell(1, 0, 'Feasibility Cosiderations :');

		$pdf->Ln(3);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->MultiCell(190, 4, "Our product quality planning team has considered the following questions. The drawing and/or \nspecifications provided have been used as a basis for analyzing the ability to meet  specified \nrequirements. All 'no' answers are supported with attached comments identifying our concerns and/or \nproposed changes to enable us to meet the specified requirements.", 0, 'L');

		$consern = $this->db->select([
			'mci.mci_name',
			'MIN(mcip.mcip_weight) AS mcip_weight',
			'ROUND(AVG(ifs.ifs_total / (mcip.mcip_weight * 5)) * 5, 2) AS ifs_score',
			'ROUND((AVG(ifs.ifs_total / (mcip.mcip_weight * 5)) * 5 * MIN(mcip.mcip_weight)), 2) AS ifs_total',
			'MIN(ifs.ifs_comment) AS ifs_comment',
			'GROUP_CONCAT(DISTINCT sd.sd_dept_aname ORDER BY sd.sd_dept_aname SEPARATOR ", ") AS sd_dept_aname',
			'MIN(ifs.ifs_status) AS ifs_status',
			'GROUP_CONCAT(DISTINCT mcip.sd_id ORDER BY mcip.sd_id SEPARATOR ", ") AS sd_id'
		])
			->from('info_feasibility_score ifs')
			->join('mst_consideration_item_pic mcip', 'ifs.mcip_id = mcip.mcip_id', 'left')
			->join('mst_consideration_item mci', 'mci.mci_id = mcip.mci_id', 'left')
			->join('sys_department sd', 'sd.sd_id = mcip.sd_id', 'left')
			->where('ifs.idc_id', $idc_id)
			->group_by('mci.mci_name')
			->order_by('MIN(ifs.ifs_id)', 'ASC')
			->get()
			->result();

		$sum_total = 0;

		for ($i = 0; $i < count($consern); $i++) {
			$sum_total += round((float)$consern[$i]->ifs_total, 2);
		}

		if ($sum_total >= 90 && $sum_total <= 100) {
			$box_green = '0, 0, 0';
			$box_yellow = '255, 255, 255';
			$box_red = '255, 255, 255';
		} else if ($sum_total >= 70 && $sum_total <= 89) {
			$box_green = '255, 255, 255';
			$box_yellow = '0, 0, 0';
			$box_red = '255, 255, 255';
		} else {
			$box_green = '255, 255, 255';
			$box_yellow = '255, 255, 255';
			$box_red = '0, 0, 0';
		}

		// Score Total
		$pdf->SetY($pdf->GetY() - 18);
		$pdf->SetX($pdf->GetX() + 118);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(30, 16, 'Score Total :', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 35);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(43, 16, $sum_total, 1, 1, 'C', true);

		// Conclusion
		$pdf->Ln(5);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->Cell(1, 1, 'Conclusion :');

		$pdf->Ln(4);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 14);
		$pdf->SetFillColor(73, 255, 0);
		$pdf->Cell(35, 5, 'GREEN', 1, 0, 'C', true);
		$pdf->SetFillColor((int)$box_green);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(251, 255, 0);
		$pdf->Cell(35, 5, 'YELLOW', 1, 0, 'C', true);
		$pdf->SetFillColor((int)$box_yellow);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(255, 0, 0);
		$pdf->Cell(35, 5, 'RED', 1, 0, 'C', true);
		$pdf->SetFillColor((int)$box_red);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetY($pdf->GetY() - 15);
		$pdf->SetX($pdf->GetX() + 47);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(15, 5, 'Green', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(25, 5, 'Score: 90 - 100', 1, 0, 'L', true);
		$pdf->Cell(25, 5, 'Feasible & No Risk', 1, 0, 'L', true);
		$pdf->Cell(79, 5, 'Product can be produced as specified with no revisions.', 1, 1, 'L', true);

		$pdf->SetX($pdf->GetX() + 47);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(15, 5, 'Yellow', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(25, 5, 'Score: 70 - 89', 1, 0, 'L', true);
		$pdf->Cell(25, 5, 'Feasible & No Risk', 1, 0, 'L', true);
		$pdf->Cell(79, 5, 'Need recommended or Other requirment (See attached).', 1, 1, 'L', true);

		$pdf->SetX($pdf->GetX() + 47);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(15, 5, 'Red', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(25, 5, 'Score: < 69', 1, 0, 'L', true);
		$pdf->Cell(25, 5, 'Feasible & No Risk', 1, 0, 'L', true);
		$pdf->MultiCell(79, 5, "Design revision required to produce product within the specified requirements and have risk to produce product.", 1, 1, 'L', true);

		// Table Sign
		$pdf->Ln(7);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->Cell(1, 1, 'Sign Off :');

		$sign_group = $this->db->select("
        CASE 
            WHEN ida.ida_status = 9 THEN su.su_sign_path 
            ELSE 'null' 
        END AS su_sign_path,
        COALESCE(CONCAT(su.su_firstname, ' ', su.su_lastname), 'null') AS fullname,
        (SELECT sd_dept_aname FROM sys_department sd WHERE sd.sd_id = su.sd_id) AS dept")
			->from('info_document_control idc')
			->join('info_document_approval ida', 'ida.idc_id = idc.idc_id', 'left')
			->join('sys_users su', 'su.su_id = ida.su_id', 'left')
			->where('idc.idc_id', $idc_id)
			->where_in('ida.ida_status', [1, 9, 6])
			->group_by(['su.su_sign_path', 'su.su_firstname', 'su.su_lastname', 'ida.ida_status'])
			->order_by('dept', 'ASC')
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

		while (count($sign_group) < 8) {
			$sign_group[] = clone $default_sign;
		}

		if (empty($sign_group)) {
			$sign_group = [clone $default_sign, clone $default_sign, clone $default_sign];
		}

		$pdf->Ln(6);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Production Engineering', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Casting Engineering', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Gravity Die-Casting', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Research and Development', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);

		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[3]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[0]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[1]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[5]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 1, 'C');

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, $sign_group[3]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[0]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[1]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[5]->fullname, 'LBR', 1, 'C');

		$pdf->Ln(6);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Sales and Marketing', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Purchasing', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Supply Chain Management', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Project Control', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[6]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[4]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[7]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($sign_group[2]->su_sign_path, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 1, 'C');

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, $sign_group[6]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[4]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[7]->fullname, 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, $sign_group[2]->fullname, 'LBR', 1, 'C');

		$pdf->AddPage();
		$pdf->SetY(5);
		$image_path = 'assets/images/logos/tbkk logo form.png';
		$pdf->Image($image_path, 5, $pdf->GetY(), 20);
		$pdf->SetFont('THSarabunNew', 'B', 28);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'TEAM FEASIBILITY & RISK ANALYSIS');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);

		$pdf->SetX($pdf->GetX() + 60);
		$issue_date = 'Doc. No. :';
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(35.5, 5, $this->input->get('idc_running_no'), 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() + 135);
		$issue_date = 'Issue Date :';
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $this->input->get('idc_created_date'), 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Ref No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(10, 5, '', '', 0, 'C');
		$pdf->Cell(100, 5, $refer_doc, 'B', 0, 'L');
		$pdf->Cell(7, 5, '', '', 0, 'C');

		$pdf->SetX($pdf->GetX() + 15);
		$attn = 'Pag No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(36.5, 5, '2 / 2', 'B', 0, 'C');

		// Conclusion
		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 14);
		$pdf->Cell(1, 1, 'Score Information :');

		$pdf->Ln(4);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Weight', 1, 0, 'C', true);
		$pdf->Cell(15, 5, 'Score', 1, 0, 'C', true);
		$pdf->Cell(15, 5, 'Total', 1, 0, 'C', true);
		$pdf->Cell(80, 5, 'Consideration', 1, 0, 'C', true);
		$pdf->Cell(55, 5, 'Comment', 1, 0, 'C', true);
		$pdf->Cell(15, 5, 'P.I.C', 1, 1, 'C', true);

		for ($i = 0; $i < count($consern); $i++) {
			if ($consern[$i]->ifs_score == 0) {
				$consern[$i]->ifs_score = "";
				$consern[$i]->ifs_total = "-";
			}
			$count_title = strlen($consern[$i]->mci_name);

			if ($count_title > 66) {
				$title1 = substr($consern[$i]->mci_name, 0, 66);
				$title2 = substr($consern[$i]->mci_name, 66);
				$height_consern = 8;
				$height_consern_title = 4;
				$pdf->SetX($pdf->GetX() - 4);
				$pdf->SetFont('THSarabunNew', 'B', 10);
				$pdf->SetFillColor(255, 255, 255);
				$pdf->Cell(15, $height_consern, $consern[$i]->mcip_weight, 1, 0, 'C');
				$pdf->Cell(15, $height_consern, (int)$consern[$i]->ifs_score, 1, 0, 'C');
				$pdf->Cell(15, $height_consern, $consern[$i]->ifs_total, 1, 0, 'C');
				$pdf->Cell(80, $height_consern_title, $title1, 'LR', 0, 'L');
				$pdf->Cell(55, $height_consern, $consern[$i]->ifs_comment, 1, 0, 'C');
				$pdf->Cell(15, $height_consern, $consern[$i]->sd_dept_aname, 1, 1, 'C');

				$pdf->SetY($pdf->GetY() - 4);
				$pdf->SetX($pdf->GetX() + 41);
				$pdf->Cell(80, $height_consern_title, $title2, 'B', 1, 'L');
			} else {
				$title1 = $consern[$i]->mci_name;
				$height_consern_title = 8;

				$pdf->SetX($pdf->GetX() - 4);
				$pdf->SetFont('THSarabunNew', 'B', 10);
				$pdf->SetFillColor(255, 255, 255);
				$pdf->Cell(15, 8, $consern[$i]->mcip_weight, 1, 0, 'C');
				$pdf->Cell(15, 8, (int)$consern[$i]->ifs_score, 1, 0, 'C');
				$pdf->Cell(15, 8, $consern[$i]->ifs_total, 1, 0, 'C');
				$pdf->Cell(80, $height_consern_title, $title1, 'LBR', 0, 'L');
				$pdf->Cell(55, 8, $consern[$i]->ifs_comment, 1, 0, 'C');
				$pdf->Cell(15, 8, $consern[$i]->sd_dept_aname, 1, 1, 'C');
			}
		}

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 13);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 8, '', '', 0, 'C');
		$pdf->Cell(15, 8, 'Total', 1, 0, 'C', true);
		$pdf->Cell(15, 8, $sum_total, 1, 1, 'C', true);

		$pdf->SetY($pdf->GetY() - 4);
		$pdf->SetX($pdf->GetX() + 50);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->Cell(25, 4, 'Scoring Meaning :', '', 0, 'L');
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(87, 4, '5 = High potential , 4 = Potential , 3 = Potential with condition.', '', 1, 'L');
		$pdf->SetX($pdf->GetX() + 50);
		$pdf->Cell(25, 4, '', '', 0, 'L');
		$pdf->Cell(87, 4, "2 = Need study for scenarior , 1 = Can't meet requirement", '', 1, 'L');

		// Conclusion
		$pdf->Ln(2);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->Cell(1, 1, 'Conclusion :');

		$pdf->Ln(4);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 14);
		$pdf->SetFillColor(73, 255, 0);
		$pdf->Cell(35, 5, 'GREEN', 1, 0, 'C', true);
		$pdf->SetFillColor((int)$box_green);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(251, 255, 0);
		$pdf->Cell(35, 5, 'YELLOW', 1, 0, 'C', true);
		$pdf->SetFillColor((int)$box_yellow);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(255, 0, 0);
		$pdf->Cell(35, 5, 'RED', 1, 0, 'C', true);
		$pdf->SetFillColor((int)$box_red);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetY($pdf->GetY() - 15);
		$pdf->SetX($pdf->GetX() + 47);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(15, 5, 'Green', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(25, 5, 'Score: 90 - 100', 1, 0, 'L', true);
		$pdf->Cell(25, 5, 'Feasible & No Risk', 1, 0, 'L', true);
		$pdf->Cell(79, 5, 'Product can be produced as specified with no revisions.', 1, 1, 'L', true);

		$pdf->SetX($pdf->GetX() + 47);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(15, 5, 'Yellow', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(25, 5, 'Score: 70 - 89', 1, 0, 'L', true);
		$pdf->Cell(25, 5, 'Feasible & No Risk', 1, 0, 'L', true);
		$pdf->Cell(79, 5, 'Need recommended or Other requirment (See attached).', 1, 1, 'L', true);

		$pdf->SetX($pdf->GetX() + 47);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(15, 5, 'Red', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->Cell(25, 5, 'Score: < 69', 1, 0, 'L', true);
		$pdf->Cell(25, 5, 'Feasible & No Risk', 1, 0, 'L', true);
		$pdf->MultiCell(79, 5, "Design revision required to produce product within the specified requirements and have risk to produce product.", 1, 1, 'L', true);

		$pdf->Output();
	}
}

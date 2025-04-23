<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
require_once APPPATH . 'libraries/fpdf186/fpdf.php';
class ManageFeasibility extends CI_Controller
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
		$this->render_view('view_mngFeasibility');
	}

	public function createFeasibilityPDF()
	{
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
		$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew-Bold.php');

		$pdf->SetY(5);
		$image_path = 'assets/images/logos/logo-tbkk.png';
		$pdf->Image($image_path, 2, $pdf->GetY() - 8, 27);
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
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 13);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 6, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 6, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 6, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 6, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 6, 'Remark', 1, 1, 'C', true);

		$idc_id = $this->input->get('idc_id');
		$consern = $this->db->select('idi_item_no, idi_item_name, idi_model, idi_remark')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		for ($i = 0; $i < 10; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 11);
			$pdf->Cell(15, 5, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->idi_item_no) ? $consern[$i]->idi_item_no : '';
			$part_name = isset($consern[$i]->idi_item_name) ? $consern[$i]->idi_item_name : '';
			$model = isset($consern[$i]->idi_model) ? $consern[$i]->idi_model : '';
			$remark = isset($consern[$i]->idi_remark) ? $consern[$i]->idi_remark : '';

			$pdf->Cell(35, 5, $part_no, 1, 0, 'C');
			$pdf->Cell(55, 5, $part_name, 1, 0, 'C');
			$pdf->Cell(40, 5, $model, 1, 0, 'C');
			$pdf->Cell(50, 5, iconv('UTF-8', 'TIS-620//IGNORE', $remark), 1, 1, 'C'); // 35 Characters
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
		$pdf->Ln(8);
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

		////////////////////////// PAGE 2 ////////////////////////
		$pdf->AddPage();
		$pdf->SetY(5);
		$image_path = 'assets/images/logos/logo-tbkk.png';
		$pdf->Image($image_path, 2, $pdf->GetY() - 8, 27);
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
				$pdf->Cell(55, $height_consern, iconv('UTF-8', 'TIS-620//IGNORE', $consern[$i]->ifs_comment), 1, 0, 'C');
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
				$pdf->Cell(55, 8, iconv('UTF-8', 'TIS-620//IGNORE', $consern[$i]->ifs_comment), 1, 0, 'C');
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

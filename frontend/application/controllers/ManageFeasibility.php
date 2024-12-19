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
		$image_path = 'assets/images/logos/tbkk logo form.png';
		$pdf->Image($image_path, 5, $pdf->GetY(), 20);
		$pdf->SetFont('THSarabunNew', 'B', 28);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'TEAM FEASIBILITY & RISK ANALYSIS');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);

		$pdf->SetX($pdf->GetX() + 60);
		$issue_date = 'Doc. No. :';
		$ir_created_date = $this->input->get('ir_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(35.5, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() + 135);
		$issue_date = 'Issue Date :';
		$ir_created_date = $this->input->get('ir_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Ref No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(10, 5, '', '', 0, 'C');
		$pdf->Cell(100, 5, $ir_created_date, 'B', 0, 'C');
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
		$pdf->Cell(100, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Overseas';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		$pdf->SetX($pdf->GetX() + 14);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Domestic';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);

		$pdf->Ln(12);
		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Requirement :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetY($pdf->GetY() - 3);
		$pdf->SetX($pdf->GetX() + 19);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$newp = 'New Project';
		$width_newp = $pdf->GetStringWidth($newp) + 2;
		$pdf->Cell($width_newp, 5, $newp);

		$pdf->SetX($pdf->GetX() + 7.5);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$ecr = 'ECR / PCR';
		$width_ecr = $pdf->GetStringWidth($ecr) + 2;
		$pdf->Cell($width_ecr, 5, $ecr);

		$pdf->SetX($pdf->GetX() + 10);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$eop = 'EOP / Service Parts';
		$width_eop = $pdf->GetStringWidth($eop) + 2;
		$pdf->Cell($width_eop, 5, $eop);

		$pdf->SetX($pdf->GetX() + 12);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$gdc_dept = 'Other :';
		$width_pu_dept = $pdf->GetStringWidth($gdc_dept) + 2;
		$pdf->Cell($width_pu_dept, 5, $gdc_dept);
		$pdf->Cell(34, 5, '', 'B', 0, 'L');

		$ir_pro_life = $this->input->get('ir_pro_life');
		$ir_sop_tim = $this->input->get('ir_sop_tim');
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

		$pdf->Ln(4);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->Cell(1, 0, 'Feasibility Cosiderations :');

		$pdf->Ln(3);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$pdf->MultiCell(190, 4, "Our product quality planning team has considered the following questions. The drawing and/or \nspecifications provided have been used as a basis for analyzing the ability to meet  specified \nrequirements. All 'no' answers are supported with attached comments identifying our concerns and/or \nproposed changes to enable us to meet the specified requirements.", 0, 'L');

		// Score Total
		$pdf->SetY($pdf->GetY() - 18);
		$pdf->SetX($pdf->GetX() + 118);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(30, 16, 'Score Total :', 1, 0, 'C', true);
		$pdf->SetFont('THSarabunNew', 'B', 35);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(43, 16, '0', 1, 1, 'C', true);

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
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(251, 255, 0);
		$pdf->Cell(35, 5, 'YELLOW', 1, 0, 'C', true);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(255, 0, 0);
		$pdf->Cell(35, 5, 'RED', 1, 0, 'C', true);
		$pdf->SetFillColor(255, 255, 255);
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

		$pdf->Ln(6);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Production Engineering', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Casting Engineering', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Gravity Die-Casting', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Research and Development', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$image_sign = 'assets/images/uploaded/signature/51SST60_signature.png';
		$image_sign2 = 'assets/images/uploaded/signature/51SST60_signature2.png';
		$image_sign3 = 'assets/images/uploaded/signature/51SST60_signature3.png';
		$pdf->Cell(48.75, 20, $pdf->Image($image_sign, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, '', 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, $pdf->Image($image_sign2, $pdf->GetX(), $pdf->GetY(), 48.75, 20), 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, '', 'LR', 1, 'C');

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 1, 'C');

		$pdf->Ln(6);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(48.75, 4, 'Sales and Marketing', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Purchasing', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Supply Chain Management', 1, 0, 'C', true);
		$pdf->Cell(48.75, 4, 'Project Control', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 20, '', 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, '', 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, '', 'LR', 0, 'C');
		$pdf->Cell(48.75, 20, '', 'LR', 1, 'C');

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Name', 'LBR', 0, 'C');

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
		$ir_created_date = $this->input->get('ir_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(35.5, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() + 135);
		$issue_date = 'Issue Date :';
		$ir_created_date = $this->input->get('ir_created_date');
		$width_issue_date = $pdf->GetStringWidth($issue_date) + 2;
		$pdf->SetX($pdf->GetX() + 5);
		$pdf->Cell($width_issue_date, 5, $issue_date);
		$pdf->Cell(33, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Ref No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(10, 5, '', '', 0, 'C');
		$pdf->Cell(100, 5, $ir_created_date, 'B', 0, 'C');
		$pdf->Cell(7, 5, '', '', 0, 'C');

		$pdf->SetX($pdf->GetX() + 15);
		$attn = 'Pag No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(36.5, 5, '2 / 2', 'B', 1, 'C');

		// Conclusion
		$pdf->Ln(6);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 15);
		$pdf->Cell(1, 1, 'Score Information :');

		$pdf->Ln(6);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 5, 'Weight', 1, 0, 'C', true);
		$pdf->Cell(15, 5, 'Score', 1, 0, 'C', true);
		$pdf->Cell(15, 5, 'Total', 1, 0, 'C', true);
		$pdf->Cell(80, 5, 'Consideration', 1, 0, 'C', true);
		$pdf->Cell(45, 5, 'Comment', 1, 0, 'C', true);
		$pdf->Cell(25, 5, 'P.I.C', 1, 1, 'C', true);

		$consern = $this->db->select('mc.mc_weight, ifcp.ifcp_score, (ifcp.ifcp_score * mc.mc_weight) AS total, mc.mc_title, ifcp.ifcp_comment, GROUP_CONCAT( DISTINCT sd.sd_dept_cd ORDER BY sd.sd_dept_cd SEPARATOR ", " ) AS sd_names')
			->from('info_feasibility_consern_point ifcp')
			->join('info_feasibility inf', 'ifcp.if_id = inf.if_id', 'left')
			->join('mst_consideration mc', 'mc.mc_id = ifcp.mc_id', 'left')
			->join('mst_consideration_incharge mci', 'mci.mc_id = mc.mc_id', 'left')
			->join('sys_department sd', 'sd.sd_id = mci.sd_id', 'left')
			->where('inf.if_id', 4)
			->group_by('inf.if_id, ifcp.mc_id, mc.mc_weight, mc.mc_title, ifcp.ifcp_score, ifcp.ifcp_comment')
			->order_by('ifcp.mc_id', 'ASC')->get()->result();

		$sum_total = 0;

		for ($i = 0; $i < count($consern); $i++) {
			if ($consern[$i]->ifcp_score == 0) {
				$consern[$i]->ifcp_score = "";
				$consern[$i]->total = "-";
			}

			$sum_total += (int)$consern[$i]->total;
			$count_title = strlen($consern[$i]->mc_title);

			if ($count_title > 66) {
				$title1 = substr($consern[$i]->mc_title, 0, 66);
				$title2 = substr($consern[$i]->mc_title, 66);
				$height_consern = 8;
				$height_consern_title = 4;
				$pdf->SetX($pdf->GetX() - 4);
				$pdf->SetFont('THSarabunNew', 'B', 10);
				$pdf->SetFillColor(255, 255, 255);
				$pdf->Cell(15, $height_consern, $consern[$i]->mc_weight, 1, 0, 'C');
				$pdf->Cell(15, $height_consern, $consern[$i]->ifcp_score, 1, 0, 'C');
				$pdf->Cell(15, $height_consern, $consern[$i]->total, 1, 0, 'C');
				$pdf->Cell(80, $height_consern_title, $title1, 'LR', 0, 'L');
				$pdf->Cell(45, $height_consern, $consern[$i]->ifcp_comment, 1, 0, 'C');
				$pdf->Cell(25, $height_consern, $consern[$i]->sd_names, 1, 1, 'C');

				$pdf->SetY($pdf->GetY() - 4);
				$pdf->SetX($pdf->GetX() + 41);
				$pdf->Cell(80, $height_consern_title, $title2, 'B', 1, 'L');
			} else {
				$title1 = $consern[$i]->mc_title;
				$height_consern_title = 8;

				$pdf->SetX($pdf->GetX() - 4);
				$pdf->SetFont('THSarabunNew', 'B', 10);
				$pdf->SetFillColor(255, 255, 255);
				$pdf->Cell(15, 8, $consern[$i]->mc_weight, 1, 0, 'C');
				$pdf->Cell(15, 8, $consern[$i]->ifcp_score, 1, 0, 'C');
				$pdf->Cell(15, 8, $consern[$i]->total, 1, 0, 'C');
				$pdf->Cell(80, $height_consern_title, $title1, 'LBR', 0, 'L');
				$pdf->Cell(45, 8, $consern[$i]->ifcp_comment, 1, 0, 'C');
				$pdf->Cell(25, 8, $consern[$i]->sd_names, 1, 1, 'C');
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
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(251, 255, 0);
		$pdf->Cell(35, 5, 'YELLOW', 1, 0, 'C', true);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(8, 5, '', 1, 1, 'C', true);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFillColor(255, 0, 0);
		$pdf->Cell(35, 5, 'RED', 1, 0, 'C', true);
		$pdf->SetFillColor(255, 255, 255);
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
require_once APPPATH . 'libraries/fpdf186/fpdf.php';
class ManageNbc extends CI_Controller
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
		$this->render_view('view_mngNbc');
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
		$attn = 'To :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(40, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->SetX($pdf->GetX() + 12);
		$attn = 'From :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(60, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->SetX($pdf->GetX() + 15);
		$attn = 'Ref. No. :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(36.5, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->Ln(8);
		$pdf->SetX($pdf->GetX() - 5);
		$attn = 'Attn :';
		$width_attn = $pdf->GetStringWidth($attn) + 2;
		$pdf->Cell($width_attn, 5, $attn);
		$pdf->Cell(37.5, 5, $ir_created_date, 'B', 0, 'C');

		$pdf->Ln(10);
		$pdf->SetX($pdf->GetX() - 5);
		$subj = 'Enclosures :';
		$width_subj = $pdf->GetStringWidth($subj) + 2;
		$pdf->Cell($width_subj, 0, $subj);

		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetY($pdf->GetY() - 2.5);
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
		$pdf->Cell(55, 5, '', 'B', 0, 'L');

		$pdf->Ln(10);
		$ir_pro_life = $this->input->get('ir_pro_life');
		$ir_sop_tim = $this->input->get('ir_sop_tim');
		$pdf->SetX($pdf->GetX() - 5);
		$note = 'Please kindly investigate part with customer requirement condition in details as below.';
		$width_note = $pdf->GetStringWidth($note) + 2;
		$pdf->Cell($width_note, 0, $note);

		// Table Part No.
		$pdf->Ln(4);
		// $pdf->SetLineWidth(1.3);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 4, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 4, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 4, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 4, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 4, 'Remark', 1, 1, 'C', true);

		// $ir_id = $this->input->get('ir_id');
		// $consern = $this->db->select('irpn.irpn_part_no, irpn.irpn_part_name, irpn.irpn_model, irpn.irpn_remark')
		// 	->from('info_rfq_part_no irpn')
		// 	->join('info_rfq ir', 'ir.ir_id = irpn.ir_id', 'left')
		// 	->where('irpn.ir_id', $ir_id)
		// 	->where('irpn.irpn_status', 1)
		// 	->order_by('irpn.irpn_id', 'ASC')->get()->result();

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
		$pdf->Ln(1);
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
		$pdf->Cell(60, 4, '', 'B', 0, 'L');
		$pdf->Cell(119, 2, '', 'R', 0, 'L');

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
		$image_sign = 'assets/images/uploaded/signature/51SST60_signature.png';
		$image_sign2 = 'assets/images/uploaded/signature/51SST60_signature2.png';
		$image_sign3 = 'assets/images/uploaded/signature/51SST60_signature3.png';
		$pdf->Cell(48.75, 15, $pdf->Image($image_sign, $pdf->GetX(), $pdf->GetY(), 48.75, 17), 'LR', 0, 'C');
		$pdf->Cell(48.75, 15, $pdf->Image($image_sign3, $pdf->GetX(), $pdf->GetY(), 48.75, 17), 'LR', 0, 'C');
		$pdf->Cell(48.75, 15, $pdf->Image($image_sign2, $pdf->GetX(), $pdf->GetY(), 48.75, 17), 'LR', 0, 'C');
		$pdf->Cell(48.75, 15, '', 'LR', 0, 'C');

		$pdf->Ln();
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, 'Pimnapat Bualuang', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Kyoko Saijo', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Sirote Sukhiranwat', 'LBR', 0, 'C');
		$pdf->Cell(48.75, 5, 'Horokoshi Yuji', 'LBR', 0, 'C');

		$pdf->Ln(7);
		$pdf->SetX($pdf->GetX() - 4);
		$pdf->SetFont('THSarabunNew', 'B', 10);
		$replysheet = 'Reply Sheet :';
		$pdf->Cell(20, 6, $replysheet, 0, 0);
		$replydept = 'R&D Dept. confirm project\'s possibility result :';
		$pdf->Cell(5, 6, $replydept, 0, 0);

		$pdf->SetY($pdf->GetY() + 0.5);
		$pdf->SetX($pdf->GetX() - 17);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetX($pdf->GetX() - 115);
		$pdf->Cell(9, 5, '', 1, 0, 'C', true);
		$drawing = 'OK';
		$pdf->Cell(15, 5, $drawing);

		$pdf->SetFillColor(255, 255, 255);
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
		$pdf->Cell(195, 20, '', 'LBR', 1, 'L',);

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

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, "CE/GDC", 0, 0, 'C');
		$pdf->Cell(48.75, 5, 'Praphan Chuesing', 'LB', 0, 'C',);
		$pdf->Cell(48.75, 5, 'Chawalit Supotjanard', 'LBR', 0, 'C',);
		$pdf->Cell(48.75, 5, 'Chawalit Supotjanard', 'BR', 1, 'C',);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Sety($pdf->GetY() - 20);
		$pdf->Cell(45, 5, "", 0, 0, 'C');
		$pdf->Cell(48.75, 5, $pdf->Image($image_sign, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 0, 'L');
		$pdf->Cell(48.75, 5, $pdf->Image($image_sign2, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 0, 'L');
		$pdf->Cell(48.75, 5, $pdf->Image($image_sign3, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 1, 'L');
		
		$pdf->Output();
	}
}

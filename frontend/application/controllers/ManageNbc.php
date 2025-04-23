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

	public function UploadFile()
	{
		$empId = $this->session->userdata('sessUsr');

		if (!empty($_FILES['inaf_file']['name'])) {
			$config['upload_path'] = 'assets/images/uploaded/NBC/' . $empId . '/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|docx|xlsx';
			$fileName = preg_replace('/[^A-Za-z0-9.\-_]/', '', $_FILES['inaf_file']['name']);
			$fileName = str_replace(' ', '', $fileName);

			$config['file_name'] = date('Y-m-d') . '_' . $fileName;

			if (empty($empId)) {
				echo json_encode([
					'status' => 'error',
					'message' => 'empId is required',
				]);
				return;
			}

			if (!is_dir($config['upload_path'])) {
				if (!mkdir($config['upload_path'], 0777, true)) {
					echo json_encode([
						'status' => 'error',
						'message' => 'Failed to create directory: ' . $config['upload_path'],
					]);
					return;
				}
			}
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('inaf_file')) {
				$uploadData = $this->upload->data();
				$fileName = $uploadData['file_name'];
				$filePath =  $config['upload_path'] . $fileName;
				$physicalPath =  FCPATH . $config['upload_path'] . $fileName;

				$data = [
					'idc_id' => $this->input->get('idc_id'),
					'inaf_file_path' => $filePath,
					'inaf_physical_path' => $physicalPath,
					'inaf_created_date' => date('Y-m-d H:i:s'),
					'inaf_created_by' => $empId,
					'inaf_updated_date' => date('Y-m-d H:i:s'),
					'inaf_updated_by' => $empId,
				];

				if ($this->db->insert('info_nbc_attach_file', $data)) {
					echo json_encode([
						'status' => 'success',
						'message' => 'Data inserted successfully.',
						'file_path' => $filePath,
						'file_name' => $fileName,
						'inaf_physical_path' => $physicalPath,
						'insert_id' => $this->db->insert_id(),
					]);
				} else {
					echo json_encode([
						'status' => 'error',
						'message' => 'Failed to insert data.',
					]);
				}
			} else {
				echo json_encode([
					'status' => 'error',
					'message' => $this->upload->display_errors(),
				]);
			}
		}
	}
	public function RemoveFile()
	{
		$filePath = $this->input->post('filePath');
		$inaf_id = $this->input->post('inaf_id');
		$idc_id = $this->input->post('idc_id');
		if (!empty($filePath)) {
			$absolutePath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $filePath);

			if (file_exists($absolutePath)) {
				if (unlink($absolutePath)) {
					if (
						$this->db->set('inaf_status', 0)
						->where('idc_id', $idc_id)
						->update('info_nbc_attach_file')
						&&
						$this->db->set('idc_file_path', NULL)
						->set('idc_physical_path', NULL)
						->set('idc_updated_date', date('Y-m-d H:i:s'))
						->set('idc_updated_by', $this->session->userdata('sessUsr'))
						->where('idc_id', $idc_id)
						->update('info_document_control')
					) {
						echo json_encode([
							'status' => 'success',
							'message' => 'File removed and database updated successfully.',
							'file_path' => $filePath,
						]);
					} else {
						echo json_encode([
							'status' => 'error',
							'message' => 'Failed to update the database.',
							'file_path' => $filePath,
						]);
					}
				} else {
					echo json_encode([
						'status' => 'error',
						'message' => 'Failed to delete the file.',
						'file_path' => $filePath,
					]);
				}
			} else {
				echo json_encode([
					'status' => 'error',
					'message' => 'File does not exist.',
					'file_path' => $filePath,
				]);
			}
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'File path is empty.',
			]);
		}
	}

	public function createNbcPDF()
	{
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
		$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew-Bold.php');

		$pdf->SetY(5);
		$image_path = 'assets/images/logos/logo-tbkk.png';
		$pdf->Image($image_path, 2, $pdf->GetY() - 8, 27);
		$pdf->SetFont('THSarabunNew', 'B', 25);
		$pdf->SetX(28);
		$pdf->Cell(40, 15, 'Confirmation Sheet for New Business');

		$pdf->SetFont('THSarabunNew', 'B', 12);
		$pdf->SetX(85);

		$pdf->SetX($pdf->GetX() + 60);
		$issue_date = 'Doc. No. :';
		$run_no = $this->input->get('idc_running_no');
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
		$pdf->SetFont('THSarabunNew', 'B', 13);
		$pdf->SetFillColor(235, 235, 235);
		$pdf->Cell(15, 4.5, 'No', 1, 0, 'C', true);
		$pdf->Cell(35, 4.5, 'PART NUMBER', 1, 0, 'C', true);
		$pdf->Cell(55, 4.5, 'PART NAME', 1, 0, 'C', true);
		$pdf->Cell(40, 4.5, 'MODEL', 1, 0, 'C', true);
		$pdf->Cell(50, 4.5, 'Remark', 1, 1, 'C', true);

		$idc_id = $this->input->get('idc_id');
		$consern = $this->db->select('idi_item_no, idi_item_name, idi_model, idi_remark')
			->from('info_document_item')
			->where('idc_id', $idc_id)
			->where('idi_status', 1)
			->order_by('idi_id', 'ASC')->get()->result();

		for ($i = 0; $i < 10; $i++) {
			$pdf->SetX($pdf->GetX() - 4);
			$pdf->SetFont('THSarabunNew', 'B', 12);
			$pdf->Cell(15, 4.5, $i + 1, 1, 0, "C");

			$part_no = isset($consern[$i]->idi_item_no) ? $consern[$i]->idi_item_no : '';
			$part_name = isset($consern[$i]->idi_item_name) ? $consern[$i]->idi_item_name : '';
			$model = isset($consern[$i]->idi_model) ? $consern[$i]->idi_model : '';
			$remark = isset($consern[$i]->idi_remark) ? $consern[$i]->idi_remark : '';

			$pdf->Cell(35, 4.5, $part_no, 1, 0, 'C');
			$pdf->Cell(55, 4.5, $part_name, 1, 0, 'C');
			$pdf->Cell(40, 4.5, $model, 1, 0, 'C');
			$pdf->Cell(50, 4.5, iconv('UTF-8', 'TIS-620//IGNORE', $remark), 1, 1, 'C'); // 35 Characters
		}

		// Table Volume
		$pdf->Ln(1);
		$pdf->SetX($pdf->GetX() - 5);
		$pdf->SetFont('THSarabunNew', 'B', 11);
		$val = 'Volume Information :';
		$width_val = $pdf->GetStringWidth($val);
		$pdf->Cell($width_val, 5, $val);

		$pdf->Ln(5);
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
		$headerHeight = 4.5;

		$pdf->SetFont('THSarabunNew', 'B', 13);
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
			$pdf->SetFont('THSarabunNew', 'B', 11);
			$pdf->Cell(15, 4.5, $i + 1, 1, 0, "C");

			$part_no = isset($itemInfo[$i]->idi_item_no) ? $itemInfo[$i]->idi_item_no : '';
			$idi_id = isset($itemInfo[$i]->idi_id) ? $itemInfo[$i]->idi_id : 0;
			$pdf->Cell(35, 4.5, $part_no, 1, 0, 'C');

			$idv_qty = $this->db->select('idv_qty')
				->from('info_document_volume')
				->where('idi_id', $idi_id)
				->where('idv_status', 1)
				->order_by('idv_id', 'ASC')
				->get()
				->result();
			for ($q = 0; $q < 10; $q++) {
				$label = isset($idv_qty[$q]) ? $idv_qty[$q]->idv_qty : ''; // ต้องใช้ ->idv_qty
				$pdf->Cell(14.5, 4.5, $label, 1, 0, 'C');
			}
			$pdf->Ln();
		}

		// Table Note
		$pdf->Ln(3);
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
		$pdf->Cell(195, 15, iconv('UTF-8', 'TIS-620//IGNORE', $idc_note2), 'LBR', 1, 'L',);

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

		$sign_group = $this->db->select("
				CASE WHEN ida.ida_status = 9 THEN su.su_sign_path ELSE 'null' END AS su_sign_path,
				COALESCE(CONCAT(su.su_firstname, ' ', su.su_lastname), 'null') AS fullname")
			->from('info_document_control idc')
			->join('info_document_approval ida', 'ida.idc_id = idc.idc_id', 'left')
			->join('sys_users su', 'su.su_id = ida.su_id', 'left')
			->where('idc.idc_id', $idc_id)
			->where_in('ida.ida_status', [1, 9, 6])
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

		while (count($sign_group) < 2) {
			$sign_group[] = clone $default_sign;
		}

		if (empty($sign_group)) {
			$sign_group = [clone $default_sign, clone $default_sign, clone $default_sign];
		}

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, '', 0, 0, 'L');
		$pdf->Cell(48.75, 5, '', 'L', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'LR', 0, 'L',);
		$pdf->Cell(48.75, 5, '', 'R', 1, 'L',);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Cell(48.75, 5, "CE/GDC", 0, 0, 'C');
		$pdf->Cell(48.75, 5, $sign1[0]->fullname, 'LB', 0, 'C',);
		$pdf->Cell(48.75, 5, $sign_group[0]->fullname, 'LBR', 0, 'C',);
		$pdf->Cell(48.75, 5, $sign_group[1]->fullname, 'BR', 1, 'C',);

		$pdf->SetX($pdf->GetX() - 4);
		$pdf->Sety($pdf->GetY() - 23);
		$pdf->Cell(45, 5, "", 0, 0, 'C');

		$pdf->Cell(48.75, 5, $pdf->Image($sign1[0]->su_sign_path, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 0, 'L');
		$pdf->Cell(48.75, 5, $pdf->Image($sign_group[0]->su_sign_path, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 0, 'L');
		$pdf->Cell(48.75, 5, $pdf->Image($sign_group[1]->su_sign_path, $pdf->GetX(), $pdf->GetY() + 1.5, 48.75, 15), '', 1, 'L');

		$pdf->Output();
	}
}

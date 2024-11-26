<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';

class FeasibilityForm extends CI_Controller
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
		$this->render_view('view_formFeasibility');
	}
	public function addFeasibility()
	{
		$this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		$this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		$this->render_view('view_makeFeasibility');
	}
	public function editFeasibility()
	{
		$this->another_js = "<script src='" . base_url() . "assets/libs/datatables.net/js/jquery.dataTables.min.js'></script>";
		$this->another_js .= "<script src='" . base_url() . "assets/js/datatable/datatable-basic.init.js'></script>";
		// $this->another_js .= "<script type='module' src='" . base_url() . "assets/js/feasibility/feasibilityPDF.js'></script>";
		$this->render_view('view_editFeasibility');
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
	public function createPDF()
	{
		$if_id = $this->input->get('if_id');
		$if_doc_no = $this->input->get('if_doc_no');
		$create_date = $this->input->get('create_date');
		$if_customer = $this->input->get('if_customer');
		$if_import_tran = $this->input->get('if_import_tran');
		$mrt_id = $this->input->get('mrt_id');

		$mrt_name = $this->db->select('mrt_name')->from('mst_requirement_type')->where('mrt_id', $mrt_id)->get()->row()->mrt_name;

		$body_consern = '';
		$sum_weight = 0;
		$sum_consern = 0;
		$total_consern = '';
		$box_green = '';
		$box_yellow = '';
		$box_red = '';

		if ($if_import_tran == 1) {
			$bg_import_tran_1 = "background-color: black;";
			$bg_import_tran_2 = "";
		} else {
			$bg_import_tran_1 = "";
			$bg_import_tran_2 = "background-color: black;";
		}

		$consern = $this->db->select('inf.if_id, ifcp.mc_id, mc.mc_weight, mc.mc_title, ifcp.ifcp_score, ifcp.ifcp_comment, GROUP_CONCAT(DISTINCT sd.sd_dept_name ORDER BY sd.sd_dept_name SEPARATOR ", ") AS sd_names')
			->from('info_feasibility inf')
			->join('info_feasibility_consern_point ifcp', 'inf.if_id = ifcp.if_id', 'left')
			->join('mst_consideration mc', 'mc.mc_id = ifcp.mc_id', 'left')
			->join('mst_consideration_incharge mci', 'mci.mc_id = mc.mc_id', 'left')
			->join('sys_department sd', 'sd.sd_id = mci.sd_id', 'left')
			->where('inf.if_id', $if_id)
			->group_by('inf.if_id, ifcp.mc_id, mc.mc_weight, mc.mc_title, ifcp.ifcp_score, ifcp.ifcp_comment')
			->order_by('ifcp.mc_id', 'ASC')->get()->result();

		for ($i = 0; $i < count($consern); $i++) {
			if ($consern[$i]->ifcp_score == "") {
				$consern[$i]->ifcp_score = 0;
			}

			$sum_weight += (float)$consern[$i]->mc_weight;
			$sum_consern += (float)$consern[$i]->ifcp_score;

			// str_replace(', ', ",<br>", $consern[$i]->sd_names)
			$body_consern .= '<tr>
					  	<td style="width: auto; text-align: center; font-weight: normal; font-size: 15px;">' . $consern[$i]->mc_weight . '</td>
					  	<td style="width: auto; text-align: center; font-weight: normal; font-size: 15px;">' . $consern[$i]->ifcp_score . '</td>
					  	<td style="width: auto; text-align: center; font-weight: normal; font-size: 15px;">' . $consern[$i]->mc_weight * $consern[$i]->ifcp_score . '</td>
					  	<td style="text-wrap: break-word; text-align: center; font-weight: normal; font-size: 15px;">' . $consern[$i]->mc_title . '</td>
						<td style="text-wrap: break-word; text-align: center; font-weight: normal; font-size: 15px;">' . $consern[$i]->ifcp_comment . '</td>
						<td style="text-wrap: break-word; text-align: center; font-weight: normal; font-size: 15px;">' . $consern[$i]->sd_names . '</td>
					  </tr>';
		}

		$total_consern = $sum_weight * $sum_consern;
		if ($total_consern > 90 && $total_consern < 100) {
			$box_green = "&nbsp;&nbsp;&nbsp;&nbsp;&#10003;&nbsp;&nbsp;&nbsp;&nbsp;";
			$box_yellow = "";
			$box_red = "";
		} else if ($total_consern >= 70 && $total_consern < 90) {
			$box_green = "";
			$box_yellow = "&nbsp;&nbsp;&nbsp;&nbsp;&#10003;&nbsp;&nbsp;&nbsp;&nbsp;";
			$box_red = "";
		} else if ($total_consern < 70) {
			$box_green = "";
			$box_yellow = "";
			$box_red = "&nbsp;&nbsp;&nbsp;&nbsp;&#10003;&nbsp;&nbsp;&nbsp;&nbsp;";
		}

		$mpdf = new \Mpdf\Mpdf([
			'format' => [210, 297],
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_top' => 5,
			'margin_bottom' => 5,
			'fontDir' => array_merge((new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'], [
				__DIR__ . '/../../vendor/mpdf/mpdf/ttfonts',
			]),
			'fontdata' => (new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'] + [
				'thsarabunnew' => [
					'R' => 'THSarabunNew.ttf',
					'B' => 'NotoSansJP-Black.ttf',
				]
			],
			'default_font' => 'thsarabunnew'
		]);
		// .doc
		// border: 1px solid black;
		// padding: 10px;

		$html = '
				<style>
					body { 
						font-size: 10px; 
						font-family: "Noto Sans JP"; /* ใช้ฟอนต์ที่กำหนด */
					}
					table { 
						width: 100%; 
						border-collapse: collapse; 
						/* เส้นกรอบรอบตาราง */
					}
					th, td { 
						text-align: left; 
						/* เส้นกรอบรอบเซลล์ */
					}
					.doc {
						display: flex;
						flex-direction: column;
					}

					.doc > div {
						flex: 1;
						text-align: center;
					}

					#table-consern {
						width: 100%;
						border-collapse: collapse;
					}
					
					#table-consern th, 
					#table-consern td {
						border: 1px solid black;
						padding: 3px; /* เพื่อให้ช่องภายในกว้างขึ้น */
					}

					#table-consern tr {
						border: 1px solid black;
					}

					#table-conclusion {
						width: 100%;
						border-collapse: collapse;
					}

					#table-conclusion th,
					#table-conclusion td {
						padding: 3px;
					}

				</style>
    
				<div class="doc">
					<div>
							<img src="assets/images/logos/tbkk logo form.png" width="60px" style="float: left;">
							<h4 style="font-size: 20px; text-align: center">
								TEAM FEASIBILITY & RISK ANALYSIS
							</h4>
					</div>

					<table style="width: 100%;">
						<thead>
							<tr>
								<th colspan="2">
									<strong style="font-size: 11px;"> Ref.&nbsp; </strong> <span style="font-size: 18px; font-weight: normal;">' . $if_doc_no . '</span>
								</th>
								<th style="text-align: right;" colspan="18">
									<strong style="font-size: 11px;"> Date:&nbsp; </strong> <span style="font-size: 18px; font-weight: normal;">' . substr($create_date, 0, 10) . '</span>
								</th>
							</tr>

							<tr>
								<th colspan="2">
									<strong style="font-size: 11px;"> Customer:&nbsp; </strong> <span style="font-size: 18px; font-weight: normal;">' . $if_customer . '</span>
								</th>
								
								<th style="font-size: 10pt; text-align: right;" colspan="8">
									<span style="width: 20px; height: 20px; display: inline-block; border: 2px solid black;' . $bg_import_tran_1 . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<span style="font-size: 18px; font-weight: normal;">Oversea</span>
								</th>

								<th style="font-size: 10pt; text-align: right;" colspan="5">
									<span style="width: 20px; height: 20px; display: inline-block; border: 2px solid black; ' . $bg_import_tran_2 . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<span style="font-size: 18px; font-weight: normal;">Domestic</span>
								</th>
								<th colspan="5"></th>
							</tr>

							<tr>
								<th colspan="2">
									<strong style="font-size: 11px;"> Part No.&nbsp; </strong> <span style="font-size: 18px; font-weight: normal;">' . $if_customer . '</span>
								</th>
								<th style="font-size: 16pt; text-align: right;" colspan="18">
									<strong style="font-size: 11px;"> Part Name:&nbsp; </strong> <span style="font-size: 18px; font-weight: normal;">' . substr($create_date, 0, 10) . '</span>
								</th>
							</tr>

							<tr>
								<th colspan="20">
									<strong style="font-size: 11px;"> Requirement:&nbsp;</strong>
									<span style="font-size: 18px; font-weight: normal;">' . $mrt_name . '</span>
								</th>

							</tr>

							<tr>
                                <th colspan="20">
									<strong style="font-size: 11px;">Feasibility Cosiderations :&nbsp;</strong>
								</th>
                            </tr>
						
                            <tr>
                                <th style="font-size: 16px; font-weight: normal;" colspan="20"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Our product quality planning team has considered the following questions, The drawing and/or specifications provided have been used as a basis for analyzing the ability to meet all specified requirements. All "no" answers are supported with attached comments identifying our concerns and/or proposed changes to enable us to meet the specified requirements.</th>
                            </tr>
						</thead>

						<tbody>
							<tr>
								<td colspan="20">
									<table id="table-consern">
										<tr style="font-weight: bold; font-size: 10px;">
											<th style="width: auto; text-align: center;" colspan="1">Weight</th>
											<th style="width: auto; text-align: center;" colspan="1">Score</th>
											<th style="width: auto; text-align: center;" colspan="1">Total</th>
											<th style="text-align: center;">CONSIDERATION</th>
											<th style="text-align: center;">Comment</th>
											<th style="text-align: center;" colspan="1">P.I.C</th>
										</tr>
										' . $body_consern . '
										<tr id="total_consern">
											<td style="font-weight: bold; font-size: 10px; width: auto; text-align: center; background-color: Yellow;" colspan="2">Total</td>
											<td style="font-weight: bold; font-size: 10px; width: auto; text-align: center; background-color: Yellow;" colspan="1">' . $total_consern . '</td>
										</tr>
									</table>
	
								</td>
							</tr>

							<tr>
								<td style="font-weight: bold; font-size: 11px;" colspan="20">Scoring meaning :</td>
							</tr>
							<tr>
								<td style="text-wrap: break-word; font-weight: normal; font-size: 16px; text-align: center" colspan="19">5 = High potential , 4 = Potential , 3 = Potential with condition.</td>
								<td></td>
							</tr>
							<tr>
								<td style="text-wrap: break-word; font-weight: normal; font-size: 16px; text-align: center" colspan="19">2 = Need study for scenarior , 1 = Cant meet requirement.</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="20" style="font-weight: bold; font-size: 11px;">Conclusion</td>
							</tr>
							<tr>
								<td colspan="20" style="font-size: 2px;">&nbsp;</td>
							</tr>

							<tr>
								<td colspan="20">
									<table id="table-conclusion">
										<tr style="font-weight: bold; font-size: 13px;">
											<th colspan="1"></th>
											<th style="width: auto; text-align: center; border: 1px solid #000; background-color: LightGreen" colspan="1">Green</th>
											<th style="width: auto; text-align: center; border: 1px solid #000;" colspan="1">' . $box_green . '</th>
											<th style="text-wrap: break-word; font-weight: normal; font-size: 15px; text-align: left" colspan="17"> &nbsp;Feasible&No Risk (Score = 90-100 ) Product can be produced as specified with no revisions.</th>
										</tr>
										<tr style="font-weight: bold; font-size: 13px;">
											<th colspan="1"></th>
											<th style="width: auto; text-align: center; border: 1px solid #000; background-color: Yellow" colspan="1">Yellow</th>
											<th style="width: auto; text-align: center; border: 1px solid #000;" colspan="1">' . $box_yellow . '</th>
											<th style="text-wrap: break-word; font-weight: normal; font-size: 15px; text-align: left" colspan="17"> &nbsp;Yellow = Feasible&NoRisk (Score 70-89) Need recommended or Other requirment  (see attached).</th>
										</tr>
										<tr style="font-weight: bold; font-size: 13px;">
											<th colspan="1"></th>
											<th style="width: auto; text-align: center; border: 1px solid #000; background-color: Red" colspan="1">Red</th>
											<th style="width: auto; text-align: center; border: 1px solid #000;" colspan="1">' . $box_red . '</th>
											<th style="text-wrap: break-word; font-weight: normal; font-size: 15px; text-align: left" colspan="17"> &nbsp;Red = Not Feasible&Risk (Score < 69) Design revision required to produce product within the specified</th>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td style="text-wrap: break-word; font-weight: normal; font-size: 15px; text-align: center" colspan="17">&nbsp;requirements and have risk to produce product.</td>
										</tr>
									</table>
								</td>
							</tr>

							<tr>
								<td colspan="20" style="font-weight: bold; font-size: 11px;">Sign-Off</td>
							</tr>

							<tr>
								<td colspan="20">
									<table id="table-conclusion">
										<tr>
											<th style="text-align: center;" colspan="10"><img src="\assets\images\uploaded\signature\51SST60_signature.png" width="130px" height="60"> <br> Tanasid Phakdeechot</th>

											<th style="text-align: center;" colspan="10"><img src="\assets\images\uploaded\signature\51SST60_signature.png" width="130px" height="60"> <br> Tanasid Phakdeechot</th>
										</tr>

										<tr>
											<th style="text-align: center;" colspan="10"><img src="\assets\images\uploaded\signature\51SST60_signature.png" width="130px" height="60"> <br> Tanasid Phakdeechot</th>

											<th style="text-align: center;" colspan="10"><img src="\assets\images\uploaded\signature\51SST60_signature.png" width="130px" height="60"> <br> Tanasid Phakdeechot</th>
										</tr>

										<tr>
											<th style="text-align: center;" colspan="10"><img src="\assets\images\uploaded\signature\51SST60_signature.png" width="130px" height="60"> <br> Tanasid Phakdeechot</th>

											<th style="text-align: center;" colspan="10"><img src="\assets\images\uploaded\signature\51SST60_signature.png" width="130px" height="60"> <br> Tanasid Phakdeechot</th>
										</tr>
										
									</table>
								</td>
							</tr>

						</tbody>
								
					</table>
				</div>

				';

		$mpdf->WriteHTML($html);

		// สร้างไฟล์ PDF
		$mpdf->Output('document.pdf', \Mpdf\Output\Destination::INLINE);
	}
	
}

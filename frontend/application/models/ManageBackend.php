<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ManageBackend extends CI_Model{
    private $theme;
    private $email_config;
	public function __construct(){
		parent::__construct();
		// $this->load->database();
		$this->email_config = $this->config->item('email_config');

		date_default_timezone_set("Asia/Bangkok");
	}

    public function chkLogin(){
        if($this->session->userdata('loggedIn')=='OK'){
            redirect('Dashboard');
			return false;
        }else{ return true; }
    }
    public function chkLogout(){
        if($this->session->userdata('loggedIn')!='OK'){
            redirect('welcome');
			return false;
        }else{ return true; }
    }
    public function log_login($id){
        $data = array(
            "su_id"=> (int)$id,
            "la_login_date"=>date("Y-m-d H:i:s")
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_BASE_URL."log/login");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        // echo "<script>console.log('Debug Objects: " . $response . "' );</script>";
        curl_close($ch);
        return json_decode($response, true);
    }
    public function log_logout($id){
        $data = array(
            "su_id"=> (int)$id,
            "la_logout_date"=>date("Y-m-d H:i:s")
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_BASE_URL."log/logout");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        // echo "<script>console.log('Debug Objects: " . $response . "' );</script>";
        curl_close($ch);
        return json_decode($response, true);
    }
// ------------- Web Utilities --------------
    public function menu_array($id,$link){
        $menu_list = []; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_BASE_URL."".$link.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if(curl_errno($ch)){
            echo 'Curl error: ' . curl_error($ch);
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode === 200) {
            $menu_list = json_decode($response, true);
        } else {
            echo "<script>console.log('Debug Objects: " . $httpCode . "' );</script>";
        }
        curl_close($ch);
        return $menu_list;
    }
    public function createFileImage($fileupload, $tempFileLogo,$user){
        $timestamp = date('YmdHis');
        // $fileName = iconv('UTF-8', 'TIS-620', $fileupload);
        $arrStrLogo = explode(".", $fileupload);
        $fileNameLogo = $timestamp . "_" . $arrStrLogo[0] . "." . $arrStrLogo[1];
        $new_img_name = $fileNameLogo;
        // $fileNameLogo = preg_replace('/  \s+/', '_', $fileNameLogo);
        $targetPathLogo = 'assets/images/uploaded/' . $user . '/';
        $targetFileLogo = $targetPathLogo . $fileNameLogo;
        //============================Checks whether a file or directory exists.============================//
        $tmpPath  = 'assets/images/uploaded/';
        $tmpPath1 = 'assets/images/uploaded/' . $user . '/';
        $tmpPath2 = $targetPathLogo;
        $this->createFolder($tmpPath, $tmpPath1, $tmpPath2,$user);
        //============================Checks whether a file or directory exists.============================//
        $saved = $this->saveUploadedFile($targetFileLogo, $new_img_name);
        copy($tempFileLogo, $targetFileLogo);
        return $saved;
        exit;
    }
    public function createFolder($tmpPath, $tmpPath1, $tmpPath2,$user){
        if (!file_exists($tmpPath1)) {
            mkdir($tmpPath . '\\' . $user . '\\', 0755, true);
        } elseif (!file_exists($tmpPath2)) {
            mkdir($tmpPath2 . '\\', 0755, true);
        }
    }
    function saveUploadedFile($targetFileLogo, $new_img_name){
        $data = array(
            'ifcp_file_name' => $new_img_name,
            'ifcp_file_path' => $targetFileLogo
        );
        return $data;
    }
// ------------- Selection ---------------
    public function list_option($link){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_BASE_URL."".$link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode === 200) {
            $menu_list = json_decode($response, true);
            echo json_encode($menu_list);
        } else {
            echo "<script>console.log('Debug Objects: " . $httpCode . "' );</script>";
        }
        curl_close($ch);
        return $menu_list;
    }
// ------------- email -------------------
	public function sent_pswToMail($data){
		$config = $this->email_config;
		$this->email->initialize($config);
		$this->email->from("64309010024@chontech.ac.th",'SYSTEM SERVICE');
		// $this->email->from("admin_pcsystem@tbkk.co.th",'SysDesk Online');
		$this->email->to($data['email']);
		$this->email->subject("Your password from CRM!");
		$this->email->message($this->load->view('view_emailForgot.php',$data,true));
		if($this->email->send()){
			return true;
		}else{
			show_error($this->email->print_debugger());
		}
	}
}
?>
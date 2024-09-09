<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class FileControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->ManageBackend->chkLogout();
    }
    public function uploadFile()
    {
        $doc_no = $this->input->post('doc_no');
        $emp_code = $this->session->userdata('sessUsr');
        $fileQty = count($_FILES['ir_file']['name']);
        $timestamp  = date('Y-m-d');
        $filePaths = [];
        $uploadPath = 'assets/images/uploaded/rfq_file/' . $emp_code;

        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0777, true)) {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to create folder',
                );
                echo json_encode($response);
                exit();
            } else {
                for ($i = 0; $i < $fileQty; $i++) {
                    if (!empty($_FILES['ir_file']['name'][$i])) {
                        $fileInfo = pathinfo($_FILES['ir_file']['name'][$i]);
                        $fileName = str_replace(' ', '', $fileInfo['filename']);
                        $fileExtension = $fileInfo['extension'];
                        $fullFilePath = $uploadPath . '/' . $doc_no . '_' . $timestamp . '_' . $fileName . '.' . $fileExtension;

                        if (file_put_contents($fullFilePath, file_get_contents($_FILES['ir_file']['tmp_name'][$i]))) {
                            $newData = array(
                                'sfu_file_name' => $doc_no . '_' . $timestamp . '_' . $fileName . '.' . $fileExtension,
                                'sfu_file_path' => $fullFilePath,
                                'sfu_doc_no' => $doc_no,
                                'sfu_type' => 2,
                                'sfu_status' => 1,
                                'create_date' => date('Y-m-d H:i:s'),
                                'update_date' => date('Y-m-d H:i:s'),
                                'create_by' => $emp_code,
                                'update_by' => $emp_code
                            );
                            if (!$this->db->insert('sys_files_upload', $newData)) {
                                $response = array(
                                    'success' => false,
                                    'message' => 'Error inserting file to database',
                                );
                            }
                            $filePaths[] = $fullFilePath;
                        } else {
                            $response = array(
                                'success' => false,
                                'message' => 'Failed to upload file [' . $i . ']',
                            );
                            echo json_encode($response);
                            exit();
                        }
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'No file selected [' . $i . ']',
                        );
                        echo json_encode($response);
                        exit();
                    }
                }
                $response = array(
                    'success' => true,
                    'message' => $filePaths,
                );
                echo json_encode($response);
            }
        } else {
            for ($i = 0; $i < $fileQty; $i++) {
                if (!empty($_FILES['ir_file']['name'][$i])) {
                    $fileInfo = pathinfo($_FILES['ir_file']['name'][$i]);
                    $fileName = str_replace(' ', '', $fileInfo['filename']);
                    $fileExtension = $fileInfo['extension'];
                    $fullFilePath = $uploadPath . '/' . $doc_no . '_' . $timestamp . '_' . $fileName . '.' . $fileExtension;

                    if (file_exists($fullFilePath)) {
                        $response = array(
                            'success' => false,
                            'message' => 'A file with this name already exists in the store.',
                        );
                        echo json_encode($response);
                        exit();
                    } else {
                        if (file_put_contents($fullFilePath, file_get_contents($_FILES['ir_file']['tmp_name'][$i]))) {
                            $newData = array(
                                'sfu_file_name' => $doc_no . '_' . $timestamp . '_' . $fileName . '.' . $fileExtension,
                                'sfu_file_path' => $fullFilePath,
                                'sfu_doc_no' => $doc_no,
                                'sfu_type' => 2,
                                'sfu_status' => 1,
                                'create_date' => date('Y-m-d H:i:s'),
                                'update_date' => date('Y-m-d H:i:s'),
                                'create_by' => $emp_code,
                                'update_by' => $emp_code
                            );
                            if (!$this->db->insert('sys_files_upload', $newData)) {
                                $response = array(
                                    'success' => false,
                                    'message' => 'Error inserting file to database',
                                );
                            }
                            $filePaths[] = $fullFilePath;
                        } else {
                            $response = array(
                                'success' => false,
                                'message' => 'Failed to upload file [' . $i . ']',
                            );
                            echo json_encode($response);
                            exit();
                        }
                    }
                } else {
                    $response = array(
                        'success' => false,
                        'message' => 'No file selected [' . $i . ']',
                    );
                    echo json_encode($response);
                    exit();
                }
            }
            $response = array(
                'success' => true,
                'message' => $filePaths,
            );
            echo json_encode($response);
        }
    }
}

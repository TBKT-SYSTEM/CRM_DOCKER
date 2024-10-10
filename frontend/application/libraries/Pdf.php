<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class Pdf
{
    public $param;
    public $pdf;

    public function __construct()
    {
        $this->param = '';
        $this->pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P'
        ]);
    }

    public function __call($method, $args)
    {
        if (method_exists($this->pdf, $method)) {
            return call_user_func_array(array($this->pdf, $method), $args);
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'pagination','email','form_validation');
$autoload['drivers'] = array();
$autoload['helper'] = array('file','url', 'form', 'security');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('ManageBackend');
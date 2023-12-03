<?php
defined('BASEPATH') or exit('No direct script access allowed');


$str = file_get_contents('setting.json');
$json = json_decode($str, true);

$autoload['packages'] = array();

// $autoload['libraries'] = array('database', 'session', 'globals');
$autoload['libraries'] = $json['general']['libraries'];

$autoload['drivers'] = array();

$autoload['helper'] = $json['general']['helper'];

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = $json['general']['models'];

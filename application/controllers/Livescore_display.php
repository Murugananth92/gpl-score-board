<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livescore_display extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Livescore_display_model');
	}

	function index()
	{
		$data = $this->getScoreData();
		//echo "<pre>"; print_r($data); echo "</pre>";
		$this->load->view('livescore_display', $data);
	}

	private function getScoreData(){
		$path = './live_score/';
		$files = scandir($path, SCANDIR_SORT_DESCENDING);
		return ($files[0] ==='..')? []: json_decode(file_get_contents($path.$files[0]), true);
	}
}

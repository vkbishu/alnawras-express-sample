<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->layout->extend('index');
    }
    
    public function track_package(){
		$this->layout->extend('track_package');
	}
	
	public function barcode(){
		$data = [
			'package_id' => '123456',
			'test' => 'test demo for testing purpose',
			'date' => date('Y-m-d')
		];
		$generator = new Picqer\Barcode\BarcodeGeneratorSVG();
		echo $generator->getBarcode(serialize($data), $generator::TYPE_CODE_128);
	}
}

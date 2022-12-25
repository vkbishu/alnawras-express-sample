<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
   
   private $data;
   
	public function __construct(){
		$this->data['curr_controller'] = $this->router->fetch_class()."/";
		$this->data['curr_method'] = $this->router->fetch_method()."/";
		$this->load->model('dashboard_model', 'dashboard');
		parent::__construct();
		
		admin_log_check();
	}

	public function index(){
        $this->data['users_count'] = $this->dashboard->get_members_count();
        $this->data['all_packages_count'] = $this->dashboard->get_packages_count();
        $this->data['pending_packages_count'] = $this->dashboard->get_packages_count(PACKAGE_PENDING);
        $this->data['rejected_packages_count'] = $this->dashboard->get_packages_count(PACKAGE_REJECTED);
        $this->data['proceeding_packages_count'] = $this->dashboard->get_packages_count(PACKAGE_PROCEEDING);
        $this->load->model('package/package_model');
        $srch['package_status'] = 'pending';
		$this->data['list'] = $this->package_model->getList($srch, 0, 10);
		$this->layout->view('dashboard', $this->data);
       
	}
	
	public function icons(){
		$this->layout->view('icons');
	}
	
	public function icons_ajax(){
		$this->load->view('icon_ajax');
	}

}



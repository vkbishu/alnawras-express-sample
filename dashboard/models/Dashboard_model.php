<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	public function __construct(){
        return parent::__construct();
	}
	
	public function get_members_count(){
        return $this->db->count_all_results('access_panel');
    }

    public function get_packages_count($status=''){
        if(admin_role_key() == 'local-admin'){
            $admin_access_city = admin_access_city_id();
           if(!$admin_access_city){
                $admin_access_city = ['ABCD'];
            }
            $this->db->where_in('city', $admin_access_city);
        }

        if($status !== ''){
           $this->db->where('status', $status);
        }
        return $this->db->count_all_results('packages');
    }
	
	
	/* public function getWorkRecords(){
		$date = date('Y-m-d');
		$records = array();
		for($i=0; $i <= 30; $i++){
			$date_key = date('Y-m-d', strtotime("-$i days"));
			$res1 = $this->db->where("DATE(posted_datetime) = DATE('$date_key') ")->count_all_results('works');
			$res2 = $this->db->where("DATE(datetime) = DATE('$date_key') ")->count_all_results('works_bids');
			$records[] = array(
				'date' => $date_key,
				'total_work' => $res1,
				'total_bids' => $res2,
			);
		}
		
		return $records;
	} */
	

}



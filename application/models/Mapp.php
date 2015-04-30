<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* created on 30 April 2015 by irfani@gmail.com */

class Mapp extends CI_Model {
	 
	 public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('default',true);
	 }
	 
	
	
	//s: global crud query
	  public function qselect($tablename,$id=0)
	 { 
	   if ($id==0) {
	   $q = $this->db->order_by('ID', 'DESC')->get_where($tablename,array('STATUSID'=>1)); 
	   } else {
		$q = $this->db->get_where($tablename,array('ID'=>$id,'STATUSID'=>1));     
	   }
	   return $q;
	   $q->free_result();
	 }
	 	
	public function qdel($tablename,$id)
	 { 
	$data = array('STATUSID' => 0);
    $this->db->where('ID', $id);
    $this->db->update($tablename, $data);	
	 }	
	 
	 public function qdel_permanent($tablename,$id)
	 { 
    $this->db->where('ID', $id);
    $this->db->delete($tablename);	
	 }	
	 
	 public function qinsert($tablename,$data=array()) {
	 $this->db->insert($tablename, $data); 
	 }
	 
	  public function qupdate($tablename,$data=array(),$id) {
	$this->db->where('ID', $id);
    $this->db->update($tablename, $data); 
	 }
	//e: global crud query

	
	//s: employee
	public function employee_insert() {
	$data = array(
   'employee_name' => trim($this->input->post('txtname')),
   'employee_position' =>trim($this->input->post('txtposition')),
   'STATUSID' => 1
      );

    $this->qinsert('employee',$data);
	}
	
	public function employee_upd($id) {
    $data = array(
   'employee_name' => trim($this->input->post('txtname')),
   'employee_position' =>trim($this->input->post('txtposition'))
      );    
	   $this->qupdate('employee',$data,$id)	;
	 
	 }
	//e: employee
	
}
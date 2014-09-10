<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Volumes extends MY_Model{

	protected $table = "volumes";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'number,tara,title';
	
	function __construct(){
		parent::__construct();
	}
	
	function getList($tara = NULL){
		
		$this->db->select('volumes.id,volumes.title,tara.title AS tara');
		$this->db->from('volumes');
		$this->db->join('tara','volumes.tara = tara.id');
		if(!is_null($tara)):
			$this->db->where('volumes.tara',$tara);
		endif;
		$this->db->order_by($this->order_by);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return FALSE;
	}
	
	function getTara($volume = NULL){
		
		$this->db->select('volumes.id,volumes.title,tara.title AS tara');
		$this->db->from('volumes');
		$this->db->join('tara','volumes.tara = tara.id');
		if(!is_null($volume)):
			$this->db->where('volumes.id',$volume);
		endif;
		$this->db->order_by($this->order_by);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data[0];
		endif;
		return FALSE;
	}
}
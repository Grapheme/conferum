<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Press_centr_resources extends MY_Model{

	protected $table = "press_centr_resources";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'number';
	
	function __construct(){
		parent::__construct();
	}
}
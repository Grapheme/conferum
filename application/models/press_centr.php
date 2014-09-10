<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Press_centr extends MY_Model{

	protected $table = "press_centr";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'date DESC';
	
	function __construct(){
		parent::__construct();
	}
}
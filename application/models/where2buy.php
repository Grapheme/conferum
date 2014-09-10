<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Where2buy extends MY_Model{

	protected $table = "where2buy";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'sort,city';
	
	function __construct(){
		parent::__construct();
	}
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends MY_Model{

	protected $table = "reviews";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'id DESC';
	
	function __construct(){
		parent::__construct();
	}
}
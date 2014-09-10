<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Banners extends MY_Model{

	protected $table = "banners";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'number';
	
	function __construct(){
		parent::__construct();
	}
}
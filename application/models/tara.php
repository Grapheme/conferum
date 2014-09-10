<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tara extends MY_Model{

	protected $table = "tara";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'title';

	function __construct(){
		parent::__construct();
	}
}
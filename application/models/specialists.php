<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Specialists extends MY_Model{

	protected $table = "specialists";
	protected $primary_key = "id";
	protected $fields = array("*");
	
	function __construct(){
		parent::__construct();
	}
}
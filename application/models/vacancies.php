<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vacancies extends MY_Model{

	protected $table = "vacancies";
	protected $primary_key = "id";
	protected $fields = array("*");
	
	function __construct(){
		parent::__construct();
	}
}
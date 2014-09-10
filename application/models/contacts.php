<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_Model{

	protected $table = "contacts";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		parent::__construct();
	}
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Product_categories extends MY_Model{

	protected $table = "product_categories";
	protected $primary_key = "id";
	protected $fields = array("*");
	
	function __construct(){
		parent::__construct();
	}
	
	function getCategoriesByProductsIDs($productsIDs,$group = FALSE){
		
		$this->db->select('product_categories.product,categories.title,categories.sub_category,categories.class_name,categories.page_url');
		$this->db->from('product_categories');
		$this->db->join('categories','product_categories.category = categories.id');
		$this->db->where_in('product_categories.product',$productsIDs);
		if($group):
			$this->db->group_by('product_categories.product');
		endif;
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
}
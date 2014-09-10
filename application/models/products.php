<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model{

	protected $table = "products";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'title';
	
	function __construct(){
		parent::__construct();
	}
	
	function getAllTitles(){
		
		$this->db->select('id,title')->order_by($this->order_by);
		$query = $this->db->get($this->table);
		$data = $query->result_array();
		if($data):
			return $data;
		endif;
		return NULL;
	}
	
	function getRandomProducts($count){
		
		$this->db->select('products.*,product_categories.category');
		$this->db->from('products');
		$this->db->join('product_categories','products.id = product_categories.product');
		$this->db->limit($count);
		$this->db->order_by('id','random');
		$this->db->group_by('products.id');
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getLimitProducts($limit = NULL,$offset = NULL,$categoryID){
		
		$this->db->select('products.*,product_categories.category');
		$this->db->from('products');
		$this->db->join('product_categories','products.id = product_categories.product');
		$this->db->order_by($this->order_by);
		$this->db->group_by('products.id');
		if(!is_null($limit) && !is_null($offset)):
			$this->db->limit($limit,$offset);
		endif;
		$this->db->where('product_categories.category',$categoryID);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getAllProductCategories($getRealCategory = NULL){
		
		if(is_null($getRealCategory)):
			$this->db->select('products.*,product_categories.category');
		else:
			$this->db->select('products.*,'.$getRealCategory.' AS category',FALSE);
		endif;
		$this->db->from('products');
		$this->db->join('product_categories','products.id = product_categories.product');
		$this->db->order_by($this->order_by);
		$this->db->where('product_categories.sub_category',0);
		$this->db->group_by('products.id');
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getFullListProductCategories(){
		
		$this->db->select('products.id,products.page_url,products.title,product_categories.category');
		$this->db->from('product_categories');
		$this->db->join('products','product_categories.product = products.id');
		$this->db->order_by('products.title');
		$this->db->where('product_categories.sub_category',0);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getCountByCategory($categoryID){
		
		$this->db->select('COUNT(products.id) AS cnt');
		$this->db->from('products');
		$this->db->join('product_categories','products.id = product_categories.product');
		$this->db->where('product_categories.category',$categoryID);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data[0]['cnt'];
		endif;
		return 0;
	}

	function getSubCategoriesTitlesByProductID($productID){
		
		$this->db->select('categories.title AS sub_category');
		$this->db->from('product_categories');
		$this->db->join('categories','categories.id = product_categories.category');
		$this->db->where('product_categories.product',$productID);
		$this->db->where('product_categories.sub_category',1);
		$query = $this->db->get();
		if($data = $query->result_array()):
			$categories = array();
			for($i=0;$i<count($data);$i++):
				$categories[] = $data[$i]['sub_category'];
			endfor;
			return $categories;
		endif;
		return NULL;
		
	}

	function setFoundProducts($string){
		
		$match = array('page_title'=>$string,'page_description'=>$string,'page_h1'=>$string,'title'=>$string,'destination'=>$string,'advantages'=>$string,'applying'=>$string,'description'=>$string);
		$this->db->select($this->_fields());
		$this->db->group_by($this->primary_key);
		$this->db->order_by($this->order_by);
		$this->db->or_like($match);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
}
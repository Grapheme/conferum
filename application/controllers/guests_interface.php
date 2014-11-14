<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{
	
	var $offset = 1000;
	var $TotalProducts = 0;
	
	function __construct(){

		parent::__construct();
		$this->load->library('meta_titles');
		$this->load->model('menu');
	}
	
	public function pages(){
		
		$this->load->model(array('pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
		);
		if(empty($pagevar['page_content'])):
			show_404();
		endif;
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/template",$pagevar);
	}
	
	public function index(){
		
		$this->load->model(array('categories','banners','pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>'home')),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>'home'),TRUE),
			'categories' => $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE),
			'banners' => $this->banners->getAll()
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/index",$pagevar);
	}
	
	public function about(){
		
		$this->load->model(array('pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE)
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/about",$pagevar);
	}
	
	public function scienceBase(){
		
		$this->load->model(array('pages','page_resources','specialists'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'specialists' => $this->specialists->getAll()
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/science-base",$pagevar);
	}
	
	/*********************************************************************************/
	public function searchResults(){
		
		$this->load->model(array('pages','page_resources'));
		$this->load->helper('text');
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'products' => array(),
			'pages' => NULL
		);
		if($this->input->get('search') !== FALSE && $this->input->get('search') != ''):
			$this->offset = (int)$this->input->get('offset');
			$pagevar['products'] = $this->foundProducts($this->input->get('search'));
			$pagevar['pages'] = $this->pagination('search?search='.$this->input->get('search'),3,$this->TotalProducts,$this->offset,TRUE);
		endif;
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/search-results",$pagevar);
	}
	
	public function searchGoods(){
		
		$this->load->model(array('pages','page_resources'));
		$this->load->helper('text');
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'products' => array(),
			'pages' => NULL
		);
		if($this->input->get('search') !== FALSE && $this->input->get('search') != ''):
			$this->offset = (int)$this->input->get('offset');
			$pagevar['products'] = $this->foundProducts($this->input->get('search'));
			$pagevar['pages'] = $this->pagination('search-goods?search='.$this->input->get('search'),3,$this->TotalProducts,$this->offset,TRUE);
		endif;
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/search-goods",$pagevar);
	}
	
	private function foundProducts($searchString = ''){
		
		if(!empty($searchString)):
			$this->load->library('sphinxclient');
			$this->sphinxclient->SetServer('localhost',9312);
			$this->sphinxclient->SetMatchMode(SPH_MATCH_EXTENDED2);
			$this->sphinxclient->setRankingMode(SPH_RANK_PROXIMITY_BM25);
			$this->sphinxclient->SetLimits($this->offset,PER_PAGE_DEFAULT);
			$this->sphinxclient->SetSortMode(SPH_SORT_RELEVANCE);
			$this->sphinxclient->SetFieldWeights(array('title'=>30,'destination'=>50,'advantages'=>40,'page_title'=>10,'page_description'=>10));
			$result = $this->sphinxclient->Query($searchString,'*');
			if($result && isset($result['matches'])):
				if($productsIDs = array_keys($result['matches'])):
					$this->TotalProducts = $result['total'];
					$this->load->model('products');
					$products = $this->products->getWhereIN(array('where_in'=>$productsIDs,'many_records'=>TRUE));
					$products = $this->addFoundProductsCategories($productsIDs,$products);
					$products = $this->BuildExcerpts($searchString,$products);
					return $products;
				endif;
			endif;
		endif;
		return NULL;
	}
	
	private function addFoundProductsCategories($productsIDs,$products){
		
		if(!empty($products)):
			$this->load->model('product_categories');
			$product_categories = $this->product_categories->getCategoriesByProductsIDs($productsIDs,TRUE);
			for($j=0;$j<count($products);$j++):
				$products[$j]['category_url'] = 'undefined';
				for($i=0;$i<count($product_categories);$i++):
					if($products[$j]['id'] == $product_categories[$i]['product']):
						$products[$j]['category_url'] = $product_categories[$i]['page_url'];
					endif;
				endfor;
			endfor;
		endif;
		return $products;
	}
	
	private function BuildExcerpts($searchString,$products){
		
		if(!empty($products)):
			$options = array('before_match'=>'<b>','after_match'=>'</b>','chunk_separator'=>' ... ','limit'=>256,'around'=>15);
			for($i=0;$i<count($products);$i++):
				$full_text_content = strip_tags($products[$i]['destination'].' '.$products[$i]['advantages']);
				$title = $this->sphinxclient->BuildExcerpts(array(strip_tags($products[$i]['title'])),'conferum_index',$searchString,$options);
				$destination = $this->sphinxclient->BuildExcerpts(array($full_text_content),'conferum_index',$searchString,$options);
				
//				print_r($destination);
				
				$products[$i]['title'] = $title[0];
				$products[$i]['destination'] = $destination[0];
				$products[$i]['advantages'] = '';
				$products[$i]['applying'] = '';
				$products[$i]['description'] = '';
			endfor;
//			exit;
		endif;
		return $products;
	}

	/*********************************************************************************/
	public function sitemap(){
		$this->load->model(array('categories','pages'));
		$pagevar['categories'] = $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE);
		$pagevar['main_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,2,5),'many_records'=>TRUE));
		$pagevar['sub_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,3),'many_records'=>TRUE));
		$pagevar['footer_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,4,5),'many_records'=>TRUE));
		$pagevar['sub_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,3),'many_records'=>TRUE));
		
		$this->load->view("guests_interface/pages/sitemap",$pagevar);
	}	
	
	/*********************************************************************************/
	public function searchResultsTest(){
		
		$this->load->model(array('pages','page_resources'));
		$this->load->helper('text');
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'products' => array(),
			'pages' => NULL
		);
		if($this->input->get('search') !== FALSE && $this->input->get('search') != ''):
			$this->offset = (int)$this->input->get('offset');
			$pagevar['products'] = $this->foundProductsTest($this->input->get('search'));
			$pagevar['pages'] = $this->pagination('search-goods?search='.$this->input->get('search'),3,$this->TotalProducts,PER_PAGE_DEFAULT,TRUE);
		endif;
		
		//print_r($pagevar['products']);exit;
		
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/search-goods",$pagevar);
	}
	
	private function foundProductsTest($searchString = ''){
		
		if(!empty($searchString)):
			$this->load->library('sphinxclient');
			$this->sphinxclient->SetServer('localhost',9312);
			$this->sphinxclient->SetMatchMode(SPH_MATCH_ALL);
//			$this->sphinxclient->SetMatchMode(SPH_MATCH_EXTENDED2);
//			$this->sphinxclient->setRankingMode(SPH_RANK_PROXIMITY_BM25);
			$this->sphinxclient->SetLimits($this->offset,PER_PAGE_DEFAULT);
			$this->sphinxclient->SetSortMode(SPH_SORT_RELEVANCE);
			$this->sphinxclient->SetFieldWeights(array('title'=>30,'destination'=>50,'advantages'=>40,'page_title'=>10,'page_description'=>10));
			$result = $this->sphinxclient->Query($searchString,'*');
			if($result && isset($result['matches'])):
				if($productsIDs = array_keys($result['matches'])):
					$this->TotalProducts = $result['total'];
					$this->load->model('products');
					$products = $this->products->getWhereIN(array('where_in'=>$productsIDs,'many_records'=>TRUE));
					$products = $this->sortArrayByIDs($productsIDs,$products);
					$products = $this->addFoundProductsCategories($productsIDs,$products);
					$products = $this->BuildExcerptsTest($searchString,$products);
					return $products;
				endif;
			endif;
		endif;
		return NULL;
	}
	
	private function BuildExcerptsTest($searchString,$products){
		
		if(!empty($products)):
			$options = array('before_match'=>'<b>','after_match'=>'</b>','chunk_separator'=>' ... ','limit'=>256,'around'=>15);
			for($i=0;$i<count($products);$i++):
				$full_text_content = strip_tags($products[$i]['destination'].' '.$products[$i]['advantages']);
				$title = $this->sphinxclient->BuildExcerpts(array(strip_tags($products[$i]['title'])),'conferum_index',$searchString,$options);
				$destination = $this->sphinxclient->BuildExcerpts(array($full_text_content),'conferum_index',$searchString,$options);
				$products[$i]['title'] = $title[0];
				$products[$i]['destination'] = $destination[0];
				$products[$i]['advantages'] = '';
				$products[$i]['applying'] = '';
				$products[$i]['description'] = '';
			endfor;
		endif;
		return $products;
	}
	/*********************************************************************************/
	public function where2buy(){
		
		$this->load->model(array('pages','page_resources','where2buy'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'where2buy' => $this->where2buy->getAll()
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/where2buy",$pagevar);
	}
	
	public function contacts(){
		
		$this->load->model(array('pages','page_resources','contacts'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'contact' => $this->contacts->getWhere()
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/contacts",$pagevar);
	}
	
	public function pressCenter(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->model(array('press_centr','pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'press_centr' => $this->press_centr->limit(PER_PAGE_DEFAULT,$this->offset),
			'pages' => $this->pagination('press-center',3,$this->press_centr->countAllResults(),PER_PAGE_DEFAULT),
		);
		$this->load->helper('date');
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/press-center",$pagevar);
	}
	
	public function reviews(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->model(array('reviews','pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'reviews' => $this->reviews->limit(PER_PAGE_DEFAULT,$this->offset),
			'pages' => $this->pagination('reviews',3,$this->reviews->countAllResults(),PER_PAGE_DEFAULT),
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/reviews",$pagevar);
	}
	
	public function honors(){
		
		$this->load->model(array('pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE)
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/honors",$pagevar);
	}
	
	public function consultation(){
		
		$this->load->model(array('pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/consultation",$pagevar);
	}
	
	public function bid(){
		
		$this->load->model(array('pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'products' => array()
		);
		if($this->session->userdata('order_list') !== FALSE):
			$pagevar['products'] = json_decode($this->session->userdata('order_list'),TRUE);
			for($i=0;$i<count($pagevar['products']);$i++):
				$pagevar['products'][$i]['sizes'] = $this->getProductSizes($pagevar['products'][$i]['size']);
				$pagevar['products'][$i]['tara'] = $this->getProductTara($pagevar['products'][$i]['sizes']);
			endfor;
		endif;
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/bid",$pagevar);
	}
	
	public function catalog(){
		
		if($this->uri->segment(3) !== FALSE):
			show_404();
		endif;
		$this->load->model(array('pages','page_resources','categories','products'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>$this->uri->segment(1))),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>$this->uri->segment(1)),TRUE),
			'categories' => $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE),
			'sub_categories' => array(),
			'products' => '',
			'tara' => array(),
			'pages' => NULL,
			'category' => array()
		);
		if($this->uri->segment(2)!== FALSE):
			if($category = $this->categories->getWhere(NULL,array('page_url'=>$this->uri->segment(2)))):
				$products = array();
				if($products = $this->products->getLimitProducts($this->offset,$this->uri->segment(4),$category['id'])):
					$products = $this->getProductCategories($products);
					for($i=0;$i<count($products);$i++):
						$products[$i]['sizes'] = $this->getProductSizes($products[$i]['size']);
						$products[$i]['tara'] = $this->getProductTara($products[$i]['sizes']);
					endfor;
				endif;
				$pagevar['sub_categories'] = $this->categories->getWhere(NULL,array('sub_category'=>1,'parent'=>$category['id']),TRUE);
				$categoryImg = $this->categories->value($category['id'],'image');
				$pagevar['products'] = $this->load->view('html/catalog-products',array('page_content'=>$pagevar['page_content'],'products'=>$products,'categoryTitle'=>$category['title'],'categoryDescription'=>$category['description'],'categoryImg'=>$categoryImg),TRUE);
				$pagevar['pages'] = $this->pagination('catalog/'.$this->uri->segment(2),4,$this->products->getCountByCategory($category['id']),$this->offset);
				$pagevar['page_content']['page_title'] = $category['page_title'];
				$pagevar['page_content']['page_description'] = $category['page_description'];
				$pagevar['page_content']['page_h1'] = $category['page_h1'];
				$pagevar['page_content']['page_url'] = $category['page_url'];
				$pagevar['category'] = $category;
			endif;
		endif;
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/catalog",$pagevar);
	}
	
	public function product(){
		
		if($this->uri->total_segments() > 2):
			show_404();
		endif;
		$this->load->model(array('categories','products','products_resources'));
		if(!$product = $this->products->getWhere(NULL,array('page_url'=>$this->uri->segment(2)))):
			show_404();
		endif;
		$pagevar = array(
			'page_content' => array(),
			'page_images' => array(),
			'categories' => $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE),
			'product' => array(),
			'keywords' => array(),
			'product_sizes' => array(),
			'product_tara' => array(),
			'similars' => array(),
			'allProducts' => $this->products->getFullListProductCategories(),
			'product_images' => $this->products_resources->getWhere(NULL,array('product'=>$product['id']),TRUE)
		);
		$keywords = $this->getProductKeyWords($product['id']);
		$pagevar['keywords'] = explode(',',$this->getProductKeyWords($product['id']));
		$pagevar['product_sizes'] = $this->getProductSizes($product['size']);
		$pagevar['product_tara'] = $this->getProductTara($pagevar['product_sizes']);
//		$pagevar['similars'] = $this->getProductSimilarsOnly($product['similar'],$category['id']);
		$pagevar['similars'] = $this->getProductSimilarsOnly($product['similar']);
		$pagevar['similars'] = $this->getProductCategories($pagevar['similars']);
		$pagevar['product'] = $product;
//		$pagevar['product']['category'] = $category['id'];
		$pagevar['product']['category'] = $this->getProductCategoriesIDs($product['id']);
		$pagevar['product']['sub_categories'] = $this->products->getSubCategoriesTitlesByProductID($pagevar['product']['id']);
		for($i=0;$i<count($pagevar['similars']);$i++):
			$pagevar['similars'][$i]['sizes'] = $this->getProductSizes($pagevar['similars'][$i]['size']);
		endfor;
		$pagevar['page_content']['page_title'] = $product['page_title'];
		$pagevar['page_content']['page_description'] = $product['page_description'];
		$pagevar['page_content']['page_h1'] = $product['page_h1'];
		$pagevar['page_content']['page_url'] = $product['page_url'];
		$pagevar['page_content']['page_keywords'] = $product['page_keywords'];
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/product",$pagevar);
	}
	
	public function publication(){
		
		$this->load->model(array('press_centr_resources','press_centr'));
		$pagevar = array(
			'content' => $this->press_centr->getWhere(NULL,array('page_url'=>$this->uri->segment(2))),
			'images' => array(),
			'page_content' => array(),
			'page_images' => array(),
		);
		if(empty($pagevar['content'])):
			show_404();
		else:
			$pagevar['images'] = $this->press_centr_resources->getWhere(NULL,array('publication'=>$pagevar['content']['id']),TRUE);
		endif;
		$this->load->helper('date');
		$pagevar['page_content']['page_title'] = $pagevar['content']['page_title'];
		$pagevar['page_content']['page_description'] = $pagevar['content']['page_description'];
		$pagevar['page_content']['page_h1'] = $pagevar['content']['page_h1'];
		$pagevar['page_content']['page_url'] = $pagevar['content']['page_url'];
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/publication",$pagevar);
	}
	
	public function responseVacancy(){
		
		$this->load->model(array('pages','page_resources','vacancies'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'vacancy' => $this->vacancies->getWhere(NULL,array('page_url'=>$this->uri->segment(2)))
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/response-vacancy",$pagevar);
	}
	
	public function vacancies(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->model(array('vacancies','pages','page_resources'));
		$pagevar = array(
			'page_content' => $this->pages->getWhere(NULL,array('page_url'=>uri_string())),
			'images' => $this->page_resources->getWhere(NULL,array('page_url'=>uri_string()),TRUE),
			'vacancies' => $this->vacancies->limit(PER_PAGE_DEFAULT,$this->offset),
			'pages' => $this->pagination('vacancies',3,$this->vacancies->countAllResults(),PER_PAGE_DEFAULT),
		);
		$pagevar = $this->getMenu($pagevar);
		$this->load->view("guests_interface/pages/vacancies",$pagevar);
	}
	
	private function getMenu($destination){
		
		$this->load->model('pages');
		$destination['main_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,2,5),'many_records'=>TRUE));
		$destination['sub_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,3),'many_records'=>TRUE));
		$destination['footer_menu'] = $this->pages->getWhereIN(array('field'=>'menu_position','where_in'=>array(1,4,5),'many_records'=>TRUE));
		return $destination;
	}
	
	private function getProductSimilarsOnly($similars_list,$getRealCategory = NULL){
		
		$productSimilars = array();
		if(!empty($similars_list)):
			$this->load->model('products');
			$productSimilars = json_decode($similars_list,TRUE);
		endif;
		$products = $this->products->getAllProductCategories($getRealCategory);
		$similars = array();
		for($i=0;$i<count($products);$i++):
			for($j=0;$j<count($productSimilars);$j++):
				if($productSimilars[$j] == $products[$i]['id']):
					$similars[] = $products[$i];
				endif;
			endfor;
		endfor;
		return $similars;
	}
	
	private function getProductCategoriesIDs($productID){
		
		$categoriesID = array(NULL);
		$this->load->model('product_categories');
		if($categories = $this->product_categories->getWhere(NULL,array('product'=>$productID,'sub_category'=>0),TRUE)):
			$categoriesID = $this->getValuesInArray($categories,'category');
		endif;
		return $categoriesID;
	}
	/********************************************************************************************************************/
}
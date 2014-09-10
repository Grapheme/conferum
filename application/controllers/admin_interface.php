<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus):
			redirect('');
		endif;
		$this->load->helper('form');
	}
	
	/******************************************** cabinet *******************************************************/
	public function controlPanel(){
		
		$pagevar = array();
		$this->load->view("admin_interface/cabinet/control-panel",$pagevar);
	}
	
	public function changePassword(){
		
		$this->load->view("admin_interface/cabinet/profile");
	}
	/********************************************* banners **********************************************************/
	public function banners(){
		
		$this->load->model('banners');
		$pagevar = array(
			'images' => $this->banners->getAll(),
		);
		$this->load->view("admin_interface/pages/banners",$pagevar);
	}
	/********************************************* specialists **********************************************************/
	public function specialistsList(){
		
		$this->load->model('specialists');
		$pagevar = array(
			'specialists' => $this->specialists->getAll(),
		);
		$this->load->view("admin_interface/specialists/list",$pagevar);
	}
	
	public function addSpecialist(){
		
		$this->load->view("admin_interface/specialists/add");
	}
	
	public function editSpecialist(){
		
		$this->load->model('specialists');
		$pagevar = array(
			'specialist' => $this->specialists->getWhere($this->input->get('id'))
		
		);
		$this->load->view("admin_interface/specialists/edit",$pagevar);
	}
	/********************************************* reviews **********************************************************/
	public function reviewsList(){
		
		$this->load->model('reviews');
		$pagevar = array(
			'reviews' => $this->reviews->getAll(),
		);
		$this->load->view("admin_interface/reviews/list",$pagevar);
	}
	
	public function addReviews(){
		
		$this->load->view("admin_interface/reviews/add");
	}
	
	public function editReviews(){
		
		$this->load->model('reviews');
		$pagevar = array(
			'reviews' => $this->reviews->getWhere($this->input->get('id'))
		
		);
		$this->load->view("admin_interface/reviews/edit",$pagevar);
	}
	/********************************************* vacancies **********************************************************/
	public function vacanciesList(){
		
		$this->load->model('vacancies');
		$pagevar = array(
			'vacancies' => $this->vacancies->getAll(),
		);
		$this->load->view("admin_interface/vacancies/list",$pagevar);
	}
	
	public function addVacancies(){
		
		$this->load->view("admin_interface/vacancies/add");
	}
	
	public function editVacancies(){
		
		$this->load->model('vacancies');
		$pagevar = array(
			'vacancies' => $this->vacancies->getWhere($this->input->get('id'))
		
		);
		$this->load->view("admin_interface/vacancies/edit",$pagevar);
	}
	/********************************************* where2buy **********************************************************/
	public function where2buyList(){
		
		$this->load->model('where2buy');
		$pagevar = array(
			'where2buy' => $this->where2buy->getAll(),
		);
		$this->load->view("admin_interface/where2buy/list",$pagevar);
	}
	
	public function addWhere2buy(){
		
		$this->load->view("admin_interface/where2buy/add");
	}
	
	public function editWhere2buy(){
		
		$this->load->model('where2buy');
		$pagevar = array(
			'where2buy' => $this->where2buy->getWhere($this->input->get('id'))
		
		);
		$this->load->view("admin_interface/where2buy/edit",$pagevar);
	}
	/******************************************** press-centr *********************************************************/
	public function pressCentrList(){
		
		$this->offset = intval($this->uri->segment(3));
		$this->load->model('press_centr');
		$pagevar = array(
			'press_centr' => $this->press_centr->getAll()
		);
		$this->load->helper('date');
		$this->load->view("admin_interface/press-centr/list",$pagevar);
	}
	
	public function addPressСentr(){
		$pagevar = array(
			'images' =>array()
		);
		if($this->input->get('id') !== FALSE && is_numeric($this->input->get('id'))):
			$this->load->model('press_centr_resources');
			$pagevar['images'] = $this->press_centr_resources->getWhere(NULL,array('publication'=>$this->input->get('id')),TRUE);
		endif;
		$this->load->view("admin_interface/press-centr/add",$pagevar);
	}
	
	public function editPressСentr(){
		
		$this->load->model(array('press_centr_resources','press_centr'));
		$pagevar = array(
			'content' => $this->press_centr->getWhere($this->input->get('id')),
			'images' =>$this->press_centr_resources->getWhere(NULL,array('publication'=>$this->input->get('id')),TRUE)
		);
		if(empty($pagevar['content'])):
			show_404();
		endif;
		$this->load->helper('date');
		$pagevar['content']['date'] = swap_dot_date_without_time($pagevar['content']['date']);
		$this->load->view("admin_interface/press-centr/edit",$pagevar);
	}
	/******************************************* contacts ********************************************************/
	public function contactsList(){
		
		$this->load->model('contacts');
		$pagevar = array(
			'contact' => $this->contacts->getWhere(),
		);
		$this->load->view("admin_interface/contacts/list",$pagevar);
	}
	
	public function editContact(){
		
		$this->load->model('contacts');
		$pagevar = array(
			'contact' => $this->contacts->getWhere(),
		);
		$this->load->view("admin_interface/contacts/edit",$pagevar);
	}
	/********************************************* menu **********************************************************/
	public function menuList(){
		
		$this->load->model('menu');
		$pagevar = array(
			'menu' => $this->menu->getAll(),
		);
		$this->load->view("admin_interface/menu/list",$pagevar);
	}
	/********************************************* tara **********************************************************/
	public function taraList(){
		
		$this->load->model('tara');
		$pagevar = array(
			'tara' => $this->tara->getAll(),
		);
		$this->load->view("admin_interface/tara/list",$pagevar);
	}
	
	public function volumesList(){
		
		$this->load->model(array('volumes','tara'));
		$pagevar = array(
			'volumes' => array(),
			'tara' => $this->tara->getAll()
		);
		if($this->input->get('tara') !== FALSE && is_numeric($this->input->get('tara'))):
			$pagevar['volumes'] = $this->volumes->getList($this->input->get('tara'));
		else:
			$pagevar['volumes'] = $this->volumes->getList();
		endif;
		$this->load->view("admin_interface/tara/volumes-list",$pagevar);
	}
	
	public function addVolume(){
		$this->load->model('tara');
		$pagevar = array(
			'tara' => $this->tara->getAll()
		);
		$this->load->view("admin_interface/tara/add-volume",$pagevar);
	}
	
	public function editVolume(){
		
		$this->load->model(array('volumes','tara'));
		$pagevar = array(
			'volume' => $this->volumes->getWhere($this->input->get('id')),
			'tara' => $this->tara->getAll()
		);
		if(empty($pagevar['volume'])):
			show_404();
		endif;
		$this->load->view("admin_interface/tara/edit-volume",$pagevar);
	}
	/****************************************** categories *******************************************************/
	public function categories(){
		
		$this->load->model('categories');
		$pagevar = array(
			'categories' => $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE)
		);
		$this->load->view("admin_interface/categories/list",$pagevar);
	}
	
	public function editCategory(){
		
		$this->load->model('categories');
		$pagevar['category'] = $this->categories->getWhere($this->input->get('id'));
		$pagevar['categories'] = $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE);
		$this->load->view("admin_interface/categories/edit",$pagevar);
	}
	/**************************************** sub categories *****************************************************/
	public function subCategories(){
		
		$this->load->model('categories');
		if($this->input->get('category') !== FALSE && is_numeric($this->input->get('category'))):
			$categories = $this->categories->getWhere(NULL,array('sub_category'=>1,'parent'=>$this->input->get('category')),TRUE);
		else:
			$categories= $this->categories->getWhere(NULL,array('sub_category'=>1),TRUE);
		endif;
		$pagevar = array(
			'categories' => $categories
		);
		$this->load->view("admin_interface/categories/sub-list",$pagevar);
	}
	
	public function editSubCategory(){
		
		$this->load->model('categories');
		$pagevar['category'] = $this->categories->getWhere($this->input->get('id'));
		$pagevar['categories'] = $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE);
		$this->load->view("admin_interface/categories/edit",$pagevar);
	}
	/********************************************* pages *********************************************************/
	public function pagesList(){
		
		$this->load->model('pages');
		$pagevar = array(
			'pages' => $this->pages->getAll(),
		);
		$this->load->view("admin_interface/pages/list",$pagevar);
	}

	public function insertPage(){
		
		$this->load->model(array('menu'));
		$pagevar = array(
			'menu' => $this->menu->getAll()
		);
		$this->load->view("admin_interface/pages/add",$pagevar);
	}

	public function editPages(){
		
		if($this->input->get('id') === FALSE || is_numeric($this->input->get('id')) === FALSE):
			redirect(ADMIN_START_PAGE);
		endif;
		$this->load->model(array('pages','page_resources','menu'));
		$pagevar = array(
			'content' => $this->pages->getWhere($this->input->get('id')),
			'images' => array(),
			'pageTitle' => '',
			'menu' => $this->menu->getAll()
		);
		if($pagevar['content']):
			$pagevar['pageTitle'] = $pagevar['content']['title'];
		endif;
		if($this->input->get('mode') == 'text'):
			$this->load->view("admin_interface/pages/edit",$pagevar);
		elseif($this->input->get('mode') == 'image'):
			$pagevar['images'] = $this->page_resources->getWhere(NULL,array('page_url'=>$pagevar['content']['page_url']),TRUE);
			$this->load->view("admin_interface/pages/images",$pagevar);
		elseif($this->input->get('mode') == 'caption'):
			$pagevar['images'] = $this->page_resources->getWhere(NULL,array('page_url'=>$pagevar['content']['page_url']),TRUE);
			$this->load->view("admin_interface/pages/images-caption",$pagevar);
		else:
			redirect(ADMIN_START_PAGE);
		endif;
	}
	/********************************************* products **********************************************************/
	public function productsList(){
		
		$this->load->model(array('products','categories'));
		$pagevar = array(
			'products' => array(),
			'categories' => $this->categories->getWhere(NULL,array('sub_category'=>0),TRUE),
		);
		if($this->input->get('category') !== FALSE && is_numeric($this->input->get('category'))):
			$pagevar['products'] = $this->products->getLimitProducts(NULL,NULL,$this->input->get('category'));
		else:
			$pagevar['products'] = $this->products->getAll();
		endif;
		$this->load->view("admin_interface/products/list",$pagevar);
	}
	
	public function addProduct(){
		
		$this->load->model(array('products','categories','tara','volumes'));
		$pagevar = array(
			'products' => $this->products->getAllTitles(),
			'categories' => $this->getCategoriesByProduct(),
			'images' =>array(),
			'tara' => $this->tara->getAll(),
			'volumes' => $this->volumes->getAll()
		);
		if($this->input->get('id') !== FALSE && is_numeric($this->input->get('id'))):
			$this->load->model('products_resources');
			$pagevar['images'] = $this->products_resources->getWhere(NULL,array('product'=>$this->input->get('id')),TRUE);
		endif;
		$this->load->view("admin_interface/products/add",$pagevar);
	}
	
	public function editProduct(){
		
		$this->load->model(array('products','products_resources','tara'));
		$pagevar = array(
			'product' => $this->products->getWhere($this->input->get('id')),
			'categories' => array(),
			'images' =>array(),
			'sizes' => array(),
			'similars' => array(),
			'tara' => $this->tara->getAll(),
		);
		if(empty($pagevar['product'])):
			show_404();
		endif;
		$pagevar['product']['keywords'] = $this->getProductKeyWords($pagevar['product']['id']);
		$pagevar['categories'] = $this->getCategoriesByProduct($pagevar['product']['id']);
		$pagevar['sizes'] = $this->getProductSizes($pagevar['product']['size']);
		$pagevar['similars'] = $this->getProductSimilars($pagevar['product']['similar']);
		$pagevar['images'] = $this->products_resources->getWhere(NULL,array('product'=>$pagevar['product']['id']),TRUE);
		$this->load->view("admin_interface/products/edit",$pagevar);
	}
	
	private function getCategoriesByProduct($productID = NULL){
		
		$this->load->model(array('categories','product_categories'));
		if($categories = $this->categories->getAll()):
			for($i=0;$i<count($categories);$i++):
				$categories[$i]['selected'] = FALSE;
			endfor;
			if(!is_null($productID) && $productCategories = $this->product_categories->getWhere(NULL,array('product'=>$productID),TRUE)):
				for($i=0;$i<count($categories);$i++):
					for($j=0;$j<count($productCategories);$j++):
						if($categories[$i]['id'] == $productCategories[$j]['category']):
							$categories[$i]['selected'] = TRUE;
						endif;
					endfor;
				endfor;
			endif;
			return $categories;
		endif;
		return NULL;
	}
	
	/*************************************************************************************************************/
	
}
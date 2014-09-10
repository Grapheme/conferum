<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function existEmail(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$statusval = array('status'=>FALSE);
		if($parametr = trim($this->input->post('parametr'))):
			if(!$this->accounts->search('email',$parametr)):
				$statusval['status'] = TRUE;
			endif;
		else:
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	public function orderProducts(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'mailText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('call_order_products') === TRUE):
			$MailData['info'] = $this->input->post();
			$MailData['bid'] = json_decode($this->session->userdata('order_list'),TRUE);
			$this->load->model('volumes');
			for($i=0;$i<count($MailData['bid']);$i++):
				if(!empty($MailData['bid'][$i]['product_size'])):
					$MailData['bid'][$i]['product_size'] = $this->volumes->getTara($MailData['bid'][$i]['product_size']);
				endif;
			endfor;
			$mailtext = $this->load->view('mails/call-bid-products',$MailData,TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(DEFAULT_MAIL,'noreply@conferum.ru','Conferum','Новый заказ',$mailtext,$file);
			$json_request['mailText'] = 'Сообщение отправлено';
			$json_request['status'] = TRUE;
			$this->session->unset_userdata('order_list');
		endif;
		echo json_encode($json_request);
	}
	
	public function responseVacancy(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'mailText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('response_vacancy') === TRUE):
			$this->load->model('vacancies');
			if($vacancy = $this->vacancies->getWhere($this->input->post('vacancy'))):
				$MailData['info'] = $this->input->post();
				$MailData['vacancy'] = $vacancy['title'];
				$mailtext = $this->load->view('mails/response-vacancy',$MailData,TRUE);
				$this->sendMail(DEFAULT_MAIL,'noreply@conferum.ru','Conferum','Отклик на вакансию',$mailtext);
				$json_request['mailText'] = 'Сообщение отправлено';
				$json_request['status'] = TRUE;
				$this->session->unset_userdata('order_list');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function orderACall(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'mailText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('call_order') === TRUE):
			$mailtext = $this->load->view('mails/call-order',$this->input->post(),TRUE);
			$this->sendMail(DEFAULT_MAIL,'noreply@conferum.ru','Conferum','Заказ звонка',$mailtext);
			$json_request['mailText'] = 'Сообщение отправлено';
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function orderAPotion(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'mailText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('call_potion') === TRUE):
			$mailtext = $this->load->view('mails/call-potion',$this->input->post(),TRUE);
			$this->sendMail(DEFAULT_MAIL,'noreply@conferum.ru','Conferum','Заказ средства',$mailtext);
			$json_request['mailText'] = 'Сообщение отправлено';
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function consultationCall(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'mailText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('call_consultation') === TRUE):
			$mailtext = $this->load->view('mails/call-consultation',$this->input->post(),TRUE);
			$this->sendMail(DEFAULT_MAIL,'noreply@conferum.ru','Conferum','Заказ на консультацию',$mailtext);
			$json_request['mailText'] = 'Сообщение отправлено';
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	/******************************************** admin interface *******************************************************/
	public function adminSavePassword(){
		
		if(!$this->input->is_ajax_request() && $this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('password')):
			if($this->validOldPassword($this->input->post('oldpassword'))):
				$this->accounts->updateField($this->account['id'],'password',md5($this->input->post('password')));
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/pages');
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Пароль сохранен';
			else:
				$json_request['responseText'] = 'Не верный старый пароль';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function validOldPassword($password = ''){
		
		if($this->accounts->getWhere(NULL,array('id'=>$this->account['id'],'password'=>md5($password)))):
			return TRUE;
		endif;
		return FALSE;
	}
	/* ------------------------------------- */
	public function insertPage(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('page')):
			$this->load->model('pages');
			if($this->pages->search('page_url',$this->input->post('page_url')) === FALSE):
				if($this->ExecuteCreatingPage($_POST)):
					$json_request['status'] = TRUE;
					$json_request['responseText'] = 'Cтраница cохранена';
					$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/pages');
				endif;
			else:
				$json_request['responseText'] = 'URL страницы уже занят!';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updatePage(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('page')):
			$this->load->model('pages');
			if($this->pages->search('page_url',$this->input->post('page_url'),array('id !='=>$this->input->get('id'))) === FALSE):
				if($this->ExecuteUpdatingPage($this->input->get('id'),$_POST)):
					$json_request['status'] = TRUE;
					$json_request['responseText'] = 'Cтраница cохранена';
				endif;
			else:
				$json_request['responseText'] = 'URL страницы уже занят!';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function pageUploadResources(){
		
		if($this->loginstatus === FALSE || !$this->input->get_request_header('X-file-name',TRUE)):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		$uploadPath = 'download';
		if(isset($_FILES['file']['name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK):
			//if($this->imageResize($_FILES['file']['tmp_name'])):
				$uploadResult = $this->uploadSingleImage(getcwd().'/'.$uploadPath);
				if($uploadResult['status'] === TRUE && !empty($uploadResult['uploadData'])):
					if($this->imageResize($_FILES['file']['tmp_name'],NULL,TRUE,200,200,TRUE)):
						$thumbNailUpload = $this->uploadSingleImage(getcwd().'/'.$uploadPath.'/thumbnail','thumb_'.$uploadResult['uploadData']['file_name']);
					endif;
					if($uploadResult['status'] == TRUE && $thumbNailUpload['status'] == TRUE):
						$json_request['status'] = TRUE;
						$json_request['responsePhotoSrc'] = $this->savePageResource($uploadPath,$uploadResult['uploadData'],$thumbNailUpload['uploadData']);
					else:
						$json_request['responseText'] = 'Ошибка при загрузке';
					endif;
				endif;
			//endif;
		elseif($_FILES['file']['error'] !== UPLOAD_ERR_OK):
			$message['error'] = $this->getFileUploadErrorMessage($_FILES['file']);
		endif;
		echo json_encode($json_request);
	}
	
	public function removePageResource(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->input->post('resourceID') != FALSE):
			$this->load->model('page_resources');
			$resourcePath = getcwd().'/'.$this->page_resources->value($this->input->post('resourceID'),'resource');
			$this->page_resources->delete($this->input->post('resourceID'));
			$this->filedelete($resourcePath);
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function removePage(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE);
		$this->load->model(array('pages','page_resources'));
		if($page = $this->pages->getWhere($this->input->post('id'))):
			if($resources = $this->page_resources->getWhere(NULL,array('page_url'=>$page['page_url']),TRUE)):
				for($i=0;$i<count($resources);$i++):
					$this->filedelete($resources[$i]['resource']);
					$this->filedelete($resources[$i]['thumbnail']);
				endfor;
				$this->page_resources->delete(NULL,array('page_url'=>$page['page_url']));
			endif;
			$json_request['status'] = $this->pages->delete($this->input->post('id'));
		endif;
		echo json_encode($json_request);
	}
	
	public function pageCaptionSave(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE);
		if($this->postDataValidation('banner_caption')):
			$this->load->model('page_resources');
			$this->page_resources->updateField($_POST['id'],'caption',$_POST['caption']);
			$this->page_resources->updateField($_POST['id'],'number',$_POST['number']);
			$json_request['status'] = TRUE;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		
		echo json_encode($json_request);
	}
	
	private function ExecuteCreatingPage($post){
		
		$this->insertItem(array('insert'=>$post,'model'=>'pages'));
		return TRUE;
	}
	
	private function ExecuteUpdatingPage($id,$post){
		
		$post['id'] = $id;
		$this->updateItem(array('update'=>$post,'model'=>'pages'));
		return TRUE;
	}
	
	private function savePageResource($path,$resource,$thumbnail){
		
		$this->load->model('page_resources');
		$number = $this->page_resources->getNextNumber(array("page_url"=>$this->uri->segment(3)));
		$resourceData = array("page_url"=>$this->uri->segment(3),'number'=>$number+1,'thumbnail'=>$path.'/thumbnail/'.$thumbnail['file_name'],"resource"=>$path.'/'.$resource['file_name']);
		/**************************************************************************************************************/
		if($resourceID = $this->insertItem(array('insert'=>$resourceData,'model'=>'page_resources'))):
			$this->load->helper('string');
			$html = '<img class="img-rounded" src="'.base_url($resourceData['thumbnail']).'" alt="" />';
			$html .= '<a href="#" data-resource-id="'.$resourceID.'" class="delete-resource-item">&times;</a>';
			return $html;
		else:
			return '';
		endif;
	}
	/*********** banners **************/
	public function bannersUpload(){
		
		if($this->loginstatus === FALSE || !$this->input->get_request_header('X-file-name',TRUE)):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		$uploadPath = 'download/banners';
		if(isset($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK):
			if($this->imageResize($_FILES['file']['tmp_name'],'width',TRUE,899,282)):
				$uploadResult = $this->uploadSingleImage(getcwd().'/'.$uploadPath);
				if($uploadResult['status'] === TRUE && !empty($uploadResult['uploadData'])):
					if($this->imageResize($_FILES['file']['tmp_name'],'width',TRUE,225,70,TRUE)):
						$thumbNailUpload = $this->uploadSingleImage(getcwd().'/'.$uploadPath.'/thumbnail','thumb_'.$uploadResult['uploadData']['file_name']);
					endif;
					if($uploadResult['status'] == TRUE && $thumbNailUpload['status'] == TRUE):
						$json_request['status'] = TRUE;
						$json_request['responsePhotoSrc'] = $this->saveBannersResource($uploadPath,$uploadResult['uploadData'],$thumbNailUpload['uploadData']);
					else:
						$json_request['responseText'] = 'Ошибка при загрузке';
					endif;
				endif;
			endif;
		else:
			$json_request['status'] = FALSE;
			$json_request['responseText'] = $this->getFileUploadErrorMessage($_FILES['file']);
		endif;
		echo json_encode($json_request);
	}
	
	public function bannersRemove(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->input->post('resourceID') != FALSE):
			$this->load->model('banners');
			$resourcePath = getcwd().'/'.$this->banners->value($this->input->post('resourceID'),'resource');
			$thumbnailpath = getcwd().'/'.$this->banners->value($this->input->post('resourceID'),'thumbnail');
			$this->banners->delete($this->input->post('resourceID'));
			$this->filedelete($resourcePath);
			$this->filedelete($thumbnailpath);
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function bannersCaptionSave(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE);
		if($this->postDataValidation('banner_caption')):
			$this->load->model('banners');
			$this->banners->updateField($_POST['id'],'caption',$_POST['caption']);
			$this->banners->updateField($_POST['id'],'product',$_POST['product']);
			$this->banners->updateField($_POST['id'],'number',$_POST['number']);
			$json_request['status'] = TRUE;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		
		echo json_encode($json_request);
	}
	
	private function saveBannersResource($path,$resource,$thumbnail){
		
		$this->load->model('banners');
		$number = $this->banners->getNextNumber();
		$resourceData = array('number'=>$number+1,'thumbnail'=>$path.'/thumbnail/'.$thumbnail['file_name'],"resource"=>$path.'/'.$resource['file_name']);
		/**************************************************************************************************************/
		if($resourceID = $this->insertItem(array('insert'=>$resourceData,'model'=>'banners'))):
			$this->load->helper('string');
			$html = '<img class="img-rounded" src="'.base_url($resourceData['thumbnail']).'" alt="" />';
			$html .= '<a href="#" data-resource-id="'.$resourceID.'" class="delete-resource-item">&times;</a>';
			return $html;
		else:
			return '';
		endif;
	}
	/********** specialits ************/
	public function insertSpecialist(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('specialist')):
			if($spacialistID = $this->ExecuteInsertingSpecialist($_POST)):
				if(isset($_FILES['file']['tmp_name'])):
					$this->uploadSpecialistLogo($spacialistID);
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Cпециалист создан';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/specialists');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updateSpecialist(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('specialist')):
			if($this->ExecuteUpdatingSpecialist($this->input->get('id'),$_POST)):
				if(isset($_FILES['file']['tmp_name'])):
					$this->load->model('specialists');
					$oldImage = $this->specialists->value($this->input->get('id'),'logo');
					$this->filedelete(getcwd().'/'.$oldImage);
					$json_request['responsePhotoSrc'] = base_url($this->uploadSpecialistLogo($this->input->get('id')));
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Cпециалист cохранен';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/specialists');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removeSpecialist(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteSpecialist($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Cпециалист удален';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/specialists');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteInsertingSpecialist($post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		return $this->insertItem(array('insert'=>$post,'model'=>'specialists'));
		return TRUE;
	}
	
	private function ExecuteUpdatingSpecialist($id,$post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		$post['id'] = $id;
		$this->updateItem(array('update'=>$post,'model'=>'specialists'));
		return TRUE;
	}
	
	private function uploadSpecialistLogo($id){
		
		$responsePhotoSrc = '';
		if($this->CropToSquare(array('filepath'=>$_FILES['file']['tmp_name'],'edgeSize'=>189))):
			$resultUpload = $this->uploadSingleImage(getcwd().'/download');
			if($resultUpload['status'] == TRUE):
				$this->load->model('specialists');
				$responsePhotoSrc = 'download/'.$resultUpload['uploadData']['file_name'];
				$this->specialists->updateField($id,'logo',$responsePhotoSrc);
			endif;
		endif;
		return $responsePhotoSrc;
	}
	
	private function deleteSpecialist($id){
		
		$this->load->model('specialists');
		$logo = $this->specialists->getWhere($id);
		$this->filedelete(getcwd().'/'.$logo['logo']);
		return $this->specialists->delete($id);
	}
	/********** reviews ************/
	public function insertReviews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('reviews')):
			if($spacialistID = $this->ExecuteInsertingReviews($_POST)):
				if(isset($_FILES['file']['tmp_name'])):
					$this->uploadReviewsLogo($spacialistID);
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Отзыв создан';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/reviews');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updateReviews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('reviews')):
			if($this->ExecuteUpdatingReviews($this->input->get('id'),$_POST)):
				if($this->input->post('delete_image') !== FALSE):
					$this->remoteReviewLogo($this->input->get('id'));
				else:
					if(isset($_FILES['file']['tmp_name'])):
						$this->load->model('reviews');
						$oldImage = $this->reviews->value($this->input->get('id'),'logo');
						$this->filedelete(getcwd().'/'.$oldImage);
						$json_request['responsePhotoSrc'] = base_url($this->uploadReviewsLogo($this->input->get('id')));
					endif;
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Отзыв cохранен';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/reviews');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removeReviews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteReviews($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Отзыв удален';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/reviews');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteInsertingReviews($post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		return $this->insertItem(array('insert'=>$post,'model'=>'reviews'));
		return TRUE;
	}
	
	private function ExecuteUpdatingReviews($id,$post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		if(isset($post['delete_image'])):
			unset($post['delete_image']);
		endif;
		$post['id'] = $id;
		$this->updateItem(array('update'=>$post,'model'=>'reviews'));
		return TRUE;
	}
	
	private function uploadReviewsLogo($id){
		
		$responsePhotoSrc = '';
		$this->imageManupulation($_FILES['file']['tmp_name'],'width',TRUE,189,189);
		$resultUpload = $this->uploadSingleImage(getcwd().'/download');
		if($resultUpload['status'] == TRUE):
			$this->load->model('reviews');
			$responsePhotoSrc = 'download/'.$resultUpload['uploadData']['file_name'];
			$this->reviews->updateField($id,'logo',$responsePhotoSrc);
		endif;
		return $responsePhotoSrc;
	}
	
	private function remoteReviewLogo($reviewID){
		
		$this->load->model('reviews');
		$filePath = getcwd().'/'.$this->reviews->value($reviewID,'logo');
		if(file_exists($filePath)):
			$this->filedelete($filePath);
			$this->reviews->updateField($reviewID,'logo','');
			return TRUE;
		endif;
		return FALSE;
	}
	
	private function deleteReviews($id){
		
		$this->load->model('reviews');
		$logo = $this->reviews->getWhere($id);
		$this->filedelete(getcwd().'/'.$logo['logo']);
		return $this->reviews->delete($id);
	}
	/********** vacancies ************/
	public function insertVacancies(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('vacancies')):
			if($spacialistID = $this->ExecuteInsertingVacancies($_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Вакансия создан';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/vacancies');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updateVacancies(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('vacancies')):
			if($this->ExecuteUpdatingVacancies($this->input->get('id'),$_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Вакансия cохранена';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/vacancies');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removeVacancies(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteVacancies($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Вакансия удалена';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/vacancies');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteInsertingVacancies($post){
		
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		return $this->insertItem(array('insert'=>$post,'model'=>'vacancies'));
		return TRUE;
	}
	
	private function ExecuteUpdatingVacancies($id,$post){
		
		$post['id'] = $id;
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		$this->updateItem(array('update'=>$post,'model'=>'vacancies'));
		return TRUE;
	}
	
	private function deleteVacancies($id){
		
		$this->load->model('vacancies');
		return $this->vacancies->delete($id);
	}
	/********** tara ************/
	public function insertVolume(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('volume')):
			if($spacialistID = $this->ExecuteInsertingVolume($_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Вес, объем cохранен';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/volumes?tara='.$this->input->post('tara'));
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updateVolume(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('volume')):
			if($this->ExecuteUpdatingVolume($this->input->get('id'),$_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Вес, объем cохранен';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/volumes?tara='.$this->input->post('tara'));
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removeVolume(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteVolume($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Вес, объем удален';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/volumes');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteInsertingVolume($post){
		
		return $this->insertItem(array('insert'=>$post,'model'=>'volumes'));
		return TRUE;
	}
	
	private function ExecuteUpdatingVolume($id,$post){
		
		$post['id'] = $id;
		$this->updateItem(array('update'=>$post,'model'=>'volumes'));
		return TRUE;
	}
	
	private function deleteVolume($id){
		
		$this->load->model('volumes');
		return $this->volumes->delete($id);
	}
	/********** where2buy ************/
	public function insertWhere2buy(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('where2buy')):
			if($spacialistID = $this->ExecuteInsertingWhere2buy($_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Адрес добавлен';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/where2buy');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updateWhere2buy(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('where2buy')):
			if($this->ExecuteUpdatingWere2buy($this->input->get('id'),$_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Адрес cохранен';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/where2buy');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removeWhere2buy(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteWhere2buy($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Адрес удален';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/where2buy');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteInsertingWhere2buy($post){
		
		return $this->insertItem(array('insert'=>$post,'model'=>'where2buy'));
		return TRUE;
	}
	
	private function ExecuteUpdatingWere2buy($id,$post){
		
		$post['id'] = $id;
		$this->updateItem(array('update'=>$post,'model'=>'where2buy'));
		return TRUE;
	}
	
	private function deleteWhere2buy($id){
		
		$this->load->model('where2buy');
		return $this->where2buy->delete($id);
	}
	/********** press-centr ************/
	public function insertPressCentr(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('press_centr')):
			if($eventID = $this->ExecuteInsertingEvent($_POST)):
				if(isset($_FILES['file']['tmp_name'])):
					$this->uploadEventsLogo($eventID);
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Событие создано';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/press-centr/add?mode=images&id='.$eventID);
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updatePressCentr(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('press_centr')):
			if($this->ExecuteUpdatingEvent($this->input->get('id'),$_POST)):
				if(isset($_FILES['file']['tmp_name'])):
					$this->load->model('press_centr');
					$oldImage = $this->press_centr->value($this->input->get('id'),'logo');
					$this->filedelete(getcwd().'/'.$oldImage);
					$json_request['responsePhotoSrc'] = base_url($this->uploadEventsLogo($this->input->get('id')));
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Событие cохранено';
				$json_request['redirect'] = FALSE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removePressCentr(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deletePressCentr($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Событие удалено';
			$json_request['redirect'] = FALSE;
		endif;
		echo json_encode($json_request);
	}
	
	public function eventResourceUpload(){
		
		if($this->loginstatus === FALSE || !$this->input->get_request_header('X-file-name',TRUE)):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		$uploadPath = 'download/events';
		if(isset($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK):
			if($this->imageResize($_FILES['file']['tmp_name'])):
				$uploadResult = $this->uploadSingleImage(getcwd().'/'.$uploadPath);
				if($uploadResult['status'] === TRUE && !empty($uploadResult['uploadData'])):
					if($this->imageResize($_FILES['file']['tmp_name'],'width',TRUE,140,140,TRUE)):
						$thumbNailUpload = $this->uploadSingleImage(getcwd().'/'.$uploadPath.'/thumbnail','thumb_'.$uploadResult['uploadData']['file_name']);
					endif;
					if($uploadResult['status'] == TRUE && $thumbNailUpload['status'] == TRUE):
						$json_request['status'] = TRUE;
						$json_request['responsePhotoSrc'] = $this->saveEventResource($uploadPath,$uploadResult['uploadData'],$thumbNailUpload['uploadData']);
					else:
						$json_request['responseText'] = 'Ошибка при загрузке';
					endif;
				endif;
			endif;
		else:
			$json_request['status'] = FALSE;
			$json_request['responseText'] = $this->getFileUploadErrorMessage($_FILES['file']);
		endif;
		echo json_encode($json_request);
	}
	
	public function eventResourceRemove(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->input->post('resourceID') != FALSE):
			$this->load->model('press_centr_resources');
			$resourcePath = getcwd().'/'.$this->press_centr_resources->value($this->input->post('resourceID'),'resource');
			$thumbnailpath = getcwd().'/'.$this->press_centr_resources->value($this->input->post('resourceID'),'thumbnail');
			$this->press_centr_resources->delete($this->input->post('resourceID'));
			$this->filedelete($resourcePath);
			$this->filedelete($thumbnailpath);
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function eventCaptionSave(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE);
		if($this->postDataValidation('image_caption')):
			$this->load->model('press_centr_resources');
			$this->press_centr_resources->updateField($_POST['id'],'caption',$_POST['caption']);
			$this->press_centr_resources->updateField($_POST['id'],'number',$_POST['number']);
			$json_request['status'] = TRUE;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		
		echo json_encode($json_request);
	}
	
	private function saveEventResource($path,$resource,$thumbnail){
		
		$this->load->model('press_centr_resources');
		$number = $this->press_centr_resources->getNextNumber(array('publication'=>$this->input->get('id')));
		$resourceData = array('number'=>$number+1,'publication'=>$this->input->get('id'),'thumbnail'=>$path.'/thumbnail/'.$thumbnail['file_name'],"resource"=>$path.'/'.$resource['file_name']);
		/**************************************************************************************************************/
		if($resourceID = $this->insertItem(array('insert'=>$resourceData,'model'=>'press_centr_resources'))):
			$this->load->helper('string');
			$html = '<img class="img-rounded" src="'.base_url($resourceData['thumbnail']).'" alt="" />';
			$html .= '<a href="#" data-resource-id="'.$resourceID.'" class="delete-resource-item">&times;</a>';
			return $html;
		else:
			return '';
		endif;
	}
	
	private function ExecuteInsertingEvent($post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		if(!empty($post['date'])):
			$post['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']);
		endif;
		return $this->insertItem(array('insert'=>$post,'model'=>'press_centr'));
		return TRUE;
	}
	
	private function ExecuteUpdatingEvent($id,$post){
		
		$post['id'] = $id;
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		if(!empty($post['date'])):
			$post['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']);
		endif;
		$this->updateItem(array('update'=>$post,'model'=>'press_centr'));
		return TRUE;
	}
	
	private function deletePressCentr($id){
		
		if($this->input->post('id') !== FALSE):
			$this->load->model(array('press_centr_resources','press_centr'));
			$resources = $this->press_centr_resources->getWhere(NULL,array('publication'=>$this->input->post('id')),TRUE);
			for($i=0;$i<count($resources);$i++):
				$resourcePath = getcwd().'/'.$resources[$i]['resource'];
				$thumbnailPath = getcwd().'/'.$resources[$i]['thumbnail'];
				$this->filedelete($resourcePath);
				$this->filedelete($thumbnailPath);
			endfor;
			$this->press_centr_resources->delete(NULL,array('publication'=>$this->input->post('id')));
			return $this->press_centr->delete($this->input->post('id'));
		endif;
		return FALSE;
	}
	
	private function uploadEventsLogo($id){
		
		$responsePhotoSrc = '';
		if($this->CropToSquare(array('filepath'=>$_FILES['file']['tmp_name'],'edgeSize'=>120))):
			$resultUpload = $this->uploadSingleImage(getcwd().'/download');
			if($resultUpload['status'] == TRUE):
				$this->load->model('press_centr');
				$responsePhotoSrc = 'download/'.$resultUpload['uploadData']['file_name'];
				$this->press_centr->updateField($id,'logo',$responsePhotoSrc);
			endif;
		endif;
		return $responsePhotoSrc;
		
	}
	/*********** contact ************/
	public function updateContact(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('contacts')):
			if($this->ExecuteUpdatingContacts($this->input->get('id'),$_POST)):
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Контакты cохранены';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/contacts');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteUpdatingContacts($id,$post){
		
		$post['id'] = $id;
		$this->updateItem(array('update'=>$post,'model'=>'contacts'));
		return TRUE;
	}
	/********** categories ************/
	public function updateCategory(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('category') === FALSE):
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены обязательные поля'),TRUE);
			echo json_encode($json_request);
			return FALSE;
		endif;
		if($this->ExecuteUpdatingCategory($this->input->get('id'),$_POST)):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Категория cохранена';
			$this->load->model('categories');
			$typeCategory = $this->categories->value($this->input->get('id'),'sub_category');
			if($typeCategory == 1):
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/sub-categories');
			else:
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/categories');
			endif;
			
		endif;
		echo json_encode($json_request);
	}
	
	public function removeCategory(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteCategory($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Категория удалена';
			$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/categories');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteUpdatingCategory($id,$post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		$post['id'] = $id;
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		$this->updateItem(array('update'=>$post,'model'=>'categories'));
		return TRUE;
	}
	/********** products ************/
	public function loadCatalogProducts(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->postDataValidation('categoryID')):
			$this->load->model(array('products','categories'));
			$pagevar = array(
				'categoryTitle' => $this->categories->value($this->input->post('category'),'title'),
				'products' => $this->products->getWhere(NULL,array('category'=>$this->input->post('category')),TRUE)
			);
			$pagevar['products'] = $this->getProductCategories($pagevar['products']);
			for($i=0;$i<count($pagevar['products']);$i++):
				$pagevar['products'][$i]['sizes'] = $this->getProductSizes($pagevar['products'][$i]['size']);
				$pagevar['products'][$i]['tara'] = $this->getProductTara($pagevar['products'][$i]['sizes']);
			endfor;
			$json_request['responseText'] = $this->load->view('html/catalog-products',$pagevar,TRUE);
			$json_request['status'] = TRUE;
		else:
			$json_request['status'] = FALSE;
		endif;
		echo json_encode($json_request);
	}

	public function addProductBid(){

        if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responseProduct'=>'','responseCount'=>0,'product_exist'=>FALSE,'product_exist_number'=>0,'product_exist_count'=>0);
		if($this->postDataValidation('order_product')):
			$this->load->model(array('products','categories'));
			if($product = $this->products->getWhere($this->input->post('product'))):
				$orderList = array();
				if($this->session->userdata('order_list') !== FALSE):
					$orderList = json_decode($this->session->userdata('order_list'),TRUE);
				endif;
				$productExist = FALSE;
				$productExistIndex = FALSE;
				for($i=0;$i<count($orderList);$i++):
					if($orderList[$i]['id'] == $this->input->post('product') && $orderList[$i]['product_size'] == $this->input->post('size')):
						$productExist = TRUE;
						$productExistIndex = $i;
						break;
					endif;
				endfor;
				if($productExist == FALSE):
					$newOrder['id'] = $product['id'];
					$newOrder['page_title'] = $product['page_title'];
					$newOrder['title'] = $product['title'];
					$newOrder['size'] = $product['size'];
					$newOrder['logo'] = $product['logo'];
					$newOrder['product_size'] = $this->input->post('size');
					$newOrder['product_count'] = $this->input->post('count');
					$newOrder['number'] = count($orderList);
					$newOrder['page_url'] = $product['page_url'];
					$newOrder['category_url'] = $this->categories->value($this->input->post('category'),'page_url');
					$orderList[] = $newOrder;
					$newOrder['sizes'] = $this->getProductSizes($newOrder['size']);
					$newOrder['tara'] = $this->getProductTara($newOrder['sizes']);
					$json_request['responseProduct'] = $this->load->view('html/order-product',array('productLi'=>$newOrder),TRUE);
				else:
					$orderList[$productExistIndex]['product_count'] += $this->input->post('count');
					$json_request['product_exist_count'] = $orderList[$productExistIndex]['product_count'];
					$json_request['product_exist'] = TRUE;
					$json_request['product_exist_number'] = $orderList[$productExistIndex]['number'];
				endif;
				$this->session->set_userdata('order_list',json_encode($orderList));
				$json_request['responseCount'] = count($orderList);
				$json_request['status'] = TRUE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
			print_r($json_request['responseText']);exit;
		endif;
		echo json_encode($json_request);
	}
	
	public function removeProductBid(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responseProduct'=>'','responseCount'=>0);
		if($this->postDataValidation('order_number')):
			$newOrderList = array();
			if($this->session->userdata('order_list') !== FALSE):
				$orderList = json_decode($this->session->userdata('order_list'),TRUE);
				for($i=0;$i<count($orderList);$i++):
					if($orderList[$i]['number'] != $this->input->post('order_number')):
						$newOrderList[] = $orderList[$i];
					endif;
				endfor;
				if(empty($newOrderList) === FALSE):
					$this->session->set_userdata('order_list',json_encode($newOrderList));
					$json_request['responseCount'] = count($newOrderList);
				else:
					$this->session->unset_userdata('order_list');
				endif;
				$json_request['status'] = TRUE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function changeProductSizeBid(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responseProduct'=>'','responseCount'=>0);
		if($this->postDataValidation('order_number_size')):
			if($this->session->userdata('order_list') !== FALSE):
				$orderList = json_decode($this->session->userdata('order_list'),TRUE);
				for($i=0;$i<count($orderList);$i++):
					if($orderList[$i]['number'] == $this->input->post('order_number')):
						$orderList[$i]['product_size'] = $this->input->post('size');
					endif;
				endfor;
				$this->session->set_userdata('order_list',json_encode($orderList));
				$json_request['status'] = TRUE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function changeProductCountBid(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responseProduct'=>'','responseCount'=>0);
		if($this->postDataValidation('order_number_count')):
			if($this->session->userdata('order_list') !== FALSE):
				$orderList = json_decode($this->session->userdata('order_list'),TRUE);
				for($i=0;$i<count($orderList);$i++):
					if($orderList[$i]['number'] == $this->input->post('order_number')):
						$orderList[$i]['product_count'] = $this->input->post('count');
					endif;
				endfor;
				$this->session->set_userdata('order_list',json_encode($orderList));
				$json_request['status'] = TRUE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function insertProduct(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('products')):
			if($productID = $this->ExecuteInsertingProduct($this->input->post())):
				$this->setKeyWords($productID,$this->input->post('keywords'));
				$this->setProductCategories($productID,$this->input->post('category'));
				$this->setProductCategories($productID,$this->input->post('sub_category'),1);
				if(isset($_FILES['file']['tmp_name'])):
					$this->uploadProductLogo($productID);
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Продукт создан';
				$json_request['redirect'] = site_url(ADMIN_START_PAGE.'/products/add?mode=images&id='.$productID);
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function updateProduct(){
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'','redirect'=>site_url(ADMIN_START_PAGE));
		if($this->postDataValidation('products')):
			if($this->ExecuteUpdatingProduct($this->input->get('id'),$_POST)):
				$this->deleteKeyWords($this->input->get('id'));
				$this->setKeyWords($this->input->get('id'),$this->input->post('keywords'));
				$this->setProductCategories($this->input->get('id'),$this->input->post('category'));
				$this->setProductCategories($this->input->get('id'),$this->input->post('sub_category'),1);
				if(isset($_FILES['file']['tmp_name'])):
					$this->load->model('products');
					$oldImage = $this->products->value($this->input->get('id'),'logo');
					$this->filedelete(getcwd().'/'.$oldImage);
					$json_request['responsePhotoSrc'] = base_url($this->uploadProductLogo($this->input->get('id')));
				endif;
				$json_request['status'] = TRUE;
				$json_request['responseText'] = 'Продукт cохранен';
				$json_request['redirect'] = FALSE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function removeProduct(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->deleteProduct($this->input->post('id'))):
			$json_request['status'] = TRUE;
			$json_request['responseText'] = 'Продукт удален';
			$json_request['redirect'] = FALSE;
		endif;
		echo json_encode($json_request);
	}
	
	public function productResourceUpload(){
		
		if($this->loginstatus === FALSE || !$this->input->get_request_header('X-file-name',TRUE)):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		$uploadPath = 'download/products';
		if(isset($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK):
			if($this->imageResize($_FILES['file']['tmp_name'])):
				$uploadResult = $this->uploadSingleImage(getcwd().'/'.$uploadPath);
				if($uploadResult['status'] === TRUE && !empty($uploadResult['uploadData'])):
					if($this->imageResize($_FILES['file']['tmp_name'],NULL,TRUE,256,256,TRUE)):
						$thumbNailUpload = $this->uploadSingleImage(getcwd().'/'.$uploadPath.'/thumbnail','thumb_'.$uploadResult['uploadData']['file_name']);
					endif;
					if($uploadResult['status'] == TRUE && $thumbNailUpload['status'] == TRUE):
						$json_request['status'] = TRUE;
						$json_request['responsePhotoSrc'] = $this->saveProuctResource($uploadPath,$uploadResult['uploadData'],$thumbNailUpload['uploadData']);
					else:
						$json_request['responseText'] = 'Ошибка при загрузке';
					endif;
				endif;
			endif;
		else:
			$json_request['status'] = FALSE;
			$json_request['responseText'] = $this->getFileUploadErrorMessage($_FILES['file']);
		endif;
		echo json_encode($json_request);
	}
	
	public function productResourceRemove(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->input->post('resourceID') != FALSE):
			$this->load->model('products_resources');
			$resourcePath = getcwd().'/'.$this->products_resources->value($this->input->post('resourceID'),'resource');
			$thumbnailpath = getcwd().'/'.$this->products_resources->value($this->input->post('resourceID'),'thumbnail');
			$this->products_resources->delete($this->input->post('resourceID'));
			$this->filedelete($resourcePath);
			$this->filedelete($thumbnailpath);
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function productCaptionSave(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE);
		if($this->postDataValidation('image_caption')):
			$this->load->model('products_resources');
			$this->products_resources->updateField($_POST['id'],'caption',$_POST['caption']);
			$this->products_resources->updateField($_POST['id'],'number',$_POST['number']);
			$json_request['status'] = TRUE;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		
		echo json_encode($json_request);
	}
	
	private function saveProuctResource($path,$resource,$thumbnail){
		
		$this->load->model('products_resources');
		$number = $this->products_resources->getNextNumber(array('product'=>$this->input->get('id')));
		$resourceData = array('number'=>$number+1,'product'=>$this->input->get('id'),'thumbnail'=>$path.'/thumbnail/'.$thumbnail['file_name'],"resource"=>$path.'/'.$resource['file_name']);
		/**************************************************************************************************************/
		if($resourceID = $this->insertItem(array('insert'=>$resourceData,'model'=>'products_resources'))):
			$this->load->helper('string');
			$html = '<img class="img-rounded" src="'.base_url($resourceData['thumbnail']).'" alt="" />';
			$html .= '<a href="#" data-resource-id="'.$resourceID.'" class="delete-resource-item">&times;</a>';
			return $html;
		else:
			return '';
		endif;
	}
	
	private function ExecuteInsertingProduct($post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		unset($post['keywords']);unset($post['category']);unset($post['sub_category']);
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		if(!isset($post['size']) || empty($post['size'])):
			$post['size'] = '';
		else:
			$post['size'] = json_encode($post['size']);
		endif;
		if(!isset($post['similar']) || empty($post['similar'])):
			$post['similar'] = '';
		else:
			$post['similar'] = json_encode($post['similar']);
		endif;
		return $this->insertItem(array('insert'=>$post,'model'=>'products'));
	}
	
	private function ExecuteUpdatingProduct($productID,$post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		unset($post['keywords']);unset($post['category']);unset($post['sub_category']);
		if(empty($post['page_url'])):
			$post['page_url'] = $this->translite($post['title']);
		endif;
		if(!isset($post['size']) || empty($post['size'])):
			$post['size'] = '';
		else:
			$post['size'] = json_encode($post['size']);
		endif;
		if(!isset($post['similar']) || empty($post['similar'])):
			$post['similar'] = '';
		else:
			$post['similar'] = json_encode($post['similar']);
		endif;
		$post['id'] = $productID;
		$this->updateItem(array('update'=>$post,'model'=>'products'));
		return TRUE;
	}
	
	private function deleteProduct($id){
		
		if($this->input->post('id') !== FALSE):
			$this->load->model(array('products_resources','products'));
			$resources = $this->products_resources->getWhere(NULL,array('product'=>$this->input->post('id')),TRUE);
			for($i=0;$i<count($resources);$i++):
				$resourcePath = getcwd().'/'.$resources[$i]['resource'];
				$thumbnailPath = getcwd().'/'.$resources[$i]['thumbnail'];
				$this->filedelete($resourcePath);
				$this->filedelete($thumbnailPath);
			endfor;
			$this->products_resources->delete(NULL,array('product'=>$this->input->post('id')));
			$this->deleteKeyWords($this->input->post('id'));
			return $this->products->delete($this->input->post('id'));
		endif;
		return FALSE;
	}
	
	private function uploadProductLogo($id){
		
		$responsePhotoSrc = '';
		if($this->CropToSquare(array('filepath'=>$_FILES['file']['tmp_name'],'edgeSize'=>165))):
			$resultUpload = $this->uploadSingleImage(getcwd().'/download/products');
			if($resultUpload['status'] == TRUE):
				$this->load->model('products');
				$responsePhotoSrc = 'download/products/'.$resultUpload['uploadData']['file_name'];
				$this->products->updateField($id,'logo',$responsePhotoSrc);
			endif;
		endif;
		return $responsePhotoSrc;
		
	}

	private function setKeyWords($productID,$keywords = NULL){
		
		if(!is_null($keywords) && !empty($keywords)):
			if($KeyWordsList = explode(',',$keywords)):
				$this->load->model(array('keywords','matching'));
				for($i=0;$i<count($KeyWordsList);$i++):
					if(!empty($KeyWordsList[$i])):
						$insert_word = array('word'=>trim($KeyWordsList[$i]),'word_hash'=>md5(trim($KeyWordsList[$i])));
						if(!$wordID = $this->keywords->search('word_hash',$insert_word['word_hash'])):
							if($wordID = $this->insertItem(array('insert'=>$insert_word,'model'=>'keywords'))):
								$insert_match = array('word'=>$wordID,'product'=>$productID);
								$matchID = $this->insertItem(array('insert'=>$insert_match,'model'=>'matching'));
							endif;
						elseif(!$this->matching->getWhere(NULL,array('word'=>$wordID,'product'=>$productID))):
							$insert_match = array('word'=>$wordID,'product'=>$productID);
							$matchID = $this->insertItem(array('insert'=>$insert_match,'model'=>'matching'));
						endif;
					endif;
				endfor;
			endif;
		endif;
	}
	
	private function deleteKeyWords($productID = NULL){
		
		$this->load->model('matching');
		$this->matching->delete(NULL,array('product'=>$productID));
	}

	private function setProductCategories($productID,$categories,$subCategory = 0){
		
		$this->load->model('product_categories');
		$this->product_categories->delete(NULL,array('product'=>$productID,'sub_category'=>$subCategory));
		if(!empty($categories)):
			$productCategories = array();
			for($i=0;$i<count($categories);$i++):
				$productCategories[] = array("product"=>$productID,"category"=>$categories[$i],'sub_category'=>$subCategory);
			endfor;
			$this->product_categories->multiInsertRecords($productCategories);
		endif;
		return TRUE;
	}
}
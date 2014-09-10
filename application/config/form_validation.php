<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	$config = array(
		'signin' =>array(
			array('field'=>'login','label'=>'Логин','rules'=>'required|trim'),
			array('field'=>'password','label'=>'Пароль','rules'=>'required|trim')
		),
		'category' =>array(
			array('field'=>'title','label'=>'Название','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'description','label'=>'Описание','rules'=>'trim|xss_clean'),
			array('field'=>'page_url','label'=>'URL','rules'=>'alpha_dash|trim'),
		),
		'password' =>array(
			array('field'=>'oldpassword','label'=>'Cтарый пароль','rules'=>'required|min_length[6]|trim'),
			array('field'=>'password','label'=>'Новый пароль','rules'=>'required|min_length[6]|trim'),
			array('field'=>'confirm','label'=>'Повтор пароля','rules'=>'required|min_length[6]|matches[password]|trim')
		),
		'categoryID' =>array(
			array('field'=>'category','label'=>'ID','rules'=>'required|trim|numeric'),
		),
		'order_number' =>array(
			array('field'=>'order_number','label'=>'ID','rules'=>'required|trim|numeric'),
		),
		'order_number_size' =>array(
			array('field'=>'order_number','label'=>'ID','rules'=>'required|trim|numeric'),
			array('field'=>'size','label'=>'Size','rules'=>'required|trim|numeric'),
		),
		'order_number_count' =>array(
			array('field'=>'order_number','label'=>'ID','rules'=>'required|trim|numeric'),
			array('field'=>'count','label'=>'Count','rules'=>'required|trim|numeric'),
		),
		'order_product' =>array(
			array('field'=>'product','label'=>'ID','rules'=>'required|trim|numeric'),
			array('field'=>'size','label'=>'Size','rules'=>'required|trim|numeric'),
			array('field'=>'count','label'=>'Count','rules'=>'required|trim|numeric'),
		),
		'specialist' =>array(
			array('field'=>'name','label'=>'Имя','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'position','label'=>'Должность','rules'=>'trim|xss_clean'),
			array('field'=>'content','label'=>'Описание','rules'=>'required|xss_clean|trim'),
		),
		'volume' =>array(
			array('field'=>'title','label'=>'Вес, объем','rules'=>'required|trim|xss_clean'),
			array('field'=>'tara','label'=>'Тара','rules'=>'required|numeric|trim'),
		),
		'reviews' =>array(
			array('field'=>'name','label'=>'Имя','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'city','label'=>'Город','rules'=>'trim|xss_clean'),
			array('field'=>'content','label'=>'Описание','rules'=>'required|xss_clean|trim'),
		),
		'where2buy' =>array(
			array('field'=>'city','label'=>'Город','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'address','label'=>'Описание','rules'=>'xss_clean|trim'),
		),
		'press_centr' =>array(
			array('field'=>'page_title','label'=>'Page Title','rules'=>'trim|xss_clean'),
			array('field'=>'page_description','label'=>'Page Description','rules'=>'trim|xss_clean'),
			array('field'=>'title','label'=>'Название','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'date','label'=>'Дата публикации','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'page_url','label'=>'URL страницы','rules'=>'trim|alpha_dash'),
			array('field'=>'anonce','label'=>'Анонс','rules'=>'trim|xss_clean'),
			array('field'=>'content','label'=>'Контент','rules'=>'trim|xss_clean'),
		),
		'products' =>array(
			array('field'=>'page_title','label'=>'Page Title','rules'=>'trim|xss_clean'),
			array('field'=>'page_description','label'=>'Page Description','rules'=>'trim'),
			array('field'=>'page_h1','label'=>'Page H1','rules'=>'trim|xss_clean'),
			array('field'=>'page_url','label'=>'URL страницы','rules'=>'trim|alpha_dash'),
			array('field'=>'title','label'=>'Название','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'destination','label'=>'Назначение','rules'=>'trim'),
			array('field'=>'description','label'=>'Описание','rules'=>'trim'),
			array('field'=>'advantages','label'=>'Описание','rules'=>'trim'),
			array('field'=>'applying','label'=>'Описание','rules'=>'trim'),
		),
		'vacancies' =>array(
			array('field'=>'page_title','label'=>'Page Title','rules'=>'trim|xss_clean'),
			array('field'=>'page_description','label'=>'Page Description','rules'=>'trim|xss_clean'),
			array('field'=>'title','label'=>'Название','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'salary','label'=>'Оплата','rules'=>'trim|htmlspecialchars'),
			array('field'=>'page_url','label'=>'URL страницы','rules'=>'trim|alpha_dash'),
			array('field'=>'сonditions','label'=>'Условия','rules'=>'trim|xss_clean'),
			array('field'=>'responsibility','label'=>'Обязанности','rules'=>'trim|xss_clean'),
			array('field'=>'requirements','label'=>'Требования','rules'=>'trim|xss_clean'),
		),
		'contacts' =>array(
			array('field'=>'address','label'=>'Адрес','rules'=>'xss_clean|trim'),
			array('field'=>'phones','label'=>'Телефоны','rules'=>'xss_clean|trim'),
			array('field'=>'emails','label'=>'Телефоны','rules'=>'xss_clean|trim'),
		),
		'banner_caption' =>array(
			array('field'=>'id','label'=>'ID','rules'=>'required|trim|numeric'),
			array('field'=>'caption','label'=>'Подпись','rules'=>'trim|xss_clean'),
			array('field'=>'product','label'=>'Ссылка на товар','rules'=>'trim|xss_clean'),
			array('field'=>'number','label'=>'Number','rules'=>'trim|numeric'),
		),
		'image_caption' =>array(
			array('field'=>'id','label'=>'ID','rules'=>'required|trim|numeric'),
			array('field'=>'caption','label'=>'Caption','rules'=>'trim|xss_clean'),
			array('field'=>'number','label'=>'Number','rules'=>'trim|numeric'),
		),
		'page' =>array(
			array('field'=>'title','label'=>'Название','rules'=>'required|trim|htmlspecialchars'),
			array('field'=>'page_url','label'=>'URL страницы','rules'=>'required|trim|alpha_dash'),
		),
		'call_order' =>array(
			array('field'=>'fio','label'=>'ФИО','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'phone','label'=>'Email','rules'=>'required|trim|xss_clean'),
			array('field'=>'time','label'=>'Удобное время','rules'=>'trim|xss_clean'),
		),
		'call_consultation' =>array(
			array('field'=>'fio','label'=>'ФИО','rules'=>'trim|htmlspecialchars|xss_clean'),
			array('field'=>'email','label'=>'Email','rules'=>'required|valid_email|trim|xss_clean'),
			array('field'=>'message','label'=>'Сообщение','rules'=>'trim|xss_clean'),
		),
		'call_potion' =>array(
			array('field'=>'fio','label'=>'ФИО','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'email','label'=>'Email','rules'=>'required|trim|xss_clean'),
			array('field'=>'message','label'=>'Требования к средству','rules'=>'trim|xss_clean'),
		),
		'call_order_products' =>array(
			array('field'=>'fio','label'=>'ФИО','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'email','label'=>'Email','rules'=>'valid_email|trim|xss_clean'),
			array('field'=>'phone','label'=>'Телефон','rules'=>'required|trim|xss_clean'),
			array('field'=>'city','label'=>'Город','rules'=>'required|trim|xss_clean'),
		),
		'response_vacancy' =>array(
			array('field'=>'vacancy','label'=>'ID','rules'=>'required|trim|integer'),
			array('field'=>'fio','label'=>'ФИО','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'email','label'=>'Email','rules'=>'valid_email|trim|xss_clean'),
			array('field'=>'phone','label'=>'Телефон','rules'=>'required|trim|xss_clean'),
			array('field'=>'message','label'=>'О себе','rules'=>'trim|xss_clean'),
		),
	);
?>
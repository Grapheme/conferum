<?php
if(!isset($page_content['page_title'])) $page_content['page_title'] = '';
if(!isset($page_content['page_description'])) $page_content['page_description'] = '';
if(!isset($page_content['page_keywords'])) $page_content['page_keywords'] = '';
?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?=$page_content['page_title'];?></title>
<meta name="description" content="<?=$page_content['page_description'];?>" />
<meta name="keywords" content="<?=$page_content['page_keywords'];?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name = "format-detection" content = "telephone=no" />

<!-- Open Graph Meta Data -->
<meta property="og:description" content="<?=$page_content['page_description'];?>">
<meta property="og:site_name" content="Конферум"/>
<meta property="og:title" content="<?=$page_content['page_title'];?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"/>

<link rel="stylesheet" href="<?=base_url('css/bootstrap.css');?>" />
<link rel="stylesheet" href="<?=base_url('css/normalize.css');?>" />
<link rel="shortcut icon" href="<?=base_url('favicon.ico');?>" />
<link rel="stylesheet" href="<?=base_url('css/fonts.css');?>" />
<link rel="stylesheet" href="<?=base_url('css/main.css');?>" />
<link rel="stylesheet" href="<?=base_url('css/discus.css')?>" />
<script src="<?=base_url('js/vendor/modernizr-2.6.2.min.js');?>"></script>
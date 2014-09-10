<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "guests_interface";
$route['404_override'] = '';

/***************************************************** GENERAL INTRERFACE *************************************************/
$route['login'] = "general_interface/signIN";
$route['login-in'] = "general_interface/loginIn";
$route['log-off'] = "general_interface/logoff";
$route['redactor/upload'] = "general_interface/redactorUploadImage";
$route['redactor/get-uploaded-images'] = "general_interface/redactorUploadedImages";


$route['product-url-generate'] = "general_interface/generateProductURL";
/*************************************************** AJAX INTRERFACE ***********************************************/
$route['order-products'] = "ajax_interface/orderProducts";
$route['send-response-vacancy'] = "ajax_interface/responseVacancy";

$route['consultation-call'] = "ajax_interface/consultationCall";
$route['order-a-call'] = "ajax_interface/orderACall";
$route['order-a-potion'] = "ajax_interface/orderAPotion";
/****************** pages ********************/
$route['page/remove'] = "ajax_interface/removePage";

$route[ADMIN_START_PAGE.'/page/insert'] = "ajax_interface/insertPage";
$route[ADMIN_START_PAGE.'/page/:any/update'] = "ajax_interface/updatePage";
$route[ADMIN_START_PAGE.'/pages/:any/upload/resource'] = "ajax_interface/pageUploadResources";
$route[ADMIN_START_PAGE.'/page/remove/resource'] = "ajax_interface/removePageResource";
$route[ADMIN_START_PAGE.'/page/caption/resource'] = "ajax_interface/pageCaptionSave";
/****************** banners *******************/
$route[ADMIN_START_PAGE.'/banners/upload/resource'] = "ajax_interface/bannersUpload";
$route[ADMIN_START_PAGE.'/banners/remove/resource'] = "ajax_interface/bannersRemove";
$route[ADMIN_START_PAGE.'/banners/caption/resource'] = "ajax_interface/bannersCaptionSave";
/**************** categories ******************/
$route[ADMIN_START_PAGE.'/volume/insert'] = "ajax_interface/insertVolume";
$route[ADMIN_START_PAGE.'/volume/update'] = "ajax_interface/updateVolume";
$route[ADMIN_START_PAGE.'/volume/remove'] = "ajax_interface/removeVolume";
/**************** categories ******************/
$route[ADMIN_START_PAGE.'/category/insert'] = "ajax_interface/insertCategory";
$route[ADMIN_START_PAGE.'/category/update'] = "ajax_interface/updateCategory";
$route[ADMIN_START_PAGE.'/category/remove'] = "ajax_interface/removeCategory";
/**************** specialists ******************/
$route[ADMIN_START_PAGE.'/specialist/insert'] = "ajax_interface/insertSpecialist";
$route[ADMIN_START_PAGE.'/specialist/update'] = "ajax_interface/updateSpecialist";
$route[ADMIN_START_PAGE.'/specialist/remove'] = "ajax_interface/removeSpecialist";
/**************** where2buy ******************/
$route[ADMIN_START_PAGE.'/where2buy/insert'] = "ajax_interface/insertWhere2buy";
$route[ADMIN_START_PAGE.'/where2buy/update'] = "ajax_interface/updateWhere2buy";
$route[ADMIN_START_PAGE.'/where2buy/remove'] = "ajax_interface/removeWhere2buy";
/**************** press-centr ******************/
$route[ADMIN_START_PAGE.'/press-centr/insert'] = "ajax_interface/insertPressCentr";
$route[ADMIN_START_PAGE.'/press-centr/update'] = "ajax_interface/updatePressCentr";
$route[ADMIN_START_PAGE.'/press-centr/remove'] = "ajax_interface/removePressCentr";

$route[ADMIN_START_PAGE.'/press-centr/upload/resource'] = "ajax_interface/eventResourceUpload";
$route[ADMIN_START_PAGE.'/press-centr/remove/resource'] = "ajax_interface/eventResourceRemove";
$route[ADMIN_START_PAGE.'/press-centr/caption/resource'] = "ajax_interface/eventCaptionSave";
/***************** reviews *********************/
$route[ADMIN_START_PAGE.'/reviews/insert'] = "ajax_interface/insertReviews";
$route[ADMIN_START_PAGE.'/reviews/update'] = "ajax_interface/updateReviews";
$route[ADMIN_START_PAGE.'/reviews/remove'] = "ajax_interface/removeReviews";
/***************** vacancies *********************/
$route[ADMIN_START_PAGE.'/vacancies/insert'] = "ajax_interface/insertVacancies";
$route[ADMIN_START_PAGE.'/vacancies/update'] = "ajax_interface/updateVacancies";
$route[ADMIN_START_PAGE.'/vacancies/remove'] = "ajax_interface/removeVacancies";
/**************** contacts ******************/
$route[ADMIN_START_PAGE.'/contact/update'] = "ajax_interface/updateContact";
/**************** products ******************/
$route['add-product-bid'] = "ajax_interface/addProductBid";
$route['remove-product-bid'] = "ajax_interface/removeProductBid";
$route['change-product-size'] = "ajax_interface/changeProductSizeBid";
$route['change-product-count'] = "ajax_interface/changeProductCountBid";

$route['load-catalog-products'] = "ajax_interface/loadCatalogProducts";

$route[ADMIN_START_PAGE.'/products/insert'] = "ajax_interface/insertProduct";
$route[ADMIN_START_PAGE.'/products/update'] = "ajax_interface/updateProduct";
$route[ADMIN_START_PAGE.'/products/remove'] = "ajax_interface/removeProduct";

$route[ADMIN_START_PAGE.'/products/upload/resource'] = "ajax_interface/productResourceUpload";
$route[ADMIN_START_PAGE.'/products/remove/resource'] = "ajax_interface/productResourceRemove";
$route[ADMIN_START_PAGE.'/products/caption/resource'] = "ajax_interface/productCaptionSave";

$route[ADMIN_START_PAGE.'/password-save'] = "ajax_interface/adminSavePassword";
/*************************************************** ADMIN INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE] = "admin_interface/controlPanel";
$route[ADMIN_START_PAGE.'/password'] = "admin_interface/changePassword";
/* --------------------------------------------- Menu ------------------------------------------------------------ */
$route[ADMIN_START_PAGE.'/menu'] = "admin_interface/menuList";
/* ------------------------------------------- Containers -------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/containers'] = "admin_interface/taraList";

$route[ADMIN_START_PAGE.'/volumes'] = "admin_interface/volumesList";
$route[ADMIN_START_PAGE.'/volumes/add'] = "admin_interface/addVolume";
$route[ADMIN_START_PAGE.'/volumes/edit'] = "admin_interface/editVolume";
/* ------------------------------------------ contacts ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/contacts'] = "admin_interface/contactsList";
$route[ADMIN_START_PAGE.'/contact/edit'] = "admin_interface/editContact";
/* ----------------------------------------- specialist --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/specialists'] = "admin_interface/specialistsList";
$route[ADMIN_START_PAGE.'/specialists/add'] = "admin_interface/addSpecialist";
$route[ADMIN_START_PAGE.'/specialists/edit'] = "admin_interface/editSpecialist";
/* ----------------------------------------- where2buy --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/where2buy'] = "admin_interface/where2buyList";
$route[ADMIN_START_PAGE.'/where2buy/add'] = "admin_interface/addWhere2buy";
$route[ADMIN_START_PAGE.'/where2buy/edit'] = "admin_interface/editWhere2buy";
/* ----------------------------------------- press-centr --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/press-centr'] = "admin_interface/pressCentrList";
$route[ADMIN_START_PAGE.'/press-centr/add'] = "admin_interface/addPressСentr";
$route[ADMIN_START_PAGE.'/press-centr/edit'] = "admin_interface/editPressСentr";
/* ----------------------------------------- reviews --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/reviews'] = "admin_interface/reviewsList";
$route[ADMIN_START_PAGE.'/reviews/add'] = "admin_interface/addReviews";
$route[ADMIN_START_PAGE.'/reviews/edit'] = "admin_interface/editReviews";
/* ----------------------------------------- vacancies --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/vacancies'] = "admin_interface/vacanciesList";
$route[ADMIN_START_PAGE.'/vacancies/add'] = "admin_interface/addVacancies";
$route[ADMIN_START_PAGE.'/vacancies/edit'] = "admin_interface/editVacancies";
/* ------------------------------------------- Banners ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/banners'] = "admin_interface/banners";
/* ------------------------------------------ Categories --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/categories'] = "admin_interface/categories";
$route[ADMIN_START_PAGE.'/categories/add'] = "admin_interface/addСategory";
$route[ADMIN_START_PAGE.'/categories/edit'] = "admin_interface/editCategory";
/* ------------------------------------------ Sub categories --------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/sub-categories'] = "admin_interface/subCategories";
$route[ADMIN_START_PAGE.'/sub-categories/edit'] = "admin_interface/editSubCategory";
/* ------------------------------------------- Contents ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/pages'] = "admin_interface/pagesList";
$route[ADMIN_START_PAGE.'/pages/add'] = "admin_interface/insertPage";
$route[ADMIN_START_PAGE.'/pages/:any/edit'] = "admin_interface/editPages";
/* ------------------------------------------- Contents ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/products'] = "admin_interface/productsList";
$route[ADMIN_START_PAGE.'/products/add'] = "admin_interface/addProduct";
$route[ADMIN_START_PAGE.'/products/edit'] = "admin_interface/editProduct";
/*************************************************** GUEST INTRERFACE ***********************************************/
$route['about'] = "guests_interface/about";
$route['science-base'] = "guests_interface/scienceBase";
$route['search-goods(\/:any)*?'] = "guests_interface/searchGoods";
$route['where2buy'] = "guests_interface/where2buy";
$route['contacts'] = "guests_interface/contacts";

$route['press-center'] = "guests_interface/pressCenter";
$route['press-center/offset'] = "guests_interface/pressCenter";
$route['press-center/offset/:num'] = "guests_interface/pressCenter";
$route['press-center/:any'] = "guests_interface/publication";

$route['reviews(\/:any)*?'] = "guests_interface/reviews";

$route['honors'] = "guests_interface/honors";
$route['consultation'] = "guests_interface/consultation";

$route['bid'] = "guests_interface/bid";

$route['catalog/:any'] = "guests_interface/catalog";
$route['catalog'] = "guests_interface/catalog";

$route['sitemap'] = "guests_interface/sitemap";

$route['product/:any'] = "guests_interface/product";
$route['response-vacancy'] = "guests_interface/responseVacancy";

$route['search(\/:any)*?'] = "guests_interface/searchResults";
$route['search-test(\/:any)*?'] = "guests_interface/searchResultsTest";

$route['vacancies/:any/response'] = "guests_interface/responseVacancy";
$route['vacancies(\/:any)*?'] = "guests_interface/vacancies";

$route[':any'] = "guests_interface/pages";
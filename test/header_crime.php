<?php
// cache
$expire = 120;
header('Cache-Control: max-age='.$expire);
header('Expires: '.gmdate('D, d M Y H:i:s', time()+$expire).' GMT');

// config
include($_SERVER['DOCUMENT_ROOT'].'/app/site-config.php');

// default tab is home
$forceTabOpen = (!empty($forceTabOpen)?$forceTabOpen:'home');

// side bar on by default
$sidebar = ($sidebar!='false'?'true':'false');

// section path strips /app for you
$sectionPath = str_replace('/app','',$_SERVER['PHP_SELF']);

// add query string to section path when present
$sectionPath = ( empty($_SERVER['QUERY_STRING']) ? $sectionPath : $sectionPath .'?' .$_SERVER['QUERY_STRING'] );

// if secure, setting new tempate
$secure = ( empty($_GET['secure']) ? false : true );
if ($_SERVER['HTTP_X_SSL_ENABLED']){ $secure = true; }
if( $secure ) {
  $templatePath = 'https://'.str_replace('.','-dot-',$_SERVER['HTTP_HOST']).'.bloxcms.com/template/';
} else {
  $templatePath = 'http://'.$_SERVER['HTTP_HOST'].'/template/';
}

// settings
$templateSettings = array(
	'template' => $templatePath,
	'tag' => 'blox template',
	'skin' => 'lee-editorial',
	'title' => $title,
	'keywords' => $pageKeywords,
	'description' => $pageDescription,
	'tabSelected' => $forceTabOpen,
	'sidebar' => $sidebar,
	'sectionPath' => $sectionPath,
	'charset' => $charset,
	'noBaseHref' => true,
	'q' => $_GET['q']
);

// load template
$template = new bloxTemplate($templateSettings);

// echo header
?>                                                                        

<?php echo $template->header(); ?>
<!-- request_uri <?=$_SERVER['REQUEST_URI']?> -->
<!-- php_self <?=$_SERVER['PHP_SELF']?> -->

<?
  $fileNames = array('index.php','index.html','index.htm','index.inc');
  $path = $_SERVER['PHP_SELF'];
  $path = str_replace($fileNames,"",$path);
?>
<?php
	//啟動緩衝區
	ob_start();
	//把 session 的生命週期調到你想要的時間 10day
	ini_set('session.gc_maxlifetime', 864000);
	//都設定好之後再啟動 session
	session_start();
	//設定hearder表頭
	header("pragma: no-cache");
	header("cache-control: no-cache, must-revalidate");
	header("Content-Type:text/html;charset=utf-8");
	//設定時區
	date_default_timezone_set("Asia/Taipei");
	//程式模式 development production
	define('ENVIRONMENT','production');
	//預設路徑
	$url = "/admin";
	define('_Img_Url'	, 'http://'.$_SERVER['HTTP_HOST']);
	define('_Web_Root'	, $_SERVER['DOCUMENT_ROOT'].$url);							// 最後沒有斜線
	define('_Web_Url'	, 'http://'.$_SERVER['HTTP_HOST'].$url);					// 最後沒有斜線
	define('_Media_Root', $_SERVER['DOCUMENT_ROOT'].$url.'/system/media');				// 最後沒有斜線
	define('_Media_Url'	, 'http://'.$_SERVER['HTTP_HOST'].$url.'/system/media');		// 最後沒有斜線
	define('_Script_Root', $_SERVER['DOCUMENT_ROOT'].$url.'/system/scripts'); 			// 最後沒有斜線
	define('_Script_Url'	, 'http://'.$_SERVER['HTTP_HOST'].$url.'/system/scripts'); // 最後沒有斜線/
	if(isset($_SERVER['HTTP_REFERER']))
	define('_Soruce_Url'	, $_SERVER['HTTP_REFERER']);// 最後沒有斜線
	//載入跳轉
	include_once _Web_Root. "/Sys_Classes/function/jumpPage.class.php";

	//資料庫 連線變數設定
	define('_DB_USERNAME', 	'antifat1');
	define('_DB_PASSWORD', 	'5tgb^YHN');
	define('_DB_DBNAME', 	'antifat1');
	define('_DB_HOST', 	'192.168.10.20');
?>

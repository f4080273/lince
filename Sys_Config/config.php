<?php
	//啟動緩衝區
	ob_start();

	//啟動 Session
	// 把 session 的生命週期調到你想要的時間
	ini_set('session.gc_maxlifetime', 864000);

	// 都設定好之後再啟動 session
	session_start();

	header("pragma: no-cache");
	header("cache-control: no-cache, must-revalidate");
	header("Content-Type:text/html;charset=utf-8");

	//設定時區
	date_default_timezone_set("Asia/Taipei");
	//程式模式 development production
	define('ENVIRONMENT','development');

	$url = "/lince";
	define('_Web_Root'	, $_SERVER['DOCUMENT_ROOT'].$url);							// 最後沒有斜線
	define('_Web_Url'	, 'http://'.$_SERVER['HTTP_HOST'].$url);					// 最後沒有斜線
	define('_Media_Root', $_SERVER['DOCUMENT_ROOT'].$url.'/assets');				// 最後沒有斜線
	define('_Media_Url'	, 'http://'.$_SERVER['HTTP_HOST'].$url.'/assets');		// 最後沒有斜線

	if(isset($_SERVER['HTTP_REFERER']))
	define('_Soruce_Url'	, $_SERVER['HTTP_REFERER']);// 最後沒有斜線

	include_once _Web_Root. "/Sys_Classes/function/jumpPage.class.php";

	//管理者介面路徑
	define('_Manager_Root'	, _Web_Root.'/admin'); // 最後沒有斜線
	define('_Manager_Url'	, _Web_Url.'/admin'); // 最後沒有斜線

	//資料庫 連線變數設定
	define('_DB_USERNAME', 	'root');
	define('_DB_PASSWORD', 	'');
	define('_DB_DBNAME', 	'lince');
	define('_DB_HOST', 	'127.0.0.1');
?>

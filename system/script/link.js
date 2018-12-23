function menu_home() {	
	location.href = _Web_Url;
}
//公司簡介
function menu_about() {	
	location.href =_Web_Url + '/index.php/web/about/';
}
//產品系列
function menu_service() {	
	location.href =_Web_Url + '/index.php/web/service/';
}
//我要訂購
function menu_products() {	
	location.href =_Web_Url + '/index.php/web/products/';
}
//最新消息
function menu_news() {	
	location.href =_Web_Url + '/index.php/web/news/';
}
//聯絡我們
function menu_contact() {	
	location.href =_Web_Url + '/index.php/web/contact/';
}
//留言版
function menu_guestbook() {	
	location.href =_Web_Url + '/index.php/web/guestbook/';
}

function red01() {	
	location.href =_Web_Url + '/index.php/web/service/19/';
}
function red02() {	
	location.href =_Web_Url + '/index.php/web/service/18/';
}
function red03() {	
	location.href =_Web_Url + '/index.php/web/service/14/';
}

function my_favorites() {	
   if (document.all){
        window.external.AddFavorite(_Web_Url, "Enter Title");
    } else {
        window.sidebar.addPanel("Enter Title", _Web_Url, "");
	}
}
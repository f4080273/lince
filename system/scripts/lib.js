function LoadingBG(){
	 var bgObj   = document.createElement("div"); 
	 bgObj.id    = "BlackBG";
	 bgObj.style.cssText = "position:fixed;left:0px;top:0px;width:100%;px;height:100%;filter:Alpha(Opacity=30);opacity:0.3;background-color:#000000;z-index:199;";
	 document.body.appendChild(bgObj); 
	
	 x = document.body.scrollWidth;
	 x = x / 2;
	  x = x - 100;
	 y = $(window).scrollTop();
	 y = y + 300;
	 
	 var bgObj1          = document.createElement("div"); 
	 bgObj1.id            = "BlackLoading";
	 bgObj1.style.cssText = "position:absolute;left:"+x+"px;top:"+y+"px;width:auto;height:auto;z-index:201;";
	 document.body.appendChild(bgObj1); 
	 document.getElementById('BlackLoading').innerHTML = "<img src='"+_Web_Url +"/upload/LoadingBG.gif'>";
}

function CloseBG(){   //刪除產生出來的div元素
	var O = document.getElementById("BlackBG");
	O.parentNode.removeChild(O);
	var O2 = document.getElementById("BlackLoading");
	O2.parentNode.removeChild(O2);
}

function LoadingOnlyBG(){
	 var bgObj   = document.createElement("div"); 
	 bgObj.id    = "BlackBG";
	 bgObj.style.cssText = "position:fixed;left:0px;top:0px;width:100%;px;height:100%;filter:Alpha(Opacity=30);opacity:0.3;background-color:#000000;z-index:199;";
	 document.body.appendChild(bgObj); 
	
	 x = document.body.scrollWidth;
	 x = x / 2;
	  x = x - 100;
	 y = $(window).scrollTop();
	 y = y + 300;
}

function CloseOnlyBG(){
	var O = document.getElementById("BlackBG");
	O.parentNode.removeChild(O);
}

function CloseObj(ObjName){
	var O = document.getElementById(ObjName);
	O.parentNode.removeChild(O);
}

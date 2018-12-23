<?=$Head?>
 <div id="wrap">
   <!--Start Header-->
   <?=$TopMenu?>
   <!--End Header-->
	 <section class="header-title" style="background: url(<?=_Web_Url?>/images/banner/<?=$page_banner[0]->img?>) no-repeat center top;padding-top: 127px;height: 280px;">
		<div class="container">
			<div class="row">
				<div class="title">
					<h2>聯絡我們</h2>
				</div>
			</div>
		</div>
	 </section>
   <section class="page-nav">
  	<div class="container">
  		<div class="row">
				<ul>
					<li>首頁</li>
					<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
					<li><span>聯絡我們</span></li>
				</ul>
  		</div>
  	</div>
   </section>
<!--Start Content-->
<div class="content">
 <div class="contact-us">
<!--
  <div class="container">
   <div class="row">
    <div class="col-md-12">
     <div class="our-location">
      <div class="map">
        <iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Envato+Pty+Ltd,+Elizabeth+Street,+Melbourne,+Victoria,+Australia&amp;aq=0&amp;oq=envato+&amp;sll=37.0625,-95.677068&amp;sspn=39.235538,86.572266&amp;ie=UTF8&amp;hq=Envato+Pty+Ltd,&amp;hnear=Elizabeth+St,+Melbourne+Victoria+3000,+Australia&amp;ll=-37.817942,144.964977&amp;spn=0.01918,0.008866&amp;t=m&amp;output=embed">
        </iframe>
      </div>
      <div class="get-directions">
         <form action="http://maps.google.com/maps" method="get" target="_blank">
              <input type="text" name="saddr" placeholder="Enter Your Address" />
              <input type="hidden" name="daddr" value="Envato Pty Ltd, Elizabeth Street, Melbourne, Victoria, Australia" />
              <input type="submit" value="Get directions" class="direction-btn" />
           </form>
      </div>
     </div>
    </div>
   </div>
  </div>
-->
  <div class="leave-msg dark-back">
   <div class="container">
    <div class="rox">
     <div class="col-md-7">
      <div class="main-title">
        <h4>服務時間</h4>
        <?=$web_define->varD?>
      </div>
      <div class="form">
        <div class="row">
          <p class="success" id="success" style="display:none;"></p>
          <p class="error" id="error" style="display:none;"></p>
          <form name="contact_form" id="contact_form" method="post" action="#" onSubmit="return false">
           <div class="col-md-12">
             <h4>病人資訊</h4>
           </div>
           <div class="col-md-4">
             <input type="text" data-delay="300" placeholder="請輸入姓名(必填)" name="name" id="name" class="input">
           </div>
           <div class="col-md-4">
             <select id="sex" name="sex" class="input">
               <option value="1">男</option>
               <option value="0">女</option>
             </select>
           </div>
           <div class="col-md-4" style="height:48px;line-height:48px">必填</div>
           <div class="col-md-12">
             <h4>聯絡資訊</h4>
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="Email或臉書" name="email" id="email" class="input">
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="行動電話(必填)" name="phone" id="phone" class="input">
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="市話" name="tel" id="tel" class="input">
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="地址(必填)" name="address" id="address" class="input">
           </div>
           <div class="col-md-12"><h4>方便聯絡時間</h4></div>
           <div class="col-md-12">
             <input type="text" data-delay="300" placeholder="方便聯絡時間(必填)" name="contract_t" id="contract_t" class="input">
           </div>
           <div class="col-md-12"><h4>諮詢或希望協助事項</h4></div>
           <div class="col-md-12">
             <select name="ask" id="ask" class="input">
               <option value="1">居家醫療服務</option>
               <option value="2">居家護理服務</option>
               <option value="3">暫時或臨時全日型</option>
               <option value="4">半日型托顧服務</option>
               <option value="5">自費全日型或半日型托顧服務</option>
               <option value="6">成人健檢服務</option>
               <option value="7">流感疫苗接種服務</option>
               <option value="8">自費四價流感疫苗</option>
               <option value="9">老人肺炎雙球菌疫苗接種服務</option>
             </select>
           </div>
           <div class="col-md-12">
             <textarea data-delay="500" class="required valid" placeholder="諮詢內容" name="message" id="message"></textarea>
           </div>
           <div class="col-md-3">
             <input name=" " id="contact_send_b" type="submit" value="送出" onClick="contact_send()">
           </div>
          </form>
        </div>
       </div>
      </div>
     <div class="col-md-5">
      <div class="contact-get">
       <div class="main-title">
         <h4>聯絡方式(居家護理所)</h4>
         <p></p>
        </div>
        <div class="get-in-touch">
         <div class="detail">
           <?if(isset($contract1->varA) && $contract1->varA != ''){?>
           <span><b>市&nbsp;&nbsp;話：</b> <?=$contract1->varA?></span>
           <?}?>
           <?if(isset($contract1->varB) && $contract1->varB != ''){?>
           <span><b>傳&nbsp;&nbsp;真：</b> <?=$contract1->varB?></span>
           <?}?>
           <?if(isset($contract1->varC) && $contract1->varC != ''){?>
           <span><b>手&nbsp;&nbsp;機：</b> <?=$contract1->varC?></span>
           <?}?>
           <?if(isset($contract1->varD) && $contract1->varD != ''){?>
           <span><b>地&nbsp;&nbsp;址：</b> <?=$contract1->varD?></span>
           <?}?>
           <?if(isset($contract1->varE) && $contract1->varE != ''){?>
           <span><b>Email：</b> <?=$contract1->varE?></span>
           <?}?>
          </div>
          <div class="social-icons">
            <!--
            <a href="#." class="fb"><i class="icon-euro"></i></a>
            <a href="#." class="tw"><i class="icon-yen"></i></a>
            <a href="#." class="gp"><i class="icon-google-plus"></i></a>
            <a href="#." class="vimeo"><i class="icon-vimeo4"></i></a>
            -->
          </div>
        </div>
       </div>
       <div class="contact-get">
        <div class="main-title">
          <h4>申訴方式</h4>
          <p>我們會於三日內回覆</p>
         </div>
         <div class="get-in-touch">
          <div class="detail">
            <?if(isset($contract3->varA) && $contract3->varA != ''){?>
            <span><b>姓&nbsp;&nbsp;名：</b> <?=$contract3->varA?></span>
            <?}?>
            <?if(isset($contract3->varB) && $contract3->varB != ''){?>
            <span><b>電&nbsp;&nbsp;話：</b> <?=$contract3->varB?></span>
            <?}?>
            <?if(isset($contract3->varC) && $contract3->varC != ''){?>
            <span><b>信&nbsp;&nbsp;箱：</b> <?=$contract3->varC?></span>
            <?}?>
           </div>
           <div class="social-icons">
             <!--
             <a href="#." class="fb"><i class="icon-euro"></i></a>
             <a href="#." class="tw"><i class="icon-yen"></i></a>
             <a href="#." class="gp"><i class="icon-google-plus"></i></a>
             <a href="#." class="vimeo"><i class="icon-vimeo4"></i></a>
             -->
           </div>
         </div>
        </div>
       <div class="contact-get">
        <div class="main-title">
          <h4>聯絡方式(敦仁診所)</h4>
          <p></p>
         </div>
         <div class="get-in-touch">
           <div class="detail">
             <?if(isset($contract2->varA) && $contract2->varA != ''){?>
             <span><b>市&nbsp;&nbsp;話：</b> <?=$contract2->varA?></span>
             <?}?>
             <?if(isset($contract2->varB) && $contract2->varB != ''){?>
             <span><b>傳&nbsp;&nbsp;真：</b> <?=$contract2->varB?></span>
             <?}?>
             <?if(isset($contract2->varC) && $contract2->varC != ''){?>
             <span><b>手&nbsp;&nbsp;機：</b> <?=$contract2->varC?></span>
             <?}?>
             <?if(isset($contract2->varD) && $contract2->varD != ''){?>
             <span><b>地&nbsp;&nbsp;址：</b> <?=$contract2->varD?></span>
             <?}?>
             <?if(isset($contract2->varE) && $contract2->varE != ''){?>
             <span><b>Email：</b> <?=$contract2->varE?></span>
             <?}?>
            </div>
           <div class="social-icons">
             <!--
             <a href="#." class="fb"><i class="icon-euro"></i></a>
             <a href="#." class="tw"><i class="icon-yen"></i></a>
             <a href="#." class="gp"><i class="icon-google-plus"></i></a>
             <a href="#." class="vimeo"><i class="icon-vimeo4"></i></a>
             -->
           </div>
         </div>
        </div>
      </div>
     </div>
    </div>
   </div>
 </div>
</div>
<!--End Content-->
	 <?=$Footer?>
   <script>
    function contact_send(){
       if($("#email").val().search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/) == -1)
       {
         alert("電子郵件或FB錯誤");
         return false;
       }
       if($("#sex").val() == ''){
         alert("請輸入性別");
         return false;
       }
       if($("#name").val() == ''){
         alert("請輸入姓名");
         return false;
       }
       if($("#phone").val() == ''){
         alert("請輸入電話");
         return false;
       }
       if($("#address").val() == ''){
         alert("請輸入地址");
         return false;
       }
       if($("#contract_t").val() == ''){
         alert("請輸入方便聯絡時間");
         return false;
       }
       if($("#message").val() == ''){
         alert("請輸入內容");
         return false;
       }
       $("#contact_send_b").val("發送中....").attr('disabled', 'disabled');
       $.ajax({
         type: "POST",
         dataType: 'json',
         url: "<?=_Web_Url?>/contact/send_message",
         data:{
           'name'		:$("#name").val(),
           'sex'    :$("#sex").val(),
           'phone'  :$("#phone").val(),
           'tel'    :$("#tel").val(),
           'address' :$("#address").val(),
           'email'		:$("#email").val(),
           'ask'		:$("#ask").val(),
           'contract_t' :$("#contract_t").val(),
           'message'	:$("#message").val()
         },
         success: function(data){
           if(data.Status == '0000')
           {
             alert(data.Msg);
             window.location.reload();
           }else{
             alert(data.Msg);
             $("#contact_send_b").val("送出");
             $("#contact_send_b").removeAttr('disabled', 'disabled');
             return false;
           }
         }
       });
     }
     </script>
	</body>
</html>

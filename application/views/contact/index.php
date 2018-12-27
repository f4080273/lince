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

  <div class="leave-msg dark-back">
   <div class="container">
    <div class="rox">
     <div class="container" style="margin:0 0 15px 0;">
       感謝您的拜訪，如果您對我們提供的產品及服務有任何問題或意見，歡迎填寫下列表單，我們將有專人為您服務。
     </div>
     <div class="col-md-7">
      <div class="form">
        <div class="row">
          <p class="success" id="success" style="display:none;"></p>
          <p class="error" id="error" style="display:none;"></p>
          <form name="contact_form" id="contact_form" method="post" action="#" onSubmit="return false">
           <div class="col-md-12">
             <h4>聯絡資訊</h4>
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="姓名(必填)" name="name" id="name" class="input">
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="公司名稱(必填)" name="contract_t" id="contract_t" class="input">
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="連絡電話(必填)" name="phone" id="phone" class="input">
           </div>
           <div class="col-md-6">
             <input type="text" data-delay="300" placeholder="電子郵件" name="email" id="email" class="input">
           </div>
           <div class="col-md-12"><h4>聯絡主旨</h4></div>
           <div class="col-md-12">
             <select name="ask" id="ask" class="input">
               <? for ($i=1; $i < 10; $i++) {?>
                <option value="<?=$i?>"><?=fafa_contract_ask($i)?></option>
               <?}?>
             </select>
           </div>
           <div class="col-md-12">
             <textarea data-delay="500" class="required valid" placeholder="聯絡訊息" name="message" id="message"></textarea>
           </div>
           <div class="col-md-3">
             <input name=" " id="contact_send_b" type="submit" value="送出" onClick="contact_send()">
           </div>
          </form>
        </div>
       </div>
      </div>
     <div class="col-md-5">
       <div class="main-title">
         <h4>聯絡資訊</h4>
         <?=$web_define->varD?>
       </div>
       <div class="our-location">
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14462.832375159045!2d121.167858!3d25.010033!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbf93e46c0999f0f5!2z56mO6KW_5bel5qWt6IKh5Lu95pyJ6ZmQ5YWs5Y-4!5e0!3m2!1szh-TW!2stw!4v1545919086880" frameborder="0" style="border:0" allowfullscreen></iframe>
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
       if($("#name").val() == ''){
         alert("請輸入姓名");
         return false;
       }
       if($("#phone").val() == ''){
         alert("請輸入聯絡電話");
         return false;
       }
       if($("#contract_t").val() == ''){
         alert("請輸入公司名稱");
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

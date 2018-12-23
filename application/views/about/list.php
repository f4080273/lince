<?=$Head?>
 <div id="wrap">
   <!--Start Header-->
   <?=$TopMenu?>
   <!--End Header-->
	 <section class="header-title" style="background: url(<?=_Web_Url?>/images/banner/<?=$page_banner[0]->img?>) no-repeat center top;padding-top: 127px;height: 280px;">
		<div class="container">
			<div class="row">
				<div class="title">
					<h2><?=$get_AboutTypeDataById->AboutType_Name?></h2>
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
					<li><span><?=$get_AboutTypeDataById->AboutType_Name?></span></li>
				</ul>
  		</div>
  	</div>
   </section>
   <section class="facture-process">
   	 <div class="container">
			<div class="row">
        <div class="col-md-3">
          <div class="special-links">
						<ul>
              <?foreach($get_AboutList['ListData'] as $row){?>
              <li>
                <a href="<?=_Web_Url?>/about/lts/<?=$row->About_AboutTypeId?>/<?=$row->About_Id?>">
                  <?=$row->About_Title?>
                </a>
                </li>
              <?}?>
            </ul>
					</div>
					<?=$Contact?>
        </div>
				<div class="col-md-9">
          <?if(isset($get_AboutDataById->About_Img) && $get_AboutDataById->About_Img != ''){?>
          <div class="img-box image">
            <img src="<?=_Web_Url?>/images/about/<?=$get_AboutDataById->About_Img?>" alt="<?=$get_AboutDataById->About_Title?>" />
          </div>
          <?}?>
					<div class="title">
						<h2><?=$get_AboutDataById->About_Title?></h2>
					</div>
				  <?=$get_AboutDataById->About_Content?>
				</div>
			</div>
		</div>
   </section>
	 <?=$Footer?>
	</body>
</html>

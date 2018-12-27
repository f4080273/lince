<?=$Head?>
 <div id="wrap">
   <!--Start Header-->
   <?=$TopMenu?>
   <!--End Header-->
	 <section class="header-title" style="background: url(<?=_Web_Url?>/images/banner/<?=$page_banner[0]->img?>) no-repeat center top;padding-top: 127px;height: 280px;">
		<div class="container">
			<div class="row">
				<div class="title">
					<h2><?=$get_ProdctCatalogById->Catalog_Name?></h2>
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
					<li><span><?=$get_ProdctCatalogById->Catalog_Name?></span></li>
				</ul>
  		</div>
  	</div>
   </section>
   <section class="facture-process">
   	 <div class="container">
			<div class="row">
        <div class="col-md-3 mobile-hide">
          <div class="special-links">
						<ul>
              <?
                foreach($get_Catalog as $row){
              ?>
              <li>
                <a class="<?=($row->Catalog_Id == $Id)?"active":"";?>" href="<?=_Web_Url?>/product/lts/<?=$row->Catalog_Id?>">
                  <?=$row->Catalog_Name?>
                </a>
                </li>
              <?}?>
            </ul>
					</div>
        </div>
				<div class="col-md-9">
          <div class="col-md-6 shop-box">
            <?foreach ($get_DataList['Data'] as $row) {?>
              <a href="<?=_Web_Url?>/device/detail/<?=$row->Product_CatalogId?>/<?=$row->Product_Id?>">
  							<div class="shop-box-imgb">
  								<img src="<?=_Web_Url?>/images/product/<?=$row->Product_Images?>" alt="<?=$row->Product_Name?>">
  							</div>
  							<p class="shop-box-name text-center"><?=$row->Product_Name?></p>
  						</a>
            <?}?>
					</div>
				</div>
			</div>
		</div>
   </section>
	 <?=$Footer?>
	</body>
</html>

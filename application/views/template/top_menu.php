<!--Start PreLoader-->
<div id="preloader">
 <div id="status">&nbsp;</div>
  <div class="loader">
    <h1>Loading...</h1>
    <span></span>
    <span></span>
    <span></span>
 </div>
</div>
<header class="main-header removelfpending">
  <div class="container removelfpending">
    <div classs"row">
  <div class="col-md-12 removelfpending">
    <section class="main-menu finance-navbar">
      <div class="container removelfpending">
        <div classs"row">
      <div class="col-md-3 removelfpending" >
        <div class="logo">
          <a href="<?=_Web_Url?>"><img src="<?=_Web_Url?>/images/<?=$web_define->varA?>" alt="<?=$mail_profile->varA?>" /></a>
        </div>
      </div>
      <div class="col-md-9 removelfpending">
        <div class="meni">
          <nav id="main-navigation-wrapper" class="navbar navbar-default">
            <div class="navbar-header">
              <button type="button" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
              </button>
            </div>
            <div id="main-navigation" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="<?=_Web_Url?>">首頁</a></li>
                <?foreach ($AboutTypeList as $row) {?>
                <li>
                  <a href="<?=_Web_Url?>/about/lts/<?=$row->AboutType_Id?>"><?=$row->AboutType_Name?></a>
                  <ul class="dropdown-submenu">
                    <?
                      foreach ($AboutList as $key=>$val) {
                        if($val->About_AboutTypeId == $row->AboutType_Id){
                    ?>
                    <li>
                      <a href="<?=_Web_Url?>/about/lts/<?=$val->About_AboutTypeId?>/<?=$val->About_Id?>">
                        <?=fafa_text_limit($val->About_Title,10,'...')?>
                      </a>
                    </li>
                    <?unset($AboutList[$key]);}}?>
                  </ul><!-- /.sub-menu -->
                </li>
                <?}?>
                <li><a href="<?=_Web_Url?>/product/lts">主要產品</a>
                    <ul class="dropdown-submenu">
                      <?
                        foreach ($get_CatalogProduct as $row) {
                      ?>
                      <li>
                        <a href="<?=_Web_Url?>/product/lts/<?=$row->Catalog_Id?>">
                          <?=fafa_text_limit($row->Catalog_Name,10,'...')?>
                        </a>
                      </li>
                      <?}?>
                    </ul><!-- /.sub-menu -->
                </li>

                <li><a href="<?=_Web_Url?>/device/lts">設備介紹</a>
                    <ul class="dropdown-submenu">
                      <?
                        foreach ($get_CatalogDevice as $row) {
                      ?>
                      <li>
                        <a href="<?=_Web_Url?>/device/lts/<?=$row->Catalog_Id?>">
                          <?=fafa_text_limit($row->Catalog_Name,10,'...')?>
                        </a>
                      </li>
                      <?}?>
                    </ul><!-- /.sub-menu -->
                </li>

                <li>
                  <a href="<?=_Web_Url?>/news/lts">最新消息</a>
                  <ul class="dropdown-submenu">
                    <?
                      foreach ($NewsList as $row) {
                    ?>
                    <li>
                      <a href="<?=_Web_Url?>/news/detail/<?=$row->News_Id?>">
                        <?=fafa_text_limit($row->News_Title,10,'...')?>
                      </a>
                    </li>
                    <?}?>
                  </ul><!-- /.sub-menu -->
                </li>
                <li><a href="<?=_Web_Url?>/contact">聯絡我們</a></li>
              </ul>
            </div>
          </nav>
        </div>
       </div>
     </div>
    </div>
    </section>
  </div>
  </div>
  </div>
</header>

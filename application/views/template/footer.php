<!--Start Footer-->
   <footer class="footer" id="footer">
   		<div class="container">
        <div class="main-footer">
        	<div class="row">
                <div class="col-md-3">
                    <div class="useful-links">
                    	<div class="title">
                        	<h5>導覽</h5>
                        </div>
                        <div class="detail">
                        	<ul>
                            	<li><a href="<?=_Web_Url?>">首頁</a></li>
                              <li><a href="<?=_Web_Url?>/product/lts">主要產品</a></li>
                              <li><a href="<?=_Web_Url?>/device/lts">設備介紹</a></li>
                              <?foreach ($AboutTypeList as $row) {?>
                                <li><a href="<?=_Web_Url?>/about/lts/<?=$row->AboutType_Id?>"><?=$row->AboutType_Name?></a></li>
                              <?}?>
                              <li><a href="<?=_Web_Url?>/news/lts">最新消息</a></li>
                              <li><a href="<?=_Web_Url?>/contact">聯絡我們</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="title">
                  	<h5>簡介</h5>
                  </div>
                  <div class="detail">
                    <div class="get-touch">
                      <span class="text"><?=$web_define->varC?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-3">
                  <div class="get-touch">
                  	<div class="title">
                      	<h5>聯絡資訊</h5>
                      </div>
                      <div class="detail">
                      	<div class="get-touch">
                              <span class="text">歡迎詢問各種問題</span>
                              <ul>
                                <?if(isset($contract1->varD) && $contract1->varD != ''){?>
                              	<li><i class="icon-location"></i> <span><?=$contract1->varD?></span></li>
                                <?}?>
                                <?if(isset($contract1->varA) && $contract1->varA != ''){?>
                                <li><i class="icon-phone4"></i> <span><?=$contract1->varA?></span></li>
                                <?}?>
                                <?if(isset($contract1->varB) && $contract1->varB != ''){?>
                                <li><i class="icon-phone5"></i> <span><?=$contract1->varB?></span></li>
                                <?}?>
                                <?if(isset($contract1->varE) && $contract1->varE != ''){?>
                                <li><a href="mailto:<?=$contract1->varE?>"><i class="icon-dollar"></i> <span><?=$contract1->varE?></span></a></li>
                                <?}?>
                              </ul>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
    	<div class="container">
        	<div class="row">
                <div class="col-md-6">
                  <span class="copyrights"><span><?=$mail_profile->varA?>  &copy;  <?=date("Y")?> All Right Reserved</span>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
   </footer>
   <!--End Footer-->


<script type="text/javascript" src="<?=_Web_Url?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- SMOOTH SCROLL -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/scroll-desktop.js"></script>
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/scroll-desktop-smooth.js"></script>

<!-- START REVOLUTION SLIDER -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/jquery.themepunch.tools.min.js"></script>


<!-- Date Picker and input hover -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/classie.js"></script>
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>

<!-- Fun Facts Counter -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/counter.js"></script>


<!-- Welcome Tabs -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/tabs.js"></script>


<!-- All Carousel -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/owl.carousel.js"></script>


<script type="text/javascript" src="<?=_Web_Url?>/assets/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/jquery.counterup.min.js"></script>

<!-- Mobile Menu -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/jquery.mmenu.min.all.js"></script>

<!-- All Scripts -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/bootstrap.min.js"></script>

<!-- All Scripts -->
<script type="text/javascript" src="<?=_Web_Url?>/assets/js/custom.js"></script>

<script type="text/javascript" src="https://kenwheeler.github.io/slick/slick/slick.min.js"></script>

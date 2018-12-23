<?=$Head?>
<!--Start Header-->
<?=$TopMenu?>
<!--End Header-->
<!--Start Banner-->
<div class="tp-banner-container">
 <div class="tp-banner" >
	<ul>	<!-- SLIDE  -->
   <?if(isset($index_banner[0]->img) && $index_banner[0]->img != ''){?>
	 <li data-transition="fade" data-slotamount="7" data-masterspeed="500"  data-saveperformance="on"  data-title="Intro Slide">
	  <img src="<?=_Web_Url?>/images/banner/<?=$index_banner[0]->img?>"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
		<div class="tp-caption grey_heavy_723 skewfromrightshort tp-resizeme rs-parallaxlevel-0"
			data-x="0"
			data-y="210"
			data-speed="500"
			data-start="2250"
			data-easing="Power3.easeInOut"
			data-splitin="chars"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
      <?=$index_banner[0]->title1?>
		</div>
    <div class="tp-caption grey_heavy_72-light skewfromrightshort tp-resizeme rs-parallaxlevel-0"
			data-x="0"
			data-y="280"
			data-speed="500"
			data-start="2250"
			data-easing="Power3.easeInOut"
			data-splitin="chars"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
      <?=$index_banner[0]->text1?>
		</div>
		<div class="tp-caption grey_regular_188 customin tp-resizeme rs-parallaxlevel-0"
			data-x="0"
			data-y="357"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="500"
			data-start="2600"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.05"
			data-endelementdelay="0.1"
			style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
      <div style="text-align:left;">
        <?=$index_banner[0]->text2?>
      </div>
		</div>
		<div class="tp-caption grey_regular_18 customin tp-resizeme rs-parallaxlevel-0"
			data-x="0"
			data-y="429"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="800"
			data-start="3100"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.05"
			data-endelementdelay="0.1"
			>
			<a href="<?=$index_banner[0]->url?>" class="read-more">更多</a>
		</div>
	</li>
  <?}?>
  <?if(isset($index_banner[1]->img) && $index_banner[1]->img != ''){?>
	<li data-transition="fade" data-slotamount="7" data-masterspeed="500"  data-saveperformance="on"  data-title="Intro Slide">
		<img src="<?=_Web_Url?>/images/banner/<?=$index_banner[1]->img?>"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
		<div class="tp-caption grey_heavy_72 skewfromleftshort fadeout tp-resizeme rs-parallaxlevel-10"
			data-x="0"
			data-y="115"
			data-speed="500"
			data-start="2250"
			data-easing="Power3.easeInOut"
			data-splitin="chars"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
      <?=$index_banner[1]->title1?>
		</div>
    <div class="tp-caption grey_heavy_72-light skewfromleftshort fadeout tp-resizeme rs-parallaxlevel-10"
			data-x="145"
			data-y="115"
			data-speed="500"
			data-start="2950"
			data-easing="Power3.easeInOut"
			data-splitin="chars"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
      <?=$index_banner[1]->title2?>
		</div>
    <div class="tp-caption arrowicon customin fadeout rs-parallaxlevel-10"
			data-x="0"
			data-y="265"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="600"
			data-start="4000"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index: 8;"><img src="<?=_Media_Url?>/images/slides/plus.png" alt="" >
		</div>
    <div class="tp-caption black_bold_bg_20 sfr fadeout tp-resizeme rs-parallaxlevel-10"
			data-x="38"
			data-y="265"
			data-speed="600"
			data-start="4100"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap; font-size: 18px;">
      <?=$index_banner[1]->text1?>
		</div>
    <div class="tp-caption arrowicon customin fadeout rs-parallaxlevel-10"
			data-x="0"
			data-y="310"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="600"
			data-start="4300"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index: 8;"><img src="<?=_Media_Url?>/images/slides/plus.png" alt="" >
		</div>
    <div class="tp-caption black_bold_bg_20 sfr fadeout tp-resizeme rs-parallaxlevel-10"
			data-x="38"
			data-y="310"
			data-speed="600"
			data-start="4400"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap; font-size: 18px;">
      <?=$index_banner[1]->text2?>
		</div>
    <div class="tp-caption arrowicon customin fadeout rs-parallaxlevel-10"
			data-x="0"
			data-y="355"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="600"
			data-start="4600"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index: 8;"><img src="<?=_Media_Url?>/images/slides/plus.png" alt="" >
		</div>
    <div class="tp-caption black_bold_bg_20 sfr fadeout tp-resizeme rs-parallaxlevel-10"
			data-x="38"
			data-y="355"
			data-speed="600"
			data-start="4700"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap; font-size: 18px;">
      <?=$index_banner[1]->text3?>
		</div>
    <?/*
    <div class="tp-caption arrowicon customin  rs-parallaxlevel-10"
			data-x="0"
			data-y="430"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="850"
			data-start="5500"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index:12000;">
      <a href="services.html">
        <img src="<?=_Media_Url?>/images/slides/icon1.png" alt="" ></a>
		</div>
    <div class="tp-caption arrowicon customin  rs-parallaxlevel-10"
			data-x="108"
			data-y="430"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="850"
			data-start="6000"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index:12000;"><a href="services.html">
        <img src="<?=_Media_Url?>/images/slides/icon2.png" alt="" ></a>
		</div>
    <div class="tp-caption arrowicon customin  rs-parallaxlevel-10"
			data-x="216"
			data-y="430"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="850"
			data-start="6500"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index:12000;"><a href="services.html">
        <img src="<?=_Media_Url?>/images/slides/icon3.png" alt="" ></a>
		</div>
    <div class="tp-caption arrowicon customin  rs-parallaxlevel-10"
			data-x="324"
			data-y="430"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="850"
			data-start="7000"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index:12000;">
      <a href="services.html">
        <img src="<?=_Media_Url?>/images/slides/icon4.png" alt="" ></a>
		</div>
    <div class="tp-caption arrowicon customin  rs-parallaxlevel-10"
			data-x="432"
			data-y="430"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="850"
			data-start="7500"
			data-easing="Power3.easeInOut"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			data-endspeed="1000"
			style="z-index:12000;"><a href="services.html">
        <img src="<?=_Media_Url?>/images/slides/view-all.png" alt="" ></a>
		</div>
    */?>
	</li>
  <?}?>
  <?if(isset($index_banner[2]->img) && $index_banner[2]->img != ''){?>
	<li data-transition="fade" data-slotamount="7" data-masterspeed="500"  data-saveperformance="on"  data-title="Intro Slide">
		<img src="<?=_Web_Url?>/images/banner/<?=$index_banner[2]->img?>"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
    <div class="tp-caption grey_heavy_72-light customin randomrotateout tp-resizeme rs-parallaxlevel-10"
			data-x="0"
			data-y="220"
			data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
			data-speed="650"
			data-start="1050"
			data-easing="Power3.easeInOut"
			data-splitin="chars"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
      <?=$index_banner[2]->title1?>
		</div>
		<div class="tp-caption grey_heavy_729 customin randomrotateout tp-resizeme rs-parallaxlevel-10"
			data-x="0"
			data-y="286"
			data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
			data-speed="650"
			data-start="2500"
			data-easing="Power3.easeInOut"
			data-splitin="chars"
			data-splitout="none"
			data-elementdelay="0.1"
			data-endelementdelay="0.1"
			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
      <?=$index_banner[2]->title2?>
		</div>
		<div class="tp-caption grey_regular_181 customin tp-resizeme rs-parallaxlevel-0"
			data-x="0"
			data-y="362"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="500"
			data-start="4600"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.05"
			data-endelementdelay="0.1"
			style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
      <div style="text-align:left;">
        <?=$index_banner[2]->text1?>
      </div>
		</div>
		<div class="tp-caption grey_regular_18 customin tp-resizeme rs-parallaxlevel-0"
			data-x="0"
			data-y="429"
			data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
			data-speed="800"
			data-start="4900"
			data-easing="Power3.easeInOut"
			data-splitin="none"
			data-splitout="none"
			data-elementdelay="0.05"
			data-endelementdelay="0.1"
			style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
      <div style="text-align:left; background:#e9c500;">
			 <a href="<?=$index_banner[2]->url?>" class="read-more">更多</a>
			</div>
		 </div>
	  </li>
    <?}?>
   </ul>
  <div class="tp-bannertimer"></div>
 </div>
</div>
   <!--End Banner-->
   <!--Start Content-->
   <div class="content">
   <!--Start Welcome-->
    <div class="welcome dark-back basic">
     <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="main-title">
              <h2><span>認識</span> 我們</h2>
              <p>致力推展居家醫療及護理優質服務，落實在宅健康老化，實現溫感心的新服務。</p>
          </div>
        </div>
     </div>
		 <div id="tabbed-nav">
      <ul>
        <?foreach($get_IndexAboutList as $row){?>
        <li><a><?=$row->About_Title?></a></li>
        <?}?>
      </ul>
      <div>
        <?foreach($get_IndexAboutList as $row){?>
        <div>
          <div class="row">
            <div class="col-md-6">
              <div class="welcome-serv-img">
                <img src="<?=_Web_Url?>/images/about/<?=$row->About_Img?>" alt="<?=$row->About_Title?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="detail">
                <?=$row->About_Content?>
              </div>
            </div>
          </div>
        </div>
        <?}?>
       </div>
      </div>
     </div>
   </div>
   <!--End Welcome-->
   <!--Start Latest News-->
   <div class="latest-news dark-back">
   	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="main-title">
            <h2><span>最新消息</span></h2>
            <p></p>
          </div>
        </div>
      </div>
      <div id="latest-news">
        <div class="container">
          <div class="row">
            <div class="span12">
              <div id="owl-demo" class="owl-carousel">
               <?foreach ($get_IndexNewsList as $row) {?>
               <div class="post item">
                <img class="lazyOwl" src="<?=_Web_Url?>/images/news/thumbnail/<?=$row->News_Img?>" alt="<?=$row->News_Title?>">
                <div class="detail">
                  <h4><a href="<?=_Web_Url?>/news/detail/<?=$row->News_Id?>"><?=$row->News_Title?></a></h4>
                  <p><?=fafa_text_limit($row->News_Content,30,$text='...')?></p>
                  <span><i class="icon-clock3"></i> <?=$row->News_PulTime?></span>
                </div>
               </div>
               <?}?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
 </div>
   <!--End Latest News-->
   </div>
   <!--End Content-->
<?=$Footer?>
<!-- Revolution Slider -->
<script type="text/javascript">
jQuery('.tp-banner').show().revolution(
{
dottedOverlay:"none",
delay:16000,
startwidth:1170,
startheight:720,
hideThumbs:200,

thumbWidth:100,
thumbHeight:50,
thumbAmount:5,

navigationType:"nexttobullets",
navigationArrows:"solo",
navigationStyle:"preview",

touchenabled:"on",
onHoverStop:"on",

swipe_velocity: 0.7,
swipe_min_touches: 1,
swipe_max_touches: 1,
drag_block_vertical: false,

parallax:"mouse",
parallaxBgFreeze:"on",
parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

keyboardNavigation:"off",

navigationHAlign:"center",
navigationVAlign:"bottom",
navigationHOffset:0,
navigationVOffset:20,

soloArrowLeftHalign:"left",
soloArrowLeftValign:"center",
soloArrowLeftHOffset:20,
soloArrowLeftVOffset:0,

soloArrowRightHalign:"right",
soloArrowRightValign:"center",
soloArrowRightHOffset:20,
soloArrowRightVOffset:0,

shadow:0,
fullWidth:"on",
fullScreen:"off",

spinner:"spinner4",

stopLoop:"off",
stopAfterLoops:-1,
stopAtSlide:-1,

shuffle:"off",

autoHeight:"off",
forceFullWidth:"off",



hideThumbsOnMobile:"off",
hideNavDelayOnMobile:1500,
hideBulletsOnMobile:"off",
hideArrowsOnMobile:"on",
hideThumbsUnderResolution:0,

hideSliderAtLimit:0,
hideCaptionAtLimit:0,
hideAllCaptionAtLilmit:0,
startWithSlide:0,
videoJsPath:"rs-plugin/videojs/",
fullScreenOffsetContainer: ""
});
</script>


</body>
</html>

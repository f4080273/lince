<?=$Head?>
 <div id="wrap">
   <!--Start Header-->
   <?=$TopMenu?>
   <!--End Header-->
	 <section class="header-title" style="background: url(<?=_Web_Url?>/images/banner/<?=$page_banner[0]->img?>) no-repeat center top;padding-top: 127px;height: 280px;">
		<div class="container">
			<div class="row">
				<div class="title">
					<h2>最新消息</h2>
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
					<li><span>最新消息</span></li>
				</ul>
  		</div>
  	</div>
   </section>
   <section class="news-section">
		<div class="container">
			<div class="row">
        <div class="col-md-9">
						<div class="left-wraper" >
							<div class="news_one-single">
								<div class="img-box image">
									<img src="<?=_Web_Url?>/images/news/<?=$get_NewsDataById->News_Img?>" alt="<?=$get_NewsDataById->News_Title?>" />
								</div>
								<div class="text-box">
									<h4><?=$get_NewsDataById->News_Title?></h4>
									<p >
										<a class="path" href="" ><i class="fa fa-clock-o" aria-hidden="true"></i><?=$get_NewsDataById->News_PulTime?> </a>
									</p>
									<div class="text">
										<?=$get_NewsDataById->News_Content?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<div class="col-md-3">
					<aside class="blog-info">
						<?=$Search?>
						<?=$RightNews?>
					 </div>
					</aside>
				</div>
			</div>
		</div>
	</section>
	 <?=$Footer?>
	</body>
</html>

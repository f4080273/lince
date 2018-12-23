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
					<div class="news-wraper">
            <?foreach($get_NewsList['ListData'] as $row){?>
            <div class="col-md-6">
							<div class="news-box">
								<div class="img-box">
									<img src="<?=_Web_Url?>/images/news/thumbnail/<?=$row->News_Img?>" alt="<?=$row->News_Title?>">
								</div>
								<div class="text-box">
									<div class="header">
										<h4><?=$row->News_Title?></h4>
										<p>
											<?=$row->News_PulTime?>
										</p>
									</div>
									<div class="text">
										<p>
											<?=fafa_text_limit($row->News_Content,40,$text='...')?>
										</p>
										<a href="<?=_Web_Url?>/news/detail/<?=$row->News_Id?>">更多</a>
									</div>
								</div>
							</div>
						</div>
            <?}?>
            <?=$get_NewsList['PageData']?>
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

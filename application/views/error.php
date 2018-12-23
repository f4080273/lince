<?=$Head?>
  <?=$TopMenu?>
  <?foreach ($BannerList as $row){
    if($row->Banner_TypeId == 2){
  ?>
	<section class="page-title" style="background:url(<?=_Web_Url?>/images/banner/<?=$row->Banner_Img?>) center center no-repeat;">
		<div class="container">
			<h2>404 錯誤!</h2>
			<ul class="list-inline">
				<li><a href="<?_Web_Url?>/web/index/<?=$WebConfig->WebConfig_MemberId?>">首頁</a></li>
				<li><span></span></li>
			</ul><!-- /.list-inline -->
		</div><!-- /.container -->
	</section><!-- /.page-title -->
  <?}}?>
  <section class="error-page">
		<div class="container">
			<div class="col-md-12">
				<div class="404-content">
					<h2>錯誤</h2>
					<p><?=errors_code($Error_Message)?></p>
					<a href="<?=_Web_Url?>/web/index/<?=$WebConfig->WebConfig_MemberId?>" class="thm-btn">回首頁</a>
				</div><!-- /.404-content -->
			</div><!-- /.col-md-6 -->
		</div><!-- /.container -->
	</section><!-- /.error-page -->
  <?=$Footer?>
</body>
</html>

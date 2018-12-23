<form action="<?=_Web_Url?>/admin/<?=$type?>_Data" method="post" name="add_form" id="add_form" enctype="multipart/form-data">
	<input type="hidden" name="action" value="banner_setup" >
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-6">
						<h4>首頁輪播1</h4>
						<?
							$temp = json_decode($get_data_list['Data']['banner1']->varB);
							if($temp->img)
							{
								echo ImgUploadTemplate('banner_i_1','1900','748',_Img_Url.'/images/banner/'.$temp->img);
							}
							else {
								echo ImgUploadTemplate('banner_i_1','1900','748');
							}
						?>
						<div class="form-group">
							<label for="banner_i_1_url">標題</label>
							<input type="text" class="form-control" name="banner_i_1_title1"  value="<?=$temp->title1?>">
						</div>
						<div class="form-group">
							<label for="banner_i_1_url">內容一</label>
							<input type="text" class="form-control" name="banner_i_1_text1"  value="<?=$temp->text1?>">
						</div>
						<div class="form-group">
							<label for="banner_i_1_url">內容二</label>
							<input type="text" class="form-control" name="banner_i_1_text2"  value="<?=$temp->text2?>">
						</div>
						<div class="form-group">
							<label for="banner_i_1_url">更多連結網址</label>
							<input type="text" class="form-control" name="banner_i_1_url"  value="<?=$temp->url?>">
						</div>
						<h4>首頁輪播2</h4>
						<?
							$temp = json_decode($get_data_list['Data']['banner1']->varC);
							if($temp->img)
							{
								echo ImgUploadTemplate('banner_i_2','1900','748',_Img_Url.'/images/banner/'.$temp->img);
							}
							else {
								echo ImgUploadTemplate('banner_i_2','1900','748');
							}
						?>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="banner_i_2_url">標題一</label>
									<input type="text" class="form-control" name="banner_i_2_title1"  value="<?=$temp->title1?>">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="banner_i_2_url">標題二</label>
									<input type="text" class="form-control" name="banner_i_2_title2"  value="<?=$temp->title2?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="banner_i_2_url">內容一</label>
							<input type="text" class="form-control" name="banner_i_2_text1"  value="<?=$temp->text1?>">
						</div>
						<div class="form-group">
							<label for="banner_i_2_url">內容二</label>
							<input type="text" class="form-control" name="banner_i_2_text2"  value="<?=$temp->text2?>">
						</div>
						<div class="form-group">
							<label for="banner_i_2_url">內容三</label>
							<input type="text" class="form-control" name="banner_i_2_text3"  value="<?=$temp->text3?>">
						</div>
						<div class="form-group display">
							<label for="banner_i_2_url">連結網址</label>
							<input type="text" class="form-control" name="banner_i_2_url"  value="<?=$temp->url?>">
						</div>
						<h4>首頁輪播3</h4>
						<?
							$temp = json_decode($get_data_list['Data']['banner1']->varD);
							if($temp->img)
							{
								echo ImgUploadTemplate('banner_i_3','1900','748',_Img_Url.'/images/banner/'.$temp->img);
							}
							else {
								echo ImgUploadTemplate('banner_i_3','1900','748');
							}
						?>
						<div class="form-group">
							<label for="banner_i_2_url">標題一</label>
							<input type="text" class="form-control" name="banner_i_3_title1"  value="<?=$temp->title1?>">
						</div>
						<div class="form-group">
							<label for="banner_i_2_url">標題二</label>
							<input type="text" class="form-control" name="banner_i_3_title2"  value="<?=$temp->title2?>">
						</div>
						<div class="form-group">
							<label for="banner_i_2_url">內文</label>
							<input type="text" class="form-control" name="banner_i_3_text1"  value="<?=$temp->text1?>">
						</div>
						<div class="form-group">
							<label for="banner_i_2_url">連結網址</label>
							<input type="text" class="form-control" name="banner_i_3_url"  value="<?=$temp->url?>">
						</div>
					</div>
					<div class="col-6">
						<h4>內頁輪播圖</h4>
						<?
							$temp = json_decode($get_data_list['Data']['banner2']->varB);
							if($temp->img)
							{
								echo ImgUploadTemplate('banner_n_1','1920','280',_Img_Url.'/images/banner/'.$temp->img);
							}
							else {
								echo ImgUploadTemplate('banner_n_1','1920','280');
							}
						?>
						<div class="form-group display">
							<label for="banner_n_1_url">連結網址</label>
							<input type="text" class="form-control" name="banner_n_1_url"  value="<?=$temp->url?>">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card-box">
			<? if($type=='add'){?>
				<div class="fixed-box-right">
					<a class="btn" href="javascript:void(0)" onclick="form_check(add_form); return false;">確定</br>新增</a>
				</div>
				<div class="col-md-12 text-center">
					<a class="btn btn-success waves-effect w-md waves-light" href="javascript:void(0)" onclick="form_check(add_form); return false;">確定新增</a>
				</div>
			<? }else{?>
				<div class="fixed-box-right">
					<a class="btn" href="javascript:void(0)" onclick="form_check(add_form); return false;">確定</br>修改</a>
				</div>
				<div class="col-md-12 text-center">
					<a class="btn btn-success waves-effect w-md waves-light" href="javascript:void(0)" onclick="form_check(add_form); return false;">確定修改</a>
				</div>
			<?}?>
			</div>
		</div>
	</div>
</form>
<!-- jcrop js -->
<script src="<?=_Web_Url?>/assets/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
<!-- Bootstrap fileupload js -->
<script src="<?=_Web_Url?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<link rel="stylesheet" href="<?=_Web_Url?>/assets/plugins/jcrop/css/jquery.Jcrop.min.css" type="text/css" />
<script>
function form_check(form) {
	document.getElementById('add_form').submit();
	return true;
}
</script>

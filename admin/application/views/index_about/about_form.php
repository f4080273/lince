<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/index_about/about_admin/list/0/<?=$Page."?".http_build_query($this->input->get())?>">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="<?=_Web_Url?>/index_about/<?=$Type?>_Data"　role="from" method="post" id="add_form" name="add_form" enctype="multipart/form-data">
	        	<input type="hidden" name="id" value="<? if(isset($DataArray -> About_Id)){echo $DataArray -> About_Id;}?>" />
	        	<input type="hidden" name="action" value="index_about" />
						<input type="hidden" name="page" value="<?=$Page?>" />
						<input type="hidden" name="seo_id" value="<?=($DataArray -> About_SeoId)?$DataArray -> About_SeoId:""?>" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
				        	<label for="status">啟用狀態</label>
				        	<select name="About_Status" class="form-control">
			        			<option value="1" <? if(isset($DataArray -> About_Status)){ echo $DataArray -> About_Status=='1' ? 'selected' : '';}?>>開啟</option>
			            	<option value="0" <? if(isset($DataArray -> About_Status)){ echo $DataArray -> About_Status=='0' ? 'selected' : '';}?>>關閉</option>
			            </select>
								</div>
								<div class="form-group">
				        	<label for="textfield">排序</label>
				        	<input class="form-control" name="About_Sort" type="text" value="<? if(isset($DataArray -> About_Sort)){echo $DataArray -> About_Sort;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="textfield">標題</label>
				        	<input class="form-control" name="About_Title" type="text" value="<? if(isset($DataArray -> About_Title)){echo $DataArray -> About_Title;}?>" />
				        </div>
								<div class="form-group">
									 <label for="textfield">內文</label>
				           <textarea class="form-control" name="About_Content" rows="25" cols="120" style="border:0;"><? if(isset($DataArray -> About_Content)){echo $DataArray -> About_Content;}?></textarea>
				        </div>
							</div>
							<div class="col-6">
								<h4>圖片</h4>
								<?
									if($DataArray -> About_Img)
									{
										echo ImgUploadTemplate('About_Img','555','414',_Img_Url.'/images/about/'.$DataArray->About_Img);
									}
									else {
										echo ImgUploadTemplate('About_Img','555','414');
									}
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<? if($Type=='add'){?>
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
</div>
<!-- jcrop js -->
<script src="<?=_Web_Url?>/assets/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
<!-- Bootstrap fileupload js -->
<script src="<?=_Web_Url?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<link rel="stylesheet" href="<?=_Web_Url?>/assets/plugins/jcrop/css/jquery.Jcrop.min.css" type="text/css" />
<script>
$(function () {
	open_ck("About_Content");
	$('.select2').select2();
});
function form_check(form) {
	document.getElementById('add_form').submit();
	return true;
}
</script>

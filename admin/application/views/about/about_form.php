<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/about/about_admin/list/0/<?=$Page."?".http_build_query($this->input->get())?>">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="<?=_Web_Url?>/about/<?=$Type?>_Data"　role="from" method="post" id="add_form" name="add_form" enctype="multipart/form-data">
	        	<input type="hidden" name="id" value="<? if(isset($DataArray -> About_Id)){echo $DataArray -> About_Id;}?>" />
	        	<input type="hidden" name="action" value="about" />
						<input type="hidden" name="page" value="<?=$Page?>" />
						<input type="hidden" name="seo_id" value="<?=($DataArray -> About_SeoId)?$DataArray -> About_SeoId:""?>" />
						<input type="hidden" name="type_id" value="<?=($DataArray -> About_AboutTypeId)?$DataArray -> About_AboutTypeId:$this->input->get('type_id')?>" />
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
										echo ImgUploadTemplate('About_Img','600','500',_Img_Url.'/images/about/'.$DataArray->About_Img);
									}
									else {
										echo ImgUploadTemplate('About_Img','600','500');
									}
								?>
								<div class="col-md-12">
									<div class="form-group">
					        	<label for="textfield">SEO標題<?=($Type=='add')?"(不輸入自動帶入標題)":"";?></label>
					        	<input class="form-control" name="DetailSeo_Title" type="text" value="<? if(isset($DataArray -> DetailSeo_Title)){echo $DataArray -> DetailSeo_Title;}?>" />
					        </div>
									<div class="form-group">
					        	<label for="textfield">SEO關鍵字<?=($Type=='add')?"(不輸入自動帶入標籤)":"";?></label>
										<div class="tags-default">
											<input class="form-control" name="DetailSeo__Keys" data-role="tagsinput" type="text" value="<? if(isset($DataArray -> DetailSeo__Keys)){echo $DataArray -> DetailSeo__Keys;}?>" />
										</div>
									</div>
									<div class="form-group">
					        	<label for="textfield">SEO內文<?=($Type=='add')?"(不輸入自動帶入內文)":"";?></label>
					        	<textarea class="form-control" name="DetailSeo__Contents" ><? if(isset($DataArray -> DetailSeo__Contents)){echo $DataArray -> DetailSeo__Contents;}?></textarea>
					        </div>
									<?if($_SESSION['UserData']['power'] == 2){?>
									<div class="form-group">
					        	<label for="textfield">自由代碼區</label>
					        	<textarea class="form-control" name="DetailSeo_SelfContents" ><? if(isset($DataArray -> DetailSeo_SelfContents)){echo $DataArray -> DetailSeo_SelfContents;}?></textarea>
					        </div>
									<?}?>
								</div>
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

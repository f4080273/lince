<form action="<?=_Web_Url?>/index.php/admin/<?=$type?>_Data" method="post" name="add_form" id="add_form" enctype="multipart/form-data">
	<input type="hidden" name="action" value="base_setup" >
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-6">
						<h4>網站相關設置</h4>
						<div class="form-group">
					    <label for="exampleInputEmail1">網站名稱</label>
					    <input type="text" class="form-control" name="web_name"  value="<?=$get_data_list['web_define']-> varB?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">網站LOGO圖</label>
							<?
								if($get_data_list['web_define'] -> varA)
								{
									echo ImgUploadTemplate('logo','465','151',_Img_Url.'/images/'.$get_data_list['web_define'] -> varA);
								}
								else {
									echo ImgUploadTemplate('logo','465','151');
								}
							?>
					  </div>
						<div class="form-group">
							 <label for="textfield">網站簡介</label>
							 <textarea class="form-control" name="web_content" rows="25" cols="120" placeholder="請輸入您的網站簡介"><? if(isset($get_data_list['web_define'] -> varC)){echo $get_data_list['web_define'] -> varC;}?></textarea>
						</div>
						<div class="form-group">
							 <label for="textfield">服務時間</label>
							 <textarea class="form-control" name="web_service_time" rows="25" cols="120"><? if(isset($get_data_list['web_define'] -> varD)){echo $get_data_list['web_define'] -> varD;}?></textarea>
						</div>
						<h4>聯絡人信箱設置</h4>
						<div class="form-group">
					    <label for="exampleInputEmail1">聯絡人名稱</label>
							<div class="tags-default">
					    	<input class="form-control" name="mail_profile_name" type="text" value="<?=$get_data_list['mail_profile']->varA?>">
							</div>
						</div>
						<div class="form-group">
					    <label for="exampleInputEmail1">信箱(可復數)</label>
							<div class="tags-default">
					    	<input class="form-control" name="mail_profile_email" type="text" data-role="tagsinput" value="<?=$get_data_list['mail_profile']->varB?>">
							</div>
						</div>
					</div>
					<div class="col-6">
						<h4>聯絡資訊(居家護理所)-不輸入則不顯示</h4>
						<div class="form-group">
					    <label for="exampleInputEmail1">電話</label>
					    <input type="email" class="form-control" name="contract1_tel" data-role="tagsinput" value="<?=$get_data_list['contract1']->varA?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">傳真</label>
					    <input type="text" class="form-control" name="contract1_fax" data-role="tagsinput" value="<?=$get_data_list['contract1']->varB?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">手機</label>
					    <input type="text" class="form-control" name="contract1_phone" data-role="tagsinput" value="<?=$get_data_list['contract1']->varC?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">地址</label>
					    <input type="text" class="form-control" name="contract1_address" value="<?=$get_data_list['contract1']->varD?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">郵件</label>
					    <input type="text" class="form-control" name="contract1_email" data-role="tagsinput" value="<?=$get_data_list['contract1']->varE?>">
					  </div>
						<h4>聯絡資訊(診所)-不輸入則不顯示</h4>
						<div class="form-group">
					    <label for="exampleInputEmail1">電話</label>
					    <input type="email" class="form-control" name="contract2_tel" data-role="tagsinput" value="<?=$get_data_list['contract2']->varA?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">傳真</label>
					    <input type="text" class="form-control" name="contract2_fax" data-role="tagsinput" value="<?=$get_data_list['contract2']->varB?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">手機</label>
					    <input type="text" class="form-control" name="contract2_phone" data-role="tagsinput" value="<?=$get_data_list['contract2']->varC?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">地址</label>
					    <input type="text" class="form-control" name="contract2_address" value="<?=$get_data_list['contract2']->varD?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">郵件</label>
					    <input type="text" class="form-control" name="contract2_email" data-role="tagsinput" value="<?=$get_data_list['contract2']->varE?>">
					  </div>
						<h4>聯絡資訊(申訴方式)-不輸入則不顯示</h4>
						<div class="form-group">
					    <label for="exampleInputEmail1">姓名</label>
					    <input type="email" class="form-control" name="contract3_name" value="<?=$get_data_list['contract3']->varA?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">電話</label>
					    <input type="text" class="form-control" name="contract3_phone" data-role="tagsinput" value="<?=$get_data_list['contract3']->varB?>">
					  </div>
						<div class="form-group">
					    <label for="exampleInputEmail1">郵件</label>
					    <input type="text" class="form-control" name="contract3_email" data-role="tagsinput" value="<?=$get_data_list['contract3']->varC?>">
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
$(function () {
	open_ck("web_service_time");
});
function form_check(form) {
	document.getElementById('add_form').submit();
	return true;
}
</script>

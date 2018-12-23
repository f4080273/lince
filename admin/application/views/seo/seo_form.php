<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/seo/seo_admin/list/0/<?=$Page."?".http_build_query($this->input->get())?>">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
				<form action="<?=_Web_Url?>/seo/<?=$Type?>_Data"　role="from" method="post" id="add_form" name="add_form" enctype="multipart/form-data">
        		<input type="hidden" name="id" value="<? if(isset($DataArray -> Seo_Id)){echo $DataArray -> Seo_Id;}?>" />
	        	<input type="hidden" name="action" value="seo" />
						<div class="form-group">
							<label for="textfield">頁面名稱：<strong><? if(isset($DataArray -> Seo_Name)){echo $DataArray -> Seo_Name;}?></strong></label>
						</div>
						<div class="form-group">
							<label for="textfield">SEO標題</label>
							<input class="form-control" name="Seo_Title" type="text" value="<? if(isset($DataArray -> Seo_Title)){echo $DataArray -> Seo_Title;}?>" />
						</div>
						<div class="form-group">
							<label for="textfield">SEO關鍵字</label>
							<div class="tags-default">
								<input class="form-control" name="Seo_Keys" data-role="tagsinput" type="text" value="<? if(isset($DataArray -> Seo_Keys)){echo $DataArray -> Seo_Keys;}?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="textfield">SEO內文</label>
							<textarea class="form-control" name="Seo_Contents" ><? if(isset($DataArray -> Seo_Contents)){echo $DataArray -> Seo_Contents;}?></textarea>
						</div>
						<?if($_SESSION['UserData']['power'] == 2){?>
						<div class="form-group">
							<label for="textfield">自由代碼區</label>
							<textarea class="form-control" name="Seo_SelfContents" ><? if(isset($DataArray -> Seo_SelfContents)){echo $DataArray -> Seo_SelfContents;}?></textarea>
						</div>
						<?}?>
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
<script>
function form_check(form) {
	document.getElementById('add_form').submit();
	return true;
}
</script>

<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/catalog/catalog_admin/list/0/<?=$Page."?".http_build_query($this->input->get())?>">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="<?=_Web_Url?>/index.php/catalog/<?=$Type?>_Data"　role="from" method="post" id="add_form" name="add_form" enctype="multipart/form-data">
	        	<input type="hidden" name="id" value="<? if(isset($DataArray -> Catalog_Id)){echo $DataArray -> Catalog_Id;}?>" />
	        	<input type="hidden" name="action" value="catalog" />
						<input type="hidden" name="seo_id" value="<?=($DataArray -> Catalog_SeoId)?$DataArray -> Catalog_SeoId:""?>" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
				        	<label for="textfield">上層類別</label>
									<select class="form-control" name="Catalog_ParentId" >
			              <option value="0">請選分類</option>
			              <?
											foreach ($get_CatalogList as $row) {
										?>
			                <option value="<?=$row->Catalog_Id?>" <?=($DataArray -> Catalog_ParentId == $row->Catalog_Id)?"selected":"";?> ><?=$row->Catalog_Name?></option>
			              <?}?>
			            </select>
				        </div>
								<div class="form-group">
				        	<label for="status">啟用狀態</label>
				        	<select name="Catalog_Status" class="select-small_d form-control">
			        			<option value="1" <? if(isset($DataArray -> Catalog_Status)){ echo $DataArray -> Catalog_Status=='1' ? 'selected' : '';}?>>開啟</option>
			            	<option value="0" <? if(isset($DataArray -> Catalog_Status)){ echo $DataArray -> Catalog_Status=='0' ? 'selected' : '';}?>>關閉</option>
			            </select>
								</div>
								<div class="form-group">
				        	<label for="textfield">類別順序</label>
				        	<input class="form-control" name="Catalog_Sort" type="text" value="<? if(isset($DataArray -> Catalog_Sort)){echo $DataArray -> Catalog_Sort;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="textfield">類別名稱</label>
				        	<input class="form-control" name="Catalog_Name" type="text" value="<? if(isset($DataArray -> Catalog_Name)){echo $DataArray -> Catalog_Name;}?>" />
				        </div>
								<h4>圖片</h4>
								<?
									if($DataArray -> Catalog_Image)
									{
										echo ImgUploadTemplate('Catalog_Image','1024','768',_Img_Url.'/images/catalog/'.$DataArray->Catalog_Image);
									}
									else {
										echo ImgUploadTemplate('Catalog_Image','1024','768');
									}
								?>
							</div>
							<div class="col-md-6">
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
	open_ck("Product_Contents");
	$('.select2').select2();
});
function form_check(form) {
	document.getElementById('add_form').submit();
	return true;
}
</script>

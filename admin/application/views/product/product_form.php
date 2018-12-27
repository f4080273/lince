<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/product/product_admin/list/0/<?=$Page."?".http_build_query($this->input->get())?>">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="<?=_Web_Url?>/index.php/product/<?=$Type?>_Data"　role="from" method="post" id="add_form" name="add_form" enctype="multipart/form-data">
	        	<input type="hidden" name="id" value="<? if(isset($DataArray -> Product_Id)){echo $DataArray -> Product_Id;}?>" />
	        	<input type="hidden" name="action" value="product" />
						<input type="hidden" name="seo_id" value="<?=($DataArray -> Product_SeoId)?$DataArray -> Product_SeoId:""?>" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
				        	<label for="textfield">類別</label>
									<select class="form-control" name="Product_CatalogId" >
			              <option value="0">請選分類</option>
			              <?
											foreach ($get_CatalogList as $row) {
										?>
			                <option value="<?=$row->Catalog_Id?>" <?=($DataArray -> Product_CatalogId == $row->Catalog_Id)?"selected":"";?> ><?=$row->Catalog_Name?></option>
			              <?}?>
			            </select>
				        </div>
								<div class="form-group">
				        	<label for="status">啟用狀態</label>
				        	<select name="Product_Status" class="select-small_d form-control">
			        			<option value="1" <? if(isset($DataArray -> Product_Status)){ echo $DataArray -> Product_Status=='1' ? 'selected' : '';}?>>開啟</option>
			            	<option value="0" <? if(isset($DataArray -> Product_Status)){ echo $DataArray -> Product_Status=='0' ? 'selected' : '';}?>>關閉</option>
			            </select>
								</div>
								<div class="form-group">
				        	<label for="textfield">產品順序</label>
				        	<input class="form-control" name="Product_Sort" type="text" value="<? if(isset($DataArray -> Product_Sort)){echo $DataArray -> Product_Sort;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="textfield">產品編號</label>
				        	<input class="form-control" name="Product_Sku" type="text" value="<? if(isset($DataArray -> Product_Sku)){echo $DataArray -> Product_Sku;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="textfield">產品名稱</label>
				        	<input class="form-control" name="Product_Name" type="text" value="<? if(isset($DataArray -> Product_Name)){echo $DataArray -> Product_Name;}?>" />
				        </div>
				        <div class="form-group">
									 <label for="textfield">產品詳細</label>
				           <textarea class="form-control" name="Product_Contents" rows="25" cols="120" style="border:0;"><? if(isset($DataArray -> Product_Contents)){echo $DataArray -> Product_Contents;}?></textarea>
				        </div>
							</div>
							<div class="col-md-6">
								<h4>圖片</h4>
								<?
									if($DataArray -> Product_Images)
									{
										echo ImgUploadTemplate('Product_Images','600','500',_Img_Url.'/images/product/'.$DataArray->Product_Images);
									}
									else {
										echo ImgUploadTemplate('Product_Images','600','500');
									}
								?>
							</div>
						</div>
					</form>
				</div>
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

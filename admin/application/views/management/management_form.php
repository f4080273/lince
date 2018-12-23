<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/admin/management/list/0/<?=$Page."?".http_build_query($this->input->get())?>">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="<?=_Web_Url?>/admin/<?=$Type?>_Data"　role="from" method="post" id="add_form" name="add_form" enctype="multipart/form-data">
	        	<input type="hidden" name="id" value="<? if(isset($DataArray -> number)){echo $DataArray -> number;}?>" />
	        	<input type="hidden" name="action" value="management" />
						<input type="hidden" name="page" value="<?=$Page?>" />
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
				        	<label for="status">啟用狀態</label>
				        	<select name="enable" class="form-control">
			        			<option value="1" <? if(isset($DataArray -> enable)){ echo $DataArray -> enable=='1' ? 'selected' : '';}?>>開啟</option>
			            	<option value="0" <? if(isset($DataArray -> enable)){ echo $DataArray -> enable=='0' ? 'selected' : '';}?>>關閉</option>
			            </select>
								</div>
								<div class="form-group">
				        	<label for="textfield">帳號</label>
				        	<input class="form-control" name="account" type="text" value="<? if(isset($DataArray -> account)){echo $DataArray -> account;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="textfield">密碼</label>
				        	<input class="form-control" name="pw" type="text" value="<? if(isset($DataArray -> pw)){echo $DataArray -> pw;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="textfield">名稱</label>
				        	<input class="form-control" name="name" type="text" value="<? if(isset($DataArray -> name)){echo $DataArray -> name;}?>" />
				        </div>
								<div class="form-group">
				        	<label for="status">帳號類型</label>
									<select name="power" class="form-control">
			        			<option value="2" <? if(isset($DataArray -> power)){ echo $DataArray -> power=='1' ? 'selected' : '';}?>><?=Power(2)?></option>
			            	<option value="0" <? if(isset($DataArray -> power)){ echo $DataArray -> power=='0' ? 'selected' : '';}?>><?=Power(0)?></option>
			            </select>
								</div>
								<div class="form-group">
									<label for="status">權限設定</label>
									<div class="col-lg-12">
									<?

										foreach($get_ModelList as $row)
										{
											if($row->class_number == 0){
									?>
										<div class="col-xs-2 model-box">
											<label class="checkbox-inline main-model">
												<input type="checkbox" name="authority[]" data-number="<?=$row->number?>" value="<?=$row -> model_name?>" <?=(in_array($row -> model_name,$AuthorityArray))?'checked="checked"':'';?> >
												<?=$row -> model_title?>
											</label>
										<?
											foreach($get_ModelList as $row2){
												if($row->number==$row2->class_number){
										?>
											<div class="checkbox sub-model">
										    	<label>
										      		<input class="sub<?=$row2->class_number?>" type="checkbox" name="authority[]" value="<?=$row2 -> model_name?>" <?=(in_array($row2 -> model_name,$AuthorityArray))?'checked="checked"':'';?> >
										      		<?=$row2 -> model_title?>
										    	</label>
										  	</div>
										<?}}?>
										</div>
										<?}?>
									<?}?>
									</div>
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
<script>
$(function () {
	$('#datetimepicker1').datetimepicker({
				language:  'zh-TW',
        format: 'yyyy-mm-dd hh:ii:00',
				weekStart: 1,
        todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				forceParse: 0,
        showMeridian: 1
    });
});
function form_check(form) {

	document.getElementById('add_form').submit();

	return true;
}
</script>

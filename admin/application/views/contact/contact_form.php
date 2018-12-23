<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<a class="pull-right btn btn-primary" href="<?=_Web_Url?>/contact/contact_admin">回上一頁</a>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
 						<label for="exampleInputEmail1">姓名：<?=$DataArray->Contact_Name?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">性別：<?=($DataArray->Contact_Sex)?"男":"女"?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">信箱/FB：<?=$DataArray->Contact_Email?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">行動電話：<?=$DataArray->Contact_Phone?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">市話：<?=$DataArray->Contact_Tel?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">地址：<?=$DataArray->Contact_Address?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">方便連絡時間：<?=$DataArray->Contact_ContractT?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">諮詢或希望協助事項：<?=fafa_contract_ask($DataArray->Contact_Ask)?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">內容：<?=$DataArray->Contact_Content?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">新增時間：<?=$DataArray->Contact_AddTime?></label>
          </div>
					<div class="form-group">
 						<label for="exampleInputEmail1">查看時間：<?=$DataArray->Contact_CheckTime?></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

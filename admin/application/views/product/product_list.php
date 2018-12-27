<div class="row">
 <div class="col-sm-12">
   <div class="card-box">
     <div class="form-group">
       <form class="form-inline" method="GET">
         <div class="form-group" style="margin:10px 10px 0px 0px">
           <div class="input-group">
             <div class="input-group-addon">上層類別</div>
             <select class="form-control" name="type_id" style="min-width: 170px;">
               <option value="0">請選分類</option>
               <?
                 foreach ($get_CatalogList as $row) {
                   $CatalogList[0] = '父類別';
                   $CatalogList[$row->Catalog_Id] = $row->Catalog_Name;
               ?>
                 <option value="<?=$row->Catalog_Id?>" <?=($this->input->get('type_id') == $row->Catalog_Id)?"selected":"";?> ><?=$row->Catalog_Name?></option>
               <?}?>
             </select>
           </div>
         </div>
        <div class="form-group" style="margin:10px 10px 0px 0px">
          <div class="input-group">
            <div class="input-group-addon">商品名稱</div>
            <input type="text" class="form-control" name="name" placeholder="請填入名稱" value="<?=$this->input->get('name')?>">
          </div>
        </div>
        <div class="form-group" style="margin:10px 10px 0px 0px">
          <div class="input-group">
            <div class="input-group-addon">商品內文</div>
            <input type="text" class="form-control" name="contents" placeholder="請填入內文" value="<?=$this->input->get('contents')?>">
          </div>
        </div>
        <button style="margin-top:10px" type="submit" class="btn btn-primary">搜尋</button>
      </form>
     </div>
     <div class="row">
         <div class="col-sm-6">
             <div class="m-b-30">
              <button id="addToTable" class="btn btn-danger waves-effect waves-light" onclick="del_data()">刪除 <i class="mdi mdi-delete"></i></button>
             </div>
         </div>
         <div class="col-sm-6">
             <div class="m-b-30 text-right">
                 <a href="<?=_Web_Url?>/product/product_admin/add" id="addToTable" class="btn btn-success waves-effect waves-light">新增 <i class="mdi mdi-plus-circle-outline"></i></a>
             </div>
         </div>
     </div>
     <div class="row">
       <div class="table-responsive">
         <table class="table table-colored table-primary" id="datatable">
           <thead>
             <tr>
               <th class="sorting_disabled first-th tg-checkbox">
							 	<input id="all-pupo" type="checkbox"  onclick="choose_all()">
							 </th>
               <th>開啟</th>
							 <th>順序</th>
               <th>產品分類</th>
							 <th>產品名稱</th>
							 <th>產品內容</th>
							 <th>最後更新</th>
               <th class="sorting_disabled">操作</th>
             </tr>
           </thead>
           <tbody>
             <?
             $x = 1;
             if($DataList)
             {
               foreach($DataList as $row)
               {
             ?>
             <tr>
                 <td class="text-center tg-checkbox">
                    <input id="checkbox<?=$x?>" type="checkbox" name="number[]" value="<?=$row -> Product_Id?>">
                 </td>
                 <td><?=($row ->Product_Status)?'啟用':'關閉'?></td>
                 <td><?=$row -> Product_Sort?></td>
                 <td><?=$CatalogList[$row -> Product_CatalogId]?></td>
                 <td><?=$row -> Product_Name?></td>
                 <td><?=$row -> Product_Contents?></td>
                 <td><?=$row -> Product_EditTime?></td>
                 <td class="actions" >
                   <a href="<?=_Web_Url?>/product/product_admin/edit/<?=$row -> Product_Id?>/<?=$Page."?".http_build_query($this->input->get())?>" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="修改">
                     <i class="fa fa-pencil"></i>
                   </a>
                 </td>
             </tr>
             <?$x++;}}?>
           </tbody>
         </table>
       </div>
     </div>
     <div class="row">
       <?=$PageList?>
     </div>
   </div>
 </div>
</div>
<script type="text/javascript">
	function choose_all()
	{
	  if($('#all-pupo').prop("checked"))
	  {
	    $("input[name='number[]']").each(function() {
	    	 $(this).prop("checked", true);
	     });
	    }else{
	    $("input[name='number[]']").each(function() {
	    	 $(this).prop("checked", false);
	     });
	  }
	}

	function del_data()
	{
		if(confirm('您確定要刪除嗎？'))
		{
			number_list = '';

			$("input[name='number[]']").each(function() {
				 if($(this).is(':checked'))
				 {
					 if(number_list != '')
						number_list = number_list + ',';

					 number_list = number_list + $(this).val();
				 }
			 });

			if(number_list != '')
			{
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: "<?=_Web_Url?>/product/Del_Data",
					data:{
						'type'			:'products',
						'number_list'	:number_list
					},
					success: function(data){
						if(data.Status != '0000')
						{
							alert(data.Msg);
							return false;
						}else{
							alert('刪除成功！');
							window.location = "<?=_Web_Url?>/product/product_admin";
							return false;
						}
					}
				});
			}else{
				alert('請選擇要刪除之資料！');
			}
		}
	}
</script>

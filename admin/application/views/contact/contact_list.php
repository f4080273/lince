<div class="row">
 <div class="col-sm-12">
   <div class="card-box">
     <div class="row">
       <div class="form-group">
         <form class="form-inline" method="GET">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">真實姓名</div>
              <input type="text" class="form-control" name="name" placeholder="請填入真實姓名">
            </div>
          </div>
          <div class="form-group" style="display:none">
            <div class="input-group">
              <div class="input-group-addon">聯絡電話</div>
              <input type="text" class="form-control" name="phone" placeholder="請填入聯絡電話">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">E-mail</div>
              <input type="text" class="form-control" name="email" placeholder="請填入E-mail">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">搜尋</button>
        </form>
       </div>
     </div>
     <div class="row">
         <div class="col-sm-6">
             <div class="m-b-30">
              <button id="addToTable" class="btn btn-danger waves-effect waves-light" onclick="del_data()">刪除 <i class="mdi mdi-delete"></i></button>
             </div>
         </div>
         <div class="col-sm-6">
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
							 <th>發問時間</th>
							 <th>內文</th>
							 <th>姓名</th>
							 <th>E-mail</th>
							 <th>查看時間</th>
               <th class="sorting_disabled">操作</th>
             </tr>
           </thead>
           <tbody>
             <?
             if($DataList)
             {
               foreach($DataList as $row)
               {
             ?>
             <tr>
                 <td class="text-center tg-checkbox">
                    <input type="checkbox" name="number[]" value="<?=$row -> Contact_Id?>">
                 </td>
                 <td><?=$row -> Contact_AddTime?></td>
                 <td><?=fafa_text_limit($row -> Contact_Content,30,'...')?></td>
                 <td><?=$row -> Contact_Name?></td>
                 <td><?=$row -> Contact_Email?></td>
                 <td><?=($row -> Contact_CheckTime)?$row -> Contact_CheckTime:"尚未"?></td>
                 <td class="actions" >
                   <a href="<?=_Web_Url?>/contact/contact_admin/edit/<?=$row -> Contact_Id?>" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
                     <i class="fa fa-pencil"></i>
                   </a>
                 </td>
             </tr>
             <?}}?>
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
					url: "<?=_Web_Url?>/contact/Del_Data",
					data:{
						'type'			:'contact',
						'number_list'	:number_list
					},
					success: function(data){
						if(data.Status != '0000')
						{
							alert(data.Msg);
							return false;
						}else{
							alert('刪除成功！');
							window.location = "<?=_Web_Url?>/contact/contact_admin";
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

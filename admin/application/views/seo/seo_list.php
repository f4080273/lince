<div class="row">
 <div class="col-sm-12">
   <div class="card-box">
     <div class="row">
       <div class="table-responsive">
         <table class="table table-colored table-primary" id="datatable">
           <thead>
             <tr>
               <th class="sorting_disabled first-th tg-checkbox">
							 	<input id="all-pupo" type="checkbox"  onclick="choose_all()">
							 </th>
							 <th>頁面名稱</th>
							 <th>標題</th>
							 <th>關鍵字</th>
							 <th>內容</th>
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
                    <input type="checkbox" name="number[]" value="<?=$row -> Seo_Id?>">
                 </td>
                 <td><?=$row -> Seo_Name?></td>
                 <td><?=$row -> Seo_Title?></td>
                 <td><?=$row -> Seo_Keys?></td>
                 <td><?=fafa_text_limit($row -> Seo_Contents,50,'...')?></td>
                 <td class="actions" >
                   <a href="<?=_Web_Url?>/seo/seo_admin/edit/<?=$row -> Seo_Id?>" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
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

<div class="row">
 <div class="col-sm-12">
   <div class="card-box">
     <div class="row">
       <div class="col-sm-6">
         <div class="m-b-30">
           共<span><?=$TotalNum?></span>則
         </div>
       </div>
       <div class="col-sm-6">
         <div class="m-b-30">
          <form role="form" action="<?=_Web_Url?>/index_about/about_admin/list/4" class="form-horizontal" method="get" enctype="multipart/form-data" >
           <div class="form-group">
              <div class="input-group">
                <input type="text" name="title" class="form-control" placeholder="請輸入標題" value="<?=($_GET['title'])?$_GET['title']:""?>">
                <span class="input-group-btn">
                  <button type="submit" class="btn waves-effect waves-light btn-primary">查詢</button>
                </span>
              </div>
            </div>
          </form>
         </div>
       </div>
      </div>
      <div class="row">
         <div class="col-sm-6">
             <div class="m-b-30">
              <button id="addToTable" class="btn btn-danger waves-effect waves-light" onclick="del_data()">刪除 <i class="mdi mdi-delete"></i></button>
             </div>
         </div>
         <div class="col-sm-6">
           <div class="m-b-30 text-right">
              <a href="<?=_Web_Url?>/index_about/about_admin/add/4" id="addToTable" class="btn btn-success waves-effect waves-light">新增 <i class="mdi mdi-plus-circle-outline"></i></a>
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
               <th>狀態</th>
               <th>順序</th>
							 <th>標題</th>
               <th>內文</th>
							 <th>修改時間</th>
               <th class="sorting_disabled">操作</th>
             </tr>
           </thead>
           <tbody>
             <?
             if(count($DataList) > 0)
             {
               foreach($DataList as $row)
               {
             ?>
             <tr>
                 <td class="text-center tg-checkbox">
                    <input type="checkbox" name="number[]" value="<?=$row -> About_Id?>">
                 </td>
                 <td><?=($row -> About_Status)?"開啟":"關閉";?></td>
                 <td><?=$row -> About_Sort?></td>
                 <td><?=$row -> About_Title?></td>
                 <td><?=fafa_text_limit($row -> About_Content,40,'...')?></td>
                 <td><?=$row -> About_EditTime?></td>
                 <td class="actions" >
                   <a href="<?=_Web_Url?>/index_about/about_admin/edit/<?=$row -> About_Id?>/<?=$Page."?".http_build_query($this->input->get())?>" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看">
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
					url: "<?=_Web_Url?>/index_about/Del_Data",
					data:{
						'action'			:'about',
						'number_list'	:number_list
					},
					success: function(data){
						if(data.Status != '0000')
						{
							alert(data.Msg);
							return false;
						}else{
							alert('刪除成功！');
							history.go(0);
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

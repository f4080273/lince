<script type="text/javascript">
	function logout()
	{
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "<?=_Web_Url?>/index.php/admin/logout",
			data:{
			},
			success: function(data){
				if(data.Status != '0000')
				{
					alert(data.Msg);
					return false;
				}else{
					alert('登出成功！');
					window.location = "<?=_Web_Url?>/index.php/admin";
					return false;
				}
			}
		});
	}
	
	function change_page_num(type,page,url)
	{
		$.ajax({
			type: "POST",
			url: "<?=_Web_Url?>/index.php/admin/change_page_num",
			data:{
				'type'		: type,
				'page_num'	: page
			},
			success: function(data){
				if(url == '')
				{
					window.location = "<?=_Web_Url?>/index.php/admin/" + type;
				}else{
					window.location = "<?=_Web_Url?>/index.php/admin/" + type + url;
				}
			}
		});
	}

</script>
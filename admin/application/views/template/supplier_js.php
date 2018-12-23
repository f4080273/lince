
function logout(){
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: "<?=_Web_Url?>/index.php/admin/logout",
		data:{
		},
		success: function(data){
			if(data.Status != '0000')
			{
				toast_alert_error(data.Msg);
				return false;
			}else{
				swal({
            title: '登出',
            text: '系統將在兩秒後登出',
            timer: 2000
        }).then(
            function () {
							window.location = "<?=_Web_Url?>/index.php/admin";
            },
            // handling the promise rejection
            function (dismiss) {
                if (dismiss === 'timer') {
										window.location = "<?=_Web_Url?>/index.php/admin";
                }
            }
        )
				return false;
			}
		}
	});
}

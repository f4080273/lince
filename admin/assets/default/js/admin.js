$(document).ready(function() {
  try {
    $('#datatable').DataTable({
          "paging":   false,
          "ordering": true,
          "info":     false,
          'searching':false
    });
  }
  catch (e) {
  }
});
	/*my js*/
	function loding(obj,bak){
		lode_html = "<i class='fa fa-spin fa-refresh'></i>";
		if(bak){
			$(obj).html(bak);
			$(bak).attr('disabled', true);
		}else{
			$(obj).html(lode_html);
			$(bak).attr('disabled', false);
		}
	}
	function toast_alert_error(msg,url){
	  $.toast({
	      heading: '錯誤!',
	      text: msg,
	      position: 'top-right',
	      loaderBg: '#bf441d',
	      icon: 'error',
	      hideAfter: 3000,
	      stack: 1
	  });
		if(url){
			location.assign(url);
		}
	}
	function toast_alert_suss(msg,url){
		$.toast({
				heading: '成功!',
				text: msg,
				position: 'top-right',
				loaderBg: '#5ba035',
				icon: 'success',
				hideAfter: 3000,
				stack: 1
		});
		if(url){
			location.assign(url);
		}
	}
  function toast_alert_info(msg,url){
		$.toast({
				heading: '系統',
				text: msg,
				position: 'top-right',
				loaderBg: '#3b98b5',
				icon: 'info',
				hideAfter: 3000,
				stack: 1
		});
		if(url){
			location.assign(url);
		}
	}
  function toast_alert_war(msg,url){
		$.toast({
				heading: '提醒',
				text: msg,
				position: 'top-right',
				loaderBg: '#da8609',
				icon: 'info',
				hideAfter: 3000,
				stack: 1
		});
		if(url){
			location.assign(url);
		}
	}
	$('.jFiler-input-choose-btn').click(function () {
			$(this).parent().parent().children(".file-input").trigger("click");
	});

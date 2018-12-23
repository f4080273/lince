<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>後台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon
        <link rel="shortcut icon" href="<?=_Web_Url?>/assets/default/images/favicon.ico">-->
	      <!-- Toastr css -->
        <link href="<?=_Web_Url?>/assets/plugins/jquery-toastr/jquery.toast.min.css" rel="stylesheet" />
        <!-- App css -->
        <link href="<?=_Web_Url?>/assets/default/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=_Web_Url?>/assets/default/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=_Web_Url?>/assets/default/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=_Web_Url?>/assets/default/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?=_Web_Url?>/assets/default/js/modernizr.min.js"></script>

    </head>
    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="<?=_Web_Url?>/admin/Login_Page" class="text-success">
                                                <span></span>
                                            </a>
                                        </h2>
                                        <h5 class="text-uppercase font-bold m-b-5 m-t-50">後台登入</h5>
                                        <p class="m-b-0">請輸入您的帳號與密碼</p>
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" action="#">

                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <label for="emailaddress">帳號</label>
                                                    <input class="form-control" type="text" id="account" required="true" placeholder="請輸入您的帳號">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <a href="page-recoverpw.html" class="text-muted pull-right" style="display:none"><small>忘記你的密碼?</small></a>
                                                    <label for="password">密碼</label>
                                                    <input class="form-control" type="password" required="true" id="passwd" placeholder="請輸入您的密碼">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20" style="display:none">
                                                <div class="col-12">

                                                    <div class="checkbox checkbox-success">
                                                        <input id="remember" type="checkbox" checked="">
                                                        <label for="remember">
                                                            	記住我
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" id="submit" type="button" onclick="login()">登入</button>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted">威卡資訊</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?=_Web_Url?>/assets/default/js/jquery.min.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="<?=_Web_Url?>/assets/default/js/bootstrap.min.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/metisMenu.min.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/waves.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/jquery.slimscroll.js"></script>
	      <!-- Toastr js -->
        <script src="<?=_Web_Url?>/assets/plugins/jquery-toastr/jquery.toast.min.js" type="text/javascript"></script>
        <script src="<?=_Web_Url?>/assets/default/pages/jquery.toastr.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="<?=_Web_Url?>/assets/default/js/jquery.core.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/jquery.app.js"></script>
		<!-- Admin js -->
		<script src="<?=_Web_Url?>/assets/default/js/admin.js"></script>
    </body>
</html>
<script>
function login()
{
	acc = $('#account').val();
	pw	= $('#passwd').val();
	remember = $('#remember').val();
	if(acc == '' || pw == '')
	{
		toast_alert_error('請輸入帳號與密碼！');
		$('#account').focus();
		return false;
	}else{
		loding($("#submit"));
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "<?=_Web_Url?>/admin/login",
			data:{
				'account'	:acc,
				'passwd'	:pw,
				'remember'	:remember
			},
			success: function(data){
				if(data.Status != '0000')
				{
					loding($("#submit"),'登入');
					toast_alert_error(data.Msg);
					return false;
				}else{
					if($("#remember").prop("checked")){
						localStorage.setItem("account", acc);
					}else{
						localStorage.removeItem("account");
					}
					window.location = "<?=_Web_Url?>/admin";
					return false;
				}
			}
		});
	}
}
$(function() {
	$("input[type=text]").keydown(function(event){
	  if(event.keyCode == 13){
		login();
	  }
	});
	$("input[type=password]").keydown(function(event){
	  if(event.keyCode == 13){
		login();
	  }
	});
});
</script>

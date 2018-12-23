<div class="col-sm-12">
    <div class="wrapper-page">
          <div class="account-box">
              <div class="text-center account-logo-box">
                  <h4 class="text-uppercase font-bold m-b-0">密碼修改</h4>
              </div>
              <div class="account-content">
                  <div class="text-center m-b-20">
                      <p class="text-muted m-b-0">請輸入您的舊密碼與新密碼</p>
                  </div>
                  <form class="form-horizontal" action="#" id="ajax_from" data-parsley-validate>
                      <div class="form-group row m-b-20">
                          <div class="col-12">
                              <label for="">舊密碼</label>
                              <input class="form-control" type="password" name="password_old" data-parsley-required="true" placeholder="請輸入舊密碼">
                          </div>
                      </div>
                      <div class="form-group row m-b-20">
                          <div class="col-12">
                              <label for="">新密碼</label>
                              <input class="form-control" type="password" id="password" name="password" data-parsley-required="true" data-parsley-length="[1,20]" placeholder="20字元以內">
                          </div>
                      </div>
                      <div class="form-group row m-b-20">
                          <div class="col-12">
                              <label for="">再次輸入新密碼</label>
                              <input class="form-control" type="password" id="password_rep" name="password_rep" data-parsley-equalto="#password" data-parsley-required="true" placeholder="20字元以內">
                          </div>
                      </div>
                      <div class="form-group row text-center m-t-10">
                          <div class="col-12">
                              <button class="btn btn-md btn-block btn-primary waves-effect waves-light submit-btn" type="button">修改密碼</button>
                          </div>
                      </div>

                  </form>
                  <div class="clearfix"></div>
              </div>
          </div>
          <!-- end card-box-->
    </div>
    <!-- end wrapper -->
</div>
<script>
$(".submit-btn").on("click",function(e){
  e.preventDefault();
  if ( $('#ajax_from').parsley().isValid()) {
  	$.ajax({
  		url: '<?=_Web_Url?>/admin/ajax_chang_paswd',
  		dataType: 'json',
  	    type: 'POST',
  	    data: $("#ajax_from").serialize(),
  	}).done(function( bak ) {
      if(bak.Status != "0000"){

        Parsley.addValidator('password_old', {
          messages: {zh_tw: '舊密碼有誤'}
        });

        toast_alert_error(bak.Msg);
      }else{
        swal({
                title: '成功!',
                text: '你已成功修改密碼!',
                type: 'success',
                confirmButtonColor: '#4fa7f3'
            }).then(function () {
              setTimeout(function () {
                  location.reload();
              }, 0.5)
            })
      }
    });
  }else{
    $('#ajax_from').parsley().validate();
  }
});
</script>

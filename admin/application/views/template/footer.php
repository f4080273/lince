		<!-- jQuery  -->
        <script src="<?=_Web_Url?>/assets/default/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="<?=_Web_Url?>/assets/default/js/bootstrap.min.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/metisMenu.min.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/waves.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/jquery.slimscroll.js"></script>
        <!-- Sweet-Alert  -->
        <script src="<?=_Web_Url?>/assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="<?=_Web_Url?>/assets/default/pages/jquery.sweet-alert.init.js"></script>
        <!-- Toastr js -->
        <script src="<?=_Web_Url?>/assets/plugins/jquery-toastr/jquery.toast.min.js" type="text/javascript"></script>
        <script src="<?=_Web_Url?>/assets/default/pages/jquery.toastr.js" type="text/javascript"></script>
        <!-- Light Box js -->
        <script src="<?=_Web_Url?>/assets/plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
        <!-- Tooltipster js -->
        <script src="<?=_Web_Url?>/assets/plugins/tooltipster/tooltipster.bundle.min.js"></script>
        <!-- Parsley js -->
        <script type="text/javascript" src="<?=_Web_Url?>/assets/plugins/parsleyjs/parsley.min.js"></script>'
        <script type="text/javascript" src="<?=_Web_Url?>/assets/plugins/parsleyjs/zh_tw.js"></script>
        <!-- Required datatable js -->
        <script src="<?=_Web_Url?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=_Web_Url?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?=_Web_Url?>/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?=_Web_Url?>/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <!-- Bootstrap datetimepicker js -->
        <script src="<?=_Web_Url?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?=_Web_Url?>/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.zh-TW.js"></script>
        <!-- tagsinput js -->
        <script src="<?=_Web_Url?>/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <?=$PluginsFooter?>
        <!-- App js -->
        <script src="<?=_Web_Url?>/assets/default/js/jquery.core.js"></script>
        <script src="<?=_Web_Url?>/assets/default/js/jquery.app.js"></script>
        <!-- Select2 js -->
        <script src="<?=_Web_Url?>/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="<?=_Web_Url?>/assets/plugins/select2/js/i18n/tw.js" type="text/javascript"></script>
        <!-- Admin js -->
	      <script src="<?=_Web_Url?>/assets/default/js/admin.js"></script>
    		<!-- Admin Supplier js -->
    		<script>
        function open_ck(content,height){
        	CKEDITOR.editorConfig = function( config ) {
        		config.language = 'tw';
        		config.uiColor = '#F7B42C';
        		config.toolbarCanCollapse = true;
        	};
        	CKEDITOR.replace( content, {
            height: '400px',
            width: 'auto',
            filebrowserBrowseUrl : '<?=_Web_Url?>/assets/plugins/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?=_Web_Url?>/assets/plugins/ckfinder/ckfinder.html?Type=Images',
            filebrowserFlashBrowseUrl : '<?=_Web_Url?>/assets/plugins/ckfinder/ckfinder.html?Type=Flash',
            filebrowserUploadUrl : '<?=_Web_Url?>/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?=_Web_Url?>/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?=_Web_Url?>/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
          }); 
        }
        function logout(){
        	$.ajax({
        		type: "POST",
        		dataType: 'json',
        		url: "<?=_Web_Url?>/admin/logout",
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
        							window.location = "<?=_Web_Url?>/admin";
                    },
                    // handling the promise rejection
                    function (dismiss) {
                        if (dismiss === 'timer') {
        										window.location = "<?=_Web_Url?>/admin";
                        }
                    }
                )
        				return false;
        			}
        		}
        	});
        }
        </script>
    </body>
</html>

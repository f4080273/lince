<?php
/*
<!--***************************************************************************
模組功能：跳頁&訊息 
系統工程企劃：Vautor
開發日期：2008/9/21
最後修改日期：2008/9/21

*******************************************************************************-->
*/

	//送出跳頁 javascript
	function jumpPage($url){

	?>
		<script language="javascript">
			self.location="<?php echo $url;?>";		
		</script>
<?php
		if(@$DB)$DB->dbClose();
		exit;
	}
	//送出訊息 javascript
	function sendMsg($msg){
	?>
		<script language="javascript">
		  	alert("<?php echo $msg;?>");	
		</script>
<?php
	}
	//送出跳頁+訊息 javascript
	function jumpPageMsg($url,$msg){
	?>
		<script language="javascript">
		  	alert("<?php echo $msg;?>");
			self.location="<?php echo $url;?>";		
		</script>
<?php
	}
	//送出跳頁+訊息 javascript
	function BackPageMsg($msg){
	?>
		<script language="javascript">
		  	alert("<?php echo $msg;?>");
			history.back(1);	
		</script>
<?php
	}
	//送出跳頁javascript
	function BackPage(){
	?>
		<script language="javascript">
			history.back(1);	
		</script>
<?php
	}
?>
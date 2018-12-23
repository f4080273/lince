<?
class Database            //數據庫查詢的類
{   
	var $dBaseLink;        //數據庫連接指針
    var $dBase;
    
    function Database($host,$user,$pwd,$dbname="") {      //構造函數 //$base 為選擇數據庫名稱
		$this->dBaseLink=mysql_connect($host,$user,$pwd);
    	if(!$this->dBaseLink) die($this->dbError("1"));
    	if($dbname!="") $this->dbChange($dbname);
		mysql_query("SET NAMES 'utf-8'",$this->dBaseLink);
  	}

    function dbClose() {      //關閉數據庫連接
   		mysql_close($this->dBaseLink);
  	}

    function dbError($n,$sql="") {   //輸出錯誤信息,並退出程序
		$dbErrorCode=array(
				1 => "不能連接到數據庫",
				1004 => DB_ERROR_CANNOT_CREATE,
				1005 => DB_ERROR_CANNOT_CREATE,
				1006 => DB_ERROR_CANNOT_CREATE,
				1007 => "對像已經存在，不能完成創建操作",
				1008 => "不能完成刪除操作",
				1046 => DB_ERROR_NODBSELECTED,
				1050 => DB_ERROR_ALREADY_EXISTS,
				1051 => DB_ERROR_NOSUCHTABLE,
				1054 => "所檢索的字段不存在",
				1062 => DB_ERROR_ALREADY_EXISTS,
				1064 => DB_ERROR_SYNTAX,
				1100 => DB_ERROR_NOT_LOCKED,
				1136 => DB_ERROR_VALUE_COUNT_ON_ROW,
				1146 => "所檢索的數據表不存在",
				1049 => "所選擇的數據庫不存在"
			);  
		echo "<div style='background-color:#dddddd;color:#000000;font-size:9pt;width=400' align=center>錯誤 $n ：".$dbErrorCode[$n]."<BR>".$sql."</div>";
  	}
	
    function dbChange($base)        //改變當前數據庫
   	{
       	$this->dBase=$base;
       	@mysql_select_db($base,$this->dBaseLink);
    	if($msg=mysql_errno($this->dBaseLink)) die($this->dbError($msg));
   	}


    function dbQuery($sql,$base="",$type=0)     //對指定數據庫進行訪問
                                                //$sql為SQL語句
                                                //$base為訪問的數據庫名，如果沒有則使用上次使用的
                                                //$type為返回數組格式，0返回name=>value形式，1返回value格式
  { 
	if($base=="" || $this->dBase!=$base) $base = $this->dBase;
  	if($base!="" || $this->dBase!=$base) $this->dbChange($base);
    $result=@mysql_query($sql,$this->dBaseLink);
    if($msg=mysql_errno($this->dBaseLink)) die($this->dbError($msg,$sql));
	
    @$num=mysql_num_rows($result);
    if($num==0) $rtArray="";
      else {
        for($i=0;$i<$num;$i++)
          $rtArray[$i]=($type==0)?mysql_fetch_array($result):mysql_fetch_row($result);

       }
    @mysql_free_result($result);
    return $rtArray;
  }
  
    

    
    function dbCountRecords($table,$where="",$base="",$index="id")  //統計表中記錄的數目
                                                //$table 操作的數據表名稱
                                                //$where 完整的where子句
                                                //$base  操作的數據庫名稱
                                                //$index 操作所使用的索引字段
  { if($base=="" || $this->dBase!=$base) $base = $this->dBase;
  	if($base!="" || $this->dBase!=$base) $this->dbChange($base);
    $result = mysql_query("select count(".$index.") as 'num' from $table ".$where,$this->dBaseLink);
    @$num = mysql_result($result,0,"num");
    @mysql_free_result($result);
    return $num;
  }



    function dbIo($sql,$base="")                //無返回值的SQL操作，例如insert操作，返回新插入的id,update和delete無返回值
  { 
  	if($base=="" || $this->dBase!=$base) $base = $this->dBase;
  	if($base!="" || $this->dBase!=$base) $this->dbChange($base);
    $result=@mysql_query($sql,$this->dBaseLink);
	if($msg=mysql_errno($this->dBaseLink)) die($this->dbError($msg,$sql));
    @mysql_free_result($result);
    return mysql_insert_id($this->dBaseLink);

  }
    
    function dbFieldList($table,$base)                //字段信息列表
  { $pt = @mysql_list_fields($base,$table);
    if($msg=mysql_errno($this->dBaseLink)) die($this->dbError($msg));
    $n=mysql_num_fields($pt);
    for($i=0;$i<$n;$i++) {
    $name    =    mysql_field_name($pt,$i);
    $type    =    mysql_field_type($pt,$i);
    $len    =    mysql_field_len($pt,$i);
    $rt[$i]=array("name" => $name,                //字段名稱
                  "type" => $type,                //字段類型
                  "len"     => $len);                //字段長度
    }
    return $rt;
  }
  
    function dbTableList($basename)                //數據庫basename的表信息
  {
    $result=mysql_list_tables($basename,$this->dBaseLink);
    $rt=mysql_fetch_array($result);
    @mysql_free_result($result);
    return $rt;
  }

    
}

?>
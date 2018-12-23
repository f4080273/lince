<?
	class cache
	{
		//快取路徑
		private $cache_root = '';
		//快取檔名
		private $cache_name	= '';
		//快取完整路徑
		private $cache_file_root = '';
		//網址區段，存成陣列方式
		private $segs		= array();
		//設定會抓快取的頁面
		private $cache_page_name = array('index','about','service','products','products_i','news','news_i','guestbook','contact');
		
		function __construct(){
			//快取路徑
			$this -> cache_root = _Web_Root .'/application/cache/';
		}
		
		//執行快取
		function run($seg_array)
		{
			//判斷是否為取網頁程式之請求，未設定則抓快取，有設定則抓網頁 #0001
			if(!isset($_POST['GetHTML']))
			{
				//設定網址區段
				$this -> segs = $seg_array;
				//判斷是否網址區段為空值，是則抓取預設值
				$this -> check_seg();
				
				//只有未登入狀態才執行快取 #0002
				if(!isset($_SERVER['UserData']))
				{
					//判斷是否需要抓快取 #0003
					if($this -> check_fetch_cache())
					{
						//設定快取檔路徑及檔名
						$this -> set_cache_file();
					
						//檢查快取檔是否不存在，不存在則建檔 #0004
						if(!file_exists($this -> cache_file_root))
						{
							//建立快取檔
							$this -> make_chche_file();
						}//end if #0004
						
						//取得快取檔內容
						$HTML = $this -> get_cache_data();
						
						//避免快取檔為空值而輸出空白頁面
						if($HTML != '')
						{
							echo $HTML;
							exit;
						}else{
							@unlink($this -> cache_file_root);
						}
						
					}//end if #0003
					
				}//end if #0002
				
			}//end if #0001
		}
		
		//取得快取檔內容
		function get_cache_data()
		{
			return file_get_contents($this -> cache_file_root);
		}
		
		//建立快取檔
		function make_chche_file()
		{
			//取得網頁程式碼，current_url()為CI取完整網址的函數
			$HTML = $this -> Send_Data(current_url());
			//寫入檔案
			file_put_contents($this -> cache_file_root,$HTML);
		}
		
		//設定快取檔路徑及檔名
		function set_cache_file()
		{
			//將網址用「 _ 」連接成檔名
			$this -> cache_name = implode('_',$this -> segs);
			//快取完整路徑
			$this -> cache_file_root = $this -> cache_root.$this -> cache_name.'.html';
		}
		
		function check_fetch_cache()
		{
			if(in_array($this -> segs[2],$this -> cache_page_name))
			{
				return true;
			}else{
				return false;
			}
		}
		
		//判斷是否網址區段為空值，是則抓取預設值
		function check_seg()
		{
			if(empty($this -> segs[1]))
			{
				$this -> segs[1] = 'web';
			}
			
			if(empty($this -> segs[2]))
			{
				$this -> segs[2] = 'index';
			}
		}
		
		function Send_Data($URL)
		{
			// 建立CURL連線
			$ch = curl_init();
			// 設定擷取的URL網址
			curl_setopt($ch, CURLOPT_URL, $URL);
			
			//curl_setopt($ch, CURLOPT_HEADER, false);
			
			//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			
			//設定要傳的 變數A=值A & 變數B=值B (中間要用&符號串接)
			$PostData = "GetHTML=1";
						
			//設定CURLOPT_POST 為 1或true，表示要用POST方式傳遞
			curl_setopt($ch, CURLOPT_POST, 1); 
			//CURLOPT_POSTFIELDS 後面則是要傳接的POST資料。
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
			curl_setopt($ch, CURLOPT_TIMEOUT, 3);   // 避免無限迴圈
			// 執行
			$temp=curl_exec($ch);
			// 關閉CURL連線
			curl_close($ch);
			return $temp;
		}
		
		//刪除快取檔
		function del_cache()
		{
			$data_list = glob($this -> cache_root.'*');
			foreach($data_list as $row)
			{
				@unlink($row);
			}
		}
	}
?>

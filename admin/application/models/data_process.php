<?
	Class Data_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this->load->library('email');
			$this -> load -> helper('page');

			$this -> load -> model('common_process');
		}

		//初始驗證
		function Check_Status($page = '')
		{
			$data = '0000';

			//驗證登入狀態
			if(!isset($_SESSION['UserData']))
			{
				$data = '0001';
				return $data;
				exit;
			}

			//驗證帳號權限
			$sql	= "select enable from manager where account = '".$_SESSION['UserData']['account']."' limit 1";
			$check	= $this -> db -> query($sql);
			$count	= $check -> num_rows();
			$check	= $check -> row_array();
			if($count < 1 or !$check or $check['enable'] == '0')
			{
				unset($_SESSION['UserData']);
				$this -> Process_Result('0008');
				exit;
			}

			//驗證模組權限
			if($page == '')
			{
				$data = '0004';
				return $data;
				exit;
			}else{
				if($page != 'index')
				{
					$sql	= "select model_name from model_auth where manager_account = '".$_SESSION['UserData']['account']."' and model_name = '".$page."'";
					$Menu	= $this -> db -> query($sql);
					$Menu	= $Menu -> num_rows();

					if($Menu < 1)
					{
						$data = '0004';
						return $data;
						exit;
					}
				}
			}

			return $data;
		}

		//依錯誤代碼回傳處理方法
		function Process_Result($Status_Num)
		{
			switch($Status_Num)
			{
				case '0001':
					jumpPage(_Web_Url.'/admin/Login_Page');
					break;
				case '0002':
					$data = array('Status' => $Status_Num,'Msg' => '查無此組帳號密碼！');
					return $data;
					break;
				case '0003':
					$data = array('Status' => $Status_Num,'Msg' => '您未登入喔！');
					return $data;
					break;
				case '0004':
					BackPageMsg('模組載入錯誤或模組未授權！');
					break;
				case '0005':
					BackPageMsg('必填欄位未填！');
					break;
				case '0006':
					$data = array('Status' => $Status_Num,'Msg' => '刪除資料有誤！');
					return $data;
					break;
				case '0007':
					BackPageMsg('查無資料！');
					break;
				case '0008':
					jumpPageMsg(_Web_Url.'/admin/Login_Page','帳號錯誤！');
					break;
				case '0009':
					BackPageMsg('產品編號重覆！！');
					break;
				case '0010':
					BackPageMsg('資料傳輸錯誤！！');
					break;
			}
		}

		//取得資料，含分頁
		function get_data_list($page = '',$page_num = 0,$DataArray = '')
		{
			$sql = '';
			$data = array();
			$page_HTML = '';

			switch($page)
			{
				//輪播管理
				case "banner_setup":
				$this->db->select("*");
				$this->db->from("mapping");
				$this->db->where("type","banner1");
				$this->db->or_where("type","banner2");
				$this->db->or_where("type","banner3");
				$this->db->order_by("number ASC");
				$query = $this->db->get();
				$data = $query->result();

				foreach ($data as $row) {
					$data[$row->type] = $row;
				}

				break;
				//權限管理
				case 'management':
					$sql = "select *,(select count(*) from model_auth ma where ma.manager_account = m.account) model_count from manager m order by m.number";
					break;
				case 'contact':
					$page_count = 25;

					$this->db->select("*");
					$this->db->from("contact");
					if($_GET['name']){
						$this->db->like('name',$_GET['name']);
					}
					if($_GET['phone']){
						$this->db->like('phone',$_GET['phone']);
					}
					if($_GET['email']){
						$this->db->like('email',$_GET['email']);
					}
					$this->db->order_by("number DESC");
					$this->db->limit($page_count,$page_num);
					$query = $this->db->get();
					$data = $query->result();
					unset($query);
					if($page_count != 'all')
					{
						$this->db->select("count(number) as c");
						$this->db->from("contact");
						if($_GET['name']){
							$this->db->like('name',$_GET['name']);
						}
						if($_GET['phone']){
							$this->db->like('phone',$_GET['phone']);
						}
						if($_GET['email']){
							$this->db->like('email',$_GET['email']);
						}
						$count		= $this -> db -> get();
						$count		= $count -> row();
						$count		= $count -> c;

						$total_page	= ceil($count / $page_count);
						$config['next_link']	= '下一頁';
						$config['prev_link']	= '上一頁';
						$config['base_url']		= _Web_Url.'/admin/contact/list/0/';
						$config['total_rows']	= $count;
						$config['per_page']		= $page_count;
						$config['uri_segment']	= 5;
						$config['first_url'] 	= _Web_Url."/admin/contact/list/0/0?".http_build_query($_GET);
						$config['suffix'] 		= "?".http_build_query($_GET);

						/*分頁樣式設定*/
						$config = PageCongig($config);

						$this->pagination->initialize($config);
						$page_HTML = $this->pagination->create_links();
					}
					break;
					case "base_setup":
						$this->db->select('type,varA,varB,varC,varD,varE,varF');
						$this->db->from('mapping');
						$this->db->where_in('type',array('mail_profile','web_define','contract1','contract2','contract3'));
						$query = $this -> db -> get();
						$data	= $query -> result();
						unset($query);
						foreach ($data as $row) {
							$data[$row->type] = $row;
						}
						break;
			}

			$DataArray = array('Data' => $data,'Page' => $page_HTML);

			return $DataArray;
		}
		//取得模組列表，權限管理用
		function get_management_data($number = '')
		{
			$DataArray = array();

			$sql	= "select * from model where enable = 1 order by sort,class_number,number";
			$data	= $this -> db -> query($sql);
			$data	= $data -> result();

			$DataArray['ModelArray']		= $data;
			$DataArray['ManagerModelArray']	= '';
			$DataArray['ManagerDataArray']	= '';

			if($number != '')
			{
				$sql	= "select * from manager where number = ".$number." limit 1";
				$data	= $this -> db -> query($sql);
				$data	= $data -> result();
				$account= ($data)?$data[0] -> account:'';
				$DataArray['ManagerDataArray']	= ($data)?$data[0]:'';

				if($account != '')
				{

					$sql	= "select * from model_auth where manager_account = '".$account."'";
					$data	= $this -> db -> query($sql);
					$data	= $data -> result();
					$tmp	= array();

					foreach($data as $key => $row)
					{
						$tmp[$key] = $row -> model_name;
					}

					$DataArray['ManagerModelArray']	= $tmp;
				}
			}

			return $DataArray;
		}

		//取得基本設定資料
		function get_base_data($type = '')
		{
			if($type == '')
			{
				$this -> Process_Result('0004');
				exit;
			}

			$DataArray = array();

			switch($type)
			{
				//基本設定
				case 'base_setup':
					//郵件設定
					$sql	= "select * from mapping where type = 'mail_profile' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['mail_profile'] = array('varA' => $data -> varA,'varB' => $data -> varB);
					//管理介面設定
					$sql	= "select * from mapping where type = 'management_profile' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['management_profile'] = array('varA' => $data -> varA);
					//瀏覽人數
					$sql	= "select * from mapping where type = 'visitors_profile' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['visitors_profile'] = array('varA' => $data -> varA);
					//產品選單設定
					$sql	= "select * from mapping where type = 'pro_menu_profile' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['pro_menu_profile'] = array('varA' => $data -> varA,'varB' => $data -> varB);
					//產品圖片設定
					$sql	= "select * from mapping where type = 'products_pic_setup' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['products_pic_setup'] = array('varA' => $data -> varA,'varB' => $data -> varB,'varC' => $data -> varC,'varD' => $data -> varD);
					break;
				//版權宣告
				case 'footer':
					$sql	= "select * from mapping where type = 'footer_profile' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['footer_profile'] = array('varA' => $data -> varA,'varB' => $data -> varB);
					break;
				//聯絡我們
				case 'contact_setup':
					$sql	= "select * from mapping where type = 'contact_profile' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['contact_profile'] = array('varA' => $data -> varA,'varB' => $data -> varB, 'varC' => $data -> varC);
					break;
				//輪播圖
				case 'banner_setup':
					$sql	= "select * from mapping where type = 'banner1' or type = 'banner2' limit 2";
					$data	= $this -> db -> query($sql);
					$data	= $data -> result();
					$DataArray['banner_1'] = array('varA' => $data[0] -> varA,'varB' => $data[0] -> varB,'varC' => $data[0] -> varC,'varD' => $data[0] -> varD,'varE' => $data[0] -> varE,'varF' => $data[0] -> varF);
					$DataArray['banner_2'] = array('varA' => $data[1] -> varA,'varB' => $data[1] -> varB,'varC' => $data[1] -> varC,'varD' => $data[1] -> varD,'varE' => $data[1] -> varE,'varF' => $data[1] -> varF);
					break;
				//各項列表顯示設定
				case 'list_setup':
					$keys	= array('about_page_num','service_page_num','news_page_num','guestbook_page_num','products_page_num');
					$sql	= "select * from mapping where type in ('".(implode("','",$keys))."')";
					$data	= $this -> db -> query($sql);
					$data	= $data -> result_array();

					$page_name	= array('about_page_num' => '關於我們','service_page_num'		=> '服務項目',
										'news_page_num'  => '最新消息','guestbook_page_num'	=> '留言板',
										'products_page_num' => '產品管理');

					foreach($data as $key => $row)
					{
						unset($row['remark']);
						unset($row['number']);
						$row['name'] = $page_name[$row['type']];
						$DataArray[] = $row;
					}

					break;
				//首頁內容設定
				case 'index_setup':
					//最新消息、產品顯示筆數
					$sql	= "select * from mapping where type = 'index_show_count' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['index_show_count'] = array('varA' => $data -> varA,'varB' => $data -> varB);
					//粉絲團程式碼
					$sql	= "select * from mapping where type = 'index_fb_fan_page_code' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['index_fb_fan_page_code'] = array('varA' => $data -> varA);
					//文字編輯區
					$sql	= "select * from mapping where type = 'index_text_data' limit 1";
					$data	= $this -> db -> query($sql);
					$data	= $data -> row();
					$DataArray['index_text_data'] = array('varA' => $data -> varA,'varB' => $data -> varB);

					break;
				default:
					$this -> Process_Result('0004');
					exit;
					break;
			}
			return $DataArray;
		}

		//登入
		function login($acc,$pw)
		{
			$DataArray = array('IP' => $_SERVER['REMOTE_ADDR'],'login_time' => date('Y-m-d H:i:s'),'do' =>  'Manager login[ID:'.$this->input->post('account').',PW:'.$this->input->post('passwd').']');

			$sql = $this -> db -> insert_string('ip_log',$DataArray);
			$this -> db -> query($sql);

			$sql	= "select * from manager where `account` = '".$this->input->post('account')."' and `pw` = '".$this->input->post('passwd')."' and `enable` = '1' order by number";
			$data	= $this -> db -> query($sql);
			$data	= $data -> row();

			if($data)
			{
				$_SESSION['UserData']['number']	= $data-> number;
				$_SESSION['UserData']['account']	= $data-> account;
				$_SESSION['UserData']['name']		= $data-> name;
				$_SESSION['UserData']['power']		= $data-> power;

				return '0000';
			}else{
				return '0002';
			}
		}

		//登出
		function logout()
		{
			if(isset($_SESSION['UserData']))
			{
				unset($_SESSION['UserData']);
				return '0000';
			}else{
				return '0003';
			}
		}

		//取得資料，不含分頁
		function get_data($type = '',$number = '')
		{
			$data = '';

			if($type != '' and $number != '')
			{
				switch($type)
				{
					case 'contact':
						$sql	= "select * from contact where number = '".$number."' limit 1";
						$data	= $this -> db -> query($sql);
						$count	= $data -> num_rows();
						$data	= $data -> result();

						if($count < 1)
						{
							$this -> Process_Result('0007');
							exit;
						}
						$tmp['Check_time']	= date("Y-m-d H:i:s");
						$tmp['Check_M']		= $_SESSION['UserData']['account'];
						$tmp['enable']		= 1;

						$where	= "number = ".$number;

						$sql = $this -> db -> update_string('contact',$tmp,$where);
						$this -> db -> query($sql);

						break;
					case 'products':
						$sql	= "select * from products where number = ".$number." limit 1";
						$data	= $this -> db -> query($sql);
						$count	= $data -> num_rows();
						$data	= $data -> result();

						if($data)
						{
							if($data -> seo_number == '0' or $data -> seo_number == '')
							{
								$seo_number = $this -> get_seo_number();
								$data -> seo_number = $seo_number;
							}else{
								$seo_number = $data -> seo_number;
							}

							$data = $this -> Get_Detail_SEO($data,$seo_number);
						}


						if($count < 1)
						{
							$this -> Process_Result('0007');
							exit;
						}
						break;
				}
			}
			return $data;
		}

		//新增資料
		function Add_Data($DataArray)
		{
			switch($DataArray['action'])
			{
				case 'management':
					$keys	= array('account','pw','name','enable');
					$data	= array();
					$x		= 0;
					foreach($DataArray as $key => $row)
					{
						if(in_array($key,$keys))
						{
							$data[$key] = $row;
							$x = ($row != '')?$x + 1:$x;
						}
					}

					if($x < 4)
					{
						return '0005';
						exit;
					}

					$sql = $this -> db -> insert_string('manager',$data);
					$this -> db -> query($sql);
					$number = $this->db->insert_id();

					if($_FILES['img']['tmp_name']){
						$tempFile = $_FILES['img']['tmp_name'];
						$savePath = _Media_Root . "/img/";
						$upFile = $_FILES['img']['name'];

						$tmp = explode(".", $upFile);
						$ExtName = StrToLower($tmp[1]);
						$saveFile = $number . "_head_shot." . $ExtName;

						@copy($tempFile,$savePath .$saveFile );

						$updata			= array();
						$updata['img']	= $saveFile;
						$where = "number = ".$number;

						$sql = $this -> db -> update_string('manager',$updata,$where);
						$this -> db -> query($sql);
					}

					$sql = "delete from model_auth where manager_account = '".$data['account']."'";
					$this -> db -> query($sql);

					if(isset($DataArray['model']))
					{
						$sql = '';
						foreach($DataArray['model'] as $row)
						{
							$sql .= ($sql != '')?',':'';
							$sql .= "('".$row."','".$data['account']."')";
						}

						$sql = "insert into model_auth (`model_name`,`manager_account`) values ".$sql;
						$this -> db -> query($sql);
					}

					jumpPageMsg(_Web_Url.'/index.php/admin/management/0/edit/'.$number,'新增成功！');
					break;
				case 'products':
					$this->db->select("number");
					$this->db->from("products");
					$this->db->where("name",$DataArray['name']);
					$this->db->limit("1");
					$CheckName = $this->db->get();
					$CheckName = $CheckName->row();

					if($CheckName->number){
						BackPageMsg("已有相同產品名稱!");
						die;
					}
					$keys	= array('class_number','pro_number','name','sort','enable','price','click','index_show','introduce','introduce_m','contents','seo_number');
					$data	= array();

					foreach($DataArray as $key => $row)
					{
						if(in_array($key,$keys))
						{
							$data[$key] = $row;
						}
					}
					$data['Change_Date'] = date('Y-m-d H:i:s');
					$data['Change_M']	 = $_SESSION['UserData']['account'];
					$data['Create_Time'] = date('Y-m-d H:i:s');
					$data['Create_M']	 = $_SESSION['UserData']['account'];

					$sql = $this -> db -> insert_string('products',$data);
					$this -> db -> query($sql);
					$number = $this->db->insert_id();

					$DataArray['seo_title'] = $DataArray['name'];
					$DataArray['seo_contents'] = strip_tags($DataArray['contents']);
					$DataArray['key_contents'] = $DataArray['name'];

					$this -> Set_Detail_SEO($DataArray,$DataArray['seo_number']);

					$updata			= '';

					$savePathMain	= _Web_Root . "/images/product/";

					if($_FILES['files']['tmp_name']){
						$tempFile = $_FILES['files']['tmp_name'];
						$upFile = $_FILES['files']['name'];
						$tmp = explode(".", $upFile);
						$ExtName = StrToLower($tmp[1]);
						$saveFile = $number . "_1".'.' . $ExtName;
						@copy($tempFile,$savePathMain .$saveFile );
						$updata['pic1']	= $saveFile;
					}
					if($updata != '')
					{
						$where = "number = ".$number;
						$sql = $this -> db -> update_string('products',$updata,$where);
						$this -> db -> query($sql);
					}

					jumpPageMsg(_Web_Url.'/index.php/admin/products','新增成功！');

					break;
			}
		}

    //$src        目的檔案
    //$maxWidth    縮圖寬度
    //$maxHeight    縮圖高度
    //$quality    JPEG品質
	//縮圖
    function ImageCopyResizedTrue($src,$quality=100,$type) {

        //檢查檔案是否存在
        if (file_exists($src)  && isset($src)) {
			switch($type)
			{
				case 'main':
					$data		= explode(',',_Pro_Main);
					$maxWidth	= $data[0];
					$maxHeight	= $data[1];
					break;
				case 'small':
					$data		= explode(',',_Pro_Small);
					$maxWidth	= $data[0];
					$maxHeight	= $data[1];
					break;
				case 'mmain':
					$data		= explode(',',_Pro_MMain);
					$maxWidth	= $data[0];
					$maxHeight	= $data[1];
					break;
				case 'msmall':
					$data		= explode(',',_Pro_MSmall);
					$maxWidth	= $data[0];
					$maxHeight	= $data[1];
					break;
				default:
					exit;
					break;
			}

            $destInfo  = pathInfo($src);
            $srcSize   = getImageSize($src); //圖檔大小
            $srcRatio  = $srcSize[0]/$srcSize[1]; // 計算寬/高
            $destRatio = $maxWidth/$maxHeight;
            if ($destRatio > $srcRatio) {
                $destSize[1] = $maxHeight;
                $destSize[0] = $maxHeight*$srcRatio;
            }
            else {
                $destSize[0] = $maxWidth;
                $destSize[1] = $maxWidth/$srcRatio;
            }


            //GIF 檔不支援輸出，因此將GIF轉成JPEG
            if ($destInfo['extension'] == "gif") $src = substr_replace($src, 'jpg', -3);

            //建立一個 True Color 的影像
            $destImage = imageCreateTrueColor($destSize[0],$destSize[1]);

            //根據副檔名讀取圖檔
            switch ($srcSize[2]) {
                case 1: $srcImage = imageCreateFromGif($src); break;
                case 2: $srcImage = imageCreateFromJpeg($src); break;
                case 3: $srcImage = imageCreateFromPng($src); break;
                default: return false; break;
            }

            //取樣縮圖
            ImageCopyResampled($destImage, $srcImage, 0, 0, 0, 0,$destSize[0],$destSize[1],
                                $srcSize[0],$srcSize[1]);

            //輸出圖檔
            switch ($srcSize[2]) {
                case 1: case 2: imageJpeg($destImage,$src,$quality); break;
                case 3: imagePng($destImage,$src); break;
            }
        }
    }

		//修改資料
		function Edit_Data($DataArray)
		{
			switch($DataArray['action'])
			{
				case 'management':
					$number		= $DataArray['number'];
					$data	= array();

					if($_FILES['img']['tmp_name']){
						$tempFile = $_FILES['img']['tmp_name'];
						$savePath = _Media_Root . "/img/";
						$upFile = $_FILES['img']['name'];

						$tmp = explode(".", $upFile);
						$ExtName = StrToLower($tmp[1]);
						$saveFile = $number . "_head_shot." . $ExtName;

						@copy($tempFile,$savePath .$saveFile );

						$data['img'] = $saveFile;
					}

					$sql		= "select account from manager where number = ".$number." limit 1";
					$account	= $this -> db -> query($sql);
					$account	= $account -> result();
					$account	= ($account)?$account[0] -> account:'';

					$keys	= array('account','pw','name','enable');

					$x		= 0;
					foreach($DataArray as $key => $row)
					{
						if(in_array($key,$keys))
						{
							$data[$key] = $row;
							$x = ($row != '')?$x + 1:$x;
						}
					}

					if($x < 4)
					{
						return '0005';
						exit;
					}

					$where = "number = ".$number;

					$sql = $this -> db -> update_string('manager',$data,$where);
					$this -> db -> query($sql);

					$sql = "delete from model_auth where manager_account = '".$account."'";
					$this -> db -> query($sql);

					if(isset($DataArray['model']))
					{
						$sql = '';
						foreach($DataArray['model'] as $row)
						{
							$sql .= ($sql != '')?',':'';
							$sql .= "('".$row."','".$data['account']."')";
						}

						$sql = "insert into model_auth (`model_name`,`manager_account`) values ".$sql;
						$this -> db -> query($sql);
					}

					jumpPageMsg(_Web_Url.'/index.php/admin/management/0/edit/'.$number,'修改成功！');
				break;

				case 'banner_setup':
					$keys = array('B','C','D','E');
					$Data1 = array();
					$Data2 = array();
					$Data3 = array();
					//上傳檔案
					if(isset($_FILES['banner_i_1']) && $_FILES['banner_i_1']['name'] != "")
					{
						$ImgWH = array(array('width'=>'1900','height'=>'748'));
						$ImgXY = array('x'=>$DataArray['banner_i_1_x'],'y'=>$DataArray['banner_i_1_y']);
						$PreWH = array('w'=>$DataArray['banner_i_1_w'],'h'=>$DataArray['banner_i_1_h']);

						$UpLoadData = $this->common_process->do_upload('../images/banner/','banner_i_1',$ImgWH,$ImgXY,$PreWH);

						if($UpLoadData['Status'] != '0000')
						{
							BackPageMsg($UpLoadData['Error']);
							die;
						}else{
							$Data1['varB'] = json_encode(array( 'img'=>$UpLoadData['FileName'],
																									'title1'=>$DataArray['banner_i_1_title1'],
																									'text1'=>$DataArray['banner_i_1_text1'],
																									'text2'=>$DataArray['banner_i_1_text2'],
																									'url'=>$DataArray['banner_i_1_url']
																				));
						}
					}else{
						$Data1['varB'] = json_encode(array( 'img'=>$DataArray['banner_i_1_oldimg'],
																								'title1'=>$DataArray['banner_i_1_title1'],
																								'text1'=>$DataArray['banner_i_1_text1'],
																								'text2'=>$DataArray['banner_i_1_text2'],
																								'url'=>$DataArray['banner_i_1_url']
																			));
					}
					//上傳檔案
					if(isset($_FILES['banner_i_2']) && $_FILES['banner_i_2']['name'] != "")
					{
						$ImgWH = array(array('width'=>'1900','height'=>'748'));
						$ImgXY = array('x'=>$DataArray['banner_i_2_x'],'y'=>$DataArray['banner_i_2_y']);
						$PreWH = array('w'=>$DataArray['banner_i_2_w'],'h'=>$DataArray['banner_i_2_h']);

						$UpLoadData = $this->common_process->do_upload('../images/banner/','banner_i_2',$ImgWH,$ImgXY,$PreWH);

						if($UpLoadData['Status'] != '0000')
						{
							BackPageMsg($UpLoadData['Error']);
							die;
						}else{
							$Data1['varC'] = json_encode( array(  'img'=>$UpLoadData['FileName'],
																										'title1'=>$DataArray['banner_i_2_title1'],
																										'title2'=>$DataArray['banner_i_2_title2'],
																										'text1'=>$DataArray['banner_i_2_text1'],
																										'text2'=>$DataArray['banner_i_2_text2'],
																										'text3'=>$DataArray['banner_i_2_text3'],
																										'url'=>$DataArray['banner_i_2_url']
																					));

						}
					}else{
						$Data1['varC'] = json_encode( array(  'img'=>$DataArray['banner_i_2_oldimg'],
																									'title1'=>$DataArray['banner_i_2_title1'],
																									'title2'=>$DataArray['banner_i_2_title2'],
																									'text1'=>$DataArray['banner_i_2_text1'],
																									'text2'=>$DataArray['banner_i_2_text2'],
																									'text3'=>$DataArray['banner_i_2_text3'],
																									'url'=>$DataArray['banner_i_2_url']
																				));
					}
					//上傳檔案
					if(isset($_FILES['banner_i_3']) && $_FILES['banner_i_3']['name'] != "")
					{
						$ImgWH = array(array('width'=>'1900','height'=>'748'));
						$ImgXY = array('x'=>$DataArray['banner_i_3_x'],'y'=>$DataArray['banner_i_3_y']);
						$PreWH = array('w'=>$DataArray['banner_i_3_w'],'h'=>$DataArray['banner_i_3_h']);

						$UpLoadData = $this->common_process->do_upload('../images/banner/','banner_i_3',$ImgWH,$ImgXY,$PreWH);

						if($UpLoadData['Status'] != '0000')
						{
							BackPageMsg($UpLoadData['Error']);
							die;
						}else{
							$Data1['varD'] = json_encode( array( 'img'=>$UpLoadData['FileName'],
																									 'title1'=>$DataArray['banner_i_3_title1'],
																									 'title2'=>$DataArray['banner_i_3_title2'],
																									 'text1'=>$DataArray['banner_i_3_text1'],
																									 'url'=>$DataArray['banner_i_3_url']
																						));
						}
					}else{
						$Data1['varD'] = json_encode( array( 'img'=>$DataArray['banner_i_3_oldimg'],
																								 'title1'=>$DataArray['banner_i_3_title1'],
																								 'title2'=>$DataArray['banner_i_3_title2'],
																								 'text1'=>$DataArray['banner_i_3_text1'],
																								 'url'=>$DataArray['banner_i_3_url']
																					));
					}
					if(count($Data1)){
						$where	= "type = 'banner1'";
						$sql = $this -> db -> update_string('mapping',$Data1,$where);
						$this -> db -> query($sql);
					}

					//上傳檔案
					if(isset($_FILES['banner_n_1']) && $_FILES['banner_n_1']['name'] != "")
					{
						$ImgWH = array(array('width'=>'1920','height'=>'280'));
						$ImgXY = array('x'=>$DataArray['banner_n_1_x'],'y'=>$DataArray['banner_n_1_y']);
						$PreWH = array('w'=>$DataArray['banner_n_1_w'],'h'=>$DataArray['banner_n_1_h']);

						$UpLoadData = $this->common_process->do_upload('../images/banner/','banner_n_1',$ImgWH,$ImgXY,$PreWH);

						if($UpLoadData['Status'] != '0000')
						{
							BackPageMsg($UpLoadData['Error']);
							die;
						}else{
							$Data2['varB'] = json_encode(array('img'=>$UpLoadData['FileName'],'url'=>$DataArray['banner_n_1_url']));
						}

					}
					if(count($Data2)){
						$where	= "type = 'banner2'";
						$sql = $this -> db -> update_string('mapping',$Data2,$where);
						$this -> db -> query($sql);
					}

					jumpPageMsg(_Web_Url.'/admin/banner_setup','設定成功！');
					break;
					case "base_setup":
					$Updat01 = array();
					//LOGO圖修改
					if(isset($_FILES['logo']) && $_FILES['logo']['name'] != "")
					{
						$ImgWH = array(array('width'=>'465','height'=>'151'));
						$ImgXY = array('x'=>$DataArray['logo_x'],'y'=>$DataArray['logo_y']);
						$PreWH = array('w'=>$DataArray['logo_w'],'h'=>$DataArray['logo_h']);

						$UpLoadData = $this-> common_process ->do_upload('../images/','logo',$ImgWH,$ImgXY,$PreWH);

						if($UpLoadData['Status'] != '0000')
						{
							BackPageMsg($UpLoadData['Error']);
							die;
						}else{
							//資訊修改
							$Updat01['varA'] = $UpLoadData['FileName'];
						}
					}
					$Updat01['varB'] = $DataArray['web_name'];
					$Updat01['varC'] = $DataArray['web_content'];
					$Updat01['varD'] = $DataArray['web_service_time'];
					$this->db->where('type', 'web_define');
					$this->db->update('mapping', $Updat01);

					//郵件設定
					$Updat02 = array(
               'varA' => $DataArray['mail_profile_name'],
               'varB' => $DataArray['mail_profile_email']
            );
					$this->db->where('type', 'mail_profile');
					$this->db->update('mapping', $Updat02);
					//聯絡資訊(居家護理所)
					$Updat03 = array(
               'varA' => $DataArray['contract1_tel'],
               'varB' => $DataArray['contract1_fax'],
							 'varC' => $DataArray['contract1_phone'],
							 'varD' => $DataArray['contract1_address'],
							 'varE' => $DataArray['contract1_email']
            );
					$this->db->where('type', 'contract1');
					$this->db->update('mapping', $Updat03);
					//聯絡資訊(居家護理所)
					$Updat04 = array(
						'varA' => $DataArray['contract2_tel'],
						'varB' => $DataArray['contract2_fax'],
						'varC' => $DataArray['contract2_phone'],
						'varD' => $DataArray['contract2_address'],
						'varE' => $DataArray['contract2_email']
            );
					$this->db->where('type', 'contract2');
					$this->db->update('mapping', $Updat04);
					//聯絡資訊(申訴方式)
					$Updat05 = array(
						'varA' => $DataArray['contract3_name'],
						'varB' => $DataArray['contract3_phone'],
						'varC' => $DataArray['contract3_email'],
            );
					$this->db->where('type', 'contract3');
					$this->db->update('mapping', $Updat05);


					jumpPageMsg(_Web_Url.'/admin/base_setup','修改成功！');
					break;
			}
		}

		//刪除資料
		function Del_Data($DataArray = '')
		{
			if($DataArray != '' and isset($DataArray['type']) and $DataArray['type'] != ''
			and isset($DataArray['number_list']) and $DataArray['number_list'] != '')
			{
				switch($DataArray['type'])
				{
					case 'management':
						$sql		= "select account from manager where number in (".$DataArray['number_list'].")";
						$data		= $this -> db -> query($sql);
						$data		= $data -> result();

						$account_list = '';
						foreach($data as $row)
						{
							$account_list .= ($account_list != '')?',':'';
							$account_list .= "'".$row -> account."'";
						}

						if($account_list == '')
						{
							return '0006';
							exit;
						}

						$sql	= "delete from model_auth where manager_account in (".$account_list.")";
						$this -> db -> query($sql);
						$sql	= "delete from manager where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'projects':
						$sql	= "delete from projects where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'about':
						$sql	= "delete from about where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'decree':
						$sql	= "delete from decree where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'filedown':
						$sql	= "delete from filedown where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'video':
						$sql	= "delete from video where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'runsup':
						$sql	= "delete from runsup where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'service2':
						$sql	= "delete from service2 where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'service':
						$sql	= "delete from service where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'news':
						$sql	= "delete from news where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'guestbook':
						$sql	= "delete from guestbook where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'contact':
						$sql	= "delete from contact where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'record':
						$sql	= "delete from ip_log";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'products':
						$sql	= "delete from products where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					case 'sub_pro_class':
						$pic_str	= '';
						$where_str	= '';

						for($i = 1;$i < 11;$i++)
						{
							$pic_str .= ($pic_str != '')?',':'';
							$pic_str .= 'pic'.$i;

							$where_str .= ($where_str != '')?' or ':'';
							$where_str .= "pic".$i." != ''";
						}

						if($DataArray['number_list'] != '')
						{
							$sql	= "select ".$pic_str." from products where class_number in (".$DataArray['number_list'].") and (".$where_str.")";
							$data	= $this -> db -> query($sql);
							$data	= $data -> result();
							foreach($data as $row)
							{
								for($i = 1;$i < 11;$i++)
								{
									if($row -> {'pic'.$i} != '')
									{
										if(file_exists(_Web_Root.'/images/pro_main/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_main/'.$row -> {'pic'.$i});
										if(file_exists(_Web_Root.'/images/pro_small/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_small/'.$row -> {'pic'.$i});
										if(file_exists(_Web_Root.'/images/pro_m_main/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_m_main/'.$row -> {'pic'.$i});
										if(file_exists(_Web_Root.'/images/pro_m_small/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_m_small/'.$row -> {'pic'.$i});
									}
								}
							}

							$sql	= "select pic1,pic2 from pro_class where number in (".$DataArray['number_list'].") and (pic1 != '' or pic2 != '')";
							$data	= $this -> db -> query($sql);
							$data	= $data -> result();
							foreach($data as $row)
							{
								for($i = 1;$i < 3;$i++)
								{
									if($row -> {'pic'.$i} != '')
									{
										if(file_exists(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i});
										if(file_exists(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i});
									}
								}
							}

							$sql	= "delete from products where class_number in (".$DataArray['number_list'].")";
							$this -> db -> query($sql);
							$sql	= "delete from pro_class where number in (".$DataArray['number_list'].")";
							$this -> db -> query($sql);
						}
						return '0000';
						break;
					case 'pro_class':
						if($DataArray['number_list'] != ''){
							$sql	= "select pic1,pic2 from pro_class where number in (".$DataArray['number_list'].") and (pic1 != '' or pic2 != '')";
							$data	= $this -> db -> query($sql);
							$data	= $data -> result();
							foreach($data as $row)
							{
								for($i = 1;$i < 3;$i++)
								{
									if($row -> {'pic'.$i} != '')
									{
										if(file_exists(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i});
										if(file_exists(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i});
									}
								}
							}

							$class_list = '';

							$sql	= "select number,pic1,pic2 from pro_class where class_number in (".$DataArray['number_list'].")";
							$data	= $this -> db -> query($sql);
							$data	= $data -> result();
							foreach($data as $row)
							{
								$class_list	.= ($class_list != '')?',':'';
								$class_list .= $row -> number;

								for($i = 1;$i < 3;$i++)
								{
									if($row -> {'pic'.$i} != '')
									{
										if(file_exists(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i});
										if(file_exists(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i}))
											unlink(_Web_Root.'/images/pro_class/'.$row -> {'pic'.$i});
									}
								}
							}

							$pic_str	= '';
							$where_str	= '';

							for($i = 1;$i < 11;$i++)
							{
								$pic_str .= ($pic_str != '')?',':'';
								$pic_str .= 'pic'.$i;

								$where_str .= ($where_str != '')?' or ':'';
								$where_str .= "pic".$i." != ''";
							}
							if($class_list != ''){
								$sql	= "select ".$pic_str." from products where class_number in (".$class_list.") and (".$where_str.")";
								$data	= $this -> db -> query($sql);
								$data	= $data -> result();
								foreach($data as $row)
								{
									for($i = 1;$i < 11;$i++)
									{
										if($row -> {'pic'.$i} != '')
										{
											if(file_exists(_Web_Root.'/images/pro_main/'.$row -> {'pic'.$i}))
												unlink(_Web_Root.'/images/pro_main/'.$row -> {'pic'.$i});
											if(file_exists(_Web_Root.'/images/pro_small/'.$row -> {'pic'.$i}))
												unlink(_Web_Root.'/images/pro_small/'.$row -> {'pic'.$i});
											if(file_exists(_Web_Root.'/images/pro_m_main/'.$row -> {'pic'.$i}))
												unlink(_Web_Root.'/images/pro_m_main/'.$row -> {'pic'.$i});
											if(file_exists(_Web_Root.'/images/pro_m_small/'.$row -> {'pic'.$i}))
												unlink(_Web_Root.'/images/pro_m_small/'.$row -> {'pic'.$i});
										}
									}
								}
								$sql	= "delete from products where class_number in (".$class_list.")";
								$this -> db -> query($sql);
							}
							$sql	= "delete from pro_class where class_number in (".$DataArray['number_list'].")";
							$this -> db -> query($sql);
							$sql	= "delete from pro_class where number in (".$DataArray['number_list'].")";
							$this -> db -> query($sql);
						}
						return '0000';
						break;
					case 'app_list':
						$sql	= "delete from app_list where number in (".$DataArray['number_list'].")";
						$this -> db -> query($sql);
						return '0000';
						break;
					default:
						return '0006';
						break;
				}
			}else{
				return '0006';
				exit;
			}
		}

		function ChangeClass($DataArray)
		{
			$class_number	= (isset($DataArray['class_number']) and $DataArray['class_number'] != '')?$DataArray['class_number']:'';
			$number			= (isset($DataArray['number']) and $DataArray['number'] != '')?$DataArray['number']:'';
			$type			= (isset($DataArray['type']) and $DataArray['type'] != '')?$DataArray['type']:'';

			unset($DataArray['type'],$DataArray['number']);

			if($class_number == '' or $number == '' or $type == '')
			{
				return '0010';
				exit;
			}

			if($type == 'sub')
			{
				$where	= "number = ".$number;
				$sql = $this -> db -> update_string('pro_class',$DataArray,$where);
				$this -> db -> query($sql);

				return '0000';
			}else{
				$sql	= "select group_concat(cast(number as char)) num_list from pro_class where class_number = ".$number." group by class_number";
				$data	= $this -> db -> query($sql);
				$data	= $data -> row();

				$class_list = ($data && $data -> num_list != '')?$data -> num_list:'';
				if($class_list != '')
				{
					$where	= "number in (".$class_list.")";
					$sql = $this -> db -> update_string('pro_class',$DataArray,$where);
					$this -> db -> query($sql);
				}
				$sql	= "select pic1,pic2 from pro_class where number = ".$number." limit 1";
				$pic	= $this -> db -> query($sql);
				$pic	= $pic -> row();

				if($pic)
				{
					@unlink(_Web_Root.'/images/pro_class/'.$pic -> pic1);
					@unlink(_Web_Root.'/images/pro_class/'.$pic -> pic2);
				}

				$sql	= "delete from pro_class where number = ".$number;
				$this -> db -> query($sql);

				return '0000';
			}
		}

		//變更資料筆數
		function change_page_num($DataArray)
		{
			if(isset($DataArray['type']) and isset($DataArray['page_num']))
			{
				$sql = "update mapping set varA = '".$DataArray['page_num']."' where type = '".$DataArray['type']."_page_num'";
				$this -> db -> query($sql);

				$_SESSION[$DataArray['type'].'_page_num'] = $DataArray['page_num'];
			}
		}

		//刪除圖片
		function Del_Pic($DataArray)
		{
			switch($DataArray['type'])
			{
				case 'products':
					$sql	= "update products set ".$DataArray['target']." = '' where number = ".$DataArray['number'];
					$this -> db -> query($sql);
					@unlink(_Web_Root.'/images/pro_main/'.$DataArray['pic']);
					@unlink(_Web_Root.'/images/pro_small/'.$DataArray['pic']);
					@unlink(_Web_Root.'/images/pro_m_main/'.$DataArray['pic']);
					@unlink(_Web_Root.'/images/pro_m_small/'.$DataArray['pic']);
					break;
				case 'banner1':
				case 'banner2':
					$this->db->select('varB');
					$this->db->from('mapping');
					$this->db->where('type',$DataArray['type']);
					$query = $this->db->get();
					$data = $query -> row();

					$data = explode(",",$data -> varB);

					foreach ($data as $i => $value) {
						if($value==$DataArray['pic'])
					    	unset($data[$i]);
					}


					$sql	= "update mapping set varB = '".implode(",",$data)."' where type = '".$DataArray['type']."'";
					$this -> db -> query($sql);
					@unlink(_Web_Root.'/images/banner/'.$DataArray['pic']);
					break;
			}
			return '0000';
		}

		//取得SEO的外來鍵，在新增時設定
		function get_seo_number()
		{
			$number = date('YmdHis').rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);

			return $number;
		}

		//細項SEO設定
		function Set_Detail_SEO($DataArray,$seo_number)
		{
			//避免未設定seo_number
			if($seo_number == '0' or $seo_number == '')
				$seo_number = $this -> get_seo_number();

			//篩選SEO資料
			$keys	= array('seo_title','key_contents','seo_contents','h1','h2','h3','self_contents','seo_enable');
			$data	= array();
			foreach($DataArray as $key => $row)
			{
				if(in_array($key,$keys))
				{
					$data[$key] = $row;
				}
			}

			//檢查是否已有資料
			$sql	= "select count(*) c from detail_seo where seo_number = '".$seo_number."'";
			$count	= $this -> db -> query($sql);
			$count	= $count -> row();

			$type	= ($count -> c < 1)?'add':'edit';

			//判斷是新增還是修改
			if($type == 'add')
			{
				$data['seo_number'] = $seo_number;

				$sql = $this -> db -> insert_string('detail_seo',$data);
				$this -> db -> query($sql);
			}else{
				$where = "seo_number = '".$seo_number."'";

				$sql = $this -> db -> update_string('detail_seo',$data,$where);
				$this -> db -> query($sql);
			}
		}

		//取得細項SEO設定
		function Get_Detail_SEO($DataArray,$seo_number = 0)
		{
			$sql	= "select * from detail_seo where seo_number = '".$seo_number."' limit 1";
			$data	= $this -> db -> query($sql);
			$data	= $data -> row();

			$DataArray -> seo_enable	= ($data)?$data -> seo_enable:'';
			$DataArray -> seo_title		= ($data)?$data -> seo_title:'';
			$DataArray -> key_contents	= ($data)?$data -> key_contents:'';
			$DataArray -> seo_contents	= ($data)?$data -> seo_contents:'';
			$DataArray -> h1			= ($data)?$data -> h1:'';
			$DataArray -> h2			= ($data)?$data -> h2:'';
			$DataArray -> h3			= ($data)?$data -> h3:'';
			$DataArray -> self_contents = ($data)?$data -> self_contents:'';

			return $DataArray;
		}
		function get_log(){
			$this->db->select('ip');
			$this->db->from('enter_log');
			$query = $this->db->get();
			$data1 = $query->num_rows();

			$this->db->select('ip');
			$this->db->from('enter_log');
			$this->db->where('date(add_time)',date("Y-m-d") );
			$this->db->group_by("ip");
			$query = $this->db->get();
			$data2 = $query->num_rows();

			$DataArray = "";
			$DataArray	= array('all' => $data1,'today' => $data2);
			return $DataArray;
		}
		function ajax_ChangPaswd()
		{
			$this->db->select("number,pw");
			$this->db->from("manager");
			$this->db->where("account",$_SESSION['UserData']['account']);
			$query = $this->db->get();
			$data = $query->row();
			if($data->number == ""){
				return array('Status' => '0400', 'Msg'=>'請先登入');
				die;
			}elseif ($data->pw != $_POST['password_old']) {
				return array('Status' => '0171', 'Msg'=>'舊密碼輸入錯誤');
				die;
			}

			$UPdat01 = array(
					 'pw'=> $_POST['password']
			);
			$this->db->where('number', $data->number);
			$this->db->update('manager', $UPdat01);

			return array('Status' => '0000', 'Msg'=>'成功修改');
		}
		function ajax_NewsList()
		{
			$this->db->select("count(News_Id) AS c");
			$this->db->from("news");
			$this->db->where("News_Status","1");
			$this->db->where("News_Del","0");
			if($_GET['q'])
				$this->db->like('News_Title', $_GET['q']);
			$query = $this->db->get();
			$count = $query->row();
			unset($query);
			$data = array();

			if($count->c != 0){
				$this->db->select("News_Id AS id,News_Title AS name");
				$this->db->from("news");
				$this->db->where("News_Status","1");
				$this->db->where("News_Del","0");

				if($_GET['q'])
					$this->db->like('News_Title', $_GET['q']);

				$this->db->limit(15,$_GET['page']);

				$query = $this->db->get();
				$data = $query->result();
				unset($query);
			}

			return array("total_count"=>$count->c,"incomplete_results"=>"true","items"=>$data);
		}
		function do_upload($upload_path,$FileName,$WH,$XY,$PreWH)
		{
			if(!file_exists($upload_path))
			{
				mkdir($upload_path, 0700);
			}

		  $config['upload_path']   = $upload_path;
		  $config['allowed_types']  = 'gif|jpeg|jpg|png|svg';
		  $config['max_size']   = 1024*2;
		  $config['max_width']  = 1920;
		  $config['max_height'] = 1000;
			$config['encrypt_name'] = 'true';

		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($FileName))
		  {
		  	return array('Status' => '1718','Error' => $this->upload->display_errors());
		  }
		  else
		  {
		    $data = array('upload_data' => $this->upload->data());
		    $this->load->library('image_lib');
				$x = 0;
				list($width, $height) = getimagesize($data['upload_data']['full_path']);

				foreach ($WH as $row) {

			    $config['image_library'] = 'gd2';
			    $config['source_image'] = $data['upload_data']['full_path'];
			    $config['maintain_ratio'] = TRUE;
			    $config['master_dim'] = 'width';

					if($row['floder'])
						$config['new_image'] = $upload_path.$row['floder'];
					else
						$config['new_image'] = $upload_path;

					if(!is_dir($config['new_image'])){
						mkdir($config['new_image'],0700);
					}
			    $config['width'] = $row['width'];
			    $config['height'] = $row['width']*$height/$width;
			    $this->image_lib->initialize($config);
					//改變影像尺寸
			    $this->image_lib->resize();
					$this->image_lib->clear();
					if($x==0){
						//剪裁影像
						if($row['floder'])
							$img_r = imagecreatefromjpeg($upload_path.$row['floder'].$data['upload_data']['file_name']);
						else
							$img_r = imagecreatefromjpeg($upload_path.$data['upload_data']['file_name']);

						$crop = ImageCreateTrueColor( $row['width'], $row['height'] );
						$jpeg_quality = 60;
						imageCopy(
						    $crop,
						    $img_r,
						    0,
						    0,
						    round($row['width']/$PreWH['w']*$XY['x']),
						    round(($row['height']*$XY['y'])/$PreWH['h']),
						    $row['width'],
						    $row['width']*$height/$width
						);

						if($row['floder'])
						imagejpeg($crop,$upload_path.$row['floder'].$data['upload_data']['file_name'],$jpeg_quality);
						else
						imagejpeg($crop,$upload_path.$data['upload_data']['file_name'],$jpeg_quality);
					}
					$x++;
				}
				return array('Status' => '0000', 'FileName' => $data['upload_data']['file_name']);
		  }
		}
	}
?>

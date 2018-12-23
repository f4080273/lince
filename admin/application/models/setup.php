<?
	Class Setup extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
		}

		function Web_Default($page)
		{

			//頁尾
			$data['CopyRight'] = "2017 © 威卡資訊. - weika.com.tw";
			//選單陣列
			$sql	= "select * from `model_auth` ma left join `model` m on m.`model_name` = ma.`model_name` where m.`enable` = 1 and ma.`manager_account` = '".$_SESSION['UserData']['account']."' order by m.`sort` asc,m.`number` desc";
			$query	= $this -> db -> query($sql);
			$MenuList = $query->result_array();
			$data['ModelFileName'] = $page;
			$data['MenuList'] = array();
			$data['MenuRoute'] = array();
			$x= 0;
			unset($query);
			foreach ($MenuList as $val1) {
				if($val1['class_number'] == 0){
					if($val1['model_name'] == $page){
						$val1['active'] = "active";
						$data['MenuRoute'][0] = $val1['model_title'];
					}
					$data['MenuList'][$x] = $val1;
					foreach ($MenuList as $val2){
						if($val1['number'] == $val2['class_number']){
							if($val2['model_name'] == $page){
								$val2['active'] = "active";
								$data['MenuList'][$x]['active'] = "active";
								$data['MenuRoute'][0] = $val1['model_title'];
								$data['MenuRoute'][1] = $val2['model_title'];
							}

							$data['MenuList'][$x]['sub'][] = $val2;
						}
					}
					if(count($data['MenuList'][$x]['sub']) == 1){
						$data['MenuList'][$x] = $data['MenuList'][$x]['sub'][0];
						unset($data['MenuRoute'][1]);
					}
					$x++;
				}
			}

			if(!isset($_SESSION['about_page_num']))
			{
				$sql	= "select varA from mapping where type = 'about_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['about_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['decree_page_num']))
			{
				$sql	= "select varA from mapping where type = 'decree_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['decree_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['filedown_page_num']))
			{
				$sql	= "select varA from mapping where type = 'filedown_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['filedown_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['video_page_num']))
			{
				$sql	= "select varA from mapping where type = 'video_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['video_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['runsup_page_num']))
			{
				$sql	= "select varA from mapping where type = 'runsup_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['runsup_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['service2_page_num']))
			{
				$sql	= "select varA from mapping where type = 'service2_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['service2_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['`']))
			{
				$sql	= "select varA from mapping where type = 'projects_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['projects_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['service_page_num']))
			{
				$sql	= "select varA from mapping where type = 'service_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['service_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['news_page_num']))
			{
				$sql	= "select varA from mapping where type = 'news_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['news_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['guestbook_page_num']))
			{
				$sql	= "select varA from mapping where type = 'guestbook_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['guestbook_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['contact_page_num']))
			{
				$sql	= "select varA from mapping where type = 'contact_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['contact_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['record_page_num']))
			{
				$sql	= "select varA from mapping where type = 'record_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['record_page_num'] = $update01[0] -> varA;
			}
			if(!isset($_SESSION['products_page_num']))
			{
				$sql	= "select varA from mapping where type = 'products_page_num' limit 1";
				$update01	= $this -> db -> query($sql);
				$update01	= $update01 -> result();
				$_SESSION['products_page_num'] = $update01[0] -> varA;
			}

			return $data;
		}
	}
?>

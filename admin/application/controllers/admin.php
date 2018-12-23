<?
	Class admin extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this -> load -> model('data_process');
			$this -> load -> model('setup');
			$this -> load -> helper('url');
			$this -> load -> helper('general');
			$this -> load -> library('cache');
		}
		//=============================== 網站基本設定、處理 ====================================
		function Check_Status($page)
		{
			$Status_Num = $this -> data_process -> Check_Status($page);

			if($Status_Num != '0000')
			{
				$this -> data_process -> Process_Result($Status_Num);
				exit;
			}
		}
		function setup($page)
		{
			//取得頁面基本設定
			$data	=	$this -> setup -> Web_Default($page);

			$data['Head'] = $this -> load -> view('template/head',$data,true);

			$data['TopBar'] = $this -> load -> view('template/top_bar',$data,true);

			$data['Menu'] = $this -> load -> view('template/menu',$data,true);

			$data['SupplierJs'] = $this -> load -> view('template/supplier_js',$data,true);

			$data['Footer'] = $this -> load -> view('template/footer',$data,true);

			return $data;
		}
		//=============================== End 網站基本設定、處理 ====================================

		//=================================== 網站頁面處理 =========================================

		//首頁
		function index()
		{
			//模組名稱
			$ModelName	= 'base_setup';
			//初始驗證
			$this -> Check_Status($ModelName);
			//頁面基本設定
			$data	= $this -> setup($ModelName);
			$data['type'] = 'edit';
			$data['get_data_list'] = $this->data_process->get_data_list($ModelName,'0','');
			$data['get_data_list'] = $data['get_data_list']['Data'];

			$data['Right_Contents']		= $this -> load -> view('base_setup',$data,true);

			$this -> load -> view('index',$data);
		}
		//
		function banner_setup()
		{
			//模組名稱
			$ModelName	= 'banner_setup';
			//初始驗證
			$this -> Check_Status($ModelName);
			//頁面基本設定
			$data	= $this -> setup($ModelName);

			$data['type'] = 'edit';

			$data['get_data_list'] = $this->data_process->get_data_list($ModelName,'0','');

			$data['Right_Contents']		= $this -> load -> view('banner_setup',$data,true);

			$this -> load -> view('index',$data);
		}
		function base_setup($type)
		{
			//模組名稱
			$ModelName	= 'base_setup';
			//初始驗證
			$this -> Check_Status($ModelName);
			//頁面基本設定
			$data	= $this -> setup($ModelName);

			$data['type'] = 'edit';

			$data['get_data_list'] = $this->data_process->get_data_list($ModelName,'0','');
			$data['get_data_list'] = $data['get_data_list']['Data'];

			$data['Right_Contents']		= $this -> load -> view('base_setup',$data,true);

			$this -> load -> view('index',$data);
		}

		function management($Type = 'list',$Id = 0,$Page = 0)
		{
			$this -> load -> model('management_process');
			$ModelName	= 'management';
			$this -> Check_Status($ModelName);
			$Data	= $this -> setup($ModelName);
			switch($Type)
			{
				case 'add':
					$Data['Page']	= $Page;
					$Data['Type'] = $Type;
					$Data['get_ModelList'] = $this -> management_process -> get_ModelList();
					$Data['Right_Contents']	= $this -> load -> view('management/management_form',$Data,true);
					break;
				case 'edit':
					$Data['Page']	= $Page;
					$Data['Type'] = $Type;
					$Data['get_ModelList'] = $this -> management_process -> get_ModelList();
					$DataArray = $this -> management_process -> get_DataById($Id);
					$Data['DataArray'] = $DataArray['Data'];
					$Data['AuthorityArray'] = $DataArray['AuthorityArray'];
					$Data['Right_Contents']	= $this -> load -> view('management/management_form',$Data,true);
					break;
				default:
					$DataArray = $this->management_process->get_DataList($Page);
					$Data['Page']	= $Page;
					$Data['DataList'] = $DataArray['DataList'];
					$Data['PageList'] = $DataArray['PageList'];
					$Data['TotalNum'] = $DataArray['TotalNum'];
					$Data['Right_Contents']	= $this -> load -> view('management/management_list',$Data,true);
					break;
			}
			$this -> load -> view('index',$Data);
		}
		//=============================== End 網站頁面處理 =========================================
		//新增資料
		function Add_Data()
		{
			switch ($this->input->post('action')) {
				case 'management':
					$this -> load -> model('management_process');
					$Status_Num	= $this -> management_process -> Add_Data($this->input->post());
					break;
				default:
					$Status_Num	= $this -> data_process -> Add_Data($this->input->post());
					break;
			}
			//刪除快取
			$this -> cache -> del_cache();

			if($Status_Num != '0000')
			{
				$data = $this -> data_process -> Process_Result($Status_Num);
			}
		}
		//修改資料
		function Edit_Data()
		{
			switch ($this->input->post('action')) {
				case 'management':
					$this -> load -> model('management_process');
					$Status_Num	= $this -> management_process -> Edit_Data($this->input->post());
					break;
				default:
					$Status_Num	= $this -> data_process -> Edit_Data($this->input->post());
					break;
			}
			//刪除快取
			$this -> cache -> del_cache();

			if($Status_Num != '0000')
			{
				$data = $this -> data_process -> Process_Result($Status_Num);
			}
		}
		//刪除資料
		function Del_Data()
		{
			switch ($this->input->post('action')) {
				case 'management':
					$this -> load -> model('management_process');
					$Status_Num	= $this -> management_process -> Del_Data($this->input->post());
					break;
				default:
					$Status_Num	= $this -> data_process -> Del_Data($this->input->post());
					break;
			}
			//刪除快取
			$this -> cache -> del_cache();

			if($Status_Num != '0000')
			{
				$data = $this -> data_process -> Process_Result($Status_Num);
			}else{
				$data = array('Status' => '0000');
			}
			echo json_encode($data);
		}
		function Login_Page()
		{
			$this -> load -> view('Login_Page');
		}
		function login()
		{
			$account	= $this -> input -> post('account');
			$passwd		= $this -> input -> post('passwd');
			$Status_Num	= $this -> data_process -> login($account,$passwd);

			if($Status_Num != '0000')
			{
				$data = $this -> data_process -> Process_Result($Status_Num);
			}else{
				$data = array('Status' => '0000');
			}

			echo json_encode($data);
		}
		function logout()
		{
			$Status_Num	= $this -> data_process -> logout();

			if($Status_Num != '0000')
			{
				$data = $this -> data_process -> Process_Result($Status_Num);
			}else{
				$data = array('Status' => '0000');
			}

			echo json_encode($data);
		}
		function change_passwd()
		{
			//模組名稱
			$ModelName	= 'base_setup';
			//初始驗證
			$this -> Check_Status($ModelName);
			//頁面基本設定
			$data	= $this -> setup($ModelName);

			$data['Right_Contents']		= $this -> load -> view('change_passwd',$data,true);

			$this -> load -> view('index',$data);
		}
		function ajax_chang_paswd()
		{
			$data = $this -> data_process -> ajax_ChangPaswd();

			echo json_encode($data);
		}
		//=============================== End 登入、出 ====================================
	}

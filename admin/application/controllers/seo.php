<?
	Class seo extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this -> load -> model('data_process');
			$this -> load -> model('seo_process');
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
		function seo_admin($Type = 'list',$Id = 0,$Page = 0)
		{
			$ModelName	= 'seo';
			$this -> Check_Status($ModelName);
			$Data	= $this -> setup($ModelName);
			switch($Type)
			{
			case 'edit':
				$Data['Type'] = $Type;
				$Data['DataArray'] = $this->seo_process->get_DataById($Id);
				$Data['Right_Contents']	= $this->load->view('seo/seo_form',$Data,true);
				break;
			default:
				$DataArray = $this->seo_process->get_DataList($Page);
				$Data['DataList'] = $DataArray['DataList'];
				$Data['PageList'] = $DataArray['PageList'];
				$Data['Right_Contents']	= $this ->load ->view('seo/seo_list',$Data,true);
				break;
			}
			$this -> load -> view('index',$Data);
		}
		//=============================== End 網站頁面處理 =========================================
		//修改資料
		function Edit_Data()
		{
			$Status_Num	= $this ->seo_process-> Edit_Data($this->input->post());
			//刪除快取
			$this -> cache -> del_cache();

			if($Status_Num != '0000')
			{
				$data = $this ->data_process-> Process_Result($Status_Num);
			}
		}
	}

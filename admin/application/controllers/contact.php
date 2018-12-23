<?
	Class contact extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this -> load -> model('data_process');
			$this -> load -> model('contact_process');
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
		function contact_admin($Type = 'list',$Id = 0,$Page = 0)
		{
			$ModelName	= 'contact';
			$this -> Check_Status($ModelName);
			$Data	= $this -> setup($ModelName);
			switch($Type)
			{
			case 'edit':
				$this-> contact_process ->add_CheckTime($Id);
				$Data['type'] = $Type;
				$Data['DataArray'] = $this-> contact_process ->get_DataById($Id);
				$Data['Right_Contents']	= $this->load->view('contact/contact_form',$Data,true);
				break;
			default:
				$DataArray = $this->contact_process->get_DataList($Page);
				$Data['DataList'] = $DataArray['DataList'];
				$Data['PageList'] = $DataArray['PageList'];
				$Data['Right_Contents']	= $this ->load ->view('contact/contact_list',$Data,true);
				break;
			}
			$this -> load -> view('index',$Data);
		}
		//=============================== End 網站頁面處理 =========================================
		//修改資料
		function Edit_Data()
		{
			$Status_Num	= $this ->contact_process-> Edit_Data($this->input->post());
			//刪除快取
			$this -> cache -> del_cache();

			if($Status_Num != '0000')
			{
				$data = $this ->data_process-> Process_Result($Status_Num);
			}
		}
		//刪除資料
		function Del_Data()
		{
			$Status_Num	= $this ->contact_process-> Del_Data($this->input->post());
			//刪除快取
			$this -> cache -> del_cache();

			if($Status_Num != '0000')
			{
				$data = $this->data_process->Process_Result($Status_Num);
			}else{
				$data = array('Status' => '0000');
			}
			echo json_encode($data);
		}
	}

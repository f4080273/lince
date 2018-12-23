<?
	Class Management_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> model('data_process');
			$this -> load -> library('pagination');
			$this -> load -> helper('page');
			$this->load->library('email');
		}
		function get_DataList($Page = 0)
		{
			$PageNum = 25;
			$this->db->select('number,enable,account,pw,name,power');
			$this->db->from('manager');
			if($this->input->get('title')){
				$this->db->like('account',$this->input->get('title'));
			}
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(number) AS Num');
			$this->db->from('manager');
			if($this->input->get('title')){
				$this->db->like('account',$this->input->get('title'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/admin/management/list/0/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/admin/management/list/0/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select('number,enable,account,pw,name,power');
			$this->db->from('manager');
			$this->db->where("number",$Id);
			$query = $this->db->get();
			$Data  = $query->row();

			$this->db->select('model_name');
			$this->db->from('model_auth');
			$this->db->where("manager_account",$Data->account);
			$query = $this->db->get();
			$AuthorityArray  = $query->result();

			foreach ($AuthorityArray as $row) {
				$AuthorityArrayTemp[] = $row->model_name;
			}

			return array('Data' => $Data,'AuthorityArray' => $AuthorityArrayTemp);
		}
		function get_ModelList()
		{
			$this->db->select('number,class_number,just_btn,model_name,model_title');
			$this->db->from('model');
			$this->db->where('enable','1');
			$this->db->order_by('sort ASC');
			$query = $this->db->get();
			$data  = $query->result();
			return $data;
		}
		function Add_Data($DataArray)
		{
			//檢查帳號重複
			$this->db->select('COUNT(number) AS Num');
			$this->db->from('manager');
			$this->db->where("account",$DataArray['account']);
			$query = $this->db->get();
			$CheckAccout = $query->row();
			unset($query);
			if($CheckAccout->Num > 0){
				BackPageMsg("相同帳號");
				die;
			}

			$keys = array(	'enable',
											'account',
											'pw',
											'name',
											'power'
									);
				$data = array();
				$x = 0;
				foreach($DataArray as $key => $row)
				{
					if(in_array($key,$keys))
					{
						$data[$key] = $row;
						$x = ($row != '')?$x + 1:$x;
					}
				}
				$this->db->insert('manager', $data);
				//
				$this->db->select('model_name');
				$this->db->from('model_auth');
				$this->db->where("manager_account",$DataArray['account']);
				$query = $this->db->get();
				$AuthorityArray  = $query->result();
				unset($query);

				foreach ($AuthorityArray as $row) {
					$AuthorityArrayTemp[] = $row->model_name;
				}
				foreach ($DataArray['authority'] as $row){
					if(!in_array($row,$AuthorityArrayTemp)){
						$Insert01 = array(
							 'model_name' => $row ,
							 'manager_account' => $DataArray['account']
						);
						$this->db->insert('model_auth', $Insert01);
					}
				}
				foreach ($AuthorityArrayTemp as $row) {
					if(!in_array($row,$DataArray['authority'])){
						$this->db->delete('model_auth', array('model_name' => $row,'manager_account'=>$DataArray['account']));
					}
				}

				jumpPageMsg(_Web_Url.'/admin/management/list/0/'.$DataArray['page'],'新增成功');
		}
		function Edit_Data($DataArray)
		{
			//檢查帳號重複
			$this->db->select('COUNT(number) AS Num');
			$this->db->from('manager');
			$this->db->where("account",$DataArray['account']);
			$this->db->where("number !=",$DataArray['id']);
			$query = $this->db->get();
			$CheckAccout = $query->row();
			unset($query);
			if($CheckAccout->Num > 0){
				BackPageMsg("相同帳號");
				die;
			}

			$keys = array(	'enable',
											'account',
											'pw',
											'name',
											'power'
									);
				$data = array();
				$x = 0;
				foreach($DataArray as $key => $row)
				{
					if(in_array($key,$keys))
					{
						$data[$key] = $row;
						$x = ($row != '')?$x + 1:$x;
					}
				}
				$this->db->where('number', $DataArray['id']);
				$this->db->update('manager', $data);

				//
				$this->db->select('model_name');
				$this->db->from('model_auth');
				$this->db->where("manager_account",$DataArray['account']);
				$query = $this->db->get();
				$AuthorityArray  = $query->result();

				foreach ($AuthorityArray as $row) {
					$AuthorityArrayTemp[] = $row->model_name;
				}
				foreach ($DataArray['authority'] as $row){
					if(!in_array($row,$AuthorityArrayTemp)){
						$Insert01 = array(
							 'model_name' => $row ,
							 'manager_account' => $DataArray['account']
						);
						$this->db->insert('model_auth', $Insert01);
					}
				}
				foreach ($AuthorityArrayTemp as $row) {
					if(!in_array($row,$DataArray['authority'])){
						$this->db->delete('model_auth', array('model_name' => $row,'manager_account'=>$DataArray['account']));
					}
				}

				jumpPageMsg(_Web_Url.'/admin/management/list/0/'.$DataArray['page'],'修改成功');
		}
		function Del_Data($DataArray)
		{
			$NumberList = explode(',',$DataArray['number_list']);
			if(count($DataArray['number_list']) > 0){
				foreach ($NumberList as $row) {
					$get_DataById = $this->get_DataById($row);
					$this->db->where('manager_account', $get_DataById['Data']->account);
					$this->db->delete('model_auth');
					//關閉本類別
					$this->db->where('number', $row);
					$this->db->delete('manager');
				}
			}
			return '0000';
		}
	}
?>

<?
	Class Contact_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> model('data_process');
			$this -> load -> model('common_process');
			$this -> load -> library('pagination');
			$this -> load -> helper('page');
			$this->load->library('email');
		}
		function get_DataList($Page = 0)
		{
			$PageNum = 25;
			$this->db->select('
													Contact_Id,Contact_Name,Contact_Content,Contact_Email,Contact_AddTime,Contact_CheckTime
												');
			$this->db->from('contact');
			if($this->input->get('Contact_Name')){
				$this->db->like('name',$this->input->get('name'));
			}
			if($this->input->get('email')){
				$this->db->like('Contact_Email',$this->input->get('email'));
			}
			$this->db->where('Contact_Del','0');
			$this->db->order_by('Contact_AddTime DESC');
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(Contact_Id) AS Num');
			$this->db->from('contact');
			if($this->input->get('name')){
				$this->db->like('Contact_Name',$this->input->get('name'));
			}
			if($this->input->get('email')){
				$this->db->like('Contact_Email',$this->input->get('email'));
			}
			$this->db->where('Contact_Del','0');
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/contact/contact_admin/list/0/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/contact/contact_admin/list/0/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select('Contact_Id,Contact_Content,Contact_Name,Contact_Email,Contact_Tel,Contact_Phone,Contact_Sex,Contact_Address,Contact_ContractT,Contact_Ask,Contact_AddTime,Contact_CheckTime');
			$this->db->from('contact');
			$this->db->where('Contact_Id',$Id);
			$this->db->where('Contact_Del','0');
			$query = $this->db->get();
			$data  = $query->row();
			return $data;
		}
		function Del_Data($DataArray)
		{
			$NumberList = explode(',',$DataArray['number_list']);
			if(count($DataArray['number_list']) > 0){
				foreach ($NumberList as $row) {
					//關閉
					$data = array(
													'Contact_Del' => '1',
													'Contact_DelTime' => data("Y-m-d H:i:s")
											);
					$this->db->where('Contact_Id', $row);
					$this->db->update('contact',$data);
				}
			}
			return '0000';
		}
		function add_CheckTime($Id)
		{
			$this-> db ->select('Contact_Id,Contact_CheckTime');
			$this-> db ->from('contact');
			$this-> db ->where('Contact_Id',$Id);
			$query = $this -> db -> get();
			$Contract	= $query -> row();

			if($Contract->Contact_CheckTime == ""){
				$Update01 = array('Contact_CheckTime' => date("Y-m-d H:i:s"));
				$this->db->where('Contact_Id',$Contract->Contact_Id);
				$this->db->update('contact',$Update01);
			}
		}
	}
?>

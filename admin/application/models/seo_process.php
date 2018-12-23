<?
	Class Seo_process extends CI_Model{
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
													Seo_Id,Seo_Page,Seo_Title,Seo_Keys,Seo_Name,Seo_Contents,Seo_SelfContents
												');
			$this->db->from('seo');
			if($this->input->get('name')){
				$this->db->like('Seo_Name',$this->input->get('name'));
			}
			$this->db->order_by('Seo_Id ASC');
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(Seo_Id) AS Num');
			$this->db->from('seo');
      if($this->input->get('name')){
				$this->db->like('Seo_Name',$this->input->get('name'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/seo/seo_admin/list/0/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/seo/seo_admin/list/0/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select('Seo_Id,Seo_Page,Seo_Name,Seo_Title,Seo_Keys,Seo_Contents,Seo_SelfContents');
			$this->db->from('seo');
			$this->db->where('Seo_Id',$Id);
			$query = $this->db->get();
			$data  = $query->row();
			return $data;
		}
		function Edit_Data($DataArray)
		{

			$keys = array(	'Seo_Title',
											'Seo_Keys',
											'Seo_Contents',
											'Seo_SelfContents'
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

			$data['Seo_ChangeDate'] = date("Y-m-d H:i:s");
			$this->db->where('Seo_Id', $DataArray['id']);
			$this->db->update('seo', $data);

			jumpPageMsg(_Web_Url.'/seo/seo_admin/list/0/'.$DataArray['page'],'修改成功');
		}
	}
?>

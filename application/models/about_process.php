<?
	Class About_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> helper('general');
			$this -> load -> helper('page');
		}
		function get_AboutList($Page = 0,$AboutTypeId = 0)
		{
			$PageNum = 9;

			$this->db->select('
													About_Id,About_AboutTypeId,About_SeoId,About_Title,About_Img
											');
			$this->db->from('about');
			$this->db->where('About_AboutTypeId',$AboutTypeId);
			$this->db->where('About_Status','1');
			$this->db->where('About_Del','0');
			$this->db->limit($PageNum,$Page);
			$this->db->order_by('About_Sort DESC');
			$query = $this->db->get();
			$data['ListData'] = $query->result();

			$this->db->select('count(About_Id) as count');
			$this->db->from('about');
			$this->db->where('About_AboutTypeId',$AboutTypeId);
			$this->db->where('About_Status','1');
			$this->db->where('About_Del','0');
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount->count;

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url."/about/lts/".$AboutTypeId."/";
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/about/lts/".$AboutTypeId."/0?".fafa_http_build_query($this->input->get());
			$config['suffix'] 		= "?".fafa_http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config,$MemberId);
			$data['PageData'] = $this->pagination->create_links();

			return $data;
		}
		function get_AboutDataById($AboutId = 0)
		{
			$this->db->select('
												 About_Id,About_SeoId,About_AboutTypeId,About_Title,About_Img,About_Content
											');
			$this->db->from('about');
			$this->db->where('About_Status','1');
			$this->db->where('About_Del','0');
			$this->db->where('About_Id',$AboutId);
			$this->db->limit('1');
			$query = $this->db->get();
			$data = $query->row();

			return $data;
		}
		function get_AboutTypeDataById($AboutTypeId)
		{
			$this->db->select('AboutType_Name');
			$this->db->from('about_type');
			$this->db->where('AboutType_Id',$AboutTypeId);
			$this->db->limit('1');
			$query = $this->db->get();
			$data = $query->row();

			return $data;
		}
	}
?>

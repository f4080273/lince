<?
	Class News_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> helper('general');
			$this -> load -> helper('page');
		}
		function get_NewsList($Page = 0)
		{
			$PageNum = 8;

			$this->db->select('
													News_Id,News_Title,News_Img,News_Content,DATE(News_PulTime) AS News_PulTime
											');
			$this->db->from('news');
			$this->db->where('News_Status','1');
			$this->db->where('News_Del','0');
			$this->db->where('News_PulTime <=',date('Y-m-d H:i:s'));
			if($this->input->get('search')){
				$this->db->like('News_Title',$this->input->get('search'));
			}
			$this->db->limit($PageNum,$Page);
			$this->db->order_by('News_Sort DESC,News_PulTime DESC');
			$query = $this->db->get();
			$data['ListData'] = $query->result();

			$this->db->select('count(News_Id) as count');
			$this->db->from('news');
			$this->db->where('News_Status','1');
			$this->db->where('News_Del','0');
			$this->db->where('News_PulTime <=',date('Y-m-d H:i:s'));
			if($this->input->get('search')){
				$this->db->like('News_Title',$this->input->get('search'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount->count;

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url."/news/lts/";
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 3;
			$config['first_url'] 	= _Web_Url."/news/lts/0?".fafa_http_build_query($this->input->get());
			$config['suffix'] 		= "?".fafa_http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config,$MemberId);
			$data['PageData'] = $this->pagination->create_links();

			return $data;
		}
		function get_NewsDataById($NewsId = 0)
		{
			$this->db->select('
													News_Title,News_SeoId,News_Img,News_Content,DATE(News_PulTime) AS News_PulTime
											');
			$this->db->from('news');
			$this->db->where('News_Status','1');
			$this->db->where('News_Del','0');
			$this->db->where('News_PulTime <=',date('Y-m-d H:i:s'));
			$this->db->where('News_Id',$NewsId);
			$this->db->limit('1');
			$query = $this->db->get();
			$data = $query->row();

			return $data;
		}
	}
?>

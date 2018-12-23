<?
	Class Common_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this->load->library('email');
		}
		function get_SeoDataById($Id)
		{
			$this->db->select('
													DetailSeo_Id,DetailSeo_Title,DetailSeo__Keys,DetailSeo__Contents,DetailSeo_SelfContents
											');
			$this->db->from('detail_seo');
			$this->db->where('DetailSeo_Id',$Id);
			$query = $this->db->get();
			$data = $query->row();

			return $data;
		}
		function Check_MemberData($Id)
		{
			$this->db->select('
													Member_Id,Member_Status,WebConfig_Name,WebConfig_Email,Member_AddTime,Member_VIPTime
											');
			$this->db->from('member');
			$this->db->join('web_config','web_config.WebConfig_MemberId = member.Member_Id');
			$this->db->where('Member_Id',$Id);
			$query = $this->db->get();
			$data = $query->row();

			if(!isset($data->Member_Id))
			{
				show_error('找不到此頁面');
				die;
			}
			elseif ($data->Member_Status == 0) {
				header('Location:'._Web_Url."/web/error/$Id/1717");
				die;
			}
			elseif (strtotime($data->Member_AddTime)+$data->Member_VIPTime*3600 <= time()) {
				header('Location:'._Web_Url."/web/error/$Id/5045");
				die;
			}
			else
				return $data;
		}
		function get_IndexNewsList($Page = 5)
		{
			$this->db->select('
													News_Id,News_Title,News_Img,DATE(News_PulTime) AS News_PulTime
											');
			$this->db->from('news');
			$this->db->where('News_Status','1');
			$this->db->where('News_Del','0');
			$this->db->where('News_PulTime <=',date('Y-m-d H:i:s'));
			$this->db->limit($Page);
			$this->db->order_by('News_PulTime DESC');
			$query = $this->db->get();
			$data = $query->result();

			return $data;
		}
		function get_RightNews()
		{
			$this->db->select('
													News_Id,News_Title,News_Img,DATE(News_PulTime) AS News_PulTime
											');
			$this->db->from('news');
			$this->db->where('News_Status','1');
			$this->db->where('News_Del','0');
			$this->db->where('News_PulTime <=',date('Y-m-d H:i:s'));
			$this->db->limit('5');
			$this->db->order_by('News_PulTime DESC');
			$query = $this->db->get();
			$data['DataList'] = $query->result();

			return $data;
		}
		function get_IndexAboutList($AboutTypeId = 0)
		{
			$this->db->select('
													About_Id,About_AboutTypeId,About_Title,About_Img,About_Content
											');
			$this->db->from('about');
			$this->db->where('About_AboutTypeId','4');
			$this->db->where('About_Status','1');
			$this->db->where('About_Del','0');
			$this->db->order_by('About_Sort DESC,About_Id ASC');
			$query = $this->db->get();
			$data = $query->result();

			return $data;
		}
		function send_Email($MailererName = '',$MailTitle='',$MailTo='',$MailHtml='')
		{

			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.gmail.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = 'f4080273@gmail.com';
			$config['smtp_pass']    = 'f4080273gn28960943';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validate'] = TRUE;

			$this->email->initialize();

			$this->email->from('service@service.com', $MailererName);
			$this->email->to($MailTo);
			$this->email->subject($MailTitle.' - '.$MailererName);
			$this->email->message($MailHtml);
			$this->email->send();
		}
	}
?>

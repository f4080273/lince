<?
	Class Setup extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();

			$this -> load -> model('common_process');
		}

		function setup($Page = 'index')
		{
			$this->db->select('
													Seo_Title AS DetailSeo_Title,Seo_Keys AS DetailSeo__Keys,Seo_Contents AS DetailSeo__Contents,Seo_SelfContents AS DetailSeo_SelfContents
											');
			$this->db->from('seo');
			$this->db->where('Seo_Page',$Page);
			$query = $this->db->get();
			$data['SeoData'] = $query->row();
			//文章類型
			$this->db->select('
													AboutType_Id,AboutType_Name
											');
			$this->db->from('about_type');
			$this->db->where('AboutType_Status','1');
			$this->db->where('AboutType_Del','0');
			$this->db->where('AboutType_Show','1');
			$query = $this->db->get();
			$data['AboutTypeList'] = $query->result();
			//文章內容(5篇)
			$sql = array();
			foreach ($data['AboutTypeList'] as $row) {
				$sql[] = "(SELECT About_Id,About_AboutTypeId,About_Title FROM about WHERE About_AboutTypeId = '".$row->AboutType_Id."' AND About_Status = '1' AND About_Del = '0' ORDER BY About_Sort DESC LIMIT 5)";
			}
			$query = $this->db->query(implode('union all',$sql));
			$data['AboutList'] = $query->result();
			//最新消息(5篇)
			$this->db->select('
													News_Id,News_Title
											');
			$this->db->from('news');
			$this->db->where('News_Status','1');
			$this->db->where('News_Del','0');
			$this->db->where('News_PulTime <=',date('Y-m-d H:i:s'));
			$this->db->order_by('News_Sort DESC,News_PulTime DESC');
			$this->db->limit('5');
			$query = $this->db->get();
			$data['NewsList'] = $query->result();
			//
			$this->db->select('type,varA,varB,varC,varD,varE,varF');
			$this->db->from('mapping');
			$this->db->where_in('type',array('mail_profile','banner1','banner2','web_define','contract1','contract2','contract3'));
			$query = $this -> db -> get();
			$WebDefault	= $query -> result();
			unset($query);
			foreach ($WebDefault as $row) {
				$data[$row->type] = $row;
			}
			$data['index_banner'][0] =  json_decode($data['banner1']->varB);
			$data['index_banner'][1] =  json_decode($data['banner1']->varC);
			$data['index_banner'][2] =  json_decode($data['banner1']->varD);

			$data['page_banner'][0] =  json_decode($data['banner2']->varB);

			switch ($Page) {
				default:
					$data['WebTitle'] = '';
					break;
			}

			return $data;
		}
		function get_Catalog($ParentId = 0)
		{
			$this->db->select("Catalog_Id,Catalog_ParentId,Catalog_Name");
			$this->db->from("catalog");
      $this->db->where("Catalog_ParentId",$ParentId);
			$this->db->where("Catalog_Del","0");
			$this->db->where("Catalog_Status","1");
			$this->db->order_by("Catalog_Sort DESC");
			$query = $this->db->get();
			$data = $query->result();
			return $data;
		}
	}
?>

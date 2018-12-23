<?
	Class Index_about_process extends CI_Model{
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
			$this->db->select('About_Id,About_Sort,About_Status,About_Title,About_Content,About_EditTime');
			$this->db->from('about');
			$this->db->where('About_Del','0');
			$this->db->like('About_AboutTypeId','4');
			if($this->input->get('title')){
				$this->db->like('About_Title',$this->input->get('title'));
			}
			$this->db->order_by('About_Sort ASC');
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(About_Id) AS Num');
			$this->db->from('about');
			$this->db->where('About_Del','0');
			$this->db->like('About_AboutTypeId','4');
			if($this->input->get('title')){
				$this->db->like('About_Title',$this->input->get('title'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/index_about/about_admin/list/4/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/index_about/about_admin/list/4/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select('	About_Id,About_SeoId,About_Sort,About_Status,About_Title,About_Content,About_EditTime,About_Img
												');
			$this->db->from('about');
			$this->db->where('About_Del','0');
			$this->db->where('About_Id',$Id);
			$query = $this->db->get();
			$data  = $query->row();


			return $data;
		}
		function Add_Data($DataArray)
		{
			$keys = array(	'About_Sort',
											'About_Status',
											'About_Title',
											'About_Content'
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
			$data['About_AboutTypeId'] = 4;
			$data['About_AddTime'] = date("Y-m-d H:i:s");
			$data['About_EditTime'] = date("Y-m-d H:i:s");
			//圖片
			if(isset($_FILES['About_Img']) && $_FILES['About_Img']['name'] != "")
			{
				$ImgWH = array(array('width'=>'555','height'=>'414'));
				$ImgXY = array('x'=>$DataArray['About_Img_x'],'y'=>$DataArray['About_Img_y']);
				$PreWH = array('w'=>$DataArray['About_Img_w'],'h'=>$DataArray['About_Img_h']);

				$UpLoadData = $this->common_process->do_upload('../images/about/','About_Img',$ImgWH,$ImgXY,$PreWH);

				if($UpLoadData['Status'] != '0000')
				{
					BackPageMsg($UpLoadData['Error']);
					die;
				}else{
					$data['About_Img'] = $UpLoadData['FileName'];
				}
			}

			$this->db->insert('about', $data);

			jumpPageMsg(_Web_Url.'/index_about/about_admin/list/4'.$DataArray['page'].'?parent_id='.$DataArray['Area_ParentId'],'新增成功');
		}
		function Edit_Data($DataArray)
		{

			$keys = array(	'About_Sort',
											'About_Status',
											'About_Title',
											'About_Content'
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
			$data['About_AboutTypeId'] = 4;
			//圖片
			if(isset($_FILES['About_Img']) && $_FILES['About_Img']['name'] != "")
			{
				$ImgWH = array(array('width'=>'555','height'=>'414'));
				$ImgXY = array('x'=>$DataArray['About_Img_x'],'y'=>$DataArray['About_Img_y']);
				$PreWH = array('w'=>$DataArray['About_Img_w'],'h'=>$DataArray['About_Img_h']);

				$UpLoadData = $this->common_process->do_upload('../images/about/','About_Img',$ImgWH,$ImgXY,$PreWH);

				if($UpLoadData['Status'] != '0000')
				{
					BackPageMsg($UpLoadData['Error']);
					die;
				}else{
					$data['About_Img'] = $UpLoadData['FileName'];
				}
			}

			$data['About_EditTime'] = date("Y-m-d H:i:s");
			$this->db->where('About_Id', $DataArray['id']);
			$this->db->update('about', $data);

			jumpPageMsg(_Web_Url.'/index_about/about_admin/list/4'.$DataArray['page'],'修改成功');
		}
		function Del_Data($DataArray)
		{
			$NumberList = explode(',',$DataArray['number_list']);
			if(count($DataArray['number_list']) > 0){
				foreach ($NumberList as $row) {
					//關閉
					$Update01 = array(
								 'About_Del' => '1',
								 'About_DelDate' => date("Y-m-d H:i:s"),
							);
					$this->db->where('About_Id', $row);
					$this->db->update('about', $Update01);
				}
			}
			return '0000';
		}
		function get_AboutTypeList()
		{
			$this->db->select("AboutType_Id,AboutType_Name");
			$this->db->from("about_type");
			$this->db->where("AboutType_Del","0");
			$this->db->where("AboutType_Show","1");
			$this->db->where("AboutType_Status","1");
			$query = $this->db->get();
			$data = $query->result();
			return $data;
		}
	}
?>

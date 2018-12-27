<?
	Class Catalog_process extends CI_Model{
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
			$this->db->select('Catalog_Id,Catalog_ParentId,Catalog_Name,Catalog_Sort,Catalog_Status');
			$this->db->from('catalog');
			$this->db->where('Catalog_Del','0');
			if($this->input->get('type_id')){
				$this->db->like('Catalog_ParentId',$this->input->get('type_id'));
			}
			if($this->input->get('name')){
				$this->db->like('Catalog_Name',$this->input->get('name'));
			}
			$this->db->order_by('Catalog_Sort DESC,Catalog_Id DESC');
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(Catalog_Id) AS Num');
			$this->db->from('catalog');
			$this->db->where('Catalog_Del','0');
			if($this->input->get('type_id')){
				$this->db->like('Catalog_ParentId',$this->input->get('type_id'));
			}
			if($this->input->get('name')){
				$this->db->like('Catalog_Name',$this->input->get('name'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/catalog/catalog_admin/list/0/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/catalog/catalog_admin/list/0/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select('	Catalog_Id,Catalog_ParentId,Catalog_Image,Catalog_Name,Catalog_Sort,Catalog_Status,Catalog_SeoId,
													DetailSeo_Title,DetailSeo__Keys,DetailSeo__Contents,DetailSeo_SelfContents
												');
			$this->db->from('catalog');
			$this->db->join('detail_seo','detail_seo.DetailSeo_Id = catalog.Catalog_SeoId');
			$this->db->where('Catalog_Del','0');
			$this->db->where('Catalog_Id',$Id);
			$query = $this->db->get();
			$data  = $query->row();

			return $data;
		}
		function Add_Data($DataArray)
		{
			$keys = array(	'Catalog_ParentId',
											'Catalog_Name',
											'Catalog_Sort',
											'Catalog_Status'
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
			//圖片
			if(isset($_FILES['Catalog_Image']) && $_FILES['Catalog_Image']['name'] != "")
			{
				$ImgWH = array(array('width'=>'1024','height'=>'768'));
				$ImgXY = array('x'=>$DataArray['Catalog_Image_x'],'y'=>$DataArray['Catalog_Image_y']);
				$PreWH = array('w'=>$DataArray['Catalog_Image_w'],'h'=>$DataArray['Catalog_Image_h']);

				$UpLoadData = $this->common_process->do_upload('../images/catalog/','Catalog_Image',$ImgWH,$ImgXY,$PreWH);

				if($UpLoadData['Status'] != '0000')
				{
					BackPageMsg($UpLoadData['Error']);
					die;
				}else{
					$data['Catalog_Image'] = $UpLoadData['FileName'];
				}
			}

			//SEO新增
			$SEOInset['DetailSeo_Title'] = ($DataArray['DetailSeo_Title'])?$DataArray['DetailSeo_Title']:$DataArray['Catalog_Name'];
			$SEOInset['DetailSeo__Keys'] = ($DataArray['DetailSeo__Keys'])?$DataArray['DetailSeo_Title']:$DataArray['Catalog_Name'];
			$SEOInset['DetailSeo__Contents'] = ($DataArray['DetailSeo__Contents'])?$DataArray['DetailSeo__Contents']:'';
			if($_SESSION['UserData']['power'] == 2){
			$SEOInset['DetailSeo_SelfContents'] = ($DataArray['DetailSeo_SelfContents'])?$DataArray['DetailSeo_SelfContents']:"";
			}
			$this->db->insert('detail_seo', $SEOInset);
			$SEOId = $this->db->insert_id();

			$data['Catalog_SeoId'] = $SEOId;
			$this->db->insert('catalog', $data);

			jumpPageMsg(_Web_Url.'/catalog/catalog_admin/list/0/'.$DataArray['page'].'?type_id='.$DataArray['type_id'],'新增成功');
		}
		function Edit_Data($DataArray)
		{

			$keys = array(	'Catalog_ParentId',
											'Catalog_Name',
											'Catalog_Sort',
											'Catalog_Status'
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

			//圖片
			//圖片
			if(isset($_FILES['Catalog_Image']) && $_FILES['Catalog_Image']['name'] != "")
			{
				$ImgWH = array(array('width'=>'1024','height'=>'768'));
				$ImgXY = array('x'=>$DataArray['Catalog_Image_x'],'y'=>$DataArray['Catalog_Image_y']);
				$PreWH = array('w'=>$DataArray['Catalog_Image_w'],'h'=>$DataArray['Catalog_Image_h']);

				$UpLoadData = $this->common_process->do_upload('../images/catalog/','Catalog_Image',$ImgWH,$ImgXY,$PreWH);

				if($UpLoadData['Status'] != '0000')
				{
					BackPageMsg($UpLoadData['Error']);
					die;
				}else{
					$data['Catalog_Image'] = $UpLoadData['FileName'];
				}
			}

			$this->db->where('Catalog_Id', $DataArray['id']);
			$this->db->update('catalog', $data);

			$SEOEdit['DetailSeo_Title'] = ($DataArray['DetailSeo_Title'])?$DataArray['DetailSeo_Title']:$DataArray['Catalog_Name'];
			$SEOEdit['DetailSeo__Keys'] = ($DataArray['DetailSeo__Keys'])?$DataArray['DetailSeo_Title']:$DataArray['Catalog_Name'];
			$SEOEdit['DetailSeo__Contents'] = ($DataArray['DetailSeo__Contents'])?$DataArray['DetailSeo__Contents']:'';
			if($_SESSION['UserData']['power'] == 2){
			$SEOEdit['DetailSeo_SelfContents'] = ($DataArray['DetailSeo_SelfContents'])?$DataArray['DetailSeo_SelfContents']:"";
			}
			$this->db->where('DetailSeo_Id', $DataArray['seo_id']);
			$this->db->update('detail_seo', $SEOEdit);

			jumpPageMsg(_Web_Url.'/catalog/catalog_admin/list/0/'.$DataArray['page'],'修改成功');
		}
		function Del_Data($DataArray)
		{
			$NumberList = explode(',',$DataArray['number_list']);
			if(count($DataArray['number_list']) > 0){
				foreach ($NumberList as $row) {
					//關閉
					$Update01 = array(
								 'Catalog_Del' => '1',
								 'Catalog_DelTime' => date("Y-m-d H:i:s"),
							);
					$this->db->where('Catalog_Id', $row);
					$this->db->update('catalog', $Update01);
				}
			}
			return '0000';
		}
		function get_CatalogList()
		{
			$this->db->select("Catalog_Id,Catalog_Name");
			$this->db->from("catalog");
			$this->db->where("Catalog_Del","0");
			$this->db->where("Catalog_Status","1");
			$this->db->order_by("Catalog_Sort DESC");
			$query = $this->db->get();
			$data = $query->result();
			return $data;
		}
	}
?>

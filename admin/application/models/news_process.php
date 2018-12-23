<?
	Class News_process extends CI_Model{
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
			$this->db->select('
													News_Id,News_Status,News_Title,
													News_PulTime,News_EditTime
			');
			$this->db->from('news');
			$this->db->where('News_Del','0');
			if($this->input->get('title')){
				$this->db->like('News_Title',$this->input->get('title'));
			}
			$this->db->order_by("News_AddTime DESC");
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(News_Id) AS Num');
			$this->db->from('news');
			$this->db->where('News_Del','0');
			if($this->input->get('title')){
				$this->db->like('News_Title',$this->input->get('title'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/news/news_admin/list/0/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/news/news_admin/list/0/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select(' News_Id,News_SeoId,News_Status,News_Img,News_Title,News_Content,News_PulTime,News_Img,
													DetailSeo_Title,DetailSeo__Keys,DetailSeo__Contents,DetailSeo_SelfContents
												');
			$this->db->from('news');
			$this->db->join('detail_seo','detail_seo.DetailSeo_Id = news.News_SeoId');
			$this->db->where('News_Del','0');
			$this->db->where('News_Id',$Id);
			$query = $this->db->get();
			$Data  = $query->row();
			unset($query);

			return array('Data' => $Data);
		}
		function Add_Data($DataArray)
		{
			$keys = array(
											'News_Status',
											'News_Title',
											'News_Content',
											'News_PulTime'
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
				$data['News_AddTime'] = date("Y-m-d H:i:s");
				$data['News_EditTime'] = date("Y-m-d H:i:s");
				$data['News_ClickCount'] = rand('50','1000');
				//圖片處理
				if(isset($_FILES['News_Img']) && $_FILES['News_Img']['name'] != "")
				{
					$ImgWH = array(array('width'=>'914','height'=>'529'),array('width'=>'398','height'=>'266','floder'=>'thumbnail'),array('width'=>'150','height'=>'100','floder'=>'right'));
					$ImgXY = array('x'=>$DataArray['News_Img_x'],'y'=>$DataArray['News_Img_y']);
					$PreWH = array('w'=>$DataArray['News_Img_w'],'h'=>$DataArray['News_Img_h']);

					$UpLoadData = $this->data_process->do_upload('../images/news/','News_Img',$ImgWH,$ImgXY,$PreWH);

					if($UpLoadData['Status'] != '0000')
					{
						BackPageMsg($UpLoadData['Error']);
						die;
					}else{
						$data['News_Img'] = $UpLoadData['FileName'];
					}
				}
				//新增SEO
				$Inset02['DetailSeo_Title'] = ($DataArray['DetailSeo_Title'])?$DataArray['DetailSeo_Title']:$DataArray['News_Title'];

				$SEOInset['DetailSeo__Keys'] = ($DataArray['DetailSeo__Keys'])?$DataArray['DetailSeo__Keys']:implode(',',array_merge($RelAreaNews_NameArray,$RelTagNews_NameArray));
				$SEOInset['DetailSeo__Contents'] = ($DataArray['DetailSeo__Contents'])?$DataArray['DetailSeo__Contents']:fafa_text_limit($DataArray['News_Content'],300,'...');
				if($_SESSION['UserData']['power'] == 2){
				$SEOInset['DetailSeo_SelfContents'] = ($DataArray['DetailSeo_SelfContents'])?$DataArray['DetailSeo_SelfContents']:"";
				}
				$this->db->insert('detail_seo', $SEOInset);
				$SEOId = $this->db->insert_id();

				$data['News_SeoId'] = $SEOId;
				$this->db->insert('news', $data);
				$Id = $this->db->insert_id();

				jumpPageMsg(_Web_Url.'/news/news_admin/list/0/'.$DataArray['page'],'新增成功');
		}
		function Edit_Data($DataArray)
		{
			$get_DataById = $this->get_DataById($DataArray['id']);

			$keys = array(
											'News_Status',
											'News_Title',
											'News_Content',
											'News_PulTime'
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
				//圖片處理
				if(isset($_FILES['News_Img']) && $_FILES['News_Img']['name'] != "")
				{
					$ImgWH = array(array('width'=>'914','height'=>'529'),array('width'=>'398','height'=>'266','floder'=>'thumbnail'),array('width'=>'150','height'=>'100','floder'=>'right'));
					$ImgXY = array('x'=>$DataArray['News_Img_x'],'y'=>$DataArray['News_Img_y']);
					$PreWH = array('w'=>$DataArray['News_Img_w'],'h'=>$DataArray['News_Img_h']);

					$UpLoadData = $this->data_process->do_upload('../images/news/','News_Img',$ImgWH,$ImgXY,$PreWH);

					if($UpLoadData['Status'] != '0000')
					{
						BackPageMsg($UpLoadData['Error']);
						die;
					}else{
						$data['News_Img'] = $UpLoadData['FileName'];
					}
				}

				$this->db->where('News_Id', $DataArray['id']);
				$this->db->update('news', $data);

				//更新SEO
				$Updata01['DetailSeo_Title'] = $DataArray['DetailSeo_Title'];
				$Updata01['DetailSeo__Keys'] = $DataArray['DetailSeo__Keys'];
				$Updata01['DetailSeo__Contents'] = mb_substr(strip_tags($DataArray['DetailSeo__Contents']),0,300,'utf8');
				if($_SESSION['UserData']['power'] == 2){
				$Updata01['DetailSeo_SelfContents'] = $DataArray['DetailSeo_SelfContents'];
				}
				$this->db->where('DetailSeo_Id', $get_DataById['Data']->News_SeoId);
				$this->db->update('detail_seo', $Updata01);

				jumpPageMsg(_Web_Url.'/news/news_admin/list/0/'.$DataArray['page'],'修改成功');
		}
		function Del_Data($DataArray)
		{
			$NumberList = explode(',',$DataArray['number_list']);
			if(count($DataArray['number_list']) > 0){
				foreach ($NumberList as $row) {
					$Update01 = array(
								 'News_Del' => '1',
								 'News_DelTime' => date("Y-m-d H:i:s"),
							);

					$this->db->where('News_Id', $row);
					$this->db->update('news', $Update01);
					unset($Update01);
				}
			}
			return '0000';
		}
	}
?>

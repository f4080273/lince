<?
	Class Product_process extends CI_Model{
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
			$this->db->select('product.*,product_catalog.ProductCatalog_CatalogId AS Product_CatalogId');
			$this->db->from('product');
			$this->db->join('product_catalog','ProductCatalog_ProductId = Product_Id');
			if($this->input->get('type_id')){
				$this->db->like('ProductCatalog_CatalogId',$this->input->get('type_id'));
			}
			if($this->input->get('name')){
				$this->db->like('Product_Name',$this->input->get('name'));
			}
			if($this->input->get('contents')){
				$this->db->like('Product_Contents',$this->input->get('contents'));
			}
			$this->db->where('Product_Del','0');
			$this->db->order_by('Product_Id DESC');
			$this->db->limit($PageNum,$Page);
			$query = $this->db->get();
			$DataList  = $query->result();
			unset($query);

			$this->db->select('count(Product_Id) AS Num');
			$this->db->from('product');
			$this->db->where('Product_Del','0');
			if($this->input->get('type_id')){
				$this->db->join('product_catalog','ProductCatalog_ProductId = Product_Id',left);
				$this->db->like('ProductCatalog_CatalogId',$this->input->get('type_id'));
			}
			if($this->input->get('title')){
				$this->db->like('Product_Name',$this->input->get('title'));
			}
			$query = $this->db->get();
			$PageCount = $query->row();
			$PageCount = $PageCount -> Num;
			unset($query);

			$config['next_link']	= '下一頁';
			$config['prev_link']	= '上一頁';
			$config['base_url']		= _Web_Url.'/product/product_admin/list/0/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/product/product_admin/list/0/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('DataList'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id)
		{
			$this->db->select('product.*,detail_seo.*,product_catalog.ProductCatalog_CatalogId AS Product_CatalogId');
			$this->db->from('product');
			$this->db->join('product_catalog','ProductCatalog_ProductId = Product_Id');
			$this->db->join('detail_seo','detail_seo.DetailSeo_Id = product.Product_SeoId');
			$this->db->where('Product_Id',$Id);
			$query = $this->db->get();
			$data  = $query->row();

			return $data;
		}
		function Add_Data($DataArray)
		{
			$keys = array(	'Product_Sku',
											'Product_Name',
											'Product_Contents',
											'Product_Sort',
											'Product_Status',
											'Product_Price'
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

			$data['Product_AddTime'] = date("Y-m-d H:i:s");
			$data['Product_EditTime'] = date("Y-m-d H:i:s");
			//圖片
			if(isset($_FILES['Product_Images']) && $_FILES['Product_Images']['name'] != "")
			{
				$ImgWH = array(array('width'=>'600','height'=>'500'));
				$ImgXY = array('x'=>$DataArray['Product_Images_x'],'y'=>$DataArray['Product_Images_y']);
				$PreWH = array('w'=>$DataArray['Product_Images_w'],'h'=>$DataArray['Product_Images_h']);

				$UpLoadData = $this->common_process->do_upload('../images/product/','Product_Images',$ImgWH,$ImgXY,$PreWH);

				if($UpLoadData['Status'] != '0000')
				{
					BackPageMsg($UpLoadData['Error']);
					die;
				}else{
					$data['Product_Images'] = $UpLoadData['FileName'];
				}
			}
			//SEO新增
			$SEOInset['DetailSeo_Title'] = ($DataArray['DetailSeo_Title'])?$DataArray['DetailSeo_Title']:$DataArray['Product_Name'];
			$SEOInset['DetailSeo__Keys'] = ($DataArray['DetailSeo__Keys'])?$DataArray['DetailSeo_Title']:$DataArray['Product_Name'];
			$SEOInset['DetailSeo__Contents'] = ($DataArray['DetailSeo__Contents'])?$DataArray['DetailSeo__Contents']:fafa_text_limit($DataArray['Product_Contents'],300,'...');
			if($_SESSION['UserData']['power'] == 2){
			$SEOInset['DetailSeo_SelfContents'] = ($DataArray['DetailSeo_SelfContents'])?$DataArray['DetailSeo_SelfContents']:"";
			}
			$this->db->insert('detail_seo', $SEOInset);
			$SEOId = $this->db->insert_id();

			$data['Product_SeoId'] = $SEOId;
			$this->db->insert('product', $data);
			$ProductId = $this->db->insert_id();
			//新增分類
			$Insert = array(
			   'ProductCatalog_ProductId' => $ProductId ,
			   'ProductCatalog_CatalogId' => $data['Product_CatalogId'] ,
			);
			$this->db->insert('product_catalog', $Insert);

			jumpPageMsg(_Web_Url.'/product/product_admin/list/0/'.$DataArray['page'].'?type_id='.$DataArray['type_id'],'新增成功');
		}
		function Edit_Data($DataArray)
		{

			$keys = array(	'Product_Sku',
											'Product_Name',
											'Product_Contents',
											'Product_Sort',
											'Product_Status',
											'Product_Price'
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
			//更新分類
			$Update = array(
               'ProductCatalog_CatalogId' => $DataArray['Product_CatalogId']
            );
			$this->db->where('ProductCatalog_ProductId', $DataArray['id']);
			$this->db->update('product_catalog', $Update);

			//圖片
			if(isset($_FILES['Product_Images']) && $_FILES['Product_Images']['name'] != "")
			{
				$ImgWH = array(array('width'=>'600','height'=>'500'));
				$ImgXY = array('x'=>$DataArray['Product_Images_x'],'y'=>$DataArray['Product_Images_y']);
				$PreWH = array('w'=>$DataArray['Product_Images_w'],'h'=>$DataArray['Product_Images_h']);

				$UpLoadData = $this->common_process->do_upload('../images/product/','Product_Images',$ImgWH,$ImgXY,$PreWH);

				if($UpLoadData['Status'] != '0000')
				{
					BackPageMsg($UpLoadData['Error']);
					die;
				}else{
					$data['Product_Images'] = $UpLoadData['FileName'];
				}
			}

			$data['Product_EditTime'] = date("Y-m-d H:i:s");

			$this->db->where('Product_Id', $DataArray['id']);
			$this->db->update('product', $data);

			$SEOEdit['DetailSeo_Title'] = ($DataArray['DetailSeo_Title'])?$DataArray['DetailSeo_Title']:$DataArray['Product_Name'];
			$SEOEdit['DetailSeo__Keys'] = ($DataArray['DetailSeo__Keys'])?$DataArray['DetailSeo_Title']:$DataArray['Product_Name'];
			$SEOEdit['DetailSeo__Contents'] = ($DataArray['DetailSeo__Contents'])?$DataArray['DetailSeo__Contents']:fafa_text_limit($DataArray['Product_Contents'],300,'...');
			if($_SESSION['UserData']['power'] == 2){
			$SEOEdit['DetailSeo_SelfContents'] = ($DataArray['DetailSeo_SelfContents'])?$DataArray['DetailSeo_SelfContents']:"";
			}
			$this->db->where('DetailSeo_Id', $DataArray['seo_id']);
			$this->db->update('detail_seo', $SEOEdit);

			jumpPageMsg(_Web_Url.'/product/product_admin/list/0/'.$DataArray['page'],'修改成功');
		}
		function Del_Data($DataArray)
		{
			$NumberList = explode(',',$DataArray['number_list']);
			if(count($DataArray['number_list']) > 0){
				foreach ($NumberList as $row) {
					//關閉
					$Update01 = array(
								 'Product_Del' => '1',
								 'Product_DelDate' => date("Y-m-d H:i:s"),
							);
					$this->db->where('Product_Id', $row);
					$this->db->update('product', $Update01);
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

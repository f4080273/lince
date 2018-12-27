<?
	Class Product_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> helper('general');
			$this -> load -> helper('page');
		}
    function get_DataList($Type_id = 0,$Page = 0)
		{
      $this->db->select("Catalog_Id,Catalog_ParentId,Catalog_Name");
			$this->db->from("catalog");
      $this->db->where("Catalog_ParentId",$Type_id);
			$this->db->where("Catalog_Del","0");
			$this->db->where("Catalog_Status","1");
			$query = $this->db->get();
			$InsCatalogs = $query->result();
      $WhereIn = array();
      foreach ($InsCatalogs as $InsCatalog) {
        $WhereIn[] = $InsCatalog->Catalog_Id;
      }

			$PageNum = 200;
			$this->db->select('product.*,product_catalog.ProductCatalog_CatalogId AS Product_CatalogId');
			$this->db->from('product');
			$this->db->join('product_catalog','ProductCatalog_ProductId = Product_Id');
			if(count($WhereIn)){
				$this->db->where_in('ProductCatalog_CatalogId',$WhereIn);
			}else{
        $this->db->where('ProductCatalog_CatalogId',$Type_id);
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
			$this->db->join('product_catalog','ProductCatalog_ProductId = Product_Id');
      if(count($WhereIn)){
				$this->db->where_in('ProductCatalog_CatalogId',$WhereIn);
			}else{
        $this->db->where('ProductCatalog_CatalogId',$Type_id);
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
			$config['base_url']		= _Web_Url.'/product/lts/'.$Type_id.'/';
			$config['total_rows']	= $PageCount;
			$config['per_page']		= $PageNum;
			$config['uri_segment']	= 5;
			$config['first_url'] 	= _Web_Url."/product/lts/'.$Type_id.'/0?".http_build_query($this->input->get());
			$config['suffix'] 		= "?".http_build_query($this->input->get());
			$config = PageCongig($config);
			$this->pagination->initialize($config);
			$PageList = $this->pagination->create_links();

			return array('Data'=>$DataList,'PageList'=>$PageList,'TotalNum'=>$PageCount);
		}
		function get_DataById($Id = 0)
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
    function get_ProdctCatalogById($Id)
		{
  			$this->db->select('	Catalog_Id,Catalog_ParentId,Catalog_Name,Catalog_Sort,Catalog_Status,Catalog_SeoId,Catalog_Image,
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
	}
?>

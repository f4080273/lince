<?
	Class product extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');

			$this -> load -> library('datalib');
			$this -> load -> model('setup');
			$this -> load -> model('common_process');
			$this -> load -> model('product_process');
			$this -> load -> helper('url');
			$this -> load -> helper('general');
		}
		//基本設定
		function setup($Page = 'index')
		{
			$data = $this -> setup -> setup($Page);

			$data['Head']		= $this -> load -> view('/template/head',$data,true);

			$data['get_CatalogProduct'] = $this-> setup ->get_Catalog('356');

			$data['get_CatalogDevice'] = $this-> setup ->get_Catalog('359');

			$data['TopMenu']	= $this -> load -> view('/template/top_menu',$data,true);

			$data['Contact'] = $this -> load -> view('/template/contact',$data,true);

			$data['Footer']		= $this -> load -> view('/template/footer',$data,true);

			return $data;
		}
		//細項SEO設定
		function detail_seo($Head = '',$SeoId = '0')
		{
			$SeoData['SeoData'] = $this->common_process->get_SeoDataById($SeoId);
			if(isset($SeoData['SeoData']->DetailSeo_Id))
			{
				$data	= $this -> load -> view('/template/head',$SeoData,true);
			}
			else{
				$data = $Head;
			}
			return $data;
		}
		function lts($Id = 356,$Page = 0)
		{
			$data = $this -> setup('product');

			$data['Id'] = $Id;

			$data['get_ProdctCatalogById'] = $this-> product_process ->get_ProdctCatalogById($Id);

			$data['get_CatalogProduct'] = $this-> product_process ->get_Catalog('356');

			$data['get_CatalogDevice'] = $this-> product_process ->get_Catalog('359');

			$data['get_DataList'] = $this-> product_process ->get_DataList($Id,$Page);

			$data['Head'] = $this->detail_seo($data['Head'],$data['get_DataList']['Data']->Product_SeoId);

			$this -> load -> view('/product/list',$data);
		}
		public function detail($Type,$Id)
		{
			$data = $this -> setup('product_detail');

			$data['Id'] = $Id;

			$data['get_ProdctCatalogById'] = $this-> product_process ->get_ProdctCatalogById($Id);

			$data['get_Catalog'] = $this-> product_process ->get_Catalog('356');

			$data['get_DataById'] = $this-> product_process ->get_DataById($Id);

			$data['Head'] = $this->detail_seo($data['Head'],$data['get_DataById']->Product_SeoId);

			$this -> load -> view('/product/detail',$data);
		}
	}

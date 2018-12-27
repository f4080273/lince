<?
	Class about extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');

			$this -> load -> library('datalib');
			$this -> load -> model('setup');
			$this -> load -> model('common_process');
			$this -> load -> model('about_process');
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
		function lts($AboutTypeId = 0,$Id = 0,$Page = 0)
		{
			$data = $this -> setup('about:'.$AboutTypeId);

			$data['get_AboutTypeDataById'] = $this-> about_process ->get_AboutTypeDataById($AboutTypeId);

			$data['get_AboutList'] = $this-> about_process ->get_AboutList($Page,$AboutTypeId);

			if($Id){
				$data['get_AboutDataById'] = $this-> about_process ->get_AboutDataById($Id);
			}else{
				$data['get_AboutDataById'] = $this-> about_process ->get_AboutDataById($data['get_AboutList']['ListData'][0]->About_Id);
			}

			$data['Head'] = $this->detail_seo($data['Head'],$data['get_AboutDataById']->About_SeoId);

			$this -> load -> view('/about/list',$data);
		}
	}

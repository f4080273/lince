<?
	Class contact extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');

			$this -> load -> library('datalib');
			$this -> load -> model('setup');
			$this -> load -> model('common_process');
			$this -> load -> model('contact_process');
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
		function index()
		{
			$data = $this -> setup($Id,'contact');

			$this -> load -> view('/contact/index',$data);
		}
		function send_message()
		{

			$data = $this->contact_process->Add_ContactData($this->input->POST());

			echo json_encode($data);
		}
	}

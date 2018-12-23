<?
	Class news extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');

			$this -> load -> library('datalib');
			$this -> load -> model('setup');
			$this -> load -> model('common_process');
			$this -> load -> model('news_process');
			$this -> load -> helper('url');
			$this -> load -> helper('general');
		}
		//基本設定
		function setup($Page = 'index')
		{
			$data = $this -> setup -> setup($Page);

			$data['Head']		= $this -> load -> view('/template/head',$data,true);

			$data['TopMenu']	= $this -> load -> view('/template/top_menu',$data,true);

			$data['Search'] = $this -> load -> view('/template/search',$data,true);

			$get_RightNews = $this-> common_process ->get_RightNews();

			$data['RightNews'] = $this -> load -> view('/template/right_news',$get_RightNews,true);

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
		function lts($Page = 0)
		{
			$data = $this -> setup('news');

			$data['get_NewsList'] = $this->news_process->get_NewsList($Page);

			$this -> load -> view('/news/list',$data);
		}
		function detail($NewsId = 0)
		{
			$data = $this -> setup('news');

			$data['get_NewsDataById'] = $this->news_process->get_NewsDataById($NewsId);

			$data['Head'] = $this->detail_seo($data['Head'],$data['get_NewsDataById']->News_SeoId);

			$this -> load -> view('/news/detail',$data);
		}
	}

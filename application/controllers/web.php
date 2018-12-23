<?
	Class web extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->helper('url');

			$this -> load -> library('datalib');
			$this -> load -> model('setup');
			$this -> load -> model('common_process');
			$this -> load -> helper('url');
			$this -> load -> helper('general');
		}
		//基本設定
		function setup($Page = 'index')
		{
			$data = $this -> setup -> setup($Page);

			$data['Head']		= $this -> load -> view('/template/head',$data,true);

			$data['TopMenu']	= $this -> load -> view('/template/top_menu',$data,true);

			$data['Footer']		= $this -> load -> view('/template/footer',$data,true);

			return $data;
		}
		//細項SEO設定
		function detail_seo($SeoId = '0')
		{
			$SeoData['SeoData'] = $this->common_process->get_SeoDataById($SeoId);

			$data	= $this -> load -> view('/template/head',$SeoData,true);

			return $data;
		}
		function index()
		{
			$data = $this -> setup('index');

			$data['get_IndexNewsList'] =	$this-> common_process ->get_IndexNewsList('7');

			$data['get_IndexAboutList'] = $this-> common_process ->get_IndexAboutList();

			$this -> load -> view('/index',$data);
		}
		function error($value='')
		{
			$data = $this -> setup($Id,'error');

			$data['Error_Message'] = $value;

			$this -> load -> view($data['WebConfig']->WebConfig_Template.'/error',$data);
		}
		function captcha()
		{
			$data = simple_php_captcha( array(
			    'min_length' => 5,
			    'max_length' => 5,
			    'min_font_size' => 28,
			    'max_font_size' => 28,
			    'color' => '#666',
			    'angle_min' => 0,
			    'angle_max' => 10,
			    'shadow' => true,
			    'shadow_color' => '#fff',
			    'shadow_offset_x' => -1,
			    'shadow_offset_y' => 1
			));
			echo $data['image_src'];
		}
	}

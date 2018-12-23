<?
	Class Contact_process extends CI_Model{
	    function __construct(){
			parent::__construct();
			$this -> load -> database();
			$this -> load -> library('pagination');
			$this -> load -> helper('general');
			$this -> load -> helper('page');

			$this -> load -> model('common_process');
		}
		function Add_ContactData($DataArray)
		{
			$this->db->select('type,varA,varB');
			$this->db->from('mapping');
			$this->db->where('type','mail_profile');
			$query = $this -> db -> get();
			$MailProfile	= $query -> row();


			$Insert01 = array(
													'Contact_Name'=>$DataArray['name'],
													'Contact_Content'=>$DataArray['message'],
													'Contact_Email'=>$DataArray['email'],
													'Contact_Tel'=>$DataArray['tel'],
													'Contact_Phone'=>$DataArray['phone'],
													'Contact_Sex'=>$DataArray['sex'],
													'Contact_Address'=>$DataArray['address'],
													'Contact_ContractT'=>$DataArray['contract_t'],
													'Contact_Ask'=>$DataArray['ask'],
													'Contact_AddTime'=>date("Y-m-d H:i:s")
			);
			$this->db->insert('contact',$Insert01);
			//寄信
			$MailHtml = "";
			$MailHtml .= "<p>病人姓名:{$DataArray['name']}</p>";
			$MailHtml .= "<p>病人性別:{$this->sex($DataArray['sex'])}</p>";
			$MailHtml .= "<p>Email/臉書:{$DataArray['email']}</p>";
			$MailHtml .= "<p>行動電話:{$DataArray['phone']}</p>";
			$MailHtml .= "<p>市話:{$DataArray['tel']}</p>";
			$MailHtml .= "<p>地址:{$DataArray['address']}</p>";
			$MailHtml .= "<p>聯絡時間:{$DataArray['contract_t']}</p>";
			$MailHtml .= "<p>協助事項:{$this->fafa_contract_ask($DataArray['ask'])}</p>";
			$MailHtml .= "<p>諮詢內容:{$DataArray['message']}</p>";
			$this-> common_process ->send_Email($MailProfile->varA,'聯絡我們有一封信',$MailProfile->varB,$MailHtml);
			return array('Status'=>'0000','Msg'=>'發送成功');
		}
		function sex($value='')
		{
			if($value == 1){return '男';}else{return '女';};
		}
		function fafa_contract_ask($Id)
		{
		  switch ($Id) {
		    case '1':
		      $data = '居家醫療服務';
		      break;
		    case '2':
		      $data = '居家護理服務';
		      break;
		    case '3':
		      $data = '暫時或臨時全日型';
		      break;
		    case '4':
		      $data = '半日型托顧服務';
		      break;
		    case '5':
		      $data = '自費全日型或半日型托顧服務';
		      break;
		    case '6':
		      $data = '成人健檢服務';
		      break;
		    case '7':
		      $data = '流感疫苗接種服務';
		      break;
		    case '8':
		      $data = '自費四價流感疫苗';
		      break;
		    case '9':
		      $data = '老人肺炎雙球菌疫苗接種服務';
		      break;
		      default:
		      $data = '請在新增 helpers/fafa_contract_ask 之參數';
		      break;
		  }
		  return $data;
		}
	}
?>

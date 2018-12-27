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
			if($DataArray['name'] == '')
			{
				return false;
			}
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
			$MailHtml .= "<p>姓名:{$DataArray['name']}</p>";
			$MailHtml .= "<p>公司名稱:{$DataArray['contract_t']}</p>";
			$MailHtml .= "<p>電子郵件:{$DataArray['email']}</p>";
			$MailHtml .= "<p>聯絡電話:{$DataArray['phone']}</p>";
			$MailHtml .= "<p>聯絡主旨:".fafa_contract_ask($DataArray['ask'])."</p>";
			$MailHtml .= "<p>聯絡訊息:{$DataArray['message']}</p>";
			$this-> common_process ->send_Email($MailProfile->varA,'聯絡我們有一封信',$MailProfile->varB,$MailHtml);
			return array('Status'=>'0000','Msg'=>'發送成功');
		}
		function sex($value='')
		{
			if($value == 1){return '男';}else{return '女';};
		}
	}
?>

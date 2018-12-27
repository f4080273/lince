<?
function News_BannerModeName($Id)
{
  switch ($Id) {
    case '0':
      $data = '無';
      break;
    case '1':
      $data = '照片';
      break;
    case '2':
      $data = '影片';
      break;
    default:
      $data = '未知';
      break;
  }
  return $data;
}
function News_GradingName($Id)
{
  switch ($Id) {
    case '0':
      $data = '無';
      break;
    case '1':
      $data = '18歲以上';
      break;
    default:
      $data = "未知";
      break;
  }
  return $data;
}
function Power($Id)
{
  switch ($Id) {
    case '2':
      $data = '管理者';
      break;
    case '1':
    case '0':
    default:
      $data = "一般";
      break;
  }
  return $data;
}
function fafa_array_column($DataArray,$ColumnName)
{
  $NewArray = array();
  foreach ($DataArray as $key => $value) {
    $NewArray[$key] = $value[$ColumnName];
  }
  return $NewArray;
}
function fafa_text_limit($Str='',$Num=10,$text='')
{
  $Str = strip_tags($Str);
  $data = ((mb_strlen($Str, "UTF8")>$Num) ? mb_substr($Str,0,$Num, "UTF8") : $Str).' '.((mb_strlen($Str, "UTF8")>$Num) ? nl2br($text) : nl2br(''));
  return  $data;
}
function ImgUploadTemplate($Name,$Width = '500',$Height = '500',$Img = '')
{
  if($Img){
		$OrgImg = "<img class='cropbox' src='{$Img}' />";
	}else{
		$OrgImg = "<img class='cropbox' src='"._Web_Url."/no_img.png' />";
	}
	$Html = "<div class='form-group mode_banner'>
						<input type='hidden' name='{$Name}_oldimg' value='".pathinfo($Img,PATHINFO_BASENAME)."'>
						<label for='textfield'>圖片(請上傳 寬{$Width}px 高{$Height}px)</label>
						<div class='fileupload fileupload-new text-center' data-provides='fileupload'>
								<div class='fileupload-new thumbnail'>
								{$OrgImg}
								</div>
								<div class='fileupload-preview fileupload-exists thumbnail' max-width='{$Width}' data-defw='{$Width}' data-defh='{$Height}'></div>
								<div style='height:50px;'>
										<button type='button' class='btn btn-secondary btn-file'>
												<span class='fileupload-new'><i class='fa fa-paper-clip'></i> 選擇圖片</span>
												<span class='fileupload-exists'><i class='fa fa-undo'></i> 更換圖片</span>
												<input type='file' class='btn-secondary' name='$Name' />
										</button>
								</div>
						</div>
						<input type='hidden' class='x' name='{$Name}_x' />
						<input type='hidden' class='y' name='{$Name}_y' />
						<input type='hidden' class='w' name='{$Name}_w' />
						<input type='hidden' class='h' name='{$Name}_h' />
					</div>";
	return $Html;
}
function fafa_contract_ask($Id)
{
  switch ($Id) {
    case '1':
      $data = '聯絡主旨';
      break;
    case '2':
      $data = '聯絡主旨';
      break;
    case '3':
      $data = '聯絡主旨';
      break;
    case '4':
      $data = '聯絡主旨';
      break;
    case '5':
      $data = '聯絡主旨';
      break;
    case '6':
      $data = '聯絡主旨';
      break;
    case '7':
      $data = '聯絡主旨';
      break;
    case '8':
      $data = '聯絡主旨';
      break;
    case '9':
      $data = '聯絡主旨';
      break;
      default:
      $data = '請在新增 helpers/fafa_contract_ask 之參數';
      break;
  }
  return $data;
}
